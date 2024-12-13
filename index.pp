<?php
  ini_set("display_errors",1);
  error_reporting(E_ALL);
  include 'connection.php';

  $conn = connect_db();
  $sql = "SELECT * FROM posts WHERE id = $id";
  $query = mysqli_query($conn, $sql);
  // $result = mysqli_fetch_array(result: $query);
  $num = mysqli_num_rows($query);

  if($num > 0 ){
    while($row=mysqli_fetch_assoc($query)){
    echo $row['title'];
    echo "<br>";
    echo $row['content'];
    echo "<br>";
      /* echo "<li><strong>" . htmlspecialchars($row['title']) . ":</strong> " . htmlspecialchars($ro['content']) . "</li>"; */
    }
  } else {
    echo "No posts found";
  }

?>
