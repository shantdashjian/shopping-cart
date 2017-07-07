<?php

$page_title = 'Register';
include('includes/header.html');

if($_SERVER['REQUEST_METHOD']=='POST'){
  require('connect_db.php');
  $errors = array();
  if(empty($_POST['first_name'])){
    $errors[] = 'Enter your first name.';
  } else {
    $first_name = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
  }
  if(empty($_POST['last_name'])){
    $errors[] = 'Enter your last name.';
  } else {
    $last_name = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
  }
  if(empty($_POST['email'])){
    $errors[] = 'Enter your email address.';
  } else {
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
  }

  if(!empty($_POST['password_1'])){
    if($_POST['password_1'] != $_POST['password_2']){
      $errors[] = 'Passwords do not match.';
    } else {
      $password = mysqli_real_escape_string($dbc, trim($_POST['password_1']));
    }

  } else {
    $errors[] = 'Enter your password';
  }

  if(empty($errors)){
    $query = "SELECT id FROM user WHERE email='$email'";
    $result = mysqli_query($dbc, $query);
    if(mysqli_num_rows($result) != 0){
      $errors[] = 'Email address already registered.<a href="login.php">Login</a>';
    }
  }

  if(empty($errors)){
    $query = "INSERT INTO user (first_name, last_name, email, password, registration_date) VALUES('$first_name', '$last_name', '$email', SHA1('$password'), NOW())";
    $result = mysqli_query($dbc, $query);

    if($result){
      echo '<h1>Registered!</h1>
            <p>
              You are now registered.
            </p>
            <p>
              <a href="login.php">Login</a>
            </p>';
    }
    mysqli_close($dbc);
    include('includes/footer.html');
    exit();
  } else {
    echo '<h1>Error!</h1>
          <p id="error_message">
            The following error(s) occurred: <br />
          ';
    foreach($errors as $message){
      echo " - $message<br />";
    }
    echo 'Please try again</p>';
    mysqli_close($dbc);

  }
}
?>
<h1>Register</h1>
<form action="register.php" method="POST">
  <p>
    First Name: <input type="text" name="first_name"
      value="<?php if (isset($_POST['first_name']))
                echo $_POST['first_name'];?>">
    Last Name: <input type="text" name="last_name"
      value="<?php if (isset($_POST['last_name']))
                echo $_POST['last_name'];?>">
  </p>
  <p>
    Email Address: <input type="text" name="email"
      value="<?php if (isset($_POST['email']))
                echo $_POST['email'];?>">
  </p>
  <p>
    Password: <input type="text" name="password_1"
      value="<?php if (isset($_POST['password_1']))
                echo $_POST['password_1'];?>">
    Confirm Password: <input type="text" name="password_2"
      value="<?php if (isset($_POST['password_2']))
                echo $_POST['password_2'];?>">
  </p>
  <p>
    <input type="submit" value="Register"
  </p>
</form>

<?php
  include('includes/footer.html');

 ?>
