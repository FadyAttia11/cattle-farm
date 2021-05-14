<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>The Cattle Farm</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.php">TheCattleFarm</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="new-product.php">Add New Product</a></li>
          <li class="active"><a href="price-today.php">Today's Pricing</a></li>
          <li><a href="hire-labour.php">Hire Labour</a></li>
          <li><a href="buy-fodders.php">Buy Fodder</a></li>
          <li><a href="#">Farm: <?php echo $user_data['user_name'] ?></a></li>
          <li><a href="logout.php">Logout</a></li>

        </ul>
      </nav><!-- .nav-menu -->

      <a href="my-profile-farm.php" class="get-started-btn scrollto">My Profile</a>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Today's Pricing</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Today's Pricing</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
      <h3>Pricing for today - The Date: <span id="date"></span></h3>
      <div class="mt-5">
        <h4>Chicken Pricing</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Category</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Meat</td>
              <td>28 L.E</td>
            </tr>
            <tr>
              <td>Egg</td>
              <td>1.25 L.E</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="mt-5">
        <h4>Camel Pricing</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Category</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Meat</td>
              <td>216 L.E</td>
            </tr>
            <tr>
              <td>Milk</td>
              <td>26.50 L.E</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="mt-5">
        <h4>Sheep Pricing</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Category</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Meat</td>
              <td>184 L.E</td>
            </tr>
            <tr>
              <td>Milk</td>
              <td>24.75 L.E</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="mt-5">
        <h4>Cattle Pricing</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Category</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Meat</td>
              <td>168 L.E</td>
            </tr>
            <tr>
              <td>Milk</td>
              <td>17.75 L.E</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="mt-5">
        <h4>Ostrich Pricing</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Category</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Meat</td>
              <td>283 L.E</td>
            </tr>
            <tr>
              <td>Milk</td>
              <td>27.25 L.E</td>
            </tr>
          </tbody>
        </table>
      </div>
      
      </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div>

  <script>
    n =  new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    document.getElementById("date").innerHTML = m + "/" + d + "/" + y;
  </script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>