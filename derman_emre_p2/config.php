<?php
if(!defined('host')) define ('host', 'localhost');
if(!defined('dbname')) define ('dbname', 'cs353');
if(!defined('username')) define ('username', 'derman');
if(!defined('password')) define ('password', 'password');
$host = 'dijkstra.ug.bcc.bilkent.edu.tr';
$username = 'emre.derman';
$password = 'Gty1Mlp7';
$dbname = 'emre_derman';
$mysqli = new mysqli($host,$username,$password,$dbname);

if($mysqli-> connect_errno){
    echo"Failed to connect to MYSQL: (" .$mysqli->connect_errno .") " . $mysqli->connect_error;
}else{
    echo "Connected Succesfully";
}
?>