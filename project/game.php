<?php

use shannon\multifunctions as f;

require ('database.php');
require ('storydb.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Personal Project</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <header>
            <h1 class="title_top">Game Page</h1>
        </header>
        <nav>
            <ul class="nav_ul">
                <li class="nav_li"><a href="index.html">Home</a></li>
                <li class="nav_li"><a href="assignments.html">Assignments</a></li>
                <li class="nav_li"><a href="aboutme.html">About Me</a></li>
                <li class="nav_li" id="proj_color"><a href="personalproject.html">Project</a></li>
            </ul>
        </nav>
        <img src="../spiderweb.jpg" alt="spiderweb" width="800" height="300">

        <?php
        $error = "";
        $variable = "";
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        //Check if email is in database
        $user_id_array = select_user_id($email);
        if ($email != NULL && $email != "" && $password != NULL && $password != "") {
            //If email isn't null, check to see if password is correct
            if ($user_id_array != NULL && $user_id_array != "") {
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
                    $variable = 'send_to_gamepage';
                    //include './gamepage.php';
                    echo ('Email: ' . $email . '<br>');
                    echo ('Password: ' . $password);
                } else {
                    //If password is wrong, send user to wrong password page
                    require ('./changepassword.php');
                }
            } else {
                //If user id is wrong, error it
                $error = "Please enter a correct username. Thank you.";
            }
        } else {
            $error = "Please enter an email and a password. Thank you.";
        }
        ?>
        <?php if ($variable == "") { ?>
            <h2>Log In Page is under construction</h2>
            <form action="./game.php" method="post">
                <?php echo $error ?>
                <table>
                    <tr>
                        <td>Email:</td>
                        <td><input type="text" name="email"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Log In" /></td>
                    </tr>
                </table>
            </form>
        <?php } else if ($variable == "send_to_gamepage") { ?>
            <h2>Game Page is under construction.</h2>
            <?php
            if ($user_id_array != NULL || $user_id_array != "") {
                $count = COUNT($user_id_array);
                $index = $count - 2;
                //create loop about array that selects correct column.
                for ($i = 0; $i <= $index; $i++) {
                    $user_id = $user_id_array[$i];
                }

                $total_steps_array = select_total_steps($user_id);

                $count = COUNT($total_steps_array);
                $index = $count - 2;
                //create loop about array that selects correct column.
                for ($i = 0; $i <= $index; $i++) {
                    $total_steps = $total_steps_array[$i];
                }

                $items_array = select_item_name($user_id);
            }
            ?>

            <table>
                <tr>
                    <td>Total Steps:</td>
                    <td><?php echo $total_steps ?></td>
                    <td>&nbsp;</td>
                </tr>

                <?php foreach ($items_array as $item): ?>   
                    <?php $value = $item[0]; ?>
                    <?php echo "<tr><td>Item: </td> <td>" . $value . "</td>" ?>           
                    <?php echo "<td>" ?>
                    <?php
                    $item_descriptions_array = select_item_description($value);
                    $desc_count = COUNT($item_descriptions_array);
                    $desc_index = $count - 2;
                    ?>
                    <?php for ($i = 0; $i <= $index; $i++) : ?>
                        <?php $item_description = $item_descriptions_array[$i]; ?>
                        <?php echo $item_description ?>
                    <?php endfor; ?>
                    <?php " </td> </tr>" ?>
                <?php endforeach; ?>
                <?php $actions_array = select_action_text($user_id) ?>
                <?php foreach ($actions_array as $action) : ?>
                    <?php $value = $action[0]; ?>
                    <?php echo "<tr><td>Action: </td> <td>" . $value . "</td>" ?>  
                    <?php echo "<td> &nbsp; </td> </tr>" ?>
                <?php endforeach ?>
            </table>
        <?php } else { ?>

        <?php } ?>
    </body>
</html>