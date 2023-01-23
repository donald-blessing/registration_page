<?php

/*
 * This section of code checks for a post action and transfers the dat
 * to the database
 */

//connect to the database connection script

require_once 'scripts/connect_to_db.php';

$name = '';
$card_name = '';
$card_month = '';
$card_year = '';
$birthdate = '';
$complete_address = '';
$profile_picture = '';
$errors = $birthdate_error = $profile_picture_error = $complete_address_error = $name_error = $card_number_error = $card_name_error = $card_month_error = $card_year_error = '';

try {
    $link->begin_transaction();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['register'])) {
            if (isset($_POST['name'])) {
                $name = $_POST['name'];
                $name = clean_input($name);
                if ($name === '') {
                    $name_error = 'Name is required.';
                }
            }
            if (isset($_POST['card_name'])) {
                $card_name = $_POST['card_name'];
                $card_name = clean_input($card_name);
                if ($card_name === '') {
                    $card_name_error = 'Card Name is required.';
                }
            }
            if (isset($_POST['card_number'])) {
                $card_number = $_POST['card_number'];
                $card_number = clean_input($card_number);
                if ($card_number === '') {
                    $card_number_error = 'Card Name is required.';
                }
            }
            if (isset($_POST['card_month'])) {
                $card_month = $_POST['card_month'];
                $card_month = clean_input($card_month);
                if ($card_month === '') {
                    $card_month_error = 'Card Month is required.';
                }
            }
            if (isset($_POST['card_year'])) {
                $card_year = $_POST['card_year'];
                $card_year = clean_input($card_year);
                if ($card_year === '') {
                    $card_year_error = 'Card Year is required.';
                }
            }
            if (isset($_POST['birthdate'])) {
                $birthdate = $_POST['birthdate'];
                $birthdate = clean_input($birthdate);
                if ($birthdate === '') {
                    $birthdate_error = 'Birthdate is required.';
                }
                if (validateDate($birthdate) === false) {
                    $birthdate_error = 'Birthdate is invalid.';
                }
            }
            if (isset($_POST['complete_address'])) {
                $complete_address = $_POST['complete_address'];
                $complete_address = clean_input($complete_address);
                if ($complete_address === '') {
                    $complete_address_error = 'Complete Address is required.';
                }
            }
            if (isset($_POST['profile_picture'])) {
                $profile_picture = $_POST['profile_picture'];
                $profile_picture = clean_input($profile_picture);
                if ($profile_picture === '') {
                    $profile_picture_error = 'Profile Picture is required.';
                }
            }

            $errors = $birthdate_error . $profile_picture_error . $complete_address_error . $name_error . $card_number_error . $card_name_error . $card_month_error . $card_year_error;
            if ($errors !== '') {
                throw new RuntimeException(str_replace('.', '.<br/>', $errors));
            }

            $target_dir = "uploads/";
            //ckeck if folder exists

            if (!mkdir($target_dir) && !is_dir($target_dir)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $target_dir));
            }

            $target_file = 'uploads/' . $_FILES['profile_picture']['name'];

            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
                $profile_picture = $target_file;
            } else {
                $profile_picture_error = "Sorry, there was an error uploading your file.";
            }
            $errors = $birthdate_error . $profile_picture_error . $complete_address_error . $name_error . $card_number_error . $card_name_error . $card_month_error . $card_year_error;


            //test if no errors occured
            if ($errors === '') {
                // errors occured
                //insert data into the database

                $sqlCommand = "INSERT INTO credit_card_infos(card_year, card_name, card_month, card_number) VALUES ('$card_year','$card_name','$card_month','$card_number')";
                if (mysqli_query($link, $sqlCommand)) {
                    $credit_card_info_id = lasdID();
                } else {
                    $mysqlerr = mysqli_errno($link) . mysqli_error($link);
                    if (mysqli_errno($link) === 1062) {//detect duplicate entries
                        if (strpos($mysqlerr, $card_number)) {
                            $card_number_error = '<strong>Sorry !</strong> card_year allready exists, Please Try another one.';
                        }
                    }
                    throw new RuntimeException($mysqlerr);
                }

                $sqlCommand = "INSERT INTO users(name, birthdate, complete_address, profile_picture, credit_card_info_id) VALUES ('$name','$birthdate','$complete_address','$profile_picture','$credit_card_info_id')";
                if (mysqli_query($link, $sqlCommand)) {
                    $id = lasdID();
                    echo "success";
                } else {
                    $mysqlerr = mysqli_errno($link) . mysqli_error($link);
                    if (mysqli_errno($link) === 1062) {//detect duplicate entries
                        if (strpos($mysqlerr, $card_year)) {
                            $card_year_error = '<strong>Sorry !</strong> card_year allready exists, Please Try another one.';
                        }
                    }
                    throw new RuntimeException($mysqlerr);
                }
                $link->commit();
            } else {
                throw new RuntimeException(str_replace('.', '.<br/>', $errors));
            }
        }
    }
} catch (Exception $e) {
    $link->rollback();
    $message = 'Message: ' . $e->getMessage();
}
