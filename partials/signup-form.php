<div class="container col-xl-10 col-xxl-8 px-4 py-5">
  <div class="row align-items-center g-lg-5 py-5">
    <div class="col-lg-7 text-center text-lg-start">
      <h1 class="display-4 fw-bold lh-1 mb-3">Registrati 
      <br/>e scopri il mondo di Clique!</h1>
      <p class="col-lg-10 fs-4 text-muted font-italic">Costruisci il blog su misura per te, inizia a creare contenuti ed entra a far parte della community</p>
    </div>
    
    <div class="col-md-10 mx-auto col-lg-5">
      <form class="p-4 border rounded-3 bg-light" method="POST" id="signUpForm">

        <small>I campi segnati da * sono obbligatori</small>
          <div class="form-floating mb-1 mt-2">
            <input type="text" class="form-control" id="signUpName" placeholder="Nome" name="suName">
            <div class="invalid-feedback" id="nameFeedback"></div >
            <label for="signUpName">Nome*</label>
          </div>

          <div class="form-floating mb-1">
            <input type="text" class="form-control" id="signUpSurname" placeholder="Cognome" name="suSurname">
            <div class="invalid-feedback" id="surnameFeedback"></div >
            <label for="signUpSurname">Cognome*</label>
          </div>

          <div class="form-floating mb-1">
            <input type="date" class="form-control" id="signUpBDate" placeholder="Data di nascita in formato 00/00/0000" name="suBDate">
            <div class="invalid-feedback" id="bDateFeedback"></div >
            <label for="signUpBDate">Data di nascita*</label>
          </div>

          <div class="form-floating mb-1">
            <input type="tel" class="form-control" id="signUpPhone" placeholder="Numero di telefono" name="suPhone">
            <div class="invalid-feedback" id="phoneFeedback"></div >
            <label for="signUpPhone">Telefono</label>
          </div>

          <div class="form-floating mb-1">
            <input type="text" class="form-control" id="signUpDocument" placeholder="Estremi documento" name="suDocument">
            <div class="invalid-feedback" id="documentFeedback"></div >
            <label for="signUpDocument">Codice carta d'identità*</label>
          </div>

          <div class="form-floating mb-1">
            <select class="form-select" id="signUPSelect" aria-label="Seleziona genere" name="suGenderSelect">
              <option name="suGenderSelect" value="0" selected disabled>Seleziona un genere</option>
              <option name="suGenderSelect" value="1">Maschio</option>
              <option name="suGenderSelect" value="2">Femmina</option>
              <option name="suGenderSelect" value="3">Altro</option>
            </select>

            <label for="signUPSelect">Genere</label>
          </div>

          <div class="form-floating mb-1">
            <input type="text" class="form-control" id="signUpUser" placeholder="Username" name="suUsername">
            <div class="invalid-feedback" id="usernameFeedback"></div >
            <label for="signUpUser">Nome utente*</label>
          </div>

          <div class="form-floating mb-1">
            <input type="email" class="form-control" id="signUpEmail" placeholder="name@example.com" name="suEmail">
            <div class="invalid-feedback" id="emailFeedback"></div >
            <label for="signUpEmail">Email*</label>
          </div>

          <div class="form-floating mb-1">
            <input type="password" class="form-control" id="signUpPassword" placeholder="Password" name="suPassword">
            <div class="invalid-feedback" id="passwordFeedback"></div >
            <label for="signUpPassword">Password*</label>
          </div>

          <div class="py-1 ">
            <small class="fs-7 lh-0">
              <a title='<ul class="list-type-1 py-2">
                <li>Minimo 12 caratteri</li>
                <li>Almeno una lettera minuscola</li>
                <li>Almeno una lettera maiuscola</li>
                <li>Almeno un carattere speciale</li>
                <li>Almeno un numero</li>
              </ul>'
                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" href="#">
                La password deve rispettare i requisiti, clicca qui per sapere quali.
              </a>
            </small>
          </div>

          <div class="form-floating mb-4">
            <input type="password" class="form-control" id="signUpCheckPassword" placeholder="Password" name="suCheckPassword">
            <div class="invalid-feedback" id="passCheckFeedback"></div >
            <div class="invalid-feedback" id="submitFeedback"></div >
            <label for="signUpCheckPassword">Conferma password*</label>
          </div>
          
          <button class="w-100 btn btn-lg btn-primary " type="submit" name="suSubmit" id="btn-submit">Registrati</button>
          
      </form>
    </div>
  </div>
</div>


