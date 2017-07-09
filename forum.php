<?php
  session_start();
  if(!isset($_SESSION['user_id'])){
    require('login_tools');
    load();
  }
  $page_title = 'Forum';
  include('includes/header.html');
  require('connect_db.php');
  $query = 'SELECT * FROM post';
  $result = mysqli_query($dbc, $query);
  if(mysqli_num_rows($result) > 0){
    echo '<table>
      <tr>
        <th>
          Posted By
        </th>
        <th>
          Subject
        </th>
        <th id="message">
          Message
        </th>
      </tr>';
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo '<tr>
          <td>
            '.$row['first_name'].' '.$row['last_name'].'<br />'
            .$row['post_date'].'</td>
          <td>
            '.$row['subject'].'</td>
          <td>
            '.$row['message'].'</td>
        </tr>';
      }

    echo '</table>';
  } else {
    echo '<p>
      There are currently no messges.
    </p>';
  }
  echo '<p>
    <a href="post.php">Post Message</a> |
    <a href="forum.php">Forum</a> |
    <a href="shop.php">Shop</a> |
    <a href="goodbye.php">Logout</a>
  </p>';
  mysqli_close($dbc);
  include('includes/footer.html');
 ?>
