<!-- form modifica profilo-->
<div class="container p-5 align-self-end flex-column" id="profileSection">

    <div class="row mt-5 align-items-center">
        <div class="col-md-3 text-center mb-5">
            <div class="avatar avatar-xl">
                <img id="profileImg" src="/progetto-sito/assets/img/default.jpg" alt="profile Image" class="avatar-img rounded-circle mb-2"/>
            </div>
            <div class="text-muted" id="profileUsername"></div>
            <a id="profileContactMe" href="mailto:abc@example.com?subject=Feedback&body=Message">
                Contattami!
            </a>
        </div>
        <div class="col">
            <div class="row align-items-top">
                <div class="col-md-7">
                    <h4 class="mb-1" id="profileName"></h4>
                    <p class="small mb-3" id="profileGender"></p>
                </div>

                <?php
                if (isset($_SESSION["userCode"]) && $_SESSION["profileCode"] == $_SESSION["userCode"]){
                    echo '<div class="col-md-5 d-flex justify-content-end">';
                        echo '<div>';
                            echo '<a class="btn btn-primary" title="Modifica profilo" id="editProfileBtn">Modifica profilo</a>';
                        echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
            <div class="row mb-4">
                <div class="col-md-7">
                    <p id="profileBio">

                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid bgColorWhite p-0">
        
        <h3 class="text-dark fs-1 profile-blog-h3" id="profileBlog">I Blog di ...</h3>

        <div class="row g-3" id="profileBlogList">
            
        </div>

        <div class="row profile-collaboration-row">
            <h3 class="text-dark fs-1" id="profileCollaboration">... collabora con</h3>
        </div>

        <div class="row row-cols-lg-5 g-3" id="profileCollabList">
        </div>
    </div>

</div>
