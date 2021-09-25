//AVVIO DEL DOCUMENTO
$(document).ready(function() {
    //OPERAZIONI PRELIMINARI

    //nascondo la sezione di modifica del profilo personale
    $("#editProfileSection").hide();

    //nascondo tutti gli alerts
    $("#profileEdited").hide();
    $("#passwordChanged").hide();

    //definisco un evento per mostrare la sezione di modifica del profilo
    $("#editProfileBtn").click(function() {
        $("#profileSection").hide();
        $("#editProfileSection").show();
    });

    //ELIMINAZIONE DEL PROFILO PERSONAL

    //definisco un evento per mostrare il modal di conferma per l'eliminazione del profilo
    $("#deleteProfile").click(function() {
        $("#exampleModal2").modal("toggle");
    });

    //definisco l'evento di chiusura del modal per l'eliminazione del profilo
    $("#closeModal2").click(function() {
        $("#exampleModal2").modal("hide");
    });

    //definisco l'evento di eliminazione del profilo personale
    $("#deleteProfile2").click(function() {
        $.ajax({
            url: 'includes/ajax/ajax-delete-profile.php',
            error: function(e) {
                console.log(e.message);
            },
            success: function(response) {
                //rimando alla homepage con l'esecuzione del logout
                $(window.location).attr('href', 'http://localhost/progetto-sito/includes/action/action-logout.php');
            }
        });
    });

    //VISUALIZZAZIONE DEL PROFILO DI UN UTENTE

    //avvio della chiamata Ajax
    $.ajax({
        url: 'includes/ajax/ajax-profile-information.php',
        error: function(e) {
            console.log(e.message);
        },
        success: function(response) {
            //formatto la response di tipo JSON
            const psdResponse = JSON.parse(response);

            //inserisco gli elementi di visualizzazione del profilo
            //Controllo che l'immagine del profilo esista
            if (psdResponse.posizioneImgProfilo !== null) {
                $("#profileImg").attr("src", "/progetto-sito/" + psdResponse.posizioneImgProfilo)
            }
            $("#profileUsername").text("@" + psdResponse.nomeUtente);
            $("#profileContactMe").attr("href", "mailto:" + psdResponse.email);
            $("#profileName").text(psdResponse.nome + " " + psdResponse.cognome);
            $("#profileGender").text(psdResponse.genere);
            $("#profileBio").text(psdResponse.biografia);

            //inserisco e visualizzo gli interessi dell'utente
            for (interesse in psdResponse.interessi) {
                $(".profileInterest").append('<a href="#" class="badge bg-primary m-1">' + psdResponse.interessi[interesse] + '</a>');
            };

            //personalizzo i titoli delle seczioni in base all'utente
            $("#profileBlog").text("I blog di @" + psdResponse.nomeUtente);
            $("#profileCollaboration").text("@" + psdResponse.nomeUtente + " collabora con");

            //inserisco i link ai blog dell'utente nel profilo
            if ((psdResponse.blog).length != 0) {
                for (nBlog in psdResponse.blog) {
                    var blogCard = '<div class="col-xl-3 d-flex text-black justify-content-center align-items-center"><div class="blog-card card align-items-center bgColorWhite"><img class="bd-placeholder-img rounded-circle mt-4" width="140" height="140" src="' + psdResponse.blog[nBlog][1] + '"><h3 class="py-3">' + psdResponse.blog[nBlog][0] + '</h3><p><a class="btn btn-primary mb-4" href="blog.php?blogCode=' + psdResponse.blog[nBlog][2] + '">Vai al blog</a></p></div ></div >';
                    $("#profileBlogList").append(blogCard);
                };
            } else {
                $("#profileBlog").hide();
            }


            //inserisco i link ai blog con cui l'utente collabora
            if ((psdResponse.collabs).length != 0) {
                for (nCollab in psdResponse.collabs) {
                    var collabCard = '<div class="col-xl-3 d-flex text-black justify-content-center align-items-center"><div class="blog-card card align-items-center bgColorWhite"><img class="bd-placeholder-img rounded-circle mt-4" width="140" height="140" src="' + psdResponse.collabs[nCollab][1] + '"><h3 class="py-3">' + psdResponse.collabs[nCollab][0] + '</h3><p><a class="btn btn-primary mb-4" href="blog.php?blogCode=' + psdResponse.collabs[nCollab][2] + '">Vai al blog</a></p></div ></div >';
                    $("#profileCollabList").append(collabCard);
                };
            } else {
                $("#profileCollaboration").hide();
            }

        }
    });

    //SIDEBAR PERSONALE

    //avvio una chiamata ajax
    $.ajax({
        url: 'includes/ajax/ajax-personal-sidebar.php',
        error: function(e) {
            console.log(e.message);
        },
        success: function(response) {
            //formatto la response di tipo JSON
            const psdResponse = JSON.parse(response);

            //inserisco i link ai miei blog nella sidebar
            for (nBlog in psdResponse.blog) {
                var sidebarBlogElem = '<li class="py-2"><a href="blog.php?blogCode=' + psdResponse.blog[nBlog][2] + '" class="blog-card d-flex align-items-center text-white text-decoration-none" aria-expanded="false"><img src="' + psdResponse.blog[nBlog][1] + '" alt="" width="32" height="32" class="rounded-circle me-2"><strong>' + psdResponse.blog[nBlog][0] + '</strong></a></li>';
                $("#myBlogs").append(sidebarBlogElem);
            };

            //inserisco i link ai blog con cui collaboro nella sidebar
            for (nCollab in psdResponse.collabs) {
                var sidebarCollabElem = '<li class="py-2"><a href="blog.php?blogCode=' + psdResponse.collabs[nCollab][2] + '" class="blog-card d-flex align-items-center text-white text-decoration-none" aria-expanded="false"><img src="' + psdResponse.collabs[nCollab][1] + '" alt="" width="32" height="32" class="rounded-circle me-2"><strong>' + psdResponse.collabs[nCollab][0] + '</strong></a></li>';
                $("#myCollabs").append(sidebarCollabElem);
            };
        }
    });

    //MODIFICA DEL PROFILO

    //avvio della validazione del form di modifica del profilo
    $("#profileEditingForm").validate({
        //definisco la posizione di visualizzazione dell'errore
        errorPlacement: function(error, element) {
            (element.parent()).after(error);
        },

        //definizione delle regole di validazione
        rules: {
            profileName: {
                required: true,
                maxlength: 50
            },

            profileSurname: {
                required: true,
                maxlength: 50
            },

            profileBDate: {
                required: true
            },

            profilePhone: {
                required: false,
                minlength: 10,
                maxlength: 10
            },

            profileDocument: {
                required: true,
                minlength: 9,
                maxlength: 9
            },

            profileUsername: {
                required: true,
                minlength: 3,
                maxlength: 50
            },

            profileEmail: {
                required: true,
                email: true
            },

            profileBio: {
                maxlength: 1500
            }
        },

        //definizione dei messaggi di errore per ogni regola
        messages: {
            profileName: {
                required: "non puoi omettere il nome",
                maxlength: "nome troppo lungo"
            },

            profileSurname: {
                required: "non puoi omettere il cognome",
                maxlength: "cognome troppo lungo"
            },

            profileBDate: {
                required: "non puoi omettere la data di nascita"
            },

            profilePhone: {
                minlength: "inserisci un numero di telefono valido",
                maxlength: "inserisci un numero di telefono valido"
            },

            profileDocument: {
                required: "non puoi omettere il documento di identità",
                minlength: "codice d'identità troppo breve",
                maxlength: "codice d'identità troppo lungo"
            },

            profileUsername: {
                required: "non puoi omettere il nome utente",
                minlength: "nome utente troppo breve (minimo 3 caratteri)",
                maxlength: "nome utente troppo lungo (massimo 50 caratteri)"
            },

            profileEmail: {
                required: "non puoi omettere l'indirizzo email"
            },

            profileBio: {
                maxlength: "la biografia è troppo lunga"
            }
        },

        //definizione dell'invio del form e delle regole
        submitHandler: function(form) {
            //formatto i dati tramite FormData e non Serialize perchè è presente un input type="file"
            var formData = new FormData(form);

            //avvio della chiamata Ajax
            $.ajax({
                type: "POST",
                //processo i dati come non stringa
                processData: false,
                //evito la codifica UTF-8
                contentType: false,
                //associo data a formData
                data: formData,
                url: 'includes/ajax/ajax-profile-editing.php',
                success: function(response) {
                    //CODICI DI ERRORE DEFINITI IN ajax-profile-editing.php
                    //in caso di errore coloro di rosso il form tramite la classe "is-invalid" di bootstrap
                    //in alternativa la evidenzio di verde con la classe "is-valid"

                    //nascondo l'alert di successo
                    $("#profileEdited").hide();
                    //codice di errore 0
                    if (response.includes("0")) {
                        $("#editProfileName").addClass("is-invalid");
                    } else {
                        $("#editProfileName").removeClass("is-invalid");
                        $("#editProfileName").addClass("is-valid");
                    }

                    //codice di errore 1
                    if (response.includes("1")) {
                        $("#editProfileSurname").addClass("is-invalid");
                    } else {
                        $("#editProfileSurname").removeClass("is-invalid");
                        $("#editProfileSurname").addClass("is-valid");
                    }

                    //codice di errore 2
                    if (response.includes("2")) {
                        $("#editProfileBDate").addClass("is-invalid");
                    } else {
                        $("#editProfileBDate").removeClass("is-invalid");
                        $("#editProfileBDate").addClass("is-valid");
                    }

                    //codice di errore 3
                    if (response.includes("3")) {
                        $("#editProfilePhone").addClass("is-invalid");
                    } else {
                        $("#editProfilePhone").removeClass("is-invalid");
                        $("#editProfilePhone").addClass("is-valid");
                    }

                    //codice di errore 4
                    if (response.includes("4")) {
                        $("#editProfileDocument").addClass("is-invalid");
                    } else {
                        $("#editProfileDocument").removeClass("is-invalid");
                        $("#editProfileDocument").addClass("is-valid");
                    }

                    //codice di errore 5
                    if (response.includes("5")) {
                        $("#editProfileEmail").addClass("is-invalid");
                    } else {
                        $("#editProfileEmail").removeClass("is-invalid");
                        $("#editProfileEmail").addClass("is-valid");
                    }

                    //codice di errore 6
                    if (response.includes("6")) {
                        $("#editProfileUser").addClass("is-invalid");
                    } else {
                        $("#editProfileUser").removeClass("is-invalid");
                        $("#editProfileUser").addClass("is-valid");
                    }

                    //codice di errore 9
                    if (response.includes("9")) {
                        $("#editProfileEmail").addClass("is-invalid");
                        $("#editProfileDocument").addClass("is-invalid");
                        $("#editProfileUser").addClass("is-invalid");
                    } else {
                        $("#editProfileEmail").removeClass("is-invalid");
                        $("#editProfileDocument").removeClass("is-invalid");
                        $("#editProfileUser").removeClass("is-invalid");

                        $("#editProfileEmail").addClass("is-valid");
                        $("#editProfileDocument").addClass("is-valid");
                        $("#editProfileUser").addClass("is-valid");
                    }

                    //modifica corretta
                    if (response == "") {
                        //visualizzo l'alert di successo
                        $("#profileEdited").show();
                    }
                }
            });
        }
    });

    //MODIFICA DELLA PASSWORD

    //validazione del form di modifica della password
    $("#passwordEditingForm").validate({
        //definisco la posizione di visualizzazione dell'errore
        errorPlacement: function(error, element) {
            (element.parent()).after(error);
        },

        //definizione delle regole del form
        rules: {
            oldPassword: {
                required: true,
            },

            newPassword: {
                required: true,
                minlength: 12,
                maxlength: 50
            },

            checkNewPassword: {
                required: true,
            }
        },

        //definizione dei messaggi di errore per ogni regola
        messages: {
            oldPassword: {
                required: "devi inserire la vecchia password prima di poterla cambiare",
            },

            newPassword: {
                required: "devi inserire una nuova password prima di procedere",
                minlength: "la nuova password deve avere almeno 12 caratteri",
                maxlength: "la nuova password non può essere più lunga di 50 caratteri"
            },

            checkNewPassword: {
                required: "inserisci nuovamente la tua nuova password",
            }
        },

        //definizione dell'invio del form e delle regole
        submitHandler: function(form) {
            //formatto i dati con serialize
            var data = $("#passwordEditingForm").serialize();

            //avvio della chiamata ajax
            $.ajax({
                type: "POST",
                url: 'includes/ajax/ajax-password-editing.php',
                data: data,
                success: function(response) {
                    //CODICI DI ERRORE DEFINITI IN  password-editing.php
                    //in caso di errore coloro di rosso il form tramite la classe "is-invalid" di bootstrap
                    //in alternativa la evidenzio di verde con la classe "is-valid"

                    //nascondo l'alert di successo
                    $("#passwordChanged").hide();

                    //codice di errore 0
                    if (response.includes("0")) {
                        $("#editProfileOldPassword").addClass("is-invalid");
                    } else {
                        $("#editProfileOldPassword").removeClass("is-invalid");
                        $("#editProfileOldPassword").addClass("is-valid");

                        //codice di errore 1
                        if (response.includes("1") || response.includes("2")) {
                            $("#editProfilePassword").addClass("is-invalid");
                        } else {
                            $("#editProfilePassword").removeClass("is-invalid");
                            $("#editProfilePassword").addClass("is-valid")

                            //codice di errore 3
                            if (response.includes("3")) {
                                $("#editProfileCheckPassword").addClass("is-invalid");
                            } else {
                                $("#editProfileCheckPassword").removeClass("is-invalid");
                                $("#editProfileCheckPassword").addClass("is-valid");
                            }

                        }
                    }

                    //modifica avvenuta con successo
                    if (response == "") {
                        //visualizzo l'alert di successo
                        $("#passwordChanged").show();
                    }
                }
            });
        }
    });
});