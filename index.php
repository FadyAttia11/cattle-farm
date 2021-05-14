<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

    if($user_data) {
      if($user_data['user_role'] == 'customer') {
        return header('Location: index-customer.php');
      } else if ($user_data['user_role'] == 'farm') {
          return header('Location: index-farm.php');
      } else if ($user_data['user_role'] == 'labour') {
        return header('Location: index-labour.php');
      } else if ($user_data['user_role'] == 'admin') {
        return header('Location: index-admin.php');
      }
    }
    header('Location: index-guest.php');
?>