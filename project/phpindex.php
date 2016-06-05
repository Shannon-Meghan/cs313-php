<?php

$lifetime = 60 * 60 * 24 * 1;
session_set_cookie_params($lifetime, '/');
session_start();

require ('./database.php');
require ('./storydb.php');

$action = filter_input(INPUT_POST, 'action');
$error = "";

if ($action == "" || $action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        require ("./signin.php");
    }
}

switch ($action) {
    case 'signin':
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');


        //Check if email is in database
        $user_id_array = select_user_id($email);
        if ($email != NULL && $email != "" && $password != NULL && $password != "") {
            //If email isn't null, check to see if password is correct
            if ($user_id_array != NULL && $user_id_array != "") {
                $useridcount = COUNT($user_id_array);
                $useridindex = $useridcount - 2;
                //create loop about array that selects correct column.
                for ($i = 0; $i <= $useridindex; $i++) {
                    $userid = $user_id_array[$i];
                }

                //If password is correct, send user to game page
                $correct_password_array = select_password($email);

                //Grab password from array
                $count = COUNT($correct_password_array);
                $index = $count - 2;
                //create loop about array that selects correct column.
                for ($i = 0; $i <= $index; $i++) {
                    $correct_password = $correct_password_array[$i];
                }

                if ($correct_password == $password) {
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['userid'] = $userid;
                    $totalsteps_array = select_total_steps($userid);
                    if ($totalsteps_array != NULL || $totalsteps_array != "") {
                        $count = COUNT($totalsteps_array);
                        $index = $count - 2;
                        //create loop about array that selects correct column.
                        for ($i = 0; $i <= $index; $i++) {
                            $totalsteps = $totalsteps_array[$i];
                        }
                    } else {
                        $totalsteps = 0;
                    }
                    require './stepsentry.php';
                } else {
                    //If password is wrong, send user to wrong password page
                    require ('./changepassword.php');
                }
            } else {
                //If user id is wrong, error it
                $error = "Please enter a correct username. Thank you.";
                require 'signin.php';
            }
        } else {
            $error = "Please enter an email and a password. Thank you.";
            require 'signin.php';
        }

        break;
    case 'signup':
        $new_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $new_password = filter_input(INPUT_POST, 'password');
        //$user_id_array = select_user_id($new_email);
        //if ($user_id_array != NULL && $user_id_array != "") {
        //    $count = COUNT($user_id_array);
        //    $index = $count - 2;
        //    //create loop about array that selects correct column.
        //    for ($i = 0; $i <= $index; $i++) {
        //        $userid = $user_id_array[$i];
        //    }
        //    $_SESSION['userid'] = $userid;
        //}

        if ($new_email == NULL || $new_email == "" || $new_password == NULL || $new_password == "") {
            $error = "Please input a valid email and password.";
            require './signup.php';
        } else {
            $user_id_array = select_user_id($new_email);
            if ($user_id_array != NULL || $user_id_array != "") {
                $error = "This email is already taken. Please enter a new one or sign in. If you've forgotten your password, please reset it.";
                echo $error;
                require './signup.php';
            } else {
                //add information into table
                $_SESSION['email'] = $new_email;
                $_SESSION['password'] = $new_password;

                add_user($new_email, $new_password);

                $user_id_array = select_user_id($new_email);

                if ($user_id_array != NULL && $user_id_array != "") {
                    $count = COUNT($user_id_array);
                    $index = $count - 2;
                    //create loop about array that selects correct column.
                    for ($i = 0; $i <= $index; $i++) {
                        $userid = $user_id_array[$i];
                    }
                    $_SESSION['userid'] = $userid;
                }

                require './signupsuccess.php';
            }
        }
        break;
    case 'changepassword' :
        $userid = $_SESSION['userid'];
        $new_password = filter_input(INPUT_POST, 'new_password');
        if ($new_password != "" || $new_password != NULL) {
            $error = "";
            update_password($userid, $new_password);
            $_SESSION['password'] = $new_password;
            require('./newpasswordsuccess.php');
        } else {
            $error = "Please enter a new password.";
            require ('changepassword.php');
        }
        break;
    case 'stepentry':
        $email = $_SESSION['email'];
        $userid = $_SESSION['userid'];

        $totalsteps_array = select_total_steps($userid);
        $count = COUNT($totalsteps_array);
        $index = $count - 2;
        //create loop about array that selects correct column.
        if ($totalsteps_array == NULL || $totalsteps_array == "") {
            $totalsteps = 0;
        } else {
            for ($i = 0; $i <= $index; $i++) {
                $totalsteps = $totalsteps_array[$i];
            }
        }
        require ('./stepsentry.php');
        break;
    case 'enter_newsteps':

        $new_steps = filter_input(INPUT_POST, 'new_steps');
        $userid = $_SESSION['userid'];

        $totalsteps_array = select_total_steps($userid);
        if ($totalsteps_array != NULL || $totalsteps_array != "") {
            if ($totalsteps_array != NULL || $totalsteps_array != "") {
                $count = COUNT($totalsteps_array);
                $index = $count - 2;
                //create loop about array that selects correct column.
                for ($i = 0; $i <= $index; $i++) {
                    $totalsteps = $totalsteps_array[$i];
                }
            } else {
                $totalsteps = '0';
            }

            $totalsteps += $new_steps;

            edit_total_steps($totalsteps, $userid);

            $new_totalsteps_array = select_total_steps($userid);
            $new_count = COUNT($new_totalsteps_array);
            $new_index = $new_count - 2;
            //create loop about array that selects correct column.
            for ($i = 0; $i <= $new_index; $i++) {
                $newtotalsteps = $new_totalsteps_array[$i];
            }
            $click = false;
        } else {
            if ($totalsteps_array != NULL || $totalsteps_array != "") {
                $count = COUNT($totalsteps_array);
                $index = $count - 2;
                //create loop about array that selects correct column.
                for ($i = 0; $i <= $index; $i++) {
                    $totalsteps = $totalsteps_array[$i];
                }
            } else {
                $totalsteps = '0';
            }

            $totalsteps += $new_steps;

            add_total_steps($userid, $totalsteps);

            $new_totalsteps_array = select_total_steps($userid);
            $new_count = COUNT($new_totalsteps_array);
            $new_index = $new_count - 2;
            //create loop about array that selects correct column.
            for ($i = 0; $i <= $new_index; $i++) {
                $newtotalsteps = $new_totalsteps_array[$i];
            }
            $click = false;
        }
        require ('./game.php');
        break;
    case 'startover' :
        $user_id = $_SESSION['userid'];
        delete_total_steps($user_id);
        delete_items($user_id);
        $totalsteps = select_total_steps($user_id);
        require ('./stepsentry.php');
        break;
    case 'game':
        $email = $_SESSION['email'];
        $user_id_array = select_user_id($email);
        if ($user_id_array != NULL || $user_id_array != "") {
            $count = COUNT($user_id_array);
            $index = $count - 2;
            //create loop about array that selects correct column.
            for ($i = 0; $i <= $index; $i++) {
                $user_id = $user_id_array[$i];
            }

            $total_steps_array = select_total_steps($user_id);

            if ($total_steps_array != NULL || $total_steps_array != "") {
                $count = COUNT($total_steps_array);
                $index = $count - 2;
                //create loop about array that selects correct column.
                for ($i = 0; $i <= $index; $i++) {
                    $total_steps = $total_steps_array[$i];
                }
            } else {
                $total_steps = 0;
            }

            $items_array = select_item_name($user_id);
            $click = true;

            $story = "";

            for ($i = 0; $i <= $total_steps; $i += 2000) {

                if ($i < 10000) {
                    $num = rand(1, 3);
                    switch ($num) {
                        case (1) :
                            $story .= "A zombie attacked you but you limped away. <br><br>";
                            break;
                        case (2) :
                            $story .= "You tripped over a tree root. Ouch! <br><br>";
                            break;
                        case (3) :
                            $story .= "A bird has started making a nest in your hair. The apocalypse is no excuse for bad hygiene. <br><br>";
                            break;
                    }
                } else if ($i == 10000) {
                    $story .= "<b>You stumbled upon your dog who you thought was dead. It was a joyous reunion. <br><br></b>";
                    $item_name = 'Zombie Dog';
                    $item_description = 'Once a large but sweet house dog, in the time that you and your dog were apart, he has transformed into a zombie dog who has the '
                            . 'strength of the zombie with the loyalty of a dog. Just make sure not to let him lick your face after he rips your foes heads off.';
                    $db_item_array = select_item_name_based_on_user_and_name($user_id, $item_name);
                    if ($db_item_array == false || $db_item_array == "" || $db_item_array == NULL) {
                        add_item($user_id, $item_name, $item_description);
                    }
                } else if ($i > 10000 && $i < 70000) {
                    $num = rand(1, 6);
                    switch ($num) {
                        case (1) :
                            $story .= "A zombie attacked you. Luckily your dog bit it and dragged it off of you. You walked away with torn pants. <br><br>";
                            break;
                        case (2) :
                            $story .= "You tripped over a tree root. Ouch! Your dog nudged you with his nose to help you up. <br><br>";
                            break;
                        case (3) :
                            $story .= "Your dog chases the birds that eye your messy hair. <br><br>";
                            break;
                    }
                } else if ($i == 70000) {
                    $story .= "<b>You and your dog fight through a swarm of zombies. At the last minute one grabs you and drags you down. "
                            . "Your dog tears it's head off. You grab a knife off of it and stab the last zombie into the ground allowing your dog to tear it's head off.<br><br></b>";
                    $item_name = 'Knife';
                    $item_description = 'A dull blade that allows you to hack a zombies head off. It takes a lot of hacking but you will eventually manage it.';
                    $db_item_array = select_item_name_based_on_user_and_name($user_id, $item_name);
                    if ($db_item_array == false || $db_item_array == "" || $db_item_array == NULL) {
                        add_item($user_id, $item_name, $item_description);
                    }
                } else if ($i > 70000 && $i < 140000) {
                    $num = rand(1, 3);
                    switch ($num) {
                        case (1) :
                            $story .= "A zombie attacked you. You push them off with your knife and your dog takes of its head. <br><br>";
                            break;
                        case (2) :
                            $story .= "You tripped over a tree root and knick yourself. Ouch! Your dog licks at your wound. <br><br>";
                            break;
                        case (3) :
                            $story .= "Your dog chases the birds that eye your messy hair. <br><br>";
                            break;
                    }
                } else if ($i == 140000) {
                    $story .= "<b>While you're cutting up a loaf of bread you found in an abandoned market, your dog sniffs out a medical bag. You gain a medical bag!<br><br></b>";
                    $item_name = 'Medical Bag';
                    $item_description = 'This is a bag of all the medical essentials: band aids, thread, and wound wraps.';
                    $db_item_array = select_item_name_based_on_user_and_name($user_id, $item_name);
                    if ($db_item_array == false || $db_item_array == "" || $db_item_array == NULL) {
                        add_item($user_id, $item_name, $item_description);
                    }
                } else if ($i > 140000 && $i < 210000) {
                    $num = rand(1, 3);
                    switch ($num) {
                        case (1) :
                            $story .= "A zombie attacked you. You push them off with your knife and your dog takes of its head. It leaves a wound that you quickly stitch up. <br><br>";
                            break;
                        case (2) :
                            $story .= "You tripped over a tree root and knick yourself. Ouch! Your dog tries to lick your wound but you wrap it up first. Good job dodging doggy slobber! <br><br>";
                            break;
                        case (3) :
                            $story .= "The birds aim for your messy hair. Your dog is able to chase of most of them. One gets through and scratches you. You pull out your meical bag"
                                    . " and fix it up. <br><br>";
                            break;
                    }
                } else if ($i == 210000) {
                    $story .= "<b>Your wondering through the city when you come across a police station. You walk in and find a friendly group of people. They offer you a leather jacket"
                            . " to help guard you from the zombie bites.<br><br></b>";
                    $item_name = 'Leather Jacket';
                    $item_description = "A thick leather jacket that protects you from zombie bites aimed towards your torso and arms.";
                    $db_item_array = select_item_name_based_on_user_and_name($user_id, $item_name);
                    if ($db_item_array == false || $db_item_array == "" || $db_item_array == NULL) {
                        add_item($user_id, $item_name, $item_description);
                    }
                } else if ($i > 210000 && $i < 250000) {
                    $num = rand(1, 3);
                    switch ($num) {
                        case (1) :
                            $story .= "You and your new group of friends go out hunting for supplies. Along the way, you get attacked by a horde of zombies. "
                                    . "One bites your arm but you're wearing your leather jacket and it doesn't bite through. You stab it in the face with your knife "
                                    . "and your dog beheads it. <br><br>";
                            break;
                        case (2) :
                            $story .= "You come across a group of kids while you're searching for suppies. Your zombie dog keeps them safe as they pet him and you and your group "
                                    . "take out the horde. <br><br>";
                            break;
                        case (3) :
                            $story .= "You trip and fall into a dry pool. You catch yourself with your arms but it doesn't really hurt because of your leather jacket. <br><br>";
                            break;
                    }
                } else if ($i == 250000) {
                    $story .= "<b>You found a box full of firework supplies. You give most of them away to the kids in your group but you keep the poppers for future use.<br><br></b>";
                    $item_name = 'Popper Fireworks';
                    $item_description = "Quite a few boxes of popper fireworks. They make a loud noise when you throw them on the ground.";
                    $db_item_array = select_item_name_based_on_user_and_name($user_id, $item_name);
                    if ($db_item_array == false || $db_item_array == "" || $db_item_array == NULL) {
                        add_item($user_id, $item_name, $item_description);
                    }
                } else if ($i > 250000 && $i < 350000) {
                    $num = rand(1, 3);
                    switch ($num) {
                        case (1) :
                            $story .= "A horde attacks your group of friends but you throw a ton of poppers at them. They're so confused, you're able to get away.<br><br>";
                            break;
                        case (2) :
                            $story .= "A zombie grabs your arm but you throw a handful of poppers at it's face. It falls onto the ground and you stab it through it's chest"
                                    . " and into the ground. Your zombie dog decapitates it.<br><br>";
                            break;
                        case (3) :
                            $story .= "You trip and fall into a dry pool. You drop a bunch of poppers, creating a loud noise. Oops! Your group is attacked by zombies. <br><br>";
                            break;
                    }
                } else if ($i == 350000) {
                    $story .= "<b>One of your group members steals the last of your poppers but they drop it making a lot of noise and end up getting consumed by a horde of "
                            . "zombies. You steal their shotgun. With this, you can get out of the city. You'll have to ditch everyone though.<br><br></b>";
                    $item_name = 'Shotgun';
                    $item_description = "Aim for the head. One shot and the zombie is dead. It does crate a loud noise though.";
                    $db_item_array = select_item_name_based_on_user_and_name($user_id, $item_name);
                    if ($db_item_array == false || $db_item_array == "" || $db_item_array == NULL) {
                        add_item($user_id, $item_name, $item_description);
                    }
                } else if ($i > 350000 && $i < 420000) {
                    $num = rand(1, 3);
                    switch ($num) {
                        case (1) :
                            $story .= "A horde of zombies attacks you. You dispatch them with your shotgun. Your dog beheads the rest. It's glorious.<br><br>";
                            break;
                        case (2) :
                            $story .= "you trip over your feet and accidentally fire your gun into zombie dog. He is not amused.<br><br>";
                            break;
                        case (3) :
                            $story .= "A bunch of birds eye you from afar as you make your way through the city. The dog keeps most away but you kill an especially brave one"
                                    . " for dinner later.<br><br>";
                            break;
                    }
                }
            }
            require ('./game.php');
        }
        break;
    case 'show_signup':
        require ('./signup.php');
        break;
    case 'sendto_stepentry':
        require ('./stepentry.php');
        break;
    case 'show_signin':
        require ('./sign_in.php');
        break;
}
?>