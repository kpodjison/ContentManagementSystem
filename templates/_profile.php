<?php
    $_SESSION['UrlTracker'] = $_SERVER['PHP_SELF'];
    $admin->confirmLogin();
?>
<?php
    $adminId = $_SESSION['UserId'];
    $currentAdmin = $admin->getSingleAdmin($adminId);
    // print_r($currentAdmin);

    //editing admin profile
    if(isset($_POST['edit_admin']))
    {
        if( strlen($_POST['headline']) > 25){
            $_SESSION['ErrorMsg'] = "Headline should be less than 15 characters!!";
        }
        else if( strlen($_POST['admin_bio']) > 500){
            $_SESSION['ErrorMsg'] = "Admin Bio should be less than 500 characters!!";
        }
        else
        {
            $admin->EditAdminProfile();
        }
    }


?>
    <!-- start of main content  -->
    <section class="bg-dark text-white font-roboto py-3">
                <?php
                    foreach($currentAdmin as $item):
                ?>
        <div class="container bg-dark text-white">
            <div class="row">
                <div class="col-md-12">
                    <h1><span><i class="fas fa-user me-1 text-warning"></i></span><?php echo "@".htmlentities($item['username'])??"Admin"; ?> </h1>
                    <small class="lead"><?php echo htmlentities($item['headline'])??"Headline" ?></small>
                </div>
                
            </div>
           
        </div>

    </section>

<section class="container py-2 mb-4 " style="min-height:622px;">
    <div class="row">
        <!-- start of left area  -->
        <div class="col-md-3">
            <div class="card">                
                <div class="card-header bg-dark text-light">
                    <h3><?php echo htmlentities($item['a_name'])??"Admin"; ?></h3>
                </div>
                <div class="card-body">
                    <img src="../assets/admins/<?php echo htmlentities($item['admin_img'])  ?>" alt="" class="img-fluid card-img-top mb-2" >
                    <div>
                    <p><?php echo htmlentities($item['admin_bio'])??"Biography"; ?></p>
                </div>
                </div>
                

                <?php  endforeach; ?>
            </div>

        </div>
        <!-- end of left area  -->
        <!-- start of right area  -->
        <div class="col-md-9" >
            <?php
                echo SuccessMsg();
                echo ErrorMsg();
            ?>
            <?php 
                foreach($currentAdmin as $admin):
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">
                <div class="card  bg-secondary text-light mb-3 font-roboto">
                    <div class="card-header"> <h4>Edit Profile</h4></div>
                   
                    <div class="card-body bg-dark "> 
                        <div class="form-group mb-3">
                            <input type="text" name="admin_name" placeholder="Enter Your Name" id="admin_name" class="form-control" value="<?php  echo $admin['a_name'];?>">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="headline" placeholder="Enter a headline" id="headline" class="form-control" value="<?php  echo $admin['headline'];?>"> 
                            <small class="text-muted">Add a professional headline like 'Programmer' at 'XYZ' or 'Writer' </small>
                            <span class="text-danger">Not more than 15 characters</span>
                        </div>
                        <div class="form-group mb-3">
                            <textarea name="admin_bio" id="admin_bio" cols="30" rows="10" class="form-control" placeholder="Enter Biography"><?php echo $admin['admin_bio']?></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image" id="image" class="form-control my-3"> 
                        </div>                      
                        <div class="row my-3">
                            <div class="col-lg-6 text-white mb-2">
                                <a href="dashboard.php" class="btn btn-warning py-3" style="width:100%;height:65px;"> <span><i class="fas fa-arrow-left mr-1"></i></span> Back To Dashboard</a>
                              
                            </div>
                            <div class="col-lg-6 text-white mb-2"> 

                                <button class="btn btn-success" name="edit_admin" style="width:100%;height:65px;"> <span><i class="fas fa-check mr-1"></i></span> Publish</button>
                            </div>
                        </div>

                    </div>
                </div>

            </form>
            <?php endforeach; ?>

        </div>
        <!-- end of right area  -->

    </div>
</section>
   