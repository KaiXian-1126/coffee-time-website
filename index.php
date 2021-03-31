<script src="./javascript/webpage.js"></script>
<?php
session_start(); 
require_once('./php/db_config.php');
$sql = "SELECT DISTINCT `Brand` FROM `coffeelist` ORDER BY `Brand` ASC";
$result = mysqli_query($db_conn, $sql);
$resultrow = mysqli_fetch_assoc($result);
$first_brand;
if(isset($_GET['logout'])){
  session_destroy();
  echo "<script>goto('index.php')</script>";
}
if (isset($_GET['brand'])){
  $first_brand = $_GET['brand'];
  echo "<script>goto('#coffee');</script>";
}else{
  $first_brand = $resultrow['Brand'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Coffee Time</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Coffee Time</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#home">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#coffee">Coffee</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact-list">Contact</a>
          </li>
          <?php 
          if(!isset($_SESSION['email'])){ ?>
            <li class="nav-item">
            <a class="nav-link" href="./php/login.php">Sign In</a>
            </li>
         
          <?php }else{ 
            $sql_user= "SELECT `UserType` FROM `user` WHERE `email` = '".$_SESSION['email']."'"; 
            $result_user = mysqli_query($db_conn, $sql_user);
            $resultrow_user = mysqli_fetch_assoc($result_user);
            if($resultrow_user['UserType'] == "Member"){  
          ?>
            <li class="nav-item">
              <a class="nav-link" href="./php/manage_user.php">Manage User</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./php/view_item.php">Manage Coffee</a>
            </li>
          <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?logout">Logout</a>
            </li>
          <?php } ?>
          
        </ul>
      </div>
    </div>
  </nav>

  <!-- Home Page Content -->
  <div id="home" class="homepage">
    <img src="./img/coffeebg.jpg" alt="Snow" style="width:100%;">
    <p class="top-left">Coffee Time is a website that collaborate with the famous coffee brand to deliver the coffee to the customer around the world.</p>
    <p class="top-left-subtext">Smooth out your day, every day.</p>
  </div>
  
  <!-- /.container -->
  <!--Item Page Content -->
  <div id="coffee" class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">Brand</h1>
        <div class="list-group">
          <?php 
            do{ 
          ?>
          <a href="index.php?brand=<?php echo $resultrow['Brand'];?>" class="list-group-item"><?php echo $resultrow['Brand']; ?></a>

          <?php }while($resultrow = mysqli_fetch_assoc($result)); ?>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <?php
              $sqlad = "SELECT `AdImage` FROM `advertisement_list`";
              $resultad = mysqli_query($db_conn, $sqlad);
              //900x350
          ?>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img id="ad" class="d-block img-fluid" src="<?php echo './img/advertisement/'.mysqli_fetch_assoc($resultad)['AdImage']; ?>" alt="First slide">
            </div>
            <div class="carousel-item">
              <img id="ad" class="d-block img-fluid" src="<?php echo './img/advertisement/'.mysqli_fetch_assoc($resultad)['AdImage']; ?>" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img id="ad" class="d-block img-fluid" src="<?php echo './img/advertisement/'.mysqli_fetch_assoc($resultad)['AdImage']; ?>" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="row">
        <?php 
          $sqlitem = "SELECT * FROM `coffeelist` WHERE `Brand` = '".$first_brand."'";
          $result = mysqli_query($db_conn, $sqlitem);
          while($resultrow = mysqli_fetch_assoc($result)){
        ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img id="coffee-item" class="card-img-top" src="<?php echo "./img/coffee/".$resultrow['ItemImage']; ?>" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#"><?php echo $resultrow['ItemName']; ?></a>
                </h4>
                <h5><?php echo "RM ".$resultrow['ItemPrice']; ?></h5>
                <!--<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.</p> -->
              </div>
             <!-- <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div> -->
            </div>
          </div>
          <?php } ?>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
  <div id="contact-list" class="link-list">
      <a href="mailto:kaixianp@gmail.com"><img id="link1" src="./img/emailLogo.jpg"></a>
      <a href="https://www.facebook.com/Coffee-Time-1419753448267526/"><img id="link2" src="./img/facebookLogo.png"></a>
      <a href="https://www.instagram.com/coffee.time__/?hl=zh-tw"><img id="link3" src="./img/instagramLogo.jpg"></a>
  </div>
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Coffee Time 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
