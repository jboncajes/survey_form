<?php
session_start();
require_once 'controller.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lastname = sanitize(connectDatabase(), $_POST["lastname"]);
    $firstname = sanitize(connectDatabase(), $_POST["firstname"]);
    $middlename = sanitize(connectDatabase(), $_POST["middlename"]);
    $contact = sanitize(connectDatabase(), $_POST["contact"]);
    $email = sanitize(connectDatabase(), $_POST["email"]);
    $address = sanitize(connectDatabase(), $_POST["address"]);
    $password = sanitize(connectDatabase(), $_POST["password"]);

    insertUserData($lastname, $firstname, $middlename, $contact, $email, $address, $password);

    header("Location: ../index.php");
    exit();
}
?>
