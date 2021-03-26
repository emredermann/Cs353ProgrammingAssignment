<?php
 include ("config.php");

 function cancel($cid,$password){
   $host = 'dijkstra.ug.bcc.bilkent.edu.tr';
   $username = 'emre.derman';
   $pword = '******';
   $dbname = 'emre_derman';
   $mysqli = new mysqli($host,$username,$pword,$dbname);

   $cancel_query = "delete from apply where sid = '$password' and cid = '$cid'";
   if($result = $mysqli->query($cancel_query)){
      echo "Succesfully deleted application.";
      header("Refresh:0");

   }else{
      echo "Unsuccesfully deleted application.";
   }
 }

session_start();
$password = $_SESSION['password'];
$query = "select * from company c left join apply a on c.cid = a.cid where sid = '$password'";

echo " <h2> <br> Welcome " . $_SESSION['username'] . "<br> Your applications are listed below: </h2>" ;
$result = $mysqli->query($query);

if($result->num_rows != 0) {
   echo "<form method='post'> ";
  while($row = $result->fetch_assoc()) {
      $cid = $row['cid'];
     echo "<br>Company ID :{$row['cid']}  <br> ".
         "Company NAME : {$row['cname']} <br> ".
         "Company QUOTA : {$row['quota']} <br>".
         "<input name ='cancel' type='submit' id='cancel' value = 'cancel'  /> <br>".
         "--------------------------------<br>";
  }
  echo " </form> ";
}else{
   echo " <p>0 results</p>";
}
   if(array_key_exists('cancel', $_POST)) { 
      cancel($cid,$password); 
   

}
?>
<html>
   
<head>
   <title>Welcome </title>
</head>

<body>
   <h2><a href = "internship_application.php">apply for new internship</a></h2>
   <h2><a href = "logout.php">Sign Out</a></h2>

</body>

</html>
