$(document).ready(function() {

    //Per ogni elemento con classe .js-article (quindi per ogni articolo) eseguo la logica seguente
    $(".js-article").each(function() {

        //Salvo l'articolo corrente in una variabile
        var curArticle = $(this);

        /*-- COMMENTI --*/

        //Salvo l'elemento che contiene la sezione commenti (comprensiva di lista commenti e form di creazione)
        var articleComments = curArticle.find(".article-comments");
        //Salvo l'elemento che contiene il form di creazione di un nuovo commento
        var articleNewCommentForm = articleComments.find(".article-new-comment-form");
        //Salvo l'elemento che contiene il "template" o meglio la struttura HTML necessaria alla creazione di un nuovo commento
        //in cui andrò poi a sostituire le informazioni relative a nome utente, data e testo del nuovo commento inserito
        var commentTpl = articleComments.find(".article-single-comment-template");
        //Salvo l'elemento che contiene la lista dei commenti
        var commentsList = articleComments.find(".article-comments-list");
        //Salvo l'elemento che contiene il messaggio di notifica di eventuale errore
        var commentsFormSentNotice = articleComments.find(".article-comment-notice");

        /*-- VOTAZIONI --*/
        //Salvo l'elemento che contiene la sezione votazioni
        var articleVotes = curArticle.find(".article-votes");
        //Salvo l'elemento che contiene il form di votazione
        var articleVoteForm = curArticle.find(".article-vote-form");
        //Salvo l'elemento che contiene il messaggio di notifica di eventuale errore
        var voteSentNoticeError = curArticle.find(".article-vote-notice-error");
        //Salvo l'elemento che contiene il messaggio di notifica di operazione andata a buon fine
        var voteSentNoticeSuccess = curArticle.find(".article-vote-notice-success");
        //Salvo l'elemento che contiene la media dei voti
        var voteAverage = curArticle.find(".vote-average > .number");
        var voteNum = curArticle.find(".vote-number > .number");

        /*-- LOGICA COMMENTI --*/

        //All'invio del form faccio chiamata ajax per inserire il commento all'articolo
        articleNewCommentForm.on("submit", function(e) {
            e.preventDefault();
            //Salvo il form di creazione del commento in una variabile in modo da poterci interagire all'interno della chiamata ajax
            var currentForm = $(this);
            //Salvo il contenuto del commento da inserire
            var commentContent = currentForm.find(".comment-content");
            //Nascondo la notice del form di commento inviato
            commentsFormSentNotice.fadeOut();

            //Verifico che il commento non sia vuoto
            if (commentContent.val() !== "") {

                //Imposto la chiamata ajax
                $.ajax({
                    type: currentForm.attr("method"), //Acquisisco il metodo di invio dati dall'attributo "method" del form di creazione del commento
                    url: currentForm.attr("action"), //Acquisisco l'action dall'attributo "action" del form di creazione del commento
                    //Passo allo script php che si occuperà della creazione del commento i parametri article_id (id dell'articolo) e comment (contenuto del commento)
                    data: {
                        "article_id": curArticle.attr("data-article-id"),
                        "comment": commentContent.val()
                    },
                    dataType: "json",
                    beforeSend: function() {
                        //$("#btn-submit").html('sending ...');
                    },
                    success: function(response) {
                        //Gestisco la risposta che mi arriva dal php, in particolare se nell'array response è presente l'indice code e vale 200
                        //vuol dire che il commento è stato inserito correttamente, altrimenti no
                        if (response.code == 200) {
                            //"Copio" il template del commento da inserire all'interno della variabile commentToAdd
                            var commentToAdd = commentTpl;
                            //Sostituisco il valore di commentToAdd con l'HTML del template del commento in modo da poterci lavorare e inserire i valori del nuovo commento (contenuto e data)
                            commentToAdd = commentToAdd[0].outerHTML;
                            //Rimuovo la classe "d-none" che tiene nascosto l'elemento template
                            commentToAdd = $(commentToAdd).removeClass("d-none");
                            //Aggiungo l'attributo data-comment-id al nuovo commento inserito così è possibile eliminarlo
                            commentToAdd.attr("data-comment-id", response.data.comment_id);
                            //Inserisco il valore del commento inserito nel testo dell'elemento HTML relativo al nuovo commento
                            $(commentToAdd).find(".article-single-comment-text > p").html(commentContent.val());
                            //Inserisco il valore relativo alla data del commento appena inserito nell'HTML relativo al nuovo commento
                            $(commentToAdd).find(".article-single-comment-date").html(response.data.date);
                            //Aggiungo il nuovo commento alla lista dei commenti
                            commentsList.prepend(commentToAdd[0].outerHTML);
                            //Ripulisco il contenuto della textarea contenente il commento da inserire
                            commentContent.val("");

                        } else {
                            //Gestisco il caso in cui il commento non è stato inserito correttamente (al momento faccio solo un console log che indica un errore generico)
                            commentsFormSentNotice.fadeIn();
                        }
                    },
                    error: function() {
                        //Quando il server non risponde faccio il seguente console.log()
                        console.log("Error while connecting to server");
                    }
                });

            }

        });

        /*-- LOGICA VOTAZIONI --*/

        //All'invio del form faccio chiamata ajax per inserire il voto all'articolo
        articleVoteForm.on("submit", function(e) {
            e.preventDefault();
            //Salvo il form del voto in una variabile in modo da poterci interagire all'interno della chiamata ajax
            var currentForm = $(this);
            //Salvo il valore del voto dato
            var voteVal = currentForm.find(".article-vote-radio:checked").val();

            voteSentNoticeError.fadeOut();
            voteSentNoticeSuccess.fadeOut();

            //Verifico che il voto sia valido
            if (voteVal !== undefined) {

                //Imposto la chiamata ajax
                $.ajax({
                    type: currentForm.attr("method"), //Acquisisco il metodo di invio dati dall'attributo "method" del form di creazione del commento
                    url: currentForm.attr("action"), //Acquisisco l'action dall'attributo "action" del form di creazione del commento
                    //Passo allo script php che si occuperà della creazione del commento i parametri article_id (id dell'articolo) e comment (contenuto del commento)
                    data: {
                        "article_id": curArticle.attr("data-article-id"),
                        "vote": voteVal
                    },
                    dataType: "json",
                    beforeSend: function() {
                        //$("#btn-submit").html('sending ...');
                    },
                    success: function(response) {
                        //Gestisco la risposta che mi arriva dal php, in particolare se nell'array response è presente l'indice code e vale 200
                        //vuol dire che il commento è stato inserito correttamente, altrimenti no
                        if (response.code == 200) {
                            currentForm.fadeOut(function() {
                                $(this).remove();
                            });
                            voteNum.html(response.data.votenum);
                            voteAverage.html(response.data.voteavg);
                            voteSentNoticeSuccess.fadeIn();
                            voteSentNoticeError.fadeOut();
                        } else {
                            voteSentNoticeError.fadeIn();
                        }
                    },
                    error: function(xhr) {
                        voteSentNoticeError.fadeIn();
                    }
                });

            }
        });

    });

    //Gestisco il click del pulsante "Elimina" commento 
    $(document).on('click', '.single-article-comments-delete-comment', function() {

        var article = $(this).closest(".js-article");
        var comment = $(this).closest(".article-single-comment");
        var commentId = comment.attr("data-comment-id");

        if (commentId !== undefined) {
            $.ajax({
                type: "POST",
                url: 'includes/ajax/ajax-article-comment-delete.php',
                data: {
                    "comment_id": parseInt(commentId)
                },
                dataType: "json",
                success: function(response) {
                    if (response.code == 200) {
                        comment.fadeOut(function() {
                            $(this).remove();
                        });
                    } else {
                        console.log("Error while deleting comment");
                    }
                },
                error: function(error) {
                    console.log(error);
                }


            });
        };
    });

});