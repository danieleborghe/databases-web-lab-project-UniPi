
<div class="feed-list py-5 container d-flex container-size-small flex-column">
        <?php if(!empty($args["posts"])){
                foreach($args["posts"] as $post){
                        
                        if ($args['current_author'] != NULL){
                                $post['current_author'] = $args['current_author'];
                                
                        } else {
                                $post['disable_comments'] = true;
                                $post['disable_votes'] = true;
                                $post['disable_options'] = true;
                        }

                        $post['blog_url'] = "/progetto-sito/blog.php?blogCode=" . $post['blog'];                                 

                        if( $post['tipologia'] == "video" ){
                                includiComponente("video-post", $post); 
                        }
                        else if ( $post['tipologia'] == "immagine" ){
                                includiComponente("image-post", $post);
                        }
                        else if ( $post['tipologia'] == "audio" ){
                                includiComponente("audio-post", $post); 
                        }
                        else if ( $post['tipologia'] == "link" ){
                                includiComponente("link-post", $post); 
                        }
                        else{
                                includiComponente("text-post", $post);
                        }
                }
        }else{
                ?>
                        <h4 class="h5 text-center p-3">Non ci sono post da vedere</h4>
                <?php 
        }
        ?>
</div>