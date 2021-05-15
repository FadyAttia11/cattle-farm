<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $farm_name = $user_data['user_name'];
    $product_id = $_GET["id"];

    $product_query = "select * from products where id = '$product_id'";
    $product = mysqli_query($con, $product_query);

    if($product && mysqli_num_rows($product) > 0) {
        $product_data = mysqli_fetch_assoc($product);
    }

    $offers_query = "select * from offers where product_id = '$product_id'";
    $offers = mysqli_query($con, $offers_query);

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['offer_id'])) {
            $offer_id = $_POST['offer_id'];

            $delete_query = "delete from offers where id = '$offer_id'";
            $delete = mysqli_query($con, $delete_query);

            if($delete) {
                header('Location: my-product.php?id='. $product_id);
                // echo "hello";
            }
        }
    }

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
          <h2>Product: <?php echo $product_data['product_name'] ?></h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Product: <?php echo $product_data['product_name'] ?></li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="portfolio-details-container">

        <img src=<?php echo "./uploads/". $product_data['image'] ?> class="img-fluid" alt="">

          <div class="portfolio-info">
            <h3>Product information</h3>
            <ul>
              <li><strong>Type</strong>: <?php echo $product_data['type'] ?></li>
              <li><strong>Category</strong>: <?php echo $product_data['category'] ?></li>
              <li><strong>Amount</strong>: <?php echo $product_data['amount'] ?> Unit</li>
              <li><strong>Price</strong>: <?php echo $product_data['price'] ?> L.E</li>
            </ul>
          </div>

        </div>

        <div class="portfolio-description">
          <h2>Product Description</h2>
          <p><?php echo $product_data['description'] ?></p>
        </div>

        <div class="portfolio-description">
          <h2>Make Offers & Promotions on This Product</h2>
          <p>(Specify a discount on a specific amount of this product)</p>
            <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="row mb-3">
                    <div class="col">
                        <input type="number" class="form-control" placeholder="Quantity" name="quantity" required>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" placeholder="Total Price" name="total_price" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Add This Offer</button>
                <?php
                    if($_SERVER['REQUEST_METHOD'] == "POST") {
                        if(isset($_POST['quantity'])) {
                            $quantity = $_POST['quantity'];
                            $total_price = $_POST['total_price'];
    
                            $query = "insert into offers (farm_name,product_id,quantity,total_price) values ('$farm_name','$product_id','$quantity','$total_price')";
                            $result = mysqli_query($con, $query);
    
                            if($result) {
                                echo "Successfully added your offer";
                            } else {
                                echo "error adding your offer";
                            }
                        }
                    }
                ?>
            </form>
        </div>

        <div class="portfolio-description">
            <h2>My Offers For This Product</h2>
            <div class="row">
                <?php
                while($row = mysqli_fetch_array($offers)) {
                ?>
                
                <div class="card col-5 ml-2" style="width: 18rem;">
                    <div class="card-body">
                        <p class="card-text">Quantity: <?php echo $row['quantity'] ?> Unit</p>
                        <p class="card-text">Total Price: <?php echo $row['total_price'] ?> L.E</p>
                        <form method="post">
                            <input type="hidden" name="offer_id" value=<?php echo $row['id'] ?>>
                            <input type="submit" class="btn btn-danger" value="Delete This offer">
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