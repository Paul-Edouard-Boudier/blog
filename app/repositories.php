<?php

  function db() {
    $dsn="mysql:dbname=BlogDDB;host=127.0.0.1;charset=UTF8";
    $username="root"; $passwd="0000";
    $pdo = new PDO($dsn, $username, $passwd);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
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
      return $prepare->fetchAll();
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

  function maxIdArticles() {
    $pdo = db();
    $query = "SELECT MAX(idarticles) FROM `articles`";
    $result = $pdo->query($query);
    $maxId = (int)$result->fetchColumn();
    return $maxId;
  }
