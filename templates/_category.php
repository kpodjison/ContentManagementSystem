<?php
     $_SESSION['UrlTracker'] = $_SERVER['PHP_SELF'];
    $admin->confirmLogin();
?>

<?php
    if(isset($_POST['add_cat'])){
        if(!empty($_POST['title']))
        {
            if(strlen($_POST['title']) < 4)
            {
                $_SESSION['ErrorMsg'] = "Category title cannot be short!!"; 
            }
            else if(strlen($_POST['title']) > 49)
            {
                $_SESSION['ErrorMsg'] = "Category title should be less than 50 characters!!"; 

            }
            else{
                $post->addCategory();  

            }
                     
           
        }
        else if(empty($_POST['title'])){
            $_SESSION['ErrorMsg'] = "Please add a title!!";         
           
        }
       
    }
    if(isset($_GET['catid'])){
        $post->DeleteCategory();

    }


    //array to hold all existing categories
    $all_categories = $post->getAllCategories();

?>
    <!-- start of main content  -->
    <section class="bg-dark text-white font-roboto py-3">
        <div class="container bg-dark text-white">
            <div class="row">
                <div class="col-md-12">
                    <h1><span><i class="fas fa-pen-square text-warning"></i></span> Manage Categories</h1>
                </div>
                
            </div>
           
        </div>

    </section>

<section class="container py-2 mb-4 " style="min-height:410px;">
    <div class="row">
        <div class="offset-lg-1 col-lg-10" >
            <?php
                echo SuccessMsg();
                echo ErrorMsg();
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                <div class="card  bg-secondary text-light mb-3 font-roboto">
                    <div class="card-header">
                        <h1>Add new category</h1>
                    </div>
                    <div class="card-body bg-dark ">
                        <div class="form-group">
                            <label for="title" class="my-1">Category Title</label>
                            <input type="text" name="title" id="title" class="form-control"> 
                        </div>
                        <div class="row my-3">
                            <div class="col-lg-6 text-white mb-2">
                                <a href="dashboard.php" class="btn btn-warning py-3" style="width:100%;height:65px;"> <span><i class="fas fa-arrow-left mr-1"></i></span> Back To Dashboard</a>
                              
                            </div>
                            <div class="col-lg-6 text-white mb-2"> 

                                <button class="btn btn-success" name="add_cat" style="width:100%;height:65px;"> <span><i class="fas fa-check mr-1"></i></span> Publish</button>
                            </div>
                        </div>

                    </div>
                </div>

            </form>

            <div class="col-lg-12" style="min-height:300px;">
                <h2>Existing Categories</h2>
                    <?php
                        echo ApSuccessMsg();               
                         echo ErrorMsg();               
                    ?>
                <table class="table table-responsive table-bordered table-striped table-hover">
                    <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Date&Time</th>
                        <th>Category Name</th>                        
                        <th>Creator Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            $counter = 0;
                            foreach($all_categories as $cat_item):
                                $counter++;

                        ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><?php echo htmlentities($cat_item['date_time']); ?></td>
                            <td><?php echo htmlentities($cat_item['title']); ?></td>
                            <td><?php echo htmlentities($cat_item['author'])??"Admin"; ?></td>
                            <td >                                  
                                <a href="category.php?catid=<?php echo $cat_item['id'];?>" class="m-1"> <span class="btn btn-danger">Delete</span> </a>                              
                            </td>
                           
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                
            </div>

        </div>
    </div>
    
</section>

   