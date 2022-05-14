<?php
session_start();
$_SESSION['Authenticated']=false;
$dbservername='localhost';
$dbname='acdb';
$dbusername='root';
$dbpassword='';

    $_SESSION['ok'] = true;
    $_SESSION['errMessage'] = "";

    if (!isset($_POST['longitude']) ||!isset($_POST['latitude']) ||!isset($_POST['shopname']) || !isset($_POST['category']))
    {
        exit();
    }


    $shopname = $_POST['shopname'];
    $category = $_POST['category'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
   
    try{
        $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
        # set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //* 店名可不可重複
        $stmt=$conn->prepare("select shopname from shops where shopname=:acc");
        $stmt->execute(array('acc' => $shopname));

        if ($stmt->rowCount()==0){
        //*/
            try{
                $stmt = $conn->prepare("select max(SID) from shops");
                $stmt->execute();
                $SID = $stmt->fetch()[0] + 1 ;
                $UID = $_SESSION['curUser']['UID'];
                $phonNum = $_SESSION['curUser']['phoneNum'];
                
                $stmt=$conn->prepare("insert into shops values ($SID ,$UID, '$shopname' ,'$category', ST_GeomFromText('POINT($latitude $longitude)'), '$phonNum');");
                $stmt->execute();

                $stmt=$conn->prepare("update users set identity = true where UID = $UID;");
                $stmt->execute();
                $_SESSION['curUser']['identity'] = true;
                $_SESSION['curUser']['SID'] = $SID;
                echo <<<EOT
                    <!DOCTYPE html>
                    <html>
                    <body>
                    <script>
                    alert("Resgister successfully.");
                    window.location.replace("../DBproject-main/navshop.php");
                    </script> </body> </html>
                EOT;
                
            }
            catch(PDOException $e){
                throw new Exception( $e->getMessage());
            }
        }
        else{
            echo "shop name existed.";
            exit();
        }
    }
    catch(PDOException $e){
        $_SESSION['ok'] = false;
        $k = $e->getMessage();
        echo "$k";
    }
/*
    echo <<<EOT
        <!DOCTYPE html>
        <html>
        <body>
        <script>
        alert("Resgister successfully.");
        window.location.replace("../../nav.php");
        </script> </body> </html>
    EOT;
        
        exit();
    */ 

    //}else
    //    throw new Exception("Logup failed.");
