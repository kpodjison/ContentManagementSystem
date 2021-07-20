<?php
    require('functions.php');
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
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#vista-navbar-collapse" aria-controls="vista-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="vista-navbar-collapse">

            
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        
                        <li class="nav-item">
                            <a href="index.php" class="nav-link ">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="post.php" class="nav-link">About us</a>
                        </li>
                        <li class="nav-item">
                            <a href="blog.php" class="nav-link">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Contact us</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Features</a> 
                        </li>
                       
                    </ul>
                  
                    <form action="index.php" class="d-flex">
                        <input type="search" class="form-control me-2" name="Search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success text-white" type="submit" name="search_btn">Search</button>
                    </form>
                </div>

            </div>
        </nav>
    <div style="height:10px; background:yellow;"></div>

    <!-- end of navbar  -->

    </header>
    <!-- start of main content  -->
    <main>