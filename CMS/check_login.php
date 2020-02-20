<?php

//Start session management
session_start();

//Set a session variable
if( array_key_exists("loggedInUserUsername", $_SESSION)) {
    echo "ok";
}
else{
    echo 'Not logged in.';
}







