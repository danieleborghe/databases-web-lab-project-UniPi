<div class="container-fluid section-padding">
    <div class="post-section post-section-height row justify-content-end" >
        <h2 class="post-section post-section-title"><?php echo $args['titolo']; ?></h2>
    </div>

    <div class="row g-4 justify-content-center">
            <?php if(!empty($args["post"])){
                foreach($args["post"] as $post){
                    //Disabilito commenti, voti e opzioni
                    $post['disable_comments'] = true;
                    $post['disable_votes'] = true;
                    $post['disable_options'] = true;
                    if( $post['tipologia'] == "immagine" ){
                        ?>
                            <div class="col-xl-4">
                                <?php includiComponente("image-post", $post); ?>
                            </div>
                        <?php 
                    }else if( $post['tipologia'] == "video" ){
                        ?>
                            <div class="col-xl-4">
                                <?php includiComponente("video-post", $post); ?>
                            </div>
                        <?php 
                    }else if( $post['tipologia'] == "audio" ){
                        ?>
                            <div class="col-xl-4">
                                <?php includiComponente("audio-post", $post); ?>
                            </div>
                        <?php
                    }else if( $post['tipologia'] == "link" ){ 
                        ?>
                            <div class="col-xl-4">
                                <?php includiComponente("link-post", $post); ?>
                            </div>
                        <?php 
                    }else{ 
                        ?>
                            <div class="col-xl-4">
                                <?php includiComponente("text-post", $post); ?>
                            </div>
                    <?php 
                    }
                }
            }?>
    </div>
</div>