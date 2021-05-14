<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $labour_id = $_GET["id"];

    $labour_query = "select * from users where id = '$labour_id'";
    $labour = mysqli_query($con, $labour_query);

    if($labour && mysqli_num_rows($labour) > 0) {
        $labour_data = mysqli_fetch_assoc($labour);
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
          <h2><?php echo $labour_data['user_name'] ?> Profile Page</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Labour Profile</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <h5>Name: <span><?php echo $labour_data['user_name'] ?></span></h5>
                    <h5>Type of Work: <span><?php echo $labour_data['category'] ?></span></h5>
                    <p>Phone Number: <span>0<?php echo $labour_data['phone'] ?></span></p>
                    <p>Address: <span><?php echo $labour_data['address'] ?></span></p>
                </div>
                <div class="col-4">
                    <img src=<?php echo "./uploads/".$labour_data['image'] ?> alt="" style="width: 100%; border: 1px solid #cda45e;">
                </div>
            </div>

            <h3>Hire This Person</h3>
            
            <form method="post">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="How much Time do you need him?" name="time" required>
                </div>
                <div class="col">
                    <input type="number" class="form-control" placeholder="Money per Day" name="money" required>
                </div>
            </div>

            <textarea class="form-control mb-3" rows="5" name="message" placeholder="Send him a message.." required></textarea>

            <input type="submit" class="btn btn-primary" value="Hire This person">
            <?php
                if($_SERVER['REQUEST_METHOD'] == "POST") {
                    $time = $_POST['time'];
                    $money = $_POST['money'];
                    $message = $_POST['message'];
                    $farm_name = $user_data['user_name'];
                    $labour_name = $labour_data['user_name'];

                    $query = "insert into hiring (farm_name,labour_name,time,money,message,response) values ('$farm_name','$labour_name','$time','$money','$message','')";
                    $result = mysqli_query($con, $query);

                    if($result) {
                        echo "successfully added your request";
                    } else {
                        echo "error adding your request";
                    }
                }
            ?>
            </form>

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