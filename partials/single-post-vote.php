<?php if( !empty( $args['user_vote'] ) ){ ?>
    <div class="row">
        <div class="col">
            <div class="alert alert-primary small" role="alert">
                <p>Hai già votato questo post con votazione <?php echo $args['user_vote']['votazione']; ?></p>
            </div>
        </div>
    </div>
<?php }else{ ?>
    <div class="single-post-vote-section">
        <div class="single-post-inserted-ok d-none">
            <div class="alert alert-primary small" role="alert">
                <p>Il tuo voto è stato inserito</p>
            </div>
        </div>
        <form method="POST" class="single-post-vote-form" action="/includes/ajax/ajax-post-vote.php">
            <div class="d-flex justify-content-between align-items-center single-post-vote mb-3 py-3">
                <div>
                    <div class="form-check form-check-inline m-1">
                        <input class="form-check-input" type="radio" name="postVote" id="postVote1"
                            value="1">
                        <label class="form-check-label" for="postVote1">1</label>
                    </div>
                    <div class="form-check form-check-inline m-1">
                        <input class="form-check-input" type="radio" name="postVote" id="postVote2"
                            value="2">
                        <label class="form-check-label" for="postVote2">2</label>
                    </div>
                    <div class="form-check form-check-inline m-1">
                        <input class="form-check-input" type="radio" name="postVote" id="postVote3"
                            value="3">
                        <label class="form-check-label" for="postVote3">3</label>
                    </div>
                    <div class="form-check form-check-inline m-1">
                        <input class="form-check-input" type="radio" name="postVote" id="postVote2"
                            value="4">
                        <label class="form-check-label" for="postVote2">4</label>
                    </div>
                    <div class="form-check form-check-inline m-1">
                        <input class="form-check-input" type="radio" name="postVote" id="postVote3"
                            value="5">
                        <label class="form-check-label" for="postVote3">5</label>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-primary">Vota</a>
                </div>
            </div>
        </form>
    </div>
<?php } ?>
<div class="single-post-vote-recap">
    <div class="d-inline-block badge bg-primary">
        <p>Media voti: <span class="vote-avg"><?php echo $args['mediaVoti']; ?></span></p>
    </div>
    <div class="d-inline-block badge bg-primary">
        <p>Numero voti: <span class="vote-num"><?php echo $args['numeroVoti']; ?></span></p>
    </div>
</div>