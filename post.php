<?php require_once('./controller/Post.php'); ?>
<?php
  $Post = new Post();
  $Post->track_visit();
  $Response = [];
  $active = $Post->active;
  $id = $_GET['id'];
  $Post->views($id);
  $Post = $Post->getPost($id);
?>
<?php require('./nav.php'); ?>
<main role="main" class="container">
  <div class="container">
    <div class="row mt-5">
      <?php if ($Post['status']) : ?>
      <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
        <h2><?php echo $Post['data']['title'] ?></h2>
        <hr>
      </div>
    </div>
      <?php	
        echo '<div>';
          echo '<p>Posted on '.date('jS M Y', strtotime($Post['data']['date_posted'])).'</p>';
          echo '<p>'.$Post['data']['content'].'</p>';				
        echo '</div>';
      ?>
    <?php endif;  ?>
  </div>
</main>
</body>
</html>