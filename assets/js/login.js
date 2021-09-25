//AVVIO DEL DOCUMENTO
$(document).ready(function() {

    //FASE DI ACCESSO

    //validazione del form di login
    $("#loginForm").validate({
        //definizione del posizionamento dei messaggi di errore
        errorPlacement: function(error, element) {
            (element.parent()).after(error);
        },

        //definizione delle regole del form
        rules: {
            loginID: {
                required: true
            },

            loginPassword: {
                required: true
            }
        },

        //definizione dei messaggi di errore per ogni regola
        messages: {
            loginID: {
                required: "Inserisci un ID valido per accedere"
            },

            loginPassword: {
                required: "Inserisci una password per accedere"
            }
        },

        //definizione dell'invio del form e delle regole
        submitHandler: function(form) {
            //formattazione dei dati di accesso
            var data = $("#loginForm").serialize();

            //definizione della chiamata Ajax
            $.ajax({
                type: "POST",
                url: 'includes/ajax/ajax-login-validation.php',
                data: data,
                success: function(response) {
                    //pulizia degli alert
                    $("#loginID").removeClass("is-invalid");
                    $("#IDFeedback").empty();
                    $("#loginPassword").removeClass("is-invalid");
                    $("#passwordFeedback").empty();

                    //controllo la response
                    if (response.includes("alreadyLogged")) {

                    } else {
                        //accesso non avvenuto
                        if (response.includes("wrongID")) {
                            //ID errato
                            $("#loginID").addClass("is-invalid");
                            $("#IDFeedback").append('Nome utente, e-mail o documento errati');

                        } else if (response.includes("wrongPassword")) {
                            //password errata
                            $("#loginID").addClass("is-valid");
                            $("#loginPassword").addClass("is-invalid");
                            $("#passwordFeedback").append('Password errata');

                        } else {
                            //dati corretti
                            $(location).attr('href', '/progetto-sito/profile.php');
                        }
                    }
                }
            });
        }
    });
});