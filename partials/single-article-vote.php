<div class="container py-4 article-votes">
    <div class="row">
        <div class="col-6">
            <?php if( $args['show_vote_form'] ){ ?>
                <?php if( empty( $args['user_votes'] ) ){ ?>
                    <form method="POST" class="article-vote-form" action="includes/ajax/ajax-article-vote.php">
                        <div class="d-flex justify-content-between align-items-center single-article-vote h4">
                            <div class="d-flex align-items-center">
                                <div class="form-check form-check-inline m-1">
                                    <input class="form-check-input article-vote-radio" type="radio" name="articleVote" id="articleVote1" value="1">
                                    <label class="form-check-label" for="articleVote1">1</label>
                                </div>
                                <div class="form-check form-check-inline m-1">
                                    <input class="form-check-input article-vote-radio" type="radio" name="articleVote" id="articleVote2" value="2">
                                    <label class="form-check-label" for="articleVote2">2</label>
                                </div>
                                <div class="form-check form-check-inline m-1">
                                    <input class="form-check-input article-vote-radio" type="radio" name="articleVote" id="articleVote3" value="3">
                                    <label class="form-check-label" for="articleVote3">3</label>
                                </div>
                                <div class="form-check form-check-inline m-1">
                                    <input class="form-check-input article-vote-radio" type="radio" name="articleVote" id="articleVote2" value="4">
                                    <label class="form-check-label" for="articleVote2">4</label>
                                </div>
                                <div class="form-check form-check-inline m-1">
                                    <input class="form-check-input article-vote-radio" type="radio" name="articleVote" id="articleVote3" value="5">
                                    <label class="form-check-label" for="articleVote3">5</label>
                                </div>
                                <div class="mx-3">
                                    <button type="submit" class="btn btn-lg btn-outline-primary">Vota
                                    </button>
                                </div>
                            </div>
                        
                        </div>
                    </form>
                    <div class="article-vote-notice article-vote-notice-error">
                        <div class="small alert alert-danger my-3 d-inline-block">Non è stato possibile inserire il voto, riprova più tardi.</div>
                    </div>
                    <div class="article-vote-notice article-vote-notice-success">
                        <div class="small alert alert-success my-3 d-inline-block">La tua votazione è stata registrata.</div>
                    </div>
                <?php }else{ ?>
                    <h3 class="h3 font-weight-light">Il tuo voto: <?php echo $args['user_votes']['votazione']; ?> su 5</h3>
                <?php } ?>     
            <?php } ?>
        </div>
        <div class="col-6">
            <div class="article-vote-stats">
                <div class="d-flex justify-content-end">
                    <div class="vote-average vote-stat text-center mx-3">
                        <span class="h3 number d-block">
                            <?php echo $args['article']['mediaVoti']; ?>
                        </span>
                        <span class="label d-block">
                            Media
                        </span>
                    </div>
                    <div class="vote-number vote-stat text-center mx-3">
                        <span class="h3 number d-block">
                            <?php echo $args['article']['numeroVoti']; ?>
                        </span>
                        <span class="label d-block">
                            Numero voti
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>