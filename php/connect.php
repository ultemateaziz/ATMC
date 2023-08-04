<?php
//server,username,password,databasename,
$con=mysqli_connect("localhost","root","","atmc");
if(!$con){
    die("Failed to Establish Database Connection");
    //connection of database
    
}