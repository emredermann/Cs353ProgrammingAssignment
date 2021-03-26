<?php
 include ("config.php");

 function apply($cid,$password){
   $host = 'dijkstra.ug.bcc.bilkent.edu.tr';
   $username = 'emre.derman';
   $pword = 'Gty1Mlp7';
   $dbname = 'emre_derman';
   $mysqli = new mysqli($host,$username,$pword,$dbname);
   $apply_query =  "insert into apply(sid,cid) values ('$password' , '$cid')";

   if($result = $mysqli->query($apply_query)){
    echo "<script type='text/javascript'>alert('Succesfully apply application.');</script>";
      header("location:student_welcome.php");
   }else{
    echo "<script type='text/javascript'>alert('Unsuccesfully apply application.');</script>";
   }
 }

session_start();
$password = $_SESSION['password'];
$query = "select * from company";

$result = $mysqli->query($query);

if($result->num_rows != 0) {
   echo "<form method='post'> ";
  while($row = $result->fetch_assoc()) {
      $cid = $row['cid'];
     echo "<br>Company ID :{$row['cid']}  <br> ".
         "Company NAME : {$row['cname']} <br> ".
         "Company QUOTA : {$row['quota']} <br>".
         "<input name ='apply' type='submit' id='apply' value = 'apply'  /> <br>".
         "--------------------------------<br>";
  }
  echo " </form> ";
}else{
   echo " <p>0 results</p>";
}
   if(array_key_exists('apply', $_POST)) { 
      apply($cid,$password); 
   

}
?>
<html>
   
<head>
   <title>Application Page </title>
</head>

<body>
   <h2><a href = "logout.php">Sign Out</a></h2>

</body>

</html>