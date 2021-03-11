<?php require_once('./controller/Post.php'); ?>
<?php
  $Post = new Post();
  $Post->track_visit();
  $Response = [];
  $active = $Post->active;
  if (isset($_POST) && count($_POST) > 0) $Response = $Post->newPost($_POST);
?>
<?php require('./nav.php'); ?>
  <main role="main" class="container">
    <div class="container">
      <div class="row mt-5">
        <div class="col-xl-4">
          <?php if (isset($Response['status']) && !$Response['status']) : ?>
          <br>
          <div class="alert alert-danger" role="alert">
            <span><B>Oops!</B> Some errors occurred in your form.</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true" class="text-danger">&times;</span>
            </button>
          </div>
          <?php endif; ?>
          <div class="card shadow-lg p-4 mb-5 bg-white rounded">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-signin">
            <h4 class="h3 mb-3 font-weight-normal text-center">Add Post</h4>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-group">
                <label for="inputTitle" class="sr-only">Titles</label>
                <input type="text" id="inputTitle" class="form-control" placeholder="Post Title" name="title" required autofocus value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
                <?php if (isset($Response['title']) && !empty($Response['title'])): ?>
                  <small class="text-danger"><?php echo $Response['title']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-group">
                <label for="inputDescription" class="sr-only">Description</label>
                <textarea id="inputDescription" class="form-control" placeholder="Post Description" name="description" required autofocus value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>"></textarea>
                <?php if (isset($Response['description']) && !empty($Response['description'])): ?>
                  <small class="text-danger"><?php echo $Response['description']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-group">
                <label for="inputContent" class="sr-only">Content</label>
                <textarea id="inputContent" class="form-control" placeholder="Post Content" name="content" required autofocus value="<?php if (isset($_POST['content'])) echo $_POST['content'] ?>"></textarea>
                <?php if (isset($Response['content']) && !empty($Response['content'])): ?>
                  <small class="text-danger"><?php echo $Response['content']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
              <button class="btn btn-md btn-primary btn-block" type="submit">Add Post</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>