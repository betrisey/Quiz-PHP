<?php
/******* CONFIG ******/
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB", "dbquiz");
/*********************/
try
{
    $dbConnection = new PDO('mysql:host='.HOST.';dbname='.DB, USER, PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch(Exception $e)
{
    die("Erreur de connexion à la base de données");
}