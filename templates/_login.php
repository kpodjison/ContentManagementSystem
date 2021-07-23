<?php
    require('../admin/functions.php');
?>
<?php
    if(isset($_SESSION['UserId'])){
        header('Location:../admin/dashboard.php');
    }
    if(isset($_POST['admin_login']))
    {

        if(empty($_POST['Username']) ||  empty($_POST['Password']) )
        {
            $_SESSION['ErrorMsg'] = "All fields must be filled!!";
        }
        else if(strlen($_POST['Username']) < 4)
        {
            $_SESSION['ErrorMsg'] = "Invalid Username!!";
            
        }        
        else{
            $admin->adminLogin();
        }        
    }    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- boostrap css  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- local css  -->
    <link rel="stylesheet" href="style.css">

    <!-- fontawesome cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <header id="header">
           <!-- start of navbar  -->
    <div style="height:10px; background:yellow;"></div>
        <nav class="navbar navbar-expand-lg font-raleway navbar-dark bg-dark">
            <div class="container py-0 my-0 ">
                <a href="index.php" class="navbar-brand">Jeevista.com</a>
                

            </div>
        </nav>
    <div style="height:10px; background:yellow;"></div>

    <!-- end of navbar  -->

    </header>
    <!-- start of main content  -->
    <main>
    <!-- start of main content  -->
    <section class="bg-dark text-white py-3">
        <div class="container bg-dark text-white">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
           
        </div>
</section>

<section class="container py-2 mb-4">
    <div class="row">
        <div class="offset-sm-3 col-sm-6" style="min-height:450px;">
                <?php
                    echo SuccessMsg();
                    echo ErrorMsg();

                ?>

            <div class="card bg-secondary text-light my-2">
                <div class="card-header"> <h4>Welcome Back!!</h4></div>
                <div class="card-body bg-dark">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-info"> <i class="fas fa-user "></i> </span>
                                <input type="text" name="Username" id="Username" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Password">Password</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-info"> <i class="fas fa-unlock"></i> </span>
                                <input type="password" name="Password" id="Password" class="form-control">
                            </div>
                        </div>
                        <input type="submit" value="Submit" class="btn btn-info float-end" name="admin_login">
                    </form>
                </div>
            </div>
    
        </div>
    </div>

</section>
   