<?php
    $_SESSION['UrlTracker'] = $_SERVER['PHP_SELF'];
    $admin->confirmLogin();
?>
<?php
        /* get the total number of categories and posts using arrays
        $allCategories and $allPosts
        NB. These arrays are already declared in functions.php file so they will 
        just be called using the count method */
        $category_sum =count($allCategories); 
        $post_sum = count($allPosts);

        // declare array to hold all admins 
        $allAdmins = $admin->getAllAdmins();
        $admin_sum = count($allAdmins);

        // declare array to hold all comments 
        $allComments = $post->getAllComments();
        $comment_sum = count($allComments);

        //get latest post
        $latestPost = $post->getLatestPost(5);
        // print_r($latestPost);
 
        
?>
<!-- style="min-height:622px;" -->   
    <section class="bg-dark text-white py-3">
        <div class="container bg-dark text-white">
            <div class="row">
                <div class="col-md-12">
                    <h1><span><i class="fas fa-chalkboard-teacher text-warning"></i></span> Dashboard</h1>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-3 col-md-12 mb-2" ">
                        <a href="addpost.php" class="btn btn-primary" >
                            <span> <i class="fas fa-edit "></i> Add New Post</span>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-12 mb-2">
                        <a href="category.php" class="btn btn-info ">
                            <span> <i class="fas fa-folder-plus "></i> Add New Category</span>
                        </a>
                    </div>                    
                    <div class="col-lg-3 col-sm-12 mb-2" >
                        <a href="admins.php" class="btn btn-warning">
                            <span> <i class="fas fa-user-plus "></i> Add New Admin</span>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-12 mb-2">
                        <a href="comments.php" class="btn btn-success">
                            <span> <i class="fas fa-check "></i> Approve Comment</span>
                        </a>
                    </div>

            </div> 
           
           
        </div>

    </section>
     <!-- start of main content  -->
    
     <section class="container py-2 mb-4">
          
         <div class="row">
         <?php
               echo SuccessMsg();               
               echo ErrorMsg();               
            ?>       
            <!-- start of left side area      -->
             <div class="col-lg-2 d-none d-md-block">
                 <div class="card text-center bg-dark text-white mb-3">
                     <div class="card-body">
                         <h1 class="lead">Posts</h1>
                         <h4 class=""
                          <span><i class="fab fa-readme"></i></span>
                             <?php  echo $post_sum??0; ?>                           
                         </h4>
                     </div>
                 </div>
                 <div class="card text-center bg-dark text-white mb-3">
                     <div class="card-body">
                         <h1 class="lead">Categories</h1>
                         <h4 class=""
                          <span><i class="fas fa-folder-open"></i></i></span>
                          <?php  echo $category_sum??0; ?>                            
                         </h4>
                     </div>
                 </div>
                 <div class="card text-center bg-dark text-white mb-3">
                     <div class="card-body">
                         <h1 class="lead">Users</h1>
                         <h4 class=""
                          <span><i class="fas fa-users"></i></span>
                          <?php  echo $admin_sum??0; ?>                             
                         </h4>
                     </div>
                 </div>
                 <div class="card text-center bg-dark text-white mb-3">
                     <div class="card-body">
                         <h1 class="lead">Comments</h1>
                         <h4 class=""
                          <span><i class="fas fa-comments"></i></span>
                          <?php  echo $comment_sum??0; ?>                            
                         </h4>
                     </div>
                 </div>

                
             </div>
              <!-- end of left side area      -->

              <!-- start of right side area      -->
              <div class="col-lg-10">
                  <h1>Top Posts</h1>
                  <table class="table table-striped table-responsive table-bordered table-hover">
                      <thead class="table-dark">
                          <tr>
                              <th>No.</th>
                              <th>Title</th>
                              <th>Date&Time</th>
                              <th>Author</th>
                              <th>Comments</th>
                              <th>Details</th>
                          </tr>
                          </thead>
                          <tbody>
                              <?php 
                                $counter = 0; 
                                foreach($latestPost as $postItem):
                                $counter++;
                                //declay array to hold approved comments
                                $allApprovedComments = count($post->getApprovedComments($postItem['id']));
                                //declay array to hold unapproved comments
                                $allUnApprovedComments = count($post->getUnApprovedComments($postItem['id']));
                              ?>
                              <tr>
                                  <td><?php  echo $counter;?></td>
                                  <td><?php  echo $postItem['title']?></td>
                                  <td><?php  echo $postItem['date_time']?></td>
                                  <td><?php  echo $postItem['author']?></td>
                                  <td>
                                          <?php
                                            if($allApprovedComments > 0)
                                            {
                                              echo '<span class="badge bg-success mx-2 p-2 fs-5 my-1">'.$allApprovedComments.'</span>';
                                            }
                                            if($allUnApprovedComments > 0)
                                            {
                                              echo '<span class="badge bg-danger mx-2 p-2 fs-5 my-1">'.$allUnApprovedComments.'</span>';
                                            }

                                          ?>                                          
                                    
                                    </td>
                                  <td>
                                      <a href="../fullpost.php?id=<?php echo $postItem['id']?>" class="btn btn-info" target="_blank">Preview </a> 
                                  </td>
                                 
                              </tr>
                              <?php  endforeach ?>
                          </tbody>                      
                  </table>
              </div>

              <!-- end of right side area      -->
         </div>
     </section>


     <!-- end of main content  -->

   