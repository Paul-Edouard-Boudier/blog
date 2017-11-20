<?php
  function test() {
    var_dump("test");die;
  }
  function db() {
    $dsn="mysql:dbname=BlogDDB;host=127.0.0.1;charset=UTF8";
    $username="root"; $passwd="0000";
    $pdo = new PDO($dsn, $username, $passwd);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
  }

  function fetchArticles($currentPage) {
    $pdo = db();
    $offset = ($currentPage -1) *3;
    $limit = 3;
    $query = "SELECT * FROM `articles`
              ORDER BY `published_at` DESC LIMIT $limit OFFSET $offset;";
    $result = $pdo->query($query);
    $articles = $result->fetchAll();
    return $articles;
  }
  function fetchArticle($id) {
    $pdo = db();
    $query = "SELECT * FROM `articles` WHERE `idarticles` = ?";
    $prepare = $pdo->prepare($query);
    $prepare->bindParam(1, $id, PDO::PARAM_INT);
    $result = $prepare->execute();
    if ($result == true) {
      return $prepare->fetch();
    }
  }
  function fetchArticlesCategories($id) {
    $pdo = db();
    $query = "SELECT * FROM `articles` WHERE `categories_id` = ?";
    $prepare = $pdo->prepare($query);
    $prepare->bindParam(1, $id, PDO::PARAM_INT);
    $result = $prepare->execute();
    if ($result == true) {
      return $prepare->fetchAll();
    }
  }
  function fetchArticlesTags($id) {
    $pdo = db();
    $query = "SELECT `articles_id`, `articles`.`*` FROM `articles_has_tags`
    INNER JOIN `articles` ON `articles`.`idarticles` = `articles_has_tags`.`articles_id`
    WHERE `tags_id` = ?;";
    $prepare = $pdo->prepare($query);
    $prepare->bindParam(1, $id, PDO::PARAM_INT);
    $result = $prepare->execute();
    if ($result == true) {
      return $prepare->fetchAll();
    }
  }

  function fetchAuthor($id) {
    $pdo = db();
    $query = "SELECT `first_name`, `last_name` FROM `users` WHERE `idusers` = ?";
    $prepare = $pdo->prepare($query);
    $prepare->bindParam(1, $id, PDO::PARAM_INT);
    $result = $prepare->execute();
    if ($result == true) {
      return $prepare->fetch();
    }
  }

  function fetchComments($id) {
    $pdo = db();
    $query = "SELECT * FROM `comments` WHERE `articles_id` = ?";
    $prepare = $pdo->prepare($query);
    $prepare->bindParam(1, $id, PDO::PARAM_INT);
    $result = $prepare->execute();
    if ($result == true) {
      return $prepare->fetchAll();
    }
  }
  function countComments($id) {
    $pdo = db();
    $query = "SELECT COUNT(*) FROM `comments` WHERE `articles_id` = ?";
    $prepare = $pdo->prepare($query);
    $prepare->bindParam(1, $id, PDO::PARAM_INT);
    $result = $prepare->execute();
    if ($result == true) {
      return $prepare->fetchColumn();
    }
  }

  function fetchCategory($id) {
    $pdo = db();
    $query = "SELECT `idcategories`, `label` FROM `categories`
      WHERE idcategories = ?";
    $prepare = $pdo->prepare($query);
    $prepare->bindParam(1, $id, PDO::PARAM_INT);
    $result = $prepare->execute();
    if ($result == true) {
      return $prepare->fetchAll();
    }
  }
  function fetchAllCategories() {
    $pdo = db();
    $query = "SELECT * FROM `categories`";
    $result = $pdo->query($query);
    $categories = $result->fetchAll();
    return $categories;
  }

  function fetchTags($id) {
    $pdo = db();
    $query = "SELECT `label` FROM `articles_has_tags` INNER JOIN `tags`
      WHERE tags_id = tags.idtags AND articles_id  = ?";
    $prepare = $pdo->prepare($query);
    $prepare->bindParam(1, $id, PDO::PARAM_INT);
    $result = $prepare->execute();
    if ($result == true) {
      return $prepare->fetchAll();
    }
  }
  function fetchAllTags() {
    $pdo = db();
    $query = "SELECT * FROM `tags`";
    $result = $pdo->query($query);
    $tags = $result->fetchAll();
    return $tags;
  }

  function countPages() {
    $pdo = db();
    $limit = 3;
    $query = "SELECT COUNT(*) FROM `articles`;";
    $result = $pdo->query($query);
    $numberOfArticles = $result->fetchColumn();
    $numberOfPages = (int)ceil($numberOfArticles / $limit);
    return $numberOfPages;
  }
  function countPagesCategories($id) {
    $pdo = db();
    $limit = 3;
    $query = "SELECT COUNT(*) FROM `articles` WHERE `categories_id` = $id;";
    $result = $pdo->query($query);
    $numberOfArticles = $result->fetchColumn();
    $numberOfPages = (int)ceil($numberOfArticles / $limit);
    return $numberOfPages;
  }
  function countPagesTags($id) {
    $pdo = db();
    $limit = 3;
    // var_dump($limit);die;
    $query = "SELECT `articles_id`, `articles`.`*` FROM `articles_has_tags`
    INNER JOIN `articles` ON `articles`.`idarticles` = `articles_has_tags`.`articles_id`
    WHERE `tags_id` = $id;";
    $result = $pdo->query($query);
    $numberOfArticles = $result->rowCount();
    $numberOfPages = (int)ceil($numberOfArticles / $limit);
    // var_dump($numberOfPages);die;
    return $numberOfPages;
  }
