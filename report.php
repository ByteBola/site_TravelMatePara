<?php
  require_once("templates/header.php");

  // Verifica se usuário está autenticado
  require_once("models/Report.php");
  require_once("dao/ReportDAO.php");
  require_once("dao/ReviewDAO.php");

  // Pegar o id do filme
  $id = filter_input(INPUT_GET, "id");

  $report;

  $reportDao = new ReportDAO($conn, $BASE_URL);

  $reviewDao = new ReviewDAO($conn, $BASE_URL);

  if(empty($id)) {

    $message->setMessage("O Relato não foi encontrado!", "error", "index.php");

  } else {

    $report = $reportDao->findById($id);

    // Verifica se o filme existe
    if(!$report) {

      $message->setMessage("O Relato não foi encontrado!", "error", "index.php");

    }

  }

  // Checar se o filme tem imagem
  if($movie->image == "") {
    $movie->image = "report_cover.jpg";
  }

  // Checar se o filme é do usuário
  $userOwnsReport = false;

  if(!empty($userData)) {

    if($userData->id === $report->users_id) {
      $userOwnsReport = true;
    }

    // Resgatar as revies do filme
    $alreadyReviewed = $reviewDao->hasAlreadyReviewed($id, $userData->id);
 
  }

  // Resgatar as reviews do filme
  $reportReviews = $reviewDao->getReportsReview($report->id);

?>
<div id="main-container" class="container-fluid">
  <div class="row">
    <div class="offset-md-1 col-md-6 movie-container">
      <h1 class="page-title"><?= $report->title ?></h1>
      <p class="movie-details">
        <span>Duração: <?= $report->length ?></span>
        <span class="pipe"></span>
        <span><?= $report->category ?></span>
        <span class="pipe"></span>
        <span><i class="fas fa-star"></i> <?= $report->rating ?></span>
      </p>
      <iframe src="<?= $report->trailer ?>" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encryted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <p><?= $report->description ?></p>
    </div>
    <div class="col-md-4">
      <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>img/reports/<?= $report->image ?>')"></div>
    </div>
    <div class="offset-md-1 col-md-10" id="reviews-container">
      <h3 id="reviews-title">Avaliações:</h3>
      <!-- Verifica se habilita a review para o usuário ou não -->
      <?php if(!empty($userData) && !$userOwnsMovie && !$alreadyReviewed): ?>
      <div class="col-md-12" id="review-form-container">
        <h4>Envie sua avaliação:</h4>
        <p class="page-description">Preencha o formulário com a nota e comentário sobre o Relato</p>
        <form action="<?= $BASE_URL ?>review_process.php" id="review-form" method="POST">
          <input type="hidden" name="type" value="create">
          <input type="hidden" name="reports_id" value="<?= $movie->id ?>">
          <div class="form-group">
            <label for="rating">Nota do filme:</label>
            <select name="rating" id="rating" class="form-control">
              <option value="">Selecione</option>
              <option value="10">10</option>
              <option value="9">9</option>
              <option value="8">8</option>
              <option value="7">7</option>
              <option value="6">6</option>
              <option value="5">5</option>
              <option value="4">4</option>
              <option value="3">3</option>
              <option value="2">2</option>
              <option value="1">1</option>
            </select>
          </div>
          <div class="form-group">
            <label for="review">Seu comentário:</label>
            <textarea name="review" id="review" rows="3" class="form-control" placeholder="O que você achou do filme?"></textarea>
          </div>
          <input type="submit" class="btn card-btn" value="Enviar comentário">
        </form>
      </div>
      <?php endif; ?>
      <!-- Comentários -->
      <?php foreach($reportReviews as $review): ?>
        <?php require("templates/user_review.php"); ?>
      <?php endforeach; ?>
      <?php if(count($reportReviews) == 0): ?>
        <p class="empty-list">Não há comentários para este filme ainda...</p>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php
  require_once("templates/footer.php");
?>