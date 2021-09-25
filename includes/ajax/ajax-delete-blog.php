<?php
//avvio la sessione
session_start();

include("../../config.php");

//memorizzo il codice utente
$userCode = $_SESSION["userCode"];
//memorizzo il codice del blog
$blogCode = $_COOKIE["blogCode"];

//controllo l'appartenenza del blog all'utente [DOPPIO CONTROLLO]
if(checkBlogOwner($conn, $userCode, $blogCode)){
    //cancello il blog
    deleteBlog($conn, $blogCode);
}

