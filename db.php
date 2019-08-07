<?php
ob_start();
session_start();

try{
    $conn = new PDO("mysql:host=localhost;dbname=company",'root','');
    $conn->exec("set names utf8");


}
catch (PDOException $e){
    echo $e->getMessage();

}




?>