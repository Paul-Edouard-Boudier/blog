<?php require_once "../app/repositories.php" ?>
<!-- Blog Entries Column -->
<div class="col-md-8">

  <h1 class="my-4">Page Heading
    <small>Secondary Text</small>
  </h1>
  <!-- TEST: Blog Posts -->
  <?php for ($i=1; $i <= maxIdArticles(); $i++): ?>
    <div class="card mb-4">
      <?php
        $article = fetchArticle($i);
        $article_id = $article['idarticles'];
        $comments = fetchComments($article_id);
        $iduser = $article['users_id'];
        $user = fetchAuthor($iduser);
        $category_id = $article['categories_id'];
        $category = fetchCategory($category_id)[0];
        $tags = fetchTags($article_id);
        $numberComments = countComments($article_id)[0]["COUNT(*)"];
        $_GET['id'] = $article_id;
      ?>
      <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
      <div class="card-body">
        <h2 class="card-title"><?= $article['title']?></h2>
        <p class="card-text"><?= substr($article['content'], 0, 150). " ..." ?></p>
        <a href='indexarticle.php?id=<?=$_GET['id']?>' class="btn btn-primary">Read More &rarr;</a>
      </div>
      <div class="card-footer text-muted">
        <div class="row">
          <div class="col-md-6">
            <?= $article['published_at'] ?>
            Comments: <?= $numberComments ?>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-6">
                Tags: <?php foreach ($tags as $tag) {
                  echo $tag['label'] . " ";
                }  ?>
              </div>
              <div class="col-6">
                Category: <?= $category['label'] ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endfor; ?>

  <!-- Pagination -->
  <ul class="pagination justify-content-center mb-4">
    <li class="page-item">
      <a class="page-link" href="#">&larr; Older</a>
    </li>
    <li class="page-item disabled">
      <a class="page-link" href="#">Newer &rarr;</a>
    </li>
  </ul>

</div>
