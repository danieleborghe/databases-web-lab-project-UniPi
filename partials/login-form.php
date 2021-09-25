<?php
  if (isset($_GET["suState"])){
    $suState = $_GET["suState"];
  }
?>
<div class="container col-xl-10 col-xxl-8 px-4 py-5 login-form">
        <div class="row align-items-center g-lg-5 py-5">
          <?php
          if (isset($suState) && $suState == 1){
          ?>
            <div class="alert alert-success" role="alert">
              Registrazione avvenuta con successo!
            </div>
          <?php
          }
          ?>

          <div class="col-lg-7 text-center text-lg-start mb-2">
            <h1 class="display-4 fw-bold lh-1 mb-3">Accedi e inizia a creare!</h1>
            <p class="col-lg-10 fs-4 font-italic text-muted">Se c’è un libro che vuoi leggere, ma non è stato ancora scritto, allora devi farlo tu! <br class=".text-muted">Toni Morrison</br></p>
          </div>
          <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-md-5 border rounded-3 bg-light" method="POST" name="loginForm" id="loginForm">
              
              <div class="form-floating mb-3" data-children-count="1">
                <input type="text" class="form-control" id="loginID" placeholder="text" data-kwimpalastatus="alive" data-kwimpalaid="1623837344234-2" name="loginID">
                <label for="loginID">Email, nome utente o documento</label>
                <div class="invalid-feedback" id="IDFeedback"></div >
              </div>
              <div class="form-floating mb-3" data-children-count="1">
                <input type="password" class="form-control" id="loginPassword" placeholder="Password" data-kwimpalastatus="alive" data-kwimpalaid="1623837344234-1" name="loginPassword">
                <label for="loginPassword">Password</label>
                <div class="invalid-feedback" id="passwordFeedback"></div >
              </div>
              
              
              <button class="w-100 btn btn-lg btn-primary" type="submit" name="loginSubmit">Sign in</button>
              
              <hr class="my-3">
              
              <small class="text-muted">Non hai ancora un account? <a href="/progetto-sito/signup.php">Registrati!</a></small>
            </form>
          </div>
        </div>
      </div>



