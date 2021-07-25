<?php
        if(isset($_GET['username'])){
            $admin_username = $_GET['username'];
            $currentAdmin = $admin->getSingleAdmin( $admin_username);
            if(empty($currentAdmin)){
                $_SESSION['ErrorMsg'] = "Incorrect Admin Username!!";
                redirect_to('index.php');
            }

        }else
        {
            $_SESSION['ErrorMsg'] = "Bad Request!!";
            redirect_to('index.php');
        }


         

?>

<?php
    foreach($currentAdmin as $admin):

?>
    <!-- start of main content  -->
    <section class="bg-dark text-white py-3">
        <div class="container bg-dark text-white">
            <div class="row">
                <div class="col-md-6">
                    <h1><span><i class="fas fa-user text-warning me-2"></i></span><?php  echo htmlentities($admin['a_name'])?></h1>
                    <h3><?php  echo htmlentities($admin['headline'])?></h3>
                </div>
            </div>           
        </div>
    </section>
    <div class="container py-2 mb-4 pe-0">
        <div class="row border">
            <div class="col-md-3 card p-0">
                <img src="assets/admins/<?php echo htmlentities($admin['admin_img'])  ?>" alt="" class="card-img img-fluid rounded-circle" style="width:100%;height:100%">
                <div class="card-img-overlay"></div>                    
                
            </div>
            <div class="col-md-9 " style="min-height:350px;">
                <div class="card border-0">
                    <div class="card-body">
                        <p class="lead"><?php  echo htmlentities($admin['admin_bio'])?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <?php endforeach; ?>