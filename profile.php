<?php 
//includo il file di configurazione
include("config.php");
//avvio la sessione
session_start();

//verifico che sia stato specificato un codice utente e la sua effettiva esistenza
if (isset($_GET['userCode']) && getUser($conn, $_GET['userCode']) !== false){
    //estraggo il codice utente dall'URL con il metodo GET
    $profileCode = htmlspecialchars($_GET['userCode']);

    //imposto un COOKIE per leggere il codice del profilo negli includes
    setcookie("profileCode", $profileCode);
    $_COOKIE["profileCode"] = $profileCode;

    //trasferisco il codice utente da GET a SESSION
    $_SESSION['profileCode'] = $profileCode;
} else if (isset($_SESSION["userCode"])){
    //altrimenti estraggo il mio codice utente per visualizzare il mio profilo
    $profileCode = $_SESSION["userCode"];

    //imposto un COOKIE per leggere il codice del profilo negli includes
    setcookie("profileCode", $profileCode);
    $_COOKIE["profileCode"] = $profileCode;

    //trasferisco il codice utente da GET a SESSION
    $_SESSION['profileCode'] = $profileCode;
} else {
    //visualizzo un messaggio di errore
    if( !getCurrentUserID() ){
        header("location:/progetto-sito/homepage.php");
    }
}

//includo l'header
includiComponente("header", array( 
    "titolo" => "Profilo utente",
    "script" => "assets/js/personal-profile.js"));
?>

<div class="d-flex align-items-start">
    <?php
    //includo la sidebar
    if (isset($_SESSION['userCode'])){
        includiComponente("profile-sidebar", array( "user" => getUser( $conn, $_SESSION['userCode'] ) ) );
    } else {
        includiComponente("profile-sidebar");
    }
    ?>

        <div class="container-fluid d-flex flex-column">
            <?php
            //includo la sezione di visualizzazione del profilo utente
            if (isset($_SESSION['userCode'])){
                includiComponente("profile-section", array( "user" => getUser( $conn, $_SESSION['userCode'] ) ) );
            } else {
                includiComponente("profile-section");
            }
           

            //controllo l'avvenuto accesso e l'appartenenza del profilo all'utente
            if (isset($_SESSION["userCode"]) && $profileCode == $_SESSION['userCode']){
                //se il profilo visualizzato è il mio includo la sezione di modifica
                includiComponente("edit-profile-section");
            }
            ?>
        </div>
</div>

<?php
//includo il footer
includiComponente("footer");
?>