<?php
   //fetching all post corresponding to search button parameter
    if(isset($_GET['search_btn']))
    {
        $allPosts = $post->getAllPost(htmlentities($_GET['Search']));
        /**check if the searched keyword results in an empty array
         * (thus does not exist). If yes display default post items and 
         * echo an error message to tell user the keyword does not exist.
         */
        if(empty( $allPosts))
        {
            
            $allPosts = $post->getAllPost("");
            $_SESSION['ErrorMsg'] = "Sorry there is no post correspoding
            to your search. Browse available posts.";
        }
    }
   //fetching all post corresponding to category type
    if(isset($_GET['category']))
    {
        $allPosts = $post->getAllPost(htmlentities($_GET['category']));
    }
    //fetching all post from pagination link
    if(isset($_GET['page']))
    {   
        if(is_numeric($_GET['page']))
        {
            $allPosts = $post-> getPaginationPost();
        }else
        {
            $_GET['page'] = 1;
            $allPosts = $post-> getPaginationPost();
        }
        
    }

?>
    <div class="container mb-4">
        <div class="row mt-4">
            <div class="col-sm-8">
                <h1>Jeevista CMS Blog</h1>
                <h1 class="lead">By Jeevista.</h1>
                <?php
                    echo ErrorMsg();
                ?>
                <?php
                    foreach($allPosts as $item):
                        $allApprovedComments = count($post->getApprovedComments($item['id']));

                ?>
                <div class="card">
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
                        <p class="card-text"><?php echo substr( htmlentities($item['post_desc']),0,150)."...";  ?></p>

                        <a href="fullpost.php?id=<?php echo $item['id']?>" class="btn btn-primary float-end"> Read More >> </a>
                    </div>
                </div>

                <?php
                    endforeach;
                ?>
                <!-- start of pagination  -->
                <nav class="my-4">
                    <ul class="pagination pagination-lg justify-content-center">

                        <?php  
                             $TotalPosts = $post->getPostTotal();
                            // echo $TotalPosts;
                             $pagination = ceil($TotalPosts/5);
                             //echo $pagination;
                             //variable to hold current page id  
                             $currentPage = null;

                             /*set page to 1 by default if it's empty or if its greater 
                             than the total number of posts 
                             */
                             if(empty($_GET['page'])){
                                $_GET['page'] = 1;
                            }
                            
                        ?> 
                         <!-- start of backward button  -->
                         <?php
                            if(isset($_GET['page']))
                            {   
                                $currentPage = $_GET['page'];  
                                $PrevPage = $_GET['page'] - 1;
                                if($currentPage > 1 && $currentPage <=$pagination){
                                     echo '<li class="page-item">
                                        <a href="index.php?page='.$PrevPage.'"class="page-link">&laquo;</a>
                                         </li> ';
                                }                                   
                            }

                        ?>
                        <!-- end of backward button  -->

                        <?php  
                             $TotalPosts = $post->getPostTotal();
                            // echo $TotalPosts;
                             $pagination = ceil($TotalPosts/5);
                             //echo $pagination;

                            for($i =1; $i <= $pagination; $i++)
                            {                                 
                                 $currentPage = $_GET['page'];  

                                if($i == $currentPage){
                                    echo '<li class="page-item active">
                                        <a href="index.php?page='.$i.'"class="page-link">'.$i.'</a>
                                         </li> ';
                                }
                                else{
                                    echo '<li class="page-item">
                                        <a href="index.php?page='.$i.'"class="page-link">'.$i.'</a>
                                         </li> ';
                                }
                                
                            }

                        ?>                        
                        <!-- start of forward button  -->
                        <?php
                            if(isset($_GET['page']))
                            {
                                $NextPage = $_GET['page'] + 1;
                                if($NextPage <= $pagination){
                                     echo '<li class="page-item">
                                        <a href="index.php?page='.$NextPage.'"class="page-link">&raquo;</a>
                                         </li> ';
                                }                                   
                            }

                        ?>
                        <!-- end of forward button  -->
                        
                      
                    </ul>
                 
                </nav>
                <!-- end of pagination  -->
 
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



