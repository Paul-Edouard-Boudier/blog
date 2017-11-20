<?php require_once "../app/repositories.php" ?>
<!-- Blog Entries Column -->
<div class="col-md-8">

  <h1 class="my-4">Page Heading
    <small>Secondary text</small>
  </h1>
    <?php
    $nbpages = countPagesTags(1);
    // $nbpages = konar(1);
      if(!isset($_GET['selectPage']) || empty($_GET['selectPage'])) {
        $currentPage = 1;
      } else { $currentPage = (int)$_GET['selectPage'];} //var_dump($currentPage);

      if (isset($_GET['category']) || !empty($_GET['category'])) {
        $id = $_GET['category'];
        $articles = fetchArticlesCategories($id);
        $nbpages = countPagesCategories($id);
      }
      else if (isset($_GET['tags']) || !empty($_GET['tags'])) {
        $id = $_GET['tags'];
        $articles = fetchArticlesTags($id);
        $nbpages = countPagesTags($id);
      }
      else {
        $articles = fetchArticles($currentPage);
        $nbpages = countPages();
      }
    ?>
  <?php foreach ($articles as $article): ?>
    <?php
      $article_id = $article['idarticles'];
      $comments = fetchComments($article_id);
      $iduser = $article['users_id'];
      $user = fetchAuthor($iduser);
      $category_id = $article['categories_id'];
      $category = fetchCategory($category_id)[0];
      $tags = fetchTags($article_id);
      $numberComments = countComments($article_id);
    ?> 
    <div class="card mb-4">
      <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
      <div class="card-body">
        <h2 class="card-title"><?= $article['title']?></h2>
        <p class="card-text"><?= substr($article['content'], 0, 150). " ..." ?></p>
        <a href='indexarticle.php?id=<?=$article_id?>' class="btn btn-primary">Read More &rarr;</a>
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
  <?php endforeach; ?>

  <!-- Pagination -->
  <ul class="pagination justify-content-center mb-4">
    <ul class="pagination">
      <?php
        // $nbpages = countPages();
        for ($i=1; $i <= $nbpages ; $i++) {
          $classLi='page-item';
          if($currentPage == $i){
            $classLi .= ' active';
          }
          echo "<li class='$classLi'>";
          echo '<a class="page-link" href="?selectPage='.$i.'">'.$i.'</a>';
          echo '</li>';
        }
      ?>
    </ul>
  </ul>

</div>
