<?php
  ini_set("display_errors",1);
  error_reporting(E_ALL);
  include 'connection.php';

  if (isset($_GET['id'])) {
    $postId = intval($_GET['id']);

  $conn = connect_db();
  $sql = "DELETE FROM posts WHERE id = $postId";
  $query = mysqli_query($conn, $sql);
  // $num = mysqli_num_rows($query);
  if ($query===TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
  $conn->close();
  } else {
    echo "Invalid post ID.";
}
?>
