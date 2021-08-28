<?php

$id=0;
$ifupdate=false;
$fname ="";
$lname ="";
$uname ="";
$email ="";
$pass ="";
$dob ="";


$host='localhost';
$dbUsername='root';
$dbPassword='';
$dbname='userdata';

$connection = mysqli_connect($host, $dbUsername, $dbPassword);

if(!$connection ){
    echo 'Connection Error';
}else if(!mysqli_select_db($connection, $dbname)){
    echo 'Database connected';
}

if(isset($_POST['save'])){
    $fname =$_POST['fname'];
    $lname =$_POST['lname'];
    $uname =$_POST['uname'];
    $email =$_POST['email'];
    $pass =$_POST['pass'];
    $dob =$_POST['dob'];

    $sql = "INSERT INTO userinfo (fname,lname,uname,email,pass,dob) VALUES('$fname','$lname','$uname','$email','$pass','$dob')";

    if(!mysqli_query($connection,$sql)){
        echo "Error in insertion";
    }else{
        header("refresh:2, url=home.php");

    }

}

if(isset($_GET['delete'])){
    $itemId = $_GET['delete'];
    
     $itemDelete = "DELETE FROM userinfo WHERE id=$itemId";

    if(!mysqli_query($connection,$itemDelete)){
        echo "Something went wrong";
    }else{
        header("refresh:2, url=home.php");

    }
}


if(isset($_GET['edit'])){
    $itemeId = $_GET['edit'];
    
     $itemEdit = $connection->query("SELECT * FROM userinfo WHERE id=$itemeId") or die($connection->error());

        if(count($itemEdit)==1){
            $data=$itemEdit->fetch_array();
            $id=$data['id'];
            $ifupdate=true;
            $fname=$data['fname'];
            $lname=$data['lname'];
            $uname=$data['uname'];
            $email=$data['email'];
            $pass=$data['pass'];
            $dob=$data['dob'];
    }else{
        echo "Something went wrong";
    }
}

if(isset($_POST['update'])){
    $id =$_POST['id'];
    $fname =$_POST['fname'];
    $lname =$_POST['lname'];
    $uname =$_POST['uname'];
    $email =$_POST['email'];
    $pass =$_POST['pass'];
    $dob =$_POST['dob'];

    $connection->query("UPDATE userinfo SET fname='$fname',lname='$lname',uname='$uname',email='$email',pass='$pass',dob='$dob' WHERE id='$id'") or die($connection->error());

    header("refresh:2, url=home.php");
}

?>
