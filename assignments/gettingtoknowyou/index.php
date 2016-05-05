<?php
$action = filter_input(INPUT_POST,'action');

if ($action == NULL || $action == "") {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        require ('../views/gettingtoknowyou.html');
    }
}

if ($action == 'submit_gettingtoknowyou') {
    $name = filter_input(INPUT_POST, 'name');
    
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    
    $major = filter_input(INPUT_POST, 'major');
    
    if ($major == NULL) {
        $major = 'undecided';
    }
    
    $places = filter_input(INPUT_POST, 'places', FILTER_REQUIRE_ARRAY);
    
    if ($name != NULL || $name != "" || $email != NULL || $email != "" || $major != NULL) {
        require ('../views/whoyouare.html');
    }
}
