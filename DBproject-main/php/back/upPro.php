<?php
$dbservername='localhost';
$dbname='acdb';
$dbusername='root';
$dbpassword='';
session_start();
$_SESSION['ok'] = true;

$conn = new PDO("mysql:host=$dbservername; dbname=$dbname", 
$dbusername, $dbpassword);
# set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, 
PDO::ERRMODE_EXCEPTION);

try{
    $productName = $_POST['pname'] ;
    $price       = $_POST['price'] ;
    $quantity    = $_POST['quantity'] ;

    if(isset($_FILES['images']['name']))
    {   
        $image_name = $_FILES['images']['name'];
        if($image_name!="")
        {   
            $ext = explode('.', $image_name)[1];
            $image_name = "Food-Name".rand(0000,9999).".".$ext;
            $src = $_FILES["images"]["tmp_name"];
            
            $dst = dirname(dirname(getcwd()))."/images/food/".$image_name;
            
            $upload = move_uploaded_file($src,$dst);
            
            if($upload==false){
                $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                header('../navshop.php');
                die();
            }
        }

        
    }else{
        $image_name = "";
    }
    

    $stmt=$conn->prepare("select SID from shops where UID=:user");
    $stmt->execute(array('user' => $_SESSION['curUser']['UID']));
    $SID = $stmt->fetch()[0];

    $stmt=$conn->prepare("select * from products where productName = '$productName' and SID = $SID");
    $stmt->execute();
    if ($stmt->rowCount()!=0){
      throw new Exception('Product existed.');
    }
    
    $s=$conn->prepare("select max(PID) from products");
    $s->execute();
    $k = $s ->fetch()[0];
    $PID=$k+1;

    $stmt=$conn->prepare("insert into products values ($PID, '$productName' ,$price ,$quantity ,$SID ,'$image_name');");       
    $stmt->execute();
    
    echo <<<EOT
    <!DOCTYPE html>
    <html>
    <body>
    <script>
    alert("add product success!" )
    window.location.replace("../../navshop.php")
    </script> </body> </html>
    EOT;

    exit();
}
catch(Exception $e){
  $_SESSION['ok'] =false;
  $msg = $e->getMessage();
  $_SESSION['errMsg'] = $e->getMessage();
    echo <<<EOT
        <!DOCTYPE html>
        <html>
        <body>
        <script>
       alert("$msg" )
        window.location.replace("../../navshop.php")
        </script> </body> </html>
    EOT;
}   
?>