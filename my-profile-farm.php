<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $farm_name = $user_data['user_name'];

    $my_products_query = "select * from products where farm_name = '$farm_name'";
    $my_products = mysqli_query($con, $my_products_query);

    $my_reservs_query = "select * from products_reserv where farm_name = '$farm_name' and response = ''";
    $my_reservs = mysqli_query($con, $my_reservs_query);

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
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Farm: <?php echo $user_data['user_name'] ?></h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Farm: <?php echo $user_data['user_name'] ?></li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="portfolio-description">
          <h2>Farm Contact Info</h2>
          <p><strong>Phone</strong>: 0<?php echo $user_data['phone'] ?></p>
          <p><strong>Address</strong>: <?php echo $user_data['address'] ?></p>
        </div>

        <div class="portfolio-details-container">
            <img src=<?php echo "./uploads/". $user_data['image'] ?> class="img-fluid" alt="">
        </div>

        <div class="portfolio-description">
            <h2>My Products</h2>
            <div class="row">
                <?php
                    while($row = mysqli_fetch_array($my_products)) {
                ?>

                <div class="col-6">
                    <a href=<?php echo "my-product.php?id=". $row['id'] ?>><img src=<?php echo "./uploads/".$row['image'] ?> alt="" style="width: 50%; border: 1px solid #cda45e;"></a>
                    <h5>Name: <?php echo $row['product_name'] ?></h5>
                </div>

                <?php } ?>
            </div>
        </div>

        <div class="portfolio-description">
            <h2>Reservations To My Products</h2>
            <div class="row">
                <?php
                    while($row = mysqli_fetch_array($my_reservs)) {
                ?>

                <div class="card col-5 ml-2" style="width: 18rem;">
                    <div class="card-body">
                        <p class="card-text">Quantity: <?php echo $row['quantity'] ?> Unit</p>
                        <p class="card-text">Message: <?php echo $row['message'] ?></p>
                        <form method="post">
                            <input type="hidden" name="reserv_id" value=<?php echo $row['id'] ?>>
                            <textarea class="form-control mb-3" rows="5" name="response" placeholder="Your Response.."></textarea>
                            <input type="submit" class="btn btn-primary" value="Send Response">
                            <?php 
                              if($_SERVER['REQUEST_METHOD'] == "POST") {
                                $reserv_id = $_POST['reserv_id'];
                                $response = $_POST['response'];

                                $query = "update products_reserv set response = '$response' where id = '$reserv_id'";
                                $result = mysqli_query($con, $query);

                                if($result) {
                                  echo "Successfully sent your response to the customer";
                                } else {
                                  echo "Error sending your response to the customer";
                                }
                              }
                            ?>
                        </form>
                    </div>
                </div>

                <?php } ?>
            </div>
        </div>

        
      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>TheCattleFarm</h3>
              <p>
                Heliopolis <br>
                Cairo 535022, EG<br><br>
                <strong>Phone:</strong> 0100 255 1010<br>
                <strong>Email:</strong> support@cattle-farm.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Add New Product</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Offers & Promotions</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Hire Labour</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Buy Online</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Get Reservations</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Subscribe to our newsletter to never miss anything related to our services.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>

        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div>

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