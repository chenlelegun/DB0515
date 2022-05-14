

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
    
    if(isset($_SESSION['upload'])){
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }
?>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand " href="#">DJJs</a>
        </div>

    </div>
</nav>
<div class="container">
<body>
    <ul class="nav nav-tabs">
        <li><a href="nav.php">Home</a></li>
        <li class="active"><a href="navshop.php">shop</a></li>


    </ul>
    
    <div class="tab-content">
        
        <div id="menu1" class="tab-pane fade in active">
        
            <h3> Start a business </h3>
            
            <script>

                $(document).ready(function() {
                    $("#shopResForm").submit( function(event) {
                        event.preventDefault();
                        var shopname = $("#exshopname").val();
                        var category = $("#excategory").val();
                        var latitude = $("#exlatitude").val();
                        var longitude = $("#exlongitude").val();
                        $("#shopResErrMsg").load("php/nav/shopRegister.php", {
                            shopname :shopname,
                            category :category,
                            latitude :latitude,
                            longitude :longitude
                        });
                        //checkResShop();
                    });   
                });
                
                /*if(true){
                    //alert("shop register success!");
                    //document.getElementById('shopResSubmit').disabled = true ;
                    document.write("<p>这是一个段落。</p>");
                    document.getElementById("exshopname").readOnly="readOnly";
                    document.getElementById("excategory").readOnly="true";
                    document.getElementById("exlatitude").readOnly="true";
                    document.getElementById("exlongitude").readOnly="true";
                    document.getElementById("exshopname").value= "ffff";
                
                }
                
                */

                
            </script>

            <form action="php/nav/shopRegister.php" class="fh5co-form animate-box" data-animate-effect="fadeIn" method="post"  target="nm_iframe" id="shopResForm">

            <div class="form-group ">
                <div class="row">
                    <div class="col-xs-2">
                        <label for="ex5">shop name</label>
                        <input name="shopname" class="form-control" id="exshopname" placeholder="macdonald" type="text" required="required" value="">
                    </div>
                    <div class="col-xs-2">
                        <label for="ex5">shop category</label>
                        <input name="category" class="form-control" id="excategory" placeholder="fast food" type="text" required="required" >
                    </div>
                    <div class="col-xs-2">
                        <label for="ex6">latitude</label>
                        <input name="latitude" class="form-control" id="exlatitude" placeholder="121.00028167648875" type="text" required="required" >
                    </div>
                    <div class="col-xs-2">
                        <label for="ex8">longitude</label>
                        <input name="longitude" class="form-control" id="exlongitude" placeholder="24.78472733371133" type="text" required="required" >
                    </div>
                </div>
            </div>
            <p id = "shopResErrMsg" style="color:red">
            </p>
            <div class=" row" style=" margin-top: 25px;">
                <div class=" col-xs-3">
                    <input type="submit" value="register" class="btn btn-primary" id="shopResSubmit">
                    <!-- <button type="button" class="btn btn-primary">register</button> -->
                </div>
            </div>

            </form>
            
            <hr>
            <h3>ADD</h3>
            <script>
                
               

                
                
            </script>
            <form class="form-group " method="post" action="php/back/upPro.php" Enctype="multipart/form-data" id= "addProForm">
                <div class="row">

                    <div class="col-xs-6">
                        <label for="ex3">meal name</label>
                        <input class="form-control" id="pname" type="text" name="pname"  required>
                    </div>
                </div>
                <div class="row" style=" margin-top: 15px;">
                    <div class="col-xs-3">
                        <label for="ex7">price</label>
                        <input class="form-control" id="price" name="price" pattern="^[0-9]+$"type="text" required>
                    </div>
                    <div class="col-xs-3">
                        <label for="ex4">quantity</label>
                        <input class="form-control" id="quantity"  name="quantity" pattern="^[0-9]+$"type="text" required>
                    </div>
                </div>


                <p id="addproErrMsg" style="color :red "></p>

                <div class="row" style=" margin-top: 25px;">

                    <div class=" col-xs-3">
                        <label for="ex12">上傳圖片</label>
                        <input id="myFile" type="file" name="images" multiple class="file-loading" required>

                    </div>
                    <div class=" col-xs-3">

                        <button id="fuck" style=" margin-top: 15px;" type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>



            <div class="row">
                <div class="  col-xs-8">
                    <table class="table" style=" margin-top: 15px;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Picture</th>
                                <th scope="col">meal name</th>

                                <th scope="col">price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <iframe name="dummyframe" id="dummyframe" style="display: none;"><?php require "php/nav/displayOwnProduct.php"; ?></iframe>
                        <?php require "php/nav/displayOwnProduct.php"; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>



    </div>
</div>
</body>
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