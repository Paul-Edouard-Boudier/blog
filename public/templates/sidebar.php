<?php require_once "../app/repositories.php" ?>
<!-- Sidebar Widgets Column -->

<?php
  $fetchCategories = fetchAllCategories();
  $allCategories = array_chunk($fetchCategories, ceil(count($fetchCategories) / 2));
  $fetchTags = fetchAllTags();
  $allTags = array_chunk($fetchTags, ceil(count($fetchTags) / 2));
?>

<div class="col-md-4">

  <!-- Search Widget -->
  <div class="card my-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for...">
        <span class="input-group-btn">
          <button class="btn btn-secondary" type="button">Go!</button>
        </span>
      </div>
    </div>
  </div>

  <!-- Categories Widget -->
  <div class="card my-4">
    <h5 class="card-header">Categories</h5>
    <div class="card-body">
      <div class="row">
        <?php foreach ($allCategories as $categories): ?>
          <div class="col-lg-6">
            <ul class="list-unstyled mb-0">
              <?php foreach ($categories as $category): ?>
                <li>
                  <a href="index.php?category=<?=$category['idcategories']?>"><?= $category['label'] ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Tags Widget -->
  <div class="card my-4">
    <h5 class="card-header">Tags</h5>
    <div class="card-body">
      <div class="row">
        <?php foreach ($allTags as $tags): ?>
          <div class="col-lg-6">
            <?php foreach ($tags as $tag): ?>
              <ul class="list-unstyled mb-0">
                <li>
                  <a href="index.php?tags=<?= $tag['idtags'] ?>"><?= $tag['label']?></a>
                </li>
              </ul>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>


  <!-- Side Widget -->
  <!-- <div class="card my-4">
    <h5 class="card-header">Side Widget</h5>
    <div class="card-body">
      You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
    </div>
  </div> -->

</div>
