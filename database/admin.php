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
                        header('Location:../admin/dashboard.php');
                    }
                    else
                    {
                        $_SESSION['ErrorMsg']  = "Incorrect Username or Password!!";
                       

                    }


                }
            }
        }

        
    }






?>