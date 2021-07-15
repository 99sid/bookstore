<?php

include "dbconnect.php";


if(isset($_POST['submit']))
{
   if($_POST['submit']=="register")
     {
        $username=$_POST['register_username'];
        $useremail=$_POST['register_useremail'];
        $password=$_POST['register_password'];
        $query="select * from users where UserName = '$username'";
        $result=mysqli_query($con,$query) or die(mysql_error);
        if(mysqli_num_rows($result)>0)
        {   
              header("Location: index.php?register=" . "Username is already taken...Use different username");
        }
        else
        {
          $query ="INSERT INTO users (UserName,Password,useremail) VALUES ('$username','$password','$useremail')";
          $result=mysqli_query($con,$query) or die(mysql_error);
          header("Location: index.php?register=" . "Successfully Registered!!");
		  
        }
    }
}


?>