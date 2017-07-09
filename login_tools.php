<?php
  function load($page = 'login.php'){
    $url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
    $url = rtrim($url, '/\\');
    $url .= '/'.$page;

      header("Location: $url");
      exit();
    
  }
 function validate($dbc, $email = '', $password = '') {
   $errors = array();
   if(empty($email)) {
     $errors[] = 'Enter your email address.';
   } else {
     $email = mysqli_real_escape_string($dbc, trim($email));
   }
   if(empty($password)) {
     $errors[] = 'Enter your password.';
   } else {
     $password = mysqli_real_escape_string($dbc, trim($password));
   }

   if(empty($error)){
    $query = "SELECT id, first_name, last_name
              FROM user WHERE email = '$email'
              AND password = SHA1('$password')";
      $result = mysqli_query($dbc, $query);
      if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return array(true, $row);
      } else {
        $errors[] = 'Email adress and password not found';

      }
   }
   return array(false, $errors);
 }
