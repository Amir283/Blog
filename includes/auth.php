<?php

// Return the user authentication status - true if a user is logged in, false if not
 
function isLoggedIn()
{
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
}
