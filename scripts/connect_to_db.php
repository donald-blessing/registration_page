<?php

/*
 * This file contains codes for connecting to mysql and the e-commerce databse.
 * Ensure that the file is being included and not called directly
 */

//if (FILE_INCLUDE !== 'TRUE') {
//    //redirect to home page for customers
//    header("Location: ../../index.php");
//}


// First we define the constants:
DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', 'donutboygirl');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'nxm_registration_app');


// Next we assign the database connection to a variable that we will call $link
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

//check if connection successful
if ($link) {
    //create the database if it does not exist
    $sqlCommand = "CREATE DATABASE IF NOT EXISTS DB_NAME";
    if (mysqli_query($link, $sqlCommand)) {
        //select the database on successful creation
        mysqli_select_db($link, DB_NAME);
    }
} else {
    die(mysqli_connect_errno() . '<br />' . mysqli_connect_error());
}

/*
 * This function is used to clean up user input
 * $data is the input from POST and GET methods
 */

function clean_input($value)
{
    global $link;
    $bad_chars = ["{", "}", "(", ")", ";", ":", "<", ">", "/", "$"];
    $value = str_ireplace($bad_chars, "", $value);
    // This part below is really overkill because the string replace above removed special characters
    $value = htmlentities($value); // Removes any html from the string and turns it into < format
    $value = strip_tags($value); // Strips html and PHP tags

    $value = stripslashes($value); // Gets rid of unwanted quotes

    $value = mysqli_real_escape_string($link, $value);
    return $value;
}

//validate email
function validateEmail($data)
{
    if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
        return "Invalid e-mail address.";
    } else {
        return "";
    }
}

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}


function listFilesInDir($start_dir)
{
    //returns an array of files in $start_dir
    $files = [];
    $dir = opendir($start_dir);
    if ($dir) {
        while (($myfile = readdir($dir)) !== false) {
            if ($myfile != '.' && $myfile != '..' && $myfile != 'resource.frk' && !eregi('^Icon', $myfile)) {
                $files[] = $myfile;
            }
        }
        closedir($dir);
    }
    return $files;
}

function lasdID()
{
    global $link;
    $stmt = mysqli_insert_id($link);
    return $stmt;
}


function redirect($url)
{
    header("Location: $url");
    exit();
}


?>