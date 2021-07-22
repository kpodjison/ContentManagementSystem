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

                ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <img src="assets/uploads/<?php echo htmlentities($item['post_img']) ?>" alt="post image" class="card-img-top img-responsive" style="max-height:450px;">
                        <h4 class="card-title mt-1"><?php echo htmlentities($item['title']) ?></h4>
                        <div class="d-flex me-auto flex-row justify-content-between">
                        <small class="text-muted">Written By: <?php echo htmlentities($item['author']) ?> On <?php echo ($item['date_time']) ?></small>
                        <small class="badge bg-secondary p-1"> <span>Comments 20</span> </small>

                        </div>
                        <hr>
                        <p class="card-text"><?php echo $item['post_desc'];  ?></p>

                    </div>
                </div>

                <?php
                    endforeach;
                ?>
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

            <div class="col-sm-4 bg-danger " >
            </div>
        </div>
    </div>





