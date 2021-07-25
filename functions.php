<?php
//    require DBController class file 
    // require('database/DBController.php');
    require('database/DBController.php');
    require('database/post.php');
    require('session.php');
    require('database/admin.php');

    // function to redirect user to a specific page
     function redirect_to($page)
    {
        header("Location:".$page);
        exit;
    }

    // db object 
    $db = new DBController();

    // post object 
    $post = new Post($db);

    //all categories
    $allCategories = $post->getAllCategories();
    // all posts 
    $allPosts = $post->getAllPost("");
    $admin = new Admin($db);

    
    


    // print_r($allPosts);
    // print_r($allCategories);
    


    
?>