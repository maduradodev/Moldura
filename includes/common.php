<?php

date_default_timezone_set("America/Bahia");

define("BASE_URL", "https://madurado.tech/Viatris/camera/");

// Starts session on every page
session_start();

if(!isset($_SESSION['is_logged'])){
    // User is not currently logged
    $_SESSION['is_logged'] = FALSE;
}