<?php

//USERS TABLE
function select_user_id($email){
    global $db;
    $query = 'SELECT user_id 
                FROM users 
                WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $user_id = $statement->fetch();
    $statement->closeCursor();
    return $user_id;
}

function select_password($email){
    global $db;
    $query = 'SELECT password 
                FROM users
                WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $password = $statement->fetch();
    $statement->closeCursor();
    return $password;
}

//STEPS TABLE
function select_total_steps($user_id){
    global $db;
    $query = 'SELECT total_steps 
                FROM steps 
                WHERE user_id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $total_steps = $statement->fetch();
    $statement->closeCursor();
    return $total_steps;
}

//ITEMS TABLE
function select_item_name($user_id){
    global $db;
    $query = 'SELECT item_name
                FROM items 
                WHERE user_id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $item_name = $statement->fetchAll();
    $statement->closeCursor();
    return $item_name;
}

function select_item_description($item_name){
    global $db;
    $query = 'SELECT item_description 
                FROM items 
                WHERE item_name = :item_name';
    $statement = $db->prepare($query);
    $statement->bindValue(':item_name',  $item_name);
    $statement->execute();
    $item_description = $statement->fetch();
    $statement->closeCursor();
    return $item_description;
}

//ACTIONS TABLE
function select_action_text($user_id){
    global $db;
    $query = 'SELECT action_text
                FROM actions 
                WHERE user_id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $action_text = $statement->fetchAll();
    $statement->closeCursor();
    return $action_text;    
}