<?php require_once('./controller/Dashboard.php'); ?>
<?php
  $Dashboard = new Dashboard();
  $Dashboard->track_visit();
  $Response = [];
  $active = $Dashboard->active;
  $Posts = $Dashboard->getPosts();

?>
<?php require('./nav.php'); ?>
<main role="main" class="container">
  <div class="container">
    <div class="row mt-5">
      <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
        <h2>Posts</h2>
        <hr>
      </div>
    </div>
    <div class="row">
      <?php if ($Posts['status']) : ?>
        <?php foreach ($Posts['data'] as $post) :  ?>
          <div class="col-xs-12 col-sm-12 col-md-12 col-xl-4 col-lg-4">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
              <div class="news_title">
                <h3><?php echo ucwords($post['title']); ?></h3>
              </div>
              <div class="news_body">
                <p><?php echo $post['description']; ?></p>
                <p><?php echo '<a href="post.php?id='.$post['id'].'">Read More</a>'; ?> </p>                
                <p><?php echo 'views: '.$post['views']; ?> </p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif;  ?>
    </div>
  </div>
</main>
</body>
</html>