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

function getCategories() {
    global $dbConnection;
    $categories = [];
    $sql =  'select catId, catNom  from tblcategorie order by catNom';
    foreach  ($dbConnection->query($sql) as $row) {
        array_push($categories, [
            'id' => $row['catId'],
            'nom' => $row['catNom']
        ]);
    }
    return $categories;
}

function getQuestion($nombre, $categories) {
    global $dbConnection;
    $questions = [];
    $sql =  'select queId, queLibelle  from tblquestion where tblCategorie_carId in (' . implode(', ', $categories) . ') order by rand() limit ' . $nombre;
    foreach  ($dbConnection->query($sql) as $row) {
        array_push($questions, [
            'id' => $row['queId'],
            'nom' => $row['queLibelle']
        ]);
    }
    return $questions;
}

function getReponses($questionId) {
    global $dbConnection;
    $reponses = [];
    $sql =  'select repId, repLibelle, repEstCorrecte from tblreponse where tblQuestion_queId = ' . $questionId . ' order by repLibelle';
    foreach  ($dbConnection->query($sql) as $row) {
        array_push($reponses, [
            'id' => $row['repId'],
            'nom' => $row['repLibelle'],
            'correcte' => $row['repEstCorrecte']
        ]);
    }
    return $reponses;
}

function getReponsesCorrectes($questionId) {
    global $dbConnection;
    $reponses = [];
    $sql =  'select repId from tblreponse where tblQuestion_queId = ' . $questionId . ' and repEstCorrecte = true order by repLibelle';
    foreach  ($dbConnection->query($sql) as $row) {
        array_push($reponses, $row['repId']);
    }
    return $reponses;
}