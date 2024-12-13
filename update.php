<?php
  ini_set("display_errors",1);
  error_reporting(E_ALL);
  include 'connection.php';

  $post = null;
  $message ="";
  $postId = null;

  if (isset($_GET['id'])) {
    $postId = intval($_GET['id']);
    $conn = connect_db();
    $sql = "SELECT * FROM posts WHERE id = $postId";
    $query = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($query);
    if ($num > 0) {
      $post = mysqli_fetch_assoc($query);
    } else {
      $message = "Post not found.";
    }
  }
  else {
    echo "Invalid post ID.";
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $title = $_POST["title"] ?? null;
  $content = $_POST["content"] ?? null;

  if (!empty($title) && !empty($content)) {
    // Escape special characters to prevent SQL injection
    $new_title = $conn->real_escape_string($title);
    $new_content = $conn->real_escape_string($content);

    $sql ="UPDATE posts SET title = '$new_title', content = '$new_content' WHERE id = $postId";
    $query = mysqli_query($conn, $sql);

    if ($query===TRUE) {
      echo "Post updated successfully";
      header("Location: index.php");
    } else {
      echo "Error updating post: " . mysqli_error($conn);
    }
  }
  else {
    $message = "Both fields are required.";
  }
  $conn->close();
}

?>


<!DOCTYPE html>
 <html lang="en">
  <head>
    <title>Bootstrap 4 Blog Template For Developers</title>

    <!-- Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Blog Template" />
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media" />
    <link rel="shortcut icon" href="favicon.ico" />

    <!-- FontAwesome JS-->
    <script
      defer
      src="https://use.fontawesome.com/releases/v5.7.1/js/all.js"
      integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7"
      crossorigin="anonymous"></script>

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/theme-1.css" />
  </head>
<body class="theme-bg-light">
  <div>
    <button class="m-5"><a href="index.php">Go back</a></button>
    <section class="cta-section theme-bg-light py-5">
        <div class="container justify-content-center">
          <h2 class="heading">Edit your Blog Post</h2>
          <div class="intro">

          </div>
          <div class="form-group">
            <form action="" method="POST" class="pt-3 ">
              <div class="justify-content-center">
                <label class="font-weight-bold text-uppercase">Title</label>
                <input
                  type="text"
                  id="title"
                  name="title"
                  class="form-control mb-3"
                  placeholder="Post Title"
                  value="<?php echo htmlspecialchars($post['title']); ?>"
                  style="width: 50%; border: 2px solid #cccccc; border-radius: 8px;"
                />
              </div>
              <div class="">
                <label class="font-weight-bold text-uppercase" for="content">Content</label>
                <textarea
                  type="text"
                  id="content"
                  name="content"
                  class="form-control mb-3"
                  placeholder="Post Content"
                  style="width: 50%; border: 2px solid #cccccc; border-radius: 8px;">
                  <?php echo htmlspecialchars($post['content']); ?>
                </textarea>
              </div>
              <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
          </div>
        </div>
        <!--//container-->
      </section>
  </div>
</body>
</html>
