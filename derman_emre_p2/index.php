<?php
include ("config.php");

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = ($_POST["username"]);
    $password = ($_POST["password"]);
    session_start();
   $_SESSION['password'] = ($_POST["password"]);
   $_SESSION['username'] = ($_POST["username"]);
   
    $query = "select * from student where sname='$username' and sid ='$password'";
   
    if($result = $mysqli->query($query)){

            if($result->num_rows == 1){
                    $_SESSION['login_user'] = $username; 
                    header("location: student_welcome.php");
            }
            else{
                echo "injected";
                header("location:index.php");
            }
        }else{
            header("location:index.php");
        }

   }
?>
<html>
   
   <head>
      <title>CS353 Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
      <script>
      function validateForm() {
         var x = document.forms["myForm"]["username"].value;
         var y = document.forms["myForm"]["password"].value;
         if (x == "" or y == "") {
            alert("Name must be filled out");
            return false;
  }
}
</script>
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form name="myForm" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> " method = "post" onsubmit="return validateForm()">
                  <label>UserName  :</label><input type = "text" name = "username"  id ="username"  class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" id ="password"   class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
             
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>