<?php

session_start();

if(isset($_SESSION['loggedInUserId']))
{
    $_SESSION = array();

}

header("Location: login.php");

