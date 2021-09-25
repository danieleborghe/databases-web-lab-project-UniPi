<?php
    //avvio la sessione
    session_start();
    //eseguo l'unset della sessione e la cancello
    session_unset();
    session_destroy();

    //torno alla homepage
    header("location: \progetto-sito\homepage.php");