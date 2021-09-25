<div class="container-fluid section-padding">
    <div class="row justify-content-end post-section post-section-height" >
        <h2 class=".post-section .post-section-title"><?php echo $args['titolo']; ?></h2>
    </div>

    <!-- qui cè una modifica-->
    <div class="row g-4 justify-content-center">
            <?php if(!empty($args["post"])){
                foreach($args["post"] as $post){
                    if( $post['tipologia'] == "immagine" ){
                        ?>
                            <div class="col-xl-4">
                                <?php includiComponente("image-post-card", $post); ?>
                            </div>
                        <?php 
                    }else if( $post['tipologia'] == "video" ){
                        ?>
                            <div class="col-xl-4">
                                <?php includiComponente("video-post-card", $post); ?>
                            </div>
                        <?php 
                    }else if( $post['tipologia'] == "audio" ){
                        ?>
                            <div class="col-xl-4">
                                <?php includiComponente("audio-post-card", $post); ?>
                            </div>
                        <?php
                    }else if( $post['tipologia'] == "citazione" ){ 
                        ?>
                            <div class="col-xl-4">
                                <?php includiComponente("quote-post-card", $post); ?>
                            </div>
                        <?php 
                    }else if( $post['tipologia'] == "link" ){ 
                        ?>
                            <div class="col-xl-4">
                                <?php includiComponente("link-post-card", $post); ?>
                            </div>
                        <?php 
                    }else{ 
                        ?>
                            <div class="col-xl-4">
                                <?php includiComponente("text-post-card", $post); ?>
                            </div>
                    <?php 
                    }
                }
            }?>
    </div>
</div>