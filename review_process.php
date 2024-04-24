<?php

  require_once("globals.php");
  require_once("db.php");
  require_once("models/Report.php");
  require_once("models/Review.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");
  require_once("dao/ReportDAO.php");
  require_once("dao/ReviewDAO.php");

  $message = new Message($BASE_URL);
  $userDao = new UserDAO($conn, $BASE_URL);
  $movieDao = new ReportDAO($conn, $BASE_URL);
  $reviewDao = new ReviewDAO($conn, $BASE_URL);

  // Recebendo o tipo do formulário
  $type = filter_input(INPUT_POST, "type");

  // Resgata dados do usuário
  $userData = $userDao->verifyToken();

  if($type === "create") {

    // Recebendo dados do post
    $rating = filter_input(INPUT_POST, "rating");
    $review = filter_input(INPUT_POST, "review");
    $reports_id = filter_input(INPUT_POST, "reports_id");
    $users_id = $userData->id;

    $reviewObject = new Review();

    $reportData = $reportDao->findById($reports_id);

    // Validando se o Relato existe
    if($reportData) {

      // Verificar dados mínimos
      if(!empty($rating) && !empty($review) && !empty($report_id)) {

        $reviewObject->rating = $rating;
        $reviewObject->review = $review;
        $reviewObject->reports_id = $reports_id;
        $reviewObject->users_id = $users_id;

        $reviewDao->create($reviewObject);

      } else {

        $message->setMessage("Você precisa inserir a nota e o comentário!", "error", "back");

      }

    } else {

      $message->setMessage("Informações inválidas!", "error", "index.php");

    }

  } else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

  }