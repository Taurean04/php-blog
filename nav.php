<?php require_once('./config.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="application-name" content="Blog">
    <meta name="author" content="Blog">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blog | <?php echo ucfirst($active); ?></title>
    <!-- Css Styles... -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Script -->
    <script src="./assets/js/jquery.js" charset="utf-8"></script>
    <script src="./assets/js/bootstrap.min.js" charset="utf-8"></script>
    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
    <script>
            tinymce.init({
                selector: "textarea",
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            });
    </script>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">SKOOLEO Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ml-auto">
            <?php if (!isset($_SESSION['auth_status'])) : ?>
              <li class="nav-item">
                <a class="nav-link <?php if (strtolower($active) === 'login') echo 'active'; ?>" href="<?php echo BASE_URL; ?>index.php">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if (strtolower($active) === 'register') echo 'active'; ?>" href="<?php echo BASE_URL; ?>register.php" tabindex="-1" aria-disabled="true">Register</a>
              </li>
            <?php elseif (isset($_SESSION['auth_status'])) : ?>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>dashboard.php" class="nav-link <?php if (strtolower($active) === 'dashboard') echo 'active'; ?>">Dashboard</a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>add_post.php" class="nav-link <?php if (strtolower($active) === 'add_post') echo 'active'; ?>">Add Post</a>
              </li>
            <?php endif; ?>
            <?php if (isset($_SESSION['auth_status'])) : ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL; ?>logout.php">Logout</a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>