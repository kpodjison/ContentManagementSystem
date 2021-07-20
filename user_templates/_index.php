<?php
    if(isset($_GET['search_btn']))
    {
        $allPosts = $post->getAllPost(htmlentities($_GET['Search']));
    }

?>
    <div class="container mb-4">
        <div class="row mt-4">
            <div class="col-sm-8">
                <h1>The Complete Responsive CMS Blog</h1>
                <h1 class="lead">By Jeevista.</h1>
                <?php
                    echo PostErrorMsg();
                ?>
                <?php
                    foreach($allPosts as $item):

                ?>
                <div class="card">
                    <div class="card-body">
                        <img src="assets/uploads/<?php echo htmlentities($item['post_img']) ?>" alt="post image" class="card-img-top img-responsive" style="max-height:450px;">
                        <h4 class="card-title mt-1"><?php echo htmlentities($item['title']) ?></h4>
                        <div class="d-flex me-auto flex-row justify-content-between">
                        <small class="text-muted">Written By: <?php echo htmlentities($item['author']) ?> On <?php echo ($item['date_time']) ?></small>
                        <small class="badge bg-secondary p-1"> <span>Comments 20</span> </small>

                        </div>
                        <hr>
                        <p class="card-text"><?php echo substr( htmlentities($item['post_desc']),0,150)."...";  ?></p>

                        <a href="fullpost.php?id=<?php echo $item['id']?>" class="btn btn-primary float-end"> Read More >> </a>
                    </div>
                </div>

                <?php
                    endforeach;
                ?>
 
            </div>
            <div class="col-sm-4 bg-danger " >
            </div>
        </div>
    </div>



