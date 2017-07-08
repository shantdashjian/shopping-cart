<?php
  session_start();
  if(!isset($_SESSION['user_id'])){
    require('login_tools');
    load();
  }
  $page_title = 'Home';
  include('includes/header.html');
  echo "<h1>Home</h1>
  <p>
  You are now logged in,
  {$_SESSION['first_name']} {$_SESSION['last_name']}
  </p>";
 ?>
