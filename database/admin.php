<?php

    class Admin{
        public $db;

        public function __construct(DBController $db)
        {
            if(!isset($db->conn))
            {
                return null;
            }else
            $this->db = $db;
        }

        public function addAdmin(){
            
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                if(isset($_POST['add_admin'])){

                    $user_name = $this->db->mysqli->real_escape_string($_POST['Username']);
                    $name = $this->db->mysqli->real_escape_string($_POST['Name']);
                    $password = $this->db->mysqli->real_escape_string($_POST['Password']);
                    $admin = "Jeevista";

                    $sql = "INSERT INTO admins(username,a_name,password,added_by) VALUES ('$user_name','$name','$password','$admin')";
                    
                    // query to check if db has an existing admin username similar to the new username
                    $user_name_check_sql = "SELECT username FROM admins WHERE username = '$user_name'";
                    $name_check_results = $this->db->conn->query($user_name_check_sql);
                                        
                    if($name_check_results->num_rows > 0 ){
                        $_SESSION['ErrorMsg'] = "Sorry Admin username exists. Try a new name!!";
                    }
                    else if($this->db->conn->query($sql) === TRUE){
                        $_SESSION['SuccessMsg'] = "Admin {$user_name} Created Successfully!";
                    }                    
                }else
                {
                    $_SESSION['ErrorMsg'] = "Failed to Create Admin!!";
                }
            }
        }

        public function adminLogin()
        {
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                if(isset($_POST['admin_login']))
                {
                    $user_name = $this->db->mysqli->real_escape_string($_POST['Username']);
                    $password = $this->db->mysqli->real_escape_string($_POST['Password']);

                    $sql = "SELECT * FROM admins WHERE username='$user_name' AND password='$password' ";
                    $results = $this->db->conn->query($sql);
                    if($item = mysqli_fetch_assoc($results))
                    {

                        $_SESSION['UserId']  = $item['id'];
                        $_SESSION['UserName']  = $item['username'];
                        $_SESSION['AdminName']  = $item['a_name'];
                        $_SESSION['SuccessMsg']  = "Welcome ".$_SESSION['UserName']."!";
                        if(isset($_SESSION['UrlTracker'])){
                            header('Location:'.$_SESSION['UrlTracker']);
                        }else
                        {
                           header('Location:../admin/dashboard.php'); 
                        }                       
                        
                    }
                    else
                    {
                        $_SESSION['ErrorMsg']  = "Incorrect Username or Password!!";
                    }
                }
            }
        }

        public function confirmLogin()
        {
            if(isset($_SESSION['UserId']))
            {
                return TRUE;
            }
            else{
                $_SESSION['ErrorMsg'] = "Login Required!!";
                header('Location:../admin/login.php');
            }
        }

         //get all admins function
         public function getAllAdmins()
         {                     
         
                  $sql = "SELECT * FROM admins";
                  $results = $this->db->conn->query($sql);
                  $resultsArray = array();
            
                 while($item = mysqli_fetch_assoc($results))
                 {
                     $resultsArray[] = $item;
                 }            
            
                 //final results returned
             return $resultsArray;
         }

         //delete admin function 
           //delete comment 
           public function DeleteAdmin(){
            if($_SERVER['REQUEST_METHOD'] === 'GET')
            {
                if(isset($_GET['admid']))
                {
                    $adm_id = $_GET['admid'];
                    $sql = "DELETE FROM admins WHERE id='$adm_id' ";
                    $results = $this->db->conn->query($sql);
                    if($results == TRUE)
                    {
                        $_SESSION["SuccessMsg"] = "Admin Deleted successfully!";
                        
                    }
                    else
                    {
                        $_SESSION["ErrorMsg"] = "Something Went Wrong. Please Try Again!!";
                    }
                
                }
            }              
        }
 

        
    }






?>