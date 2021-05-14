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
          <li><a href="products-reserv.php">Products Reservations</a></li>
          <li class="active"><a href="new-fodder.php">Add New Fodder</a></li>
          <li><a href="avail-fodders.php">Available Fodders</a></li>
          <li><a href="fodders-sales.php">Fodders Sales</a></li>
          <li><a href="#">Balance: <?php echo $user_data['balance'] ?> L.E</a></li>
          <li><a href="logout.php">Logout</a></li>

        </ul>
      </nav><!-- .nav-menu -->

      <a href="#about" class="get-started-btn scrollto">Get Started</a>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Add New Fodder</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Add New Fodder</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container" style="max-width: 700px;">
      <h3>Add New Fodder</h3>
      <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
      <input type="text" class="form-control mb-3" placeholder="Fodder Name" name="name" required>
        
        <div class="row mb-3">
        <div class="col">
            <input type="number" class="form-control" placeholder="Amount (in Kg)" name="amount" required>
        </div>
        <div class="col">
            <input type="number" class="form-control" placeholder="Kg Price (in L.E)" name="price" required>
        </div>
        </div>


        <label for="fileToUpload">Product Image (Required): </label>
        <input type="file" name="fileToUpload" class="mb-3" id="fileToUpload" required> <br>

        <button type="submit" class="btn btn-primary">Add New Fodder</button>
        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                $image = '';
                $name = $_POST['name'];
                $amount = $_POST['amount'];
                $price = $_POST['price'];

                $target_dir = "uploads/";
                $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);

                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $image = time() . basename($_FILES["fileToUpload"]["name"]);
                    $error_msg = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                } else {
                    $error_msg = "Sorry, there was an error uploading your LOGO.";
                }

                $query = "insert into fodders (name,amount,price,image) values ('$name','$amount','$price','$image')";
                $result = mysqli_query($con, $query);

                if($result) {
                    echo "Successfully added your fodder!";
                } else {
                    echo "Error adding your fodder!";
                }
            }
        ?>
        </form>
      </div>
    </section>

  </main><!-- End #main -->

  

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