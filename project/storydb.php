<?php

//USERS TABLE
function select_user_id($email) {
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

function select_password($email) {
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

function add_user($email, $password) {
    global $db;
    $query = 'INSERT INTO users
                 (email, password)
              VALUES
                 (:email, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();
}

function update_password($user_id, $new_password) {
    global $db;
    $query = 'UPDATE users
             SET password = :password
             WHERE user_id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':password', $new_password);
    $statement->execute();
    $statement->closeCursor();
}

//STEPS TABLE
function select_total_steps($user_id) {
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

function edit_total_steps($total_steps, $user_id) {
    global $db;
    $query = 'UPDATE steps
                    SET total_steps = :total_steps
                    WHERE user_id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':total_steps', $total_steps);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_total_steps($user_id, $total_steps) {
    global $db;
    $query = 'INSERT INTO steps
                 (user_id, total_steps)
              VALUES
                 (:user_id, :total_steps)';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':total_steps', $total_steps);
    $statement->execute();
    $statement->closeCursor();
}

function delete_total_steps($user_id) {
    global $db;
    $query = 'DELETE FROM steps
             WHERE user_id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $statement->closeCursor();
}

//ITEMS TABLE
function select_item_name($user_id) {
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

function select_item_name_based_on_user_and_name($user_id, $item_name) {
    global $db;
    $query = 'SELECT item_name
                FROM items 
                WHERE user_id = :user_id && item_name = :item_name';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':item_name', $item_name);
    $statement->execute();
    $spec_item = $statement->fetch();
    $statement->closeCursor();
    return $spec_item;
}

function select_item_description($item_name) {
    global $db;
    $query = 'SELECT item_description 
                FROM items 
                WHERE item_name = :item_name';
    $statement = $db->prepare($query);
    $statement->bindValue(':item_name', $item_name);
    $statement->execute();
    $item_description = $statement->fetch();
    $statement->closeCursor();
    return $item_description;
}

function add_item($user_id, $item_name, $item_description) {
    global $db;
    $query = 'INSERT INTO items
                 (user_id, item_name, item_description)
              VALUES
                 (:user_id, :item_name, :item_description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':item_name', $item_name);
    $statement->bindValue(':item_description', $item_description);
    $statement->execute();
    $statement->closeCursor();
}

function delete_items($user_id) {
    global $db;
    $query = 'DELETE FROM items
             WHERE user_id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $statement->closeCursor();
}

//ACTIONS TABLE
function select_action_text($user_id) {
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
