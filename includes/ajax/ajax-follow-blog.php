<?php
//avvio la sessione
session_start();

include("../../config.php");

//verifico che sia stato eseguito l'accesso
if (isset($_SESSION["userCode"])){
    //memorizzo il codice utente
    $userCode = $_SESSION["userCode"];
    //memorizzo il codice del Blog
    $blogCode = $_COOKIE["blogCode"];

    //memorizzo lo stato del follow
    $followState = checkFollow($conn, $userCode, $blogCode);

    if (!$followState){
        //memorizzo la data di oggi
        $todayDate = new DateTime("now");
        $todayDate = $todayDate->format('Y-m-d');

        //aggiungo il "follow" del blog
        followBlog($conn, $userCode, $blogCode, $todayDate);
        
    } else {
        //smetto di seguire il blog
        unfollowBlog($conn, $userCode, $blogCode);

    }

} else {
    die("Per seguire un blog devi aver eseguito l'accesso!");

}


