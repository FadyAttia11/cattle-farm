<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $farm_name = $user_data['user_name'];

    $all_labours_query = "select * from users where user_role = 'labour'";
    $all_labours = mysqli_query($con, $all_labours_query);

    $labour_responses_query = "select * from hiring where farm_name = '$farm_name' and response != ''";
    $labour_responses = mysqli_query($con, $labour_responses_query);

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
          <li><a href="price-today.php">Today's Pricing</a></li>
          <li class="active"><a href="hire-labour.php">Hire Labour</a></li>
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
          <h2>Hire Labour</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Hire Labour</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">
          <h3>Hire Labour</h3>
          <div class="row">
              <?php
                  while($row = mysqli_fetch_array($all_labours)) {
              ?>

              <div class="col-6">
                  <a href=<?php echo "labour.php?id=". $row['id'] ?>><img src=<?php echo "./uploads/".$row['image'] ?> alt="" style="width: 50%; border: 1px solid #cda45e;"></a>
                  <h5>Name: <?php echo $row['user_name'] ?></h5>
                  <h5>Labour Type: <?php echo $row['category'] ?></h5>
              </div>

              <?php } ?>
          </div>
          
          <h3 style="margin-top: 100px;">Labour Responses</h3>
          <div class="row">
                <?php
                while($row = mysqli_fetch_array($labour_responses)) {
                ?>
                
                <div class="card col-5 ml-2" style="width: 18rem;">
                    <div class="card-body">
                        <p class="card-text">Labour Name: <?php echo $row['labour_name'] ?></p>
                        <p class="card-text">Time Needed: <?php echo $row['time'] ?></p>
                        <p class="card-text">Money per Day: <?php echo $row['money'] ?> L.E</p>
                        <p class="card-text">Message: <?php echo $row['message'] ?></p>
                        <p class="card-text">Response: <strong><?php echo $row['response'] ?></strong></p>
                    </div>
                </div>

                <?php } ?>
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