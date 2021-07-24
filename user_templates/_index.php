<?php
   //fetching all post corresponding to search button parameter
    if(isset($_GET['search_btn']))
    {
        $allPosts = $post->getAllPost(htmlentities($_GET['Search']));
    }
    //fetching all post from pagination link
    if(isset($_GET['page']))
    {
        $allPosts = $post-> getPaginationPost();
    }

?>
    <div class="container mb-4">
        <div class="row mt-4">
            <div class="col-sm-8">
                <h1>Jeevista CMS Blog</h1>
                <h1 class="lead">By Jeevista.</h1>
                <?php
                    echo PostErrorMsg();
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
            <div class="col-sm-4 bg-danger " >
            </div>
        </div>
    </div>



