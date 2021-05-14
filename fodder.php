<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $fodder_id = $_GET["id"];

    $fodder_query = "select * from fodders where id = '$fodder_id'";
    $fodder = mysqli_query($con, $fodder_query);

    if($fodder && mysqli_num_rows($fodder) > 0) {
        $fodder_data = mysqli_fetch_assoc($fodder);
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
          <li class="active"><a href="buy-fodders.php">Buy Fodder</a></li>
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
          <h2>Buy Fodder</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Buy Fodder</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <h5>Name: <span><?php echo $fodder_data['name'] ?></span></h5>
                    <h5>Available Amount: <span><?php echo $fodder_data['amount'] ?> Kg</span></h5>
                    <p>Kg Price: <span><?php echo $fodder_data['price'] ?> L.E</span></p>
                </div>
                <div class="col-4">
                    <img src=<?php echo "./uploads/".$fodder_data['image'] ?> alt="" style="width: 100%; border: 1px solid #cda45e;">
                </div>
            </div>

            <h3>Buy This Fodder</h3>
            
            <form method="post">

                <div class="form-group mt-2">
                    <label>Card holder's name</label>
                    <input type="text" placeholder="Card holder's name" class="form-control">
                </div>

                <div class="form-group">
                <label>Card number</label>
                <input type="number" placeholder="Card number" class="form-control">
                </div>

                <div class="form-group">
                    <label>Expire Date</label>
                    <input type="date" placeholder="dd/mm/yy" class="form-control">
                </div>

                <div class="form-group">
                    <label>CVV</label>
                    <input type="text" placeholder="CVV" class="form-control">
                </div>

                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" class="form-control mb-3" placeholder="How much do you need?" name="quantity" required>
                </div>
            
                <input type="submit" class="btn btn-primary" value="Buy This Quantity">
            <?php
                if($_SERVER['REQUEST_METHOD'] == "POST") {
                    $quantity = $_POST['quantity'];
                    $farm_name = $user_data['user_name'];

                    $get_money_query = "select * from users where user_role = 'admin'";
                    $get_money = mysqli_query($con, $get_money_query);

                    if($get_money && mysqli_num_rows($get_money) > 0) {
                        $current_money = mysqli_fetch_assoc($get_money);
                        $deposit = $fodder_data['price'] * $quantity;
                        $updated_money = $current_money['balance'] + $deposit;

                        $add_money_query = "update users set balance = '$updated_money' where user_role = 'admin'";
                        $add_money = mysqli_query($con, $add_money_query);

                        if($add_money) {
                            $query = "insert into fodder_purchases (fodder_id,farm_name,quantity) values ('$fodder_id','$farm_name','$quantity')";
                            $result = mysqli_query($con, $query);

                            if($result) {
                                echo "successfully purchased the fodder";
                            } else {
                                echo "error purchasing the fodder";
                            }
                        } else {
                            echo "error adding money to our account";
                        }
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