<?php
  # Connect on 'localhost' for user 'site_db_user'
  $dbc = mysqli_connect
    ('localhost', 'users_user', 'users_user', 'users')
  OR die
    (mysqli_connect_error());

  # Set MySQL encoding to match PHP script encoding
  mysqli_set_charset( $dbc, 'utf8');
?>
