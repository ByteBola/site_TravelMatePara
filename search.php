<?php
  require_once("templates/header.php");

  require_once("dao/ReportDAO.php");

  // DAO dos relatos
  $reportDao = new ReportDAO($conn, $BASE_URL);

  // Resgata busca do usuário
  $q = filter_input(INPUT_GET, "q");

  $reports = $reportDao->findByTitle($q);

?>
  <div id="main-container" class="container-fluid">
    <h2 class="section-title" id="search-title">Você está buscando por: <span id="search-result"><?= $q ?></span></h2>
    <p class="section-description">Resultados de busca retornados com base na sua pesquisa.</p>
    <div class="relatos-container">
      <?php foreach($reports as $report): ?>
        <?php require("templates/report_card.php"); ?>
      <?php endforeach; ?>
      <?php if(count($reports) === 0): ?>
        <p class="empty-list">Não há relatos para esta busca, <a href="<?= $BASE_URL ?>" class="back-link">voltar</a>.</p>
      <?php endif; ?>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>