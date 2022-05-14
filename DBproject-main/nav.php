

<?php require "php/shit/head2.php"; ?>
<?php
    session_start();
    $_SESSION['ok'] = true;
    /*
    $account = $_SESSION['account'];
    $conn = new PDO('mysql:host=localhost;dbname=acdb', 'root', '');
    $stmt=$conn->prepare("select * from users where account=:acc");
    $stmt->execute(array('acc' => $account));
    $row = $stmt->fetch();
    $stmt=$conn->prepare("select ST_AsText(location) from users where account=:acc");
    $stmt->execute(array('acc' => $account));
    //找location
    $geoloca = $stmt->fetch()["ST_AsText(location)"];
    $geoloca = substr($geoloca, 6, strlen($geoloca)-6-1);
    $loca = explode(" ",$geoloca);
    */
    $_SESSION['Authenticated']=false;
    $dbservername='localhost';
    $dbname='acdb';
    $dbusername='root';
    $dbpassword='';
    $conn = new PDO("mysql:host=$dbservername; dbname=$dbname", $dbusername, $dbpassword);
    # set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
?>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand " href="#">DJJs</a>
        </div>

    </div>
</nav>
<div class="container">

    <ul class="nav nav-tabs">
        <li class="active"><a href="nav.php">Home</a></li>
        <li><a href="navshop.php">shop</a></li>


    </ul>
    
    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <h3>Profile</h3>
            <div class="row">
                <div class="col-xs-12">
                
                    Accouont: <?php echo $_SESSION['curUser']['account']; ?>, user: <?php echo $_SESSION['curUser']['username'];?>, PhoneNumber: <?php echo $_SESSION['curUser']['phoneNum']; ?>, location: <?php echo $_SESSION['curUser']['latitude'],',',$_SESSION['curUser']['longitude']; ?>

                    <button type="button " style="margin-left: 5px;" class=" btn btn-info " data-toggle="modal" data-target="#location">edit location</button>
                    <!--  -->
                    
                    
                    
                    <div class="modal fade" id="location" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-sm">
                            <div class="modal-content">
                                <form action="php/nav/edit_location.php" class="fh5co-form animate-box" data-animate-effect="fadeIn" method="post" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">edit location</h4>
                                </div>
                                <div class="modal-body">
                                    <label class="control-label " for="latitude">latitude</label>
                                    <input name= lat type="text" class="form-control" id="latitude" placeholder="enter latitude" required="required">
                                    <br>
                                    <label class="control-label " for="longitude">longitude</label>
                                    <input name= lon type="text" class="form-control" id="longitude" placeholder="enter longitude" required="required">
                                </div>
                
                                <div class="modal-footer">
                                    <input type="submit" value="Edit" class="btn btn-primary">
                                   <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Edit</button> -->
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                   
                    
                    
                    <!--  -->
                    walletbalance: <?php echo $_SESSION['curUser']['balance']; ?>
                    <!-- Modal -->
                    <button type="button " style="margin-left: 5px;" class=" btn btn-info " data-toggle="modal" data-target="#myModal">Add value</button>
                    <div class="modal fade" id="myModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-sm">
                            <div class="modal-content">
                            <form action="php/nav/add_value.php" class="fh5co-form animate-box" data-animate-effect="fadeIn" method="post" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add value</h4>
                                </div>
                                <div class="modal-body">
                                    <input name="add_value" type="text" class="form-control" id="value" placeholder="enter add value" required="required">
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="Add" class="btn btn-primary">
                                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Add</button>-->
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- 
                搜尋SEARCH
                頁面 跳轉to action_page.php
                用session return data 
             -->
            <h3>Search</h3>
            <div class=" row  col-xs-8">
                <form method="post" class="form-horizontal" action="php/nav/action_page.php">
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="Shop">Shop</label>
                        <div class="col-sm-5">
                            <input name="shopname" type="text" class="form-control" placeholder="Enter Shop name">
                        </div>
                        <label class="control-label col-sm-1" for="distance">distance</label>
                        <div class="col-sm-5">


                            <select name="distance" class="form-control" id="sel1">
                                <option>null</option>
                                <option>near</option>
                                <option>medium </option>
                                <option>far</option>
                                

                            </select>
                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label col-sm-1" for="Price">Price</label>
                        <div class="col-sm-2">

                            <input name="min_price" type="text" class="form-control">

                        </div>
                        <label class="control-label col-sm-1" for="~">~</label>
                        <div class="col-sm-2">

                            <input name="max_price" type="text" class="form-control">

                        </div>
                        <label class="control-label col-sm-1" for="Meal">Meal</label>
                        <div class="col-sm-5">
                            <input name="meal" type="text" list="Meals" class="form-control" id="Meal" placeholder="Enter Meal">
                            <datalist id="Meals">
                                <option value="Hamburger">
                                <option value="coffee">
                            </datalist>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="category"> category</label>


                        <div class="col-sm-5">
                            <input name="category" type="text" list="categorys" class="form-control" id="category" placeholder="Enter shop category">
                            <datalist id="categorys">
                                <option value="fast food">

                            </datalist>
                        </div>
                        <button type="submit" style="margin-left: 18px;" class="btn btn-primary">Search</button>

                    </div>
                </form>
            </div>

            <!--搜尋結果      -->
            <div class="row">
                <div class="  col-xs-8">
                    <table class="table" style=" margin-top: 15px;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>

                                <th scope="col">shop name</th>
                                <th scope="col">shop category</th>
                                <th scope="col">Distance</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $Shopsname=array();
                            if($_SESSION['begin']){
                                
                            }
                            else{
                            foreach($_SESSION['Shops'] as $keys => $value){
                                $s=$conn->prepare("select * from shops where SID=$value");
                                $s->execute();
                                $shop = $s->fetch();
                                $id = $keys+1;
                                $shopname = $shop['shopname'];
                                array_push($Shopsname,$shopname);
                                $category = $shop['category'];
                                $s=$conn->prepare("select ST_Distance_Sphere(POINT(:lat,:lon),location) from shops where SID=$value");
                                $s->execute(array('lat' => $_SESSION['curUser']['latitude'] ,'lon' => $_SESSION['curUser']['longitude'] ));
                                $dis = $s -> fetch()[0];
                    
                                if($dis<100){$distance='near';}
                                elseif($dis<10000){$distance = 'medium';}
                                elseif($dis<10000000){$distance = 'far';}
                                //echo $dis;
                                //echo "<br>";
                            ?>
                                <tr>
                                <th scope="row"><?php echo $id ?></th>

                                <td><?php echo $shopname ?></td>
                                <td><?php echo $category ?></td>

                                <td> <?php echo $distance ?> </td>
                                <td> <button type="button" class="btn btn-info " data-toggle="modal" data-target="#<?php echo $shopname ;?>" >Open menu</button></td>

                                </tr>
                        
                            <?php
                            }
                            }
                            ?>
                 
                        
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <?php 
                        if($_SESSION['begin']){
                                
                        }
                        else{
                        foreach($_SESSION['Shops'] as $keys => $value){
                            $s=$conn->prepare("select * from shops where SID=$value");
                            $s->execute();
                            $shop = $s->fetch();
                            $shopname = $shop['shopname'];
                    ?>
                    <div class="modal fade" id="<?php echo $shopname ;?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">menu</h4>
                                </div>
                                <div class="modal-body">
                                    <!--  -->

                                    <div class="row">
                                        <div class="  col-xs-12">
                                            <table class="table" style=" margin-top: 15px;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Picture</th>

                                                        <th scope="col">meal name</th>

                                                        <th scope="col">price</th>
                                                        <th scope="col">Quantity</th>

                                                        <th scope="col">Order check</th>
                                                    </tr>
                                                </thead>
                                        
                                                <tbody>
                                                    <?php
                                                        $s=$conn->prepare("select * from products where SID=$value");
                                                        $s->execute();
                                                        foreach($s -> fetchAll() as $keys => $product){
                                                            $id = $keys+1;
                                                            $PID = $product['PID'];
                                    
                                                            $productName = $product['productName'];
                                                            $price = $product['price'];
                                                            $quantity	 = $product['quantity'];
                                                            $image_name = $product['image_name'];
                                                            $showimage = "images/food/".$image_name;
                                                    ?>

                                                    
                                                   
                                                    <tr>
                                                        <th scope="row"><?php echo $id;?></th>
                                                        <td><img src="<?php echo $showimage;?>" width="50" height="30" alt="<?php echo $productName;?>"></td>

                                                        <td><?php echo $productName;?></td>

                                                        <td><?php echo $price;?></td>
                                                        <td><?php echo $quantity;?></td>

                                                        <td> <input type="checkbox" id="cbox1" value="<?php echo $productName;?>"></td>
                                                    </tr>
                                                    


                                                    <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    <!--  -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Order</button>
                                </div>
                            </div>

                        </div>
                    </div>
                
                

                    <?php
                            }
                            }
                    ?>


                </div>

            </div>
        </div>
        
        


    </div>
</div>
<button id="logout" style=" margin-top: 15px;" type="button" class="btn btn-primary">logout</button>

<!-- Option 1: Bootstrap Bundle with Popper -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
<script>
    $(document).ready(function() {
        $("#logout").click(function() {
            <?php echo $_SESSION['Authenticated']=false;?>
            window.location.replace("index.php");
        });
    });
    $(document).ready(function() {
        $(".nav-tabs a").click(function() {
            $(this).tab('show');
        });
    });
</script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

<?php require "php/shit/foot.php"; ?>