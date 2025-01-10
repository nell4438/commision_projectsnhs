<?php
$host = "localhost";
$username = "root";
$password = "admin";
$dbname = "projectsnhs";

try{
    $conn = new MySQLi($host, $username, $password, $dbname);
} catch (Exception $e){
    die($e->getMessage());
}