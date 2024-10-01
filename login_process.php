<?php 
        session_start();
        require_once("require/database_settings.php");
        require_once("require/database.php");
        require_once("fpdf/fpdf.php");
    
        $database = new Database(HOSTNAME,USERNAME,PASSWORD,DATABASE);


extract($_REQUEST);
$query = "SELECT * FROM user WHERE email='" . $email . "' AND password='" . $password . "'";

$result = $database->query_excute($query);
if(isset($_REQUEST['submit']))
{       
        if($result->num_rows){
                $user = mysqli_fetch_assoc($result);
                $user_id = $user['user_id'];

                if($user['is_active'] == "Active" AND $user['role_id'] == 1)
                {
                        $_SESSION['user'] = $user_id;
                         header("location:admin/dashboard.php?user_id=$user_id"); 
                }
                if($user['role_id'] == 2 AND $user['is_approved'] == "Approved" AND $user['is_active']=="Active")

                {      
                         $_SESSION['user'] = $user_id;

                        header("location:index.php?user_id=$user_id");
                }
                if($user['role_id'] == 2 AND $user['is_approved'] == "Pending")
                {
                        header("location:login.php?message=Your Account is not Approved Yet Kindly Wait for Approval &color=red");
                }
                else
                {
                        echo"not matched";
                }
        }
        else
        {
                header("location:login.php?message=Invaid Email or Password Try Again...!&color=red");
        }
}

?>
