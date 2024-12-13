<?php
  ini_set("display_errors",1);
  error_reporting(E_ALL);
  include 'connection.php';

  if (isset($_GET['id'])) {
    $postId = intval($_GET['id']);

  $conn = connect_db();
  $sql = "SELECT * FROM posts where id = $postId";
  $query = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($query);
  if ($num > 0) {
    $row = mysqli_fetch_assoc($query);
    $title = $row['title'];
    $content = $row['content'];
    $published_date =$row['created_at'];
  } else {
      $title = "No Posts Found";
      $content = "There are no posts in the database.";
  }
  $conn->close();
  } else {
    echo "Invalid post ID.";
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

    <!-- Plugin CSS -->
    <link
      rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.14.2/styles/monokai-sublime.min.css" />

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/theme-1.css" />
  </head>

  <body>
    <header class="header text-center">
      <h1 class="blog-name pt-lg-4 mb-0">
        <a href="index.php">Anthony's Blog</a>
      </h1>

      <nav class="navbar navbar-expand-lg navbar-dark">
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navigation"
          aria-controls="navigation"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navigation" class="collapse navbar-collapse flex-column">
          <div class="profile-section pt-3 pt-lg-0">
            <img
              class="profile-image mb-3 rounded-circle mx-auto"
              src="assets/images/profile.png"
              alt="image" />

            <div class="bio mb-3">
              Hi, my name is Anthony Doe. Briefly introduce yourself here. You
              can also provide a link to the about page.<br /><a
                href="about.html"
                >Find out more about me</a
              >
            </div>
            <!--//bio-->
            <ul class="social-list list-inline py-3 mx-auto">
              <li class="list-inline-item">
                <a href="#"><i class="fab fa-twitter fa-fw"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="#"><i class="fab fa-linkedin-in fa-fw"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="#"><i class="fab fa-github-alt fa-fw"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="#"><i class="fab fa-stack-overflow fa-fw"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="#"><i class="fab fa-codepen fa-fw"></i></a>
              </li>
            </ul>
            <!--//social-list-->
            <hr />
          </div>
          <!--//profile-section-->

          <ul class="navbar-nav flex-column text-left">
            <li class="nav-item">
              <a class="nav-link" href="index.php"
                ><i class="fas fa-home fa-fw mr-2"></i>Blog Home
                <span class="sr-only">(current)</span></a
              >
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="blog-post.html"
                ><i class="fas fa-bookmark fa-fw mr-2"></i>Blog Post</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html"
                ><i class="fas fa-user fa-fw mr-2"></i>About Me</a
              >
            </li>
          </ul>

          <div class="my-2 my-md-3">
            <a
              class="btn btn-primary"
              href="https://themes.3rdwavemedia.com/"
              target="_blank"
              >Get in Touch</a
            >
          </div>
        </div>
      </nav>
    </header>

    <div class="main-wrapper">
      <article class="blog-post px-3 py-5 p-md-5">
        <?php if ($num == 0): ?>
          <p><?php echo $content; ?></p>
            <nav class="blog-nav nav nav-justified my-5">
            <a class="nav-link-prev nav-item nav-link rounded-left"
              href="index.php">
              HomePage<i class="arrow-prev fas fa-long-arrow-alt-left"></i>
            </a>
      </nav>
        <?php else: ?>
          <div class="container">
            <header class="blog-post-header">
              <h2 class="title mb-2"><?php echo $title; ?></h2>
              <div class="meta mb-3">
                <span class="date">Published <?php echo $published_date; ?></span>
                <span class="time">5 min read</span>
              </div>
            </header>

            <div class="blog-post-body">
              <figure class="blog-banner">
                <a href="https://made4dev.com"
                  ><img
                    class="img-fluid"
                    src="assets/images/blog/blog-post-banner.jpg"
                    alt="image"
                /></a>
                <figcaption class="mt-2 text-center image-caption">
                  Image Credit:
                  <a href="https://made4dev.com?ref=devblog" target="_blank"
                    >made4dev.com (Premium Programming T-shirts)</a
                  >
                </figcaption>
              </figure>
              <p>
              <?php echo $content; ?>
              </p>
              <nav class="blog-nav nav nav-justified my-5">
                <a
                  class="nav-link-prev nav-item nav-link rounded-left"
                  href="index.php"
                  >HomePage<i class="arrow-prev fas fa-long-arrow-alt-left"></i
                ></a>
              </nav>
              <div class="justify-content-center">
                <button type="submit" class="btn btn-dark ">
                  <a href=<?php echo "update.php?id=$postId" ?> class="#999999">Edit Post</a>
                </button>
                <button type="submit" class="btn btn-dark ">
                  <a href=<?php echo "delete.php?id=$postId" ?> class="#999999">Delete Post</a>
                </button>
              </div>


              <div class="blog-comments-section">
                <div id="disqus_thread"></div>
                <script>
                  /**
                  *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT
                  *  THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR
                  *  PLATFORM OR CMS.
                  *
                  *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT:
                  *  https://disqus.com/admin/universalcode/#configuration-variables
                  */
                  /*
                  var disqus_config = function () {
                      // Replace PAGE_URL with your page's canonical URL variable
                      this.page.url = PAGE_URL;

                      // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                      this.page.identifier = PAGE_IDENTIFIER;
                  };
                  */

                  (function () {
                    // REQUIRED CONFIGURATION VARIABLE: EDIT THE SHORTNAME BELOW
                    var d = document,
                      s = d.createElement('script');

                    // IMPORTANT: Replace 3wmthemes with your forum shortname!
                    s.src = 'https://3wmthemes.disqus.com/embed.js';

                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                  })();
                </script>
                <noscript>
                  Please enable JavaScript to view the
                  <a href="https://disqus.com/?ref_noscript" rel="nofollow">
                    comments powered by Disqus.
                  </a>
                </noscript>
              </div>
              <!--//blog-comments-section-->
          </div>
        </div>
          <!--//container-->
        </article>
      <?php endif; ?>

      <section class="promo-section theme-bg-light py-5 text-center">
        <div class="container">
          <h2 class="title">Promo Section Heading</h2>
          <p>
            You can use this section to promote your side projects etc. Lorem
            ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
            ligula eget dolor. Aenean massa.
          </p>
          <figure class="promo-figure">
            <a href="https://made4dev.com" target="_blank"
              ><img
                class="img-fluid"
                src="assets/images/promo-banner.jpg"
                alt="image"
            /></a>
          </figure>
        </div>
        <!--//container-->
      </section>
      <!--//promo-section-->

      <footer class="footer text-center py-2 theme-bg-dark">
        <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can buy the commercial license via our website: themes.3rdwavemedia.com */-->
        <small class="copyright"
          >Designed with <i class="fas fa-heart" style="color: #fb866a"></i> by
          <a href="http://themes.3rdwavemedia.com" target="_blank"
            >Xiaoying Riley</a
          >
          for developers</small
        >
      </footer>
    </div>
    <!--//main-wrapper-->

    <!-- *****CONFIGURE STYLE (REMOVE ON YOUR PRODUCTION SITE)****** -->
    <div id="config-panel" class="config-panel d-none d-lg-block">
      <div class="panel-inner">
        <a
          id="config-trigger"
          class="config-trigger config-panel-hide text-center"
          href="#"
          ><i class="fas fa-cog fa-spin mx-auto" data-fa-transform="down-6"></i
        ></a>
        <h5 class="panel-title">Choose Colour</h5>
        <ul id="color-options" class="list-inline mb-0">
          <li class="theme-1 active list-inline-item">
            <a data-style="assets/css/theme-1.css" href="#"></a>
          </li>
          <li class="theme-2 list-inline-item">
            <a data-style="assets/css/theme-2.css" href="#"></a>
          </li>
          <li class="theme-3 list-inline-item">
            <a data-style="assets/css/theme-3.css" href="#"></a>
          </li>
          <li class="theme-4 list-inline-item">
            <a data-style="assets/css/theme-4.css" href="#"></a>
          </li>
          <li class="theme-5 list-inline-item">
            <a data-style="assets/css/theme-5.css" href="#"></a>
          </li>
          <li class="theme-6 list-inline-item">
            <a data-style="assets/css/theme-6.css" href="#"></a>
          </li>
          <li class="theme-7 list-inline-item">
            <a data-style="assets/css/theme-7.css" href="#"></a>
          </li>
          <li class="theme-8 list-inline-item">
            <a data-style="assets/css/theme-8.css" href="#"></a>
          </li>
        </ul>
        <a id="config-close" class="close" href="#"
          ><i class="fa fa-times-circle"></i
        ></a>
      </div>
      <!--//panel-inner-->
    </div>
    <!--//configure-panel-->

    <!-- Javascript -->
    <script src="assets/plugins/jquery-3.3.1.min.js"></script>
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Page Specific JS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.14.2/highlight.min.js"></script>

    <!-- Custom JS -->
    <script src="assets/js/blog.js"></script>

    <!-- Style Switcher (REMOVE ON YOUR PRODUCTION SITE) -->
    <script src="assets/js/demo/style-switcher.js"></script>
  </body>
</html>
