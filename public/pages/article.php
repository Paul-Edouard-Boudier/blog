
<?php require_once "../app/repositories.php" ?>
<?php $id = $_GET['id'] ?>
<?php $article = fetchArticle($id); ?>
<?php
  $author = fetchAuthor($article['users_id']);
  if ($author == false) {
    $fullname = "John Doe";
  }
  else {
    $fullname = $author['first_name'] . " " . $author['last_name'];
  }
?>
<pre>
<?php $publication = fetchArticle($id)['published_at'] ?>
<?php $comments = fetchComments($id) ?>
</pre>
<!-- Post Content Column -->
<div class="col-lg-8">

  <!-- Title -->
  <h1 class="mt-4"><?= ucfirst($article['title'])?></h1>

  <!-- Author -->
  <p class="lead">
    by
    <a href="#"><?= $fullname ?></a>
  </p>

  <hr>

  <!-- Date/Time -->
  <p>Posted on <?= $publication ?></p>

  <hr>

  <!-- Preview Image -->
  <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">

  <hr>
  <p><?= $article['content']?></p>

  <!-- Comments Form -->
  <div class="card my-4">
    <h5 class="card-header">Leave a Comment:</h5>
    <div class="card-body">
      <form>
        <div class="form-group">
          <textarea class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>

  <!-- Single Comment -->
  <?php foreach ($comments as $comment):?>
    <div class="media mb-4">
      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
      <div class="media-body">
        <h5 class="mt-0"><?=  $comment['name']  ?></h5>
        <?= $comment['content'] ?>
      </div>
    </div>
  <?php endforeach ?>
</div>
