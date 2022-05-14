<?php

$dbservername='localhost';
$dbname='acdb';
$dbusername='root';
$dbpassword='';
session_start();

$productName = $_REQUEST['productName'] ;
$price       = $_REQUEST['price'] ;
$quantity    = $_REQUEST['quantity'] ;
  $conn = new PDO("mysql:host=$dbservername; dbname=$dbname", 
  $dbusername, $dbpassword);
  # set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, 
  PDO::ERRMODE_EXCEPTION);
  try{
    $stmt=$conn->prepare("select SID from shops where UID=:user");
    $stmt->execute(array('user' => $_SESSION['curUser']['UID']));
    $SID = $stmt->fetch()[0];

    $stmt=$conn->prepare("delete from products where SID = $SID and productName = '$productName'");
    $stmt->execute();
    echo <<<EOT
        <!DOCTYPE html>
        <html>
        <body>
        <script>
        alert("remove success!" )
        window.location.replace("navshop.php")
        </script> </body> </html>
    EOT;

    exit();
  }
  catch(PDOException $e){
    $msg = $e->getMessage();
    echo <<<EOT
        <!DOCTYPE html>
        <html>
        <body>
        <script>
        alert("$msg" )
        window.location.replace("navshop.php")
        </script> </body> </html>
    EOT;

  }