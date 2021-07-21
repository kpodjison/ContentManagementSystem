<?php
    class Post
    {
       public $db = null;       

        // constructor 
        public function __construct(DBController $db)
        {
            if(!isset($db->conn)){
                return null;
            }else
            $this->db = $db;

        }

        //add post function 
        public function addPost()
        {
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                if(isset($_POST['add_post']))
                {
                    $post_title = $this->db->mysqli->real_escape_string($_POST['postTitle']);
                    $category = $this->db->mysqli->real_escape_string($_POST['category']);
                    $image = $_FILES['image']['name'];
                    $ImgTargetDir  = "../assets/uploads/".basename($_FILES['image']['name']);
                    $post_desc =  $this->db->mysqli->real_escape_string($_POST['post_desc']);
                    $author = "jeevista";

                    $sql = "INSERT INTO post(title,category,author,post_img,post_desc) VALUES ('$post_title', '$category','$author','$image','$post_desc')";

                    if($this->db->conn->query($sql) === TRUE)
                    {
                        
                        //move file into uploads folder
                        move_uploaded_file($_FILES['image']['tmp_name'], $ImgTargetDir);                        
                        $_SESSION["SuccessMsg"] = "Post added successfully!";

                    }

                }
            }
            
        }
        //edit post function 
        public function editPost()
        {
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                if(isset($_POST['edit_post']))
                {
                    $post_id = $this->db->mysqli->real_escape_string($_POST['edit_post_id']);
                    $post_title = $this->db->mysqli->real_escape_string($_POST['postTitle']);
                    $category = $this->db->mysqli->real_escape_string($_POST['category']);
                    $image = $_FILES['image']['name'];
                    $ImgTargetDir  = "../assets/uploads/".basename($_FILES['image']['name']);
                    $post_desc =  $this->db->mysqli->real_escape_string($_POST['post_desc']);
                    $author = "jeevista";

                    //query to update table
                    $sql = "UPDATE post SET title='$post_title',category='$category',post_img='$image',post_desc='$post_desc' WHERE id='$post_id' ";

                    if($this->db->conn->query($sql) === TRUE)
                    {
                        
                        //move file into uploads folder
                        move_uploaded_file($_FILES['image']['tmp_name'], $ImgTargetDir);                        
                        $_SESSION['EditSuccessMsg'] = "Post {$post_id}: Edited Successfully!";
                        header("Location:post.php");
                          

                    }

                }
            }
            
        }

        //get all post function
        /*This function gets all post: 
            1. by default it returns all post (thus when called with an empty string as argument)
            2.  It returns post based on search keywords( thus when called with a string parameter from 
                searched keyword.)
        */
        public function getAllPost($searched_key_word)
        {
            //Variable to hold all results 
            $resultsArray = array();

            if(!empty($searched_key_word))
            {
                if($_SERVER['REQUEST_METHOD'] === "GET")
                {
            
                    if(isset($_GET['search_btn']))
                    {
                        $search = $this->db->mysqli->real_escape_string($_GET['Search']);                    
                        
                        $sql = "SELECT * FROM post WHERE date_time LIKE '%$search%' 
                        OR title LIKE '%$search%' 
                        OR category LIKE '%$search%' 
                        OR  post_desc LIKE '%$search%' 
                        ";
                        $results = $this->db->conn->query($sql);
                
                        while($item = mysqli_fetch_assoc($results))
                        {
                            $resultsArray[] = $item;
                
                        }                        
                    }              

                }
            } 
            else{
                    $sql = "SELECT * FROM post ORDER BY id DESC";
                    $results = $this->db->conn->query($sql);

                    while($item = mysqli_fetch_assoc($results))
                    {
                        $resultsArray[] = $item;
                    
                    }
                }

            return $resultsArray;
        }

        // function to get an single post 
        public function getSinglePost($id)
        {
            $sql = "SELECT * FROM post WHERE id='$id' ";
            $results = $this->db->conn->query($sql);

            $resultsArray = array();

            while($item = mysqli_fetch_assoc($results))
            {
                $resultsArray[] = $item;
            }
            
            return $resultsArray;
        }


        // add category function 
        public function addCategory(){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                if(isset($_POST['add_cat']))
                {

                    $title = $this->db->mysqli->real_escape_string($_POST['title']);
                    $author = $this->db->mysqli->real_escape_string('jeevista');
                    $sql = "INSERT INTO category (title,author) VALUES ('$title','$author')";

                    if($this->db->conn->query($sql) === TRUE){
                        // $this->status= "Category added successfully!";
                        $_SESSION["SuccessMsg"] = "Category added successfully!";
                    }
                    else
                    $_SESSION["ErrorMsg"] = "Failed to add category!!";
                }
            }

        }

        //get category function
        public function getAllCategories()
        {                     
        
                 $sql = "SELECT * FROM category";
                 $results = $this->db->conn->query($sql);
                 $resultsArray = array();
           
                while($item = mysqli_fetch_assoc($results))
                {
                    $resultsArray[] = $item;
                }            
           
                //final results returned
            return $resultsArray;
        }

    }




?>