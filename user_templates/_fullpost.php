<?php
    $post_id = "";
    if(isset($_GET['search_btn']))
    {
        $allPosts = $post->getAllPost(htmlentities($_GET['Search']));
    }
    if(isset($_GET['id']))
    {
        $searchQueryParam = $_GET['id'];
        $singlePost = $post->getSinglePost( $searchQueryParam);
        if(empty($singlePost))
        {
            $_SESSION['PostErrorMsg'] = "Opps Page Not Found! Browse existing post."; 
             redirect_to('index.php'); 
        }
    }    
    if(!isset($_GET['id']) || empty($_GET['id']))
    {
        $_SESSION['PostErrorMsg'] = "Opps Page Not Found! Browse existing post."; 
        redirect_to('index.php'); 
    }

    //handling comments
    if(isset($_POST['add_comment']))
    {      
        if(empty($_POST['commenter_name']) ||  empty($_POST['commenter_email']) || empty($_POST['commenter_comments']))
        {
            $_SESSION['ErrorMsg'] = "All fields must be filled!!";
            redirect_to('fullpost.php?id='.$_POST['post_id']);
        }
        else if(strlen($_POST['commenter_comments']) > 500)
        {
            $_SESSION['ErrorMsg'] = "Comment length should be less than 500 characters!!";
            redirect_to('fullpost.php?id='.$_POST['post_id']);
        }        
        else{
            $post->addComment();
        }        
    }    

?>

    <div class="container mb-4">
        <div class="row mt-4">
            <div class="col-sm-8">
                <h1>The Complete Responsive CMS Blog</h1>
                <h1 class="lead">By Jeevista.</h1>
                
                <?php
                    echo SuccessMsg();
                    echo ErrorMsg();

                ?>

                <?php
                    foreach( $singlePost as $item):
                        $post_id = $item['id'];
                        $allApprovedComments = count($post->getApprovedComments($item['id']));

                ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <img src="assets/uploads/<?php echo htmlentities($item['post_img']) ?>" alt="post image" class="card-img-top img-responsive" style="max-height:450px;">
                        <h4 class="card-title mt-1"><?php echo htmlentities($item['title']) ?></h4>
                        <div class="d-flex me-auto flex-row justify-content-between">
                            <small class="text-muted">Written By: <?php echo htmlentities($item['author']) ?> On <?php echo ($item['date_time']) ?>
                                <span class="fw-bold"><?php echo ($item['category']) ?> </span>
                            </small>
                            <?php 
                                    if($allApprovedComments > 0)
                                    {
                                   
                                        if($allApprovedComments > 1)
                                        {
                                            echo '<small class="badge bg-secondary p-1"><span>Comments '.$allApprovedComments.'</span></small>';
                                
                                        } 
                                        if($allApprovedComments == 1)
                                        {
                                            echo '<small class="badge bg-secondary p-1"><span>Comment '.$allApprovedComments.'</span></small>';
                                        }
                                    }
                                ?>
                        </div>
                        <hr>
                        <p class="card-text"><?php echo $item['post_desc'];  ?></p>

                    </div>
                </div>

                <?php
                    endforeach;
                ?>
                <!-- start of fetching existing comments  -->
                <div>

               
                    <?php
                        $allComments = $post->getPostComments($post_id);
                        // print_r($allComments);
                        
                        foreach($allComments as $comment ):
                    ?>
                    <div class="media d-flex flex-row mb-2 bg-dark text-white p-1" >
                        <img src="./assets/user2.png" alt="User-img" width="64px" height="64px" class="align-self-start me-2 img-fluid">
                        <div class="media-body">                                                      
                                <h6 class="lead mb-0"><?php echo $comment['commenter_name'] ?></h6>
                                <small class=""><?php  echo $comment['date_time'] ?></small>                            
                                <p><?php echo $comment['comment'] ?></p>
                        </div>

                    </div>
                    <hr>

                    <?php
                        endforeach;
                    ?>


                      
                </div>   
                <!-- end of fetching existing comments  -->

                <!-- start of comment  -->
                <div class="">
                    <form action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$post_id; ?>" method="post">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>Share your thougts about this post</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-2">
                                    <div class="input-group">   
                                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">                                     
                                        <span class="input-group-text"> <i class="fas fa-user"></i> </span>                                        
                                        <input type="text" name="commenter_name" class="form-control" placeholder="Name">                                   
                                     </div>
                                </div>
                                <div class="form-group mb-2">
                                    <div class="input-group">                                        
                                        <span class="input-group-text"> <i class="fas fa-at"></i> </span>                                        
                                        <input type="email" name="commenter_email" class="form-control" placeholder="Email">                                   
                                     </div>
                                </div>
                                <div class="form-group mb-2">
                                    <textarea name="commenter_comments" id="commenter_comments" cols="30" rows="8" class="form-control"></textarea>                                  
                                </div>
                                <div>
                                    <button class="btn btn-primary float-end" name="add_comment" type="submit" >Submit</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>

                <!-- end of comment  -->
 
            </div>

              <!-- start of side area  -->
              <div class="col-sm-4" >
                <div class="card mt-4">
                    <div class="card-body p-0">
                        <img src="assets/uploads/bg-06.jpg" class="card-img-top img-responsive p-0" style="max-height:400px;">
                        <div class="text-center">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                Nostrum aut amet quasi?</p>
                        </div>
                    </div>                   
                </div>
                <br>
                <div class="card mb-4">
                    <div class="card-header bg-dark text-white">
                        <h2 class="lead">Sign Up</h2>
                    </div>
                    <div class="card-body">
                        <div class="btn-group d-flex flex-row me-auto mb-3">
                            <button class="btn btn-success text-center text-white me-2">Join Now</button>
                            <button class="btn btn-danger text-center text-white">Login Now</button>
                        </div>
                        <div class="input-group mb-3" role="group">
                            <input type="email" name="email_submit" class="form-control">                            
                            <button type="submit" name="submit_email" class="btn btn-primary text-white text-center">Subscribe</button>
                          
                        </div>
                        
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="lead">Categories</h2>
                    </div>                   
                    <div class="card-body">
                      
                            <?php
                                foreach($allCategories as $category):
                                    
                            ?>
                                <a href="index.php?category=<?php echo $category["title"];?>" class="categorylinks"><?php echo $category["title"];?> </a><br>
                            <?php
                                endforeach;
                            ?>                       
                        
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h2 class="lead">Latest Post</h2>
                    </div>
                    <div class="card-body">
                        <?php 
                            $latestPost = $post->getAllPost("");
                            foreach($latestPost as $latest):
                        ?>
                        <div class="media d-flex flex-row mb-2">
                            <img src="assets/uploads/<?php echo htmlentities($latest['post_img'] ) ?>" alt="post-img" width="84px" height="84px" classs="img-fluid d-block align-self-start">
                            <div class="media-body ms-2">
                               <a href="fullpost.php?id=<?php echo htmlentities($latest['id']); ?>"><h6 class="text-dark"><?php echo $latest['title']; ?></h6></a> 
                                <small class="text-muted"><?php echo htmlentities($latest['date_time']); ?></small>
                            </div>
                        </div>
                        <hr>


                        <?php  endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- end of side area  -->

           
        </div>
    </div>





