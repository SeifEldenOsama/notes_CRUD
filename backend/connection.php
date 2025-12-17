<?php 
session_start(); 

$databaseHost = "mysql:host=localhost:3307;dbname=crud";
$databaseUser = "root";
$databasePass = "";

try{
    $pdo = new PDO($databaseHost, $databaseUser, $databasePass);
}catch (PDOException $e){
    print "Connection ERROR!: " .$e -> getMessage(). "<br/>";
    die();
}
?>