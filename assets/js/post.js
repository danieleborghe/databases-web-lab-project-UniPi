$(document).ready(function() {
    //Per ogni elemento con classe .js-article (quindi per ogni post) eseguo la logica seguente
    $(".js-post").each(function() {

            //Salvo il post corrente nella variabile curPost
            var curPost = $(this);
            //Salvo il contenitore dei commenti nella variabile comments
            var comments = curPost.find(".single-post-comments");
            //Salvo il form per la creazione di un commento in commentsForm
            var commentsForm = curPost.find(".single-post-comments-form");
            //salvo la sezione per la creazione di un commento
            var commentsSection = curPost.find(".single-post-comments-add");
            //Salvo l'elemento che contiene la lista dei commenti in commentsList
            var commentsList = curPost.find(".single-post-comments-list");
            //Salvo l'elemento contenente il template del nuovo commento da inserire
            var commentTpl = commentsList.find(".single-post-comment-template");
            //Salvo l'elemento contenente il badge con il numero di commenti
            var commentsBadge = curPost.find(".single-post-comments-badge");
            //Salvo l'elemento contenente il form di votazione
            var voteForm = curPost.find(".single-post-vote-form");
            //Salvo l'elemento contenente il riepilogo dei voti
            var voteRecap = curPost.find(".single-post-vote-recap");
            //Salvo l'elemento contenente le opzioni del post
            var postOptions = curPost.find(".single-post-options");
            //Salvo i bottoni contenuti nelle opzioni del post (es. bottone elimina)
            var postOption = postOptions.find("[data-action]");

            //Gestisco i commenti per ogni post
            commentsForm.on("submit", function(e) {
                    //Prevengo il comportamento di default del form
                    e.preventDefault();
                    //Salvo il form coinvolto nell'evento "submit" in currentForm
                    var currentForm = $(this);
                    //Salvo il contenuto del commento in commentContent
                    var commentContent = currentForm.find(".comment-content");

                    //Controllo che il contenuto del commento non sia vuoto e procedo alla chiamata ajax di inserimento del commento
                    if (commentContent.val() !== ""){
                        $.ajax({
                            type: commentsForm.attr("method"), //Prendo il method dal form
                            url: commentsForm.attr("action"), //Prendo l'action dal form
                            data: {
                                "post_id": curPost.attr("data-post-id"), //Prendo il post_id dall'attributo [data-post-id] dell'elemento curPost
                                "comment": commentContent.val() //Prendo il contenuto del commento da commentContent
                            },
                            dataType: "json",
                            success: function(response) {
                                //Se il codice restituito è 200 
                                if (response.code == 200) {
                                    //Memorizzo lo "scheletro" del nuovo commento in commentToAdd
                                    var commentToAdd = commentTpl;
                                    //Estraggo l'HTML del nuovo commento e lo riassegno a commentToAdd in modo da poterlo manipolare con javascript
                                    commentToAdd = commentToAdd[0].outerHTML;
                                    //Rimuovo la classe che "nasconde" il commento
                                    commentToAdd = $(commentToAdd).removeClass("d-none");
                                    //Inserisco l'id del nuovo commento
                                    $(commentToAdd).attr("data-comment-id", response.data.comment_id);
                                    //Aggiungo il testo del nuovo commento
                                    $(commentToAdd).find(".comment-content").append("<p>" + commentContent.val() + "</p>");
                                    //Aggiungo la data del nuovo commento
                                    $(commentToAdd).find(".comment-meta .date").html(response.data.date);
                                    //A questo punto prendo il nuovo commento e lo inserisco in pila agli altri commenti
                                    commentsList.prepend(commentToAdd[0].outerHTML);
                                    //Aggiorno il badge relativo al numero dei commenti incrementandolo di 1
                                    commentsBadge.html(parseInt(commentsBadge.html()) + 1);
                                    //Ripulisco l'area di testo del form di commenti
                                    commentContent.val("");
                                } else {
                                    commentsForm.hide();
                                    commentsSection.append('<div class="alert alert-danger" role="alert">Hai commentato abbastanza questo post per oggi</div >');
                                    console.log("Error while posting comment");
                                }
                            },
                            error: function() {

                            }
                        });

                }

            });

        //Gestisco la votazione dei post
        voteForm.on("submit", function(e) {
            e.preventDefault();
            var currentForm = $(this);
            var selectedVote = currentForm.find(".form-check-input:checked");

            //Controllo che sia stato effettivamente selezionato un voto prima di inviare il form
            if (selectedVote.length > 0) {

                $.ajax({
                    type: "POST",
                    url: 'includes/ajax/ajax-post-vote.php',
                    data: {
                        "post_id": curPost.attr("data-post-id"), //Id del post da commentare
                        "vote": selectedVote.val() //Quantitativo voto (da 1 a 5)
                    },
                    dataType: "json",
                    beforeSend: function() {
                        //$("#btn-submit").html('sending ...');
                    },
                    success: function(response) {
                        //Se il codice restituito è 200 il voto è stato inserito correttamente
                        if (response.code == 200) {
                            //Faciamo sparire il form di votazione con un effetto di dissolvenza
                            currentForm.fadeOut(function() {
                                //Rimuoviamo il form di votazione
                                $(this).remove();
                                //Mostriamo il messaggio di avvenuta votazione
                                curPost.find(".single-post-vote-section .single-post-inserted-ok").removeClass("d-none");
                                //Memorizzo l'elemento contenente la media voti
                                var voteAvgEl = voteRecap.find(".vote-avg");
                                //Memorizzo l'elemento contenente il numero di voti
                                var voteNumEl = voteRecap.find(".vote-num");
                                var voteNum = parseInt(voteNumEl.html());
                                voteNumEl.html(voteNum + 1);
                                voteAvgEl.html(response.data.voteavg);
                            });
                        } else {
                            console.log("Error while posting comment");
                        }
                    },
                    error: function(jqxhr, textStatus, errorThrown) {
                        console.log(jqxhr);
                        console.log("Error in insert post ajax call");
                    }
                });
            }

        });

        //Gestisco le opzioni per ogni singolo post
        postOption.on("click", function(e) {

            var action = $(this).attr("data-action");

            if (action == "delete-post") {
                $.ajax({
                    type: "POST",
                    url: 'includes/ajax/ajax-post-delete.php',
                    data: {
                        "post_id": curPost.attr("data-post-id"),
                    },
                    dataType: "json",
                    success: function(response) {
                        //Se il codice restituito è 200 il voto è stato inserito correttamente
                        if (response.code == 200) {
                            curPost.fadeOut(function() {
                                curPost.remove();
                            });
                        } else {
                            console.log("Error while posting comment");
                        }
                    },
                    error: function(jqxhr, textStatus, errorThrown) {
                        console.log("Error in insert post ajax call");
                    }
                });
            }


        });

    });

//Gestisco il click del pulsante "Elimina" commento
$(document).on("click", ".single-post-comments-delete-comment", function(e) {

    var post = $(this).closest(".js-post");
    var commentsBadge = post.find(".single-post-comments-badge");
    var comment = $(this).closest(".single-post-comment");
    var commentId = comment.attr("data-comment-id");

    //Controlla che comment_id non sia vuoto
    if (commentId !== undefined) {
        $.ajax({
            type: "POST",
            url: 'includes/ajax/ajax-post-comment-delete.php',
            data: {
                "comment_id": parseInt(commentId),
            },
            dataType: "json",
            success: function(response) {
                //Se il codice restituito è 200 il voto è stato inserito correttamente
                if (response.code == 200) {
                    comment.fadeOut(function() {
                        $(this).remove();
                    });
                    var commentsNum = parseInt(commentsBadge.html());
                    if (commentsNum > 0) {
                        commentsBadge.html(commentsNum - 1);
                    }
                } else {
                    console.log("Error while deleting comment");
                }
            },
            error: function(jqxhr, textStatus, errorThrown) {
                console.log(jqxhr);
                console.log("Error in insert post ajax call");
            }
        });
    }

});

});