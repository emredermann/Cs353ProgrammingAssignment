<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['username'];
   $password = $_SESSION['password'];
   $ses_sql = mysqli_query($db,"select * from student where username = '$user_check' and password = '$password' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
      die();
   }
?>