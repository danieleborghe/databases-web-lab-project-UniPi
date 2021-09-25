<div class="container py-5">
    <form method="POST" enctype="multipart/form-data" action="/progetto-sito/includes/actions/action-add-article.php">
        
        <?php 
            //Controllo che non sia stata specificata una risposta relativa a un'operazione precedente
            //se così fosse mostro il risultato di successo o fallimento dell'operazione
            if( !empty( $args['article_insert_result'] ) ){ ?>
            <?php if( $args['article_insert_result']['result'] == "success"){ ?>
                <div class="alert alert-primary" role="alert">
                    <?php echo $args['article_insert_result']['notice']; ?>
                </div>
            <?php }else{ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $args['article_insert_result']['notice']; ?>
                </div>
            <?php } ?>
        <?php } ?>

        <input type="hidden" name="action" value="addArticle">
        <h4 class="mb-5 h2">Aggiungi articolo</h4>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input required type="text" class="form-control" id="addArticleTitle" placeholder="Titolo blog" name="articleTitle">
                    <label for="addArticleTitle">Titolo articolo</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <?php 
                    /*      
                        Verifico che la lista dei blog a cui associare il post non sia vuota, e nel caso
                        stampo i blog nella select con id editArticleBlogSelect
                    */ ?>
                    <select required class="form-select" id="editArticleBlogSelect" aria-label="Seleziona blog" name="blogId">
                        <option value="" disabled="">Seleziona un blog</option>
                        <?php if( !empty( $args['blog_list'] ) ){ ?>
                            <?php foreach( $args['blog_list'] as $blog ){ ?>
                                <option value="<?php echo $blog[2]; ?>"><?php echo $blog[0]; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <label for="editArticleBlogSelect">Blog in cui aggiungere l'articolo</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="addArticleImg" class="form-label">Copertina articolo (formati consentiti: .jpg, .gif, .png)</label>
                <input name="articleImage" required class="form-control mb-3" type="file" id="addArticleImg">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <textarea required name="articleContent" class="js-custom-editor">
                </textarea>
            </div>
        </div>

        <div class="row py-3">
            <div class="col">
                 <div class="mb-3">
                    <label class="form-label mb-3" for="addArticleTags">Digita i tag dell'articolo</label>
                    <input type="text" class="form-control tag-selector" id="addArticleTags" placeholder="Tags" name="articleTags">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col py-3">
                <button type="submit" class="btn btn-primary" aria-label="Aggiungi articolo">Aggiungi articolo</button>
            </div>
        </div>

    </form>
</div>