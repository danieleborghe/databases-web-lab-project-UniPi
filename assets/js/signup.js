//CARICAMENTO DELLA PAGINA
$(document).ready(function() {
    //validazione del form di registrazione 
    $("#signUpForm").validate({
        //definisco la posizione di visualizzazione degli errori
        errorPlacement: function(error, element) {
            (element.parent()).after(error);
        },

        validClass: "valid is-valid",

        errorClass: "my-2 invalid-feedback",

        highlight: function(element, errorClass) {
            $(element).fadeOut(function() {
                $(element).fadeIn();
            });
        },

        //definizione delle regole del form
        rules: {
            suName: {
                required: false,
                maxlength: 50
            },

            suSurname: {
                required: false,
                maxlength: 50
            },

            suBDate: {
                required: true
            },

            suPhone: {
                required: false,
                minlength: 10,
                maxlength: 10
            },

            suDocument: {
                required: true,
                minlength: 9,
                maxlength: 9
            },

            suUsername: {
                required: true,
                minlength: 3,
                maxlength: 50
            },

            suEmail: {
                required: true,
                email: true
            },

            suPassword: {
                required: true,
                minlength: 12,
                maxlength: 50
            },

            suCheckPassword: {
                required: true,
            }
        },

        //definizione dei messaggi di errore per ogni regola
        messages: {
            suName: {
                required: "Per favore, inserisci un nome valido",
                maxlength: "Per favore, inserisci un nome valido"
            },

            suSurname: {
                required: "Per favore, inserisci un cognome valido",
                maxlength: "Per favore, inserisci un cognome valido"
            },

            suBDate: {
                required: "L'età minima per registrarsi è di 14 anni!"
            },

            suPhone: {
                required: "Per favore, inserisci un numero di telefono valido",
                minlength: "Per favore, inserisci un numero di telefono valido",
                maxlength: "Per favore, inserisci un numero di telefono valido"
            },

            suDocument: {
                required: "Per favore, inserisci un documento valido",
                minlength: "Per favore, inserisci un documento valido",
                maxlength: "Per favore, inserisci un documento valido"
            },

            suUsername: {
                required: "Per favore, inserisci un nome utente valido",
                minlength: "La lunghezza del nome utente non può essere inferiore a 3 caratteri",
                maxlength: "la lunghezza del nome utente non può essere superiore a 50 caratteri"
            },

            suEmail: {
                required: "Per favore, inserisci un indirizzo e-mail valido",
                email: "Per favore, inserisci un indirizzo e-mail valido",
            },

            suPassword: {
                required: "Per favore, inserisci una password valida",
                minlength: "La password non può essere inferiore a 12 caratteri",
                maxlength: "La password non può essere superiore a 50 caratteri"
            },

            suCheckPassword: {
                required: "Per favore, conferma la tua password prima di procedere",
            }
        },

        //definizione dell'invio del form e delle regole
        submitHandler: function(form) {
            //formattazioen dei dati del form
            var data = $("#signUpForm").serialize();

            $.ajax({
                type: "POST",
                url: 'includes/ajax/ajax-signup-validation.php',
                data: data,
                success: function(response) {
                    //CODICI DI ERRORE DEFINITI IN signup-validation.php

                    //codice di errore 0
                    if (response.includes("0")) {
                        $("#signUpName").addClass("is-invalid");
                        $("#nameFeedback").append('Nome inserito non valido');
                    } else {
                        $("#signUpName").removeClass("is-invalid");
                        $("#signUpName").addClass("is-valid");
                        $("#nameFeedback").empty();
                    }

                    //codice di errore 1
                    if (response.includes("1")) {
                        $("#signUpSurname").addClass("is-invalid");
                        $("#surnameFeedback").append('Cognome inserito non valido');
                    } else {
                        $("#signUpSurname").removeClass("is-invalid");
                        $("#signUpSurname").addClass("is-valid");
                        $("#surnameFeedback").empty();
                    }

                    //codice di errore 2
                    if (response.includes("2")) {
                        $("#signUpBDate").addClass("is-invalid");
                        $("#bDateFeedback").append('Devi avere almeno 14 anni per registrarti');
                    } else {
                        $("#signUpBDate").removeClass("is-invalid");
                        $("#signUpBDate").addClass("is-valid");
                        $("#bDateFeedback").empty();
                    }

                    //codice di errore 3
                    if (response.includes("3")) {
                        $("#signUpPhone").addClass("is-invalid");
                        $("#phoneFeedback").append('Numero di telefono non valido');
                    } else {
                        $("#signUpPhone").removeClass("is-invalid");
                        $("#signUpPhone").addClass("is-valid");
                        $("#phoneFeedback").empty();
                    }

                    //codice di errore 4
                    if (response.includes("4")) {
                        $("#signUpDocument").addClass("is-invalid");
                        $("#documentFeedback").append('Documento inserito non valido');
                    } else {
                        $("#signUpDocument").removeClass("is-invalid");
                        $("#signUpDocument").addClass("is-valid");
                        $("#documentFeedback").empty();
                    }

                    //codice di errore 5
                    if (response.includes("5")) {
                        $("#signUpUser").addClass("is-invalid");
                        $("#usernameFeedback").append('Username inserito non valido');
                    } else {
                        $("#signUpUser").removeClass("is-invalid");
                        $("#signUpUser").addClass("is-valid");
                        $("#usernameFeedback").empty();
                    }

                    //codice di errore 6
                    if (response.includes("6")) {
                        $("#signUpEmail").addClass("is-invalid");
                        $("#emailFeedback").append('Email inserita non valida');
                    } else {
                        $("#signUpEmail").removeClass("is-invalid");
                        $("#signUpEmail").addClass("is-valid");
                        $("#emailFeedback").empty();
                    }

                    //codice di errore 7
                    if (response.includes("7")) {
                        $("#signUpPassword").addClass("is-invalid");
                        $("#passwordFeedback").append('Password inserita non valida');
                    } else {
                        $("#signUpPassword").removeClass("is-invalid");
                        $("#signUpPassword").addClass("is-valid");
                        $("#passwordFeedback").empty();
                    }

                    //codice di errore 8
                    if (response.includes("8")) {
                        $("#signUpCheckPassword").addClass("is-invalid");
                        $("#passCheckFeedback").append('Le password devono corrispondere');
                    } else {
                        $("#signUpCheckPassword").removeClass("is-invalid");
                        $("#signUpPassword").addClass("is-valid");
                        $("#passCheckFeedback").empty();
                    }

                    //codice di errore 9
                    if (response.includes("9")) {
                        $("#signUpEmail").addClass("is-invalid");
                        $("#signUpDocument").addClass("is-invalid");
                        $("#signUpUser").addClass("is-invalid");

                        $("#submitFeedback").append('Utente già registrato');
                    } else {
                        $("#signUpEmail").removeClass("is-invalid");
                        $("#signUpDocument").removeClass("is-invalid");
                        $("#signUpUser").removeClass("is-invalid");

                        $("#signUpEmail").addClass("is-valid");
                        $("#signUpDocument").addClass("is-valid");
                        $("#signUpUser").addClass("is-valid");

                        $("#submitFeedback").empty();
                    }

                    //codice di avvenuta registrazione
                    if (response == "") {
                        window.location.replace("http://localhost/progetto-sito/login.php?suState=1");
                    }
                }
            });
        }
    });
});