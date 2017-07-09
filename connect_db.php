<?php
  # Connect on 'localhost' for user 'shop_user'
  $dbc = mysqli_connect
    ('localhost', 'shop_user', 'shop_user', 'shop')
  OR die
    (mysqli_connect_error());

  # Set MySQL encoding to match PHP script encoding
  mysqli_set_charset( $dbc, 'utf8');
?>
