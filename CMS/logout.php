<?php

//start session management
session_start();

//remove all session variables
session_unset();

//destroy the session
session_destroy();

//Echo result to user
echo 'ok';

?>