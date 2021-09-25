<?php 

//avvio della sessione
session_start();

//inclusione del file di configurazione
include("config.php");

/*-- Fase di controllo accesso --*/
    //Controllo se l'utente è loggato
    if( getCurrentUserID() ){
        header("location:/progetto-sito/profile.php");
        die();
    }
/*-- Fine fase si controllo accesso --*/

includiComponente("header", array( 
    "titolo" => "Registrati",
    "script" => "assets/js/signup.js"));

includiComponente("signup-form");

includiComponente("footer");