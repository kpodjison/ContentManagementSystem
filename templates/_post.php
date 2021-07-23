<?php
    $admin->confirmLogin();
?>
<?php
    /* check if session exist for successfully editing a post
     and display a success message.*/
        function EditSuccessMsg()
        {
                if(isset($_SESSION["EditSuccessMsg"] ))
                {
                    $status = '<div class="alert alert-success">'
                                .htmlentities($_SESSION["EditSuccessMsg"]).
                                '</div>';    
                                //make this session null after using it
                                $_SESSION["EditSuccessMsg"]  = null;
                                return $status;
                }    
        }

        /* check if session exist for successfully deleting a post
     and display a success message.*/
     function DeleteSuccessMsg()
     {    
            if(isset($_SESSION['DeleteSuccessMsg']))
            {
                $status = '<div class="alert alert-success">'.
                htmlentities($_SESSION['DeleteSuccessMsg']).
                '</div>';

                //make this session null after using it
                $_SESSION['DeleteSuccessMsg'] =  null;
                return $status;

            }
    }

        
?>
<!-- style="min-height:622px;" -->   
    <section class="bg-dark text-white py-3">
        <div class="container bg-dark text-white">
            <div class="row">
                <div class="col-md-12">
                    <h1><span><i class="fas fa-blog text-warning"></i></span> Blog Posts  </h1>
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
            <?php
               echo EditSuccessMsg();               
               echo DeleteSuccessMsg();               
            ?>
           
         <div class="row">
             <div class="col-lg-12">
                 <table class="table table-responsive table-bordered table-striped table-hover">
                     <thead class="table-dark">
                         <tr>
                             <th scope="col">#</th>
                             <th scope="col">Title</th>
                             <th scope="col">Category</th>
                             <th scope="col">Date&Time</th>
                             <th scope="col">Author</th>
                             <th scope="col">Banner</th>
                             <th scope="col">Comment</th>
                             <th scope="col">Action</th>
                             <th scope="col">Live Preview</th>
                         </tr>
                     </thead>
                     <tbody>
                            <?php  
                                 $counter = 0;
                                foreach($allPosts as  $item ):
                                    $counter++;
                             ?>
                        <tr>                            

                             <td><?php echo $counter;?>  </td>
                             <td><?php echo substr($item['title'],0,15)."..."; ?>  </td>
                             <td><?php echo $item['category']?>  </td>
                             <td><?php echo $item['date_time']?>  </td>
                             <td><?php echo $item['author']?>  </td>
                             <td><img src="../assets/uploads/<?php echo $item['post_img']?>" alt="post-image" width="140px;" height="80px;"></td>
                             <td>comment </td>
                             <td>
                                    <div class="btn-group" role="group">

                                        <a href="editpost.php?id=<?php echo $item['id'] ?>" class="m-1"><span class="btn btn-warning">Edit</span> </a>
                                        <a href="deletepost.php?id=<?php echo $item['id'] ?>"class="m-1"><span class="btn btn-danger">Delete</span> </a>
                                    </div>
                                 
                            </td>
                             <td>
                                <a href="../fullpost.php?id=<?php echo $item['id'] ?>" class="m-1" target="_blank"><span class="btn btn-primary">Live Preview</span> </a>
                             </td>
                        </tr>
                             <?php
                                endforeach;
                             ?>
                         
                     </tbody>
                 </table>
             </div>
         </div>
     </section>


     <!-- end of main content  -->

   