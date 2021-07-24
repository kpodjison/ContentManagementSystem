<?php
     $_SESSION['UrlTracker'] = $_SERVER['PHP_SELF'];
     $admin->confirmLogin();
?>
<?php
    
    // Handling creation of Admin 
    if(isset($_POST['add_admin'])){
        $password = $_POST['Password'];
        $confirm_password = $_POST['ConfirmPassword'];
        if(!empty($_POST['Username']))
        {
            if(strlen($_POST['Username']) < 4)
            {
                $_SESSION['ErrorMsg'] = "Admin username cannot be short!!"; 
            }
            else if(strlen($_POST['Password']) < 4)
            {
                $_SESSION['ErrorMsg'] = "Password cannot be short!!"; 
            }
            else if(strlen($_POST['Username']) > 49)
            {
                $_SESSION['ErrorMsg'] = "Admin username should be less than 50 characters!!"; 

            }
            else if($password != $confirm_password){

                $_SESSION['ErrorMsg'] = "Password and ConfirmPassword not matching!!"; 
            }
            else{
                $admin->addAdmin();                           
            }                   
           
        }
        else if(empty($_POST['Username'])){
            $_SESSION['ErrorMsg'] = "Please add a username!!";         
           
        }       
    }

    //delete admin
    if(isset($_GET['admid']))
    {
        $admin->DeleteAdmin();
    }

    //get all admins
    $allAdmins = $admin->getAllAdmins();    
    // print_r($allAdmins);

?>
    <!-- start of main content  -->
    <section class="bg-dark text-white font-roboto py-3">
        <div class="container bg-dark text-white">
            <div class="row">
                <div class="col-md-12">
                    <h1><span><i class="fas fa-users text-warning"></i></span> Manage Admins</h1>
                </div>
                
            </div>
           
        </div>

    </section>

<section class="container py-2 mb-4 " style="min-height:400px;">
    <div class="row">
        <div class="offset-lg-1 col-lg-10" >
            <?php
                echo SuccessMsg();
                echo ErrorMsg();
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                <div class="card  bg-secondary text-light mb-3 font-roboto">
                    <div class="card-header">
                        <h1>Add new Admin</h1>
                    </div>
                    <div class="card-body bg-dark ">
                        <div class="form-group">
                            <label for="Username" class="my-1">User Name</label>
                            <input type="text" name="Username" id="Username" class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="Name" class="my-1">Name</label>
                            <input type="text" name="Name" id="Name" class="form-control">
                            <small class="text-muted">Optional</small> 
                        </div>
                        <div class="form-group">
                            <label for="Password" class="my-1">Password</label>
                            <input type="password" name="Password" id="Password" class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="ConfirmPassword" class="my-1">Comfirm Password</label>
                            <input type="password" name="ConfirmPassword" id="ConfirmPassword" class="form-control"> 
                        </div>
                        
                        <div class="row my-3">
                            <div class="col-lg-6 text-white mb-2">
                                <a href="dashboard.php" class="btn btn-warning py-3" style="width:100%;height:65px;"> <span><i class="fas fa-arrow-left mr-1"></i></span> Back To Dashboard</a>
                              
                            </div>
                            <div class="col-lg-6 text-white mb-2"> 

                                <button class="btn btn-success" name="add_admin" style="width:100%;height:65px;"> <span><i class="fas fa-check mr-1"></i></span> Create Admin</button>
                            </div>
                        </div>

                    </div>
                </div>

            </form>

            <div class="col-lg-12" style="min-height:300px;">
                <h2>Existing Admins</h2>
                    <?php
                        echo SuccessMsg();               
                         echo ErrorMsg();               
                    ?>
                <table class="table table-responsive table-bordered table-striped table-hover">
                    <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Date&Time</th>
                        <th>Username</th>                        
                        <th>Admin Name</th>
                        <th>Added By</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            $counter = 0;
                            foreach($allAdmins as $ad_item):
                                $counter++;

                        ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><?php echo htmlentities($ad_item['date_time']); ?></td>
                            <td><?php echo htmlentities($ad_item['username']); ?></td>
                            <td><?php echo htmlentities($ad_item['a_name']); ?></td>
                            <td><?php echo htmlentities($ad_item['added_by'])??"Admin"; ?></td>
                            <td >                                  
                                <a href="admins.php?admid=<?php echo $ad_item['id'];?>" class="m-1"> <span class="btn btn-danger">Delete</span> </a>                              
                            </td>
                           
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                
            </div>


        </div>
    </div>
</section>
   