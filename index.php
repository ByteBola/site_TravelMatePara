<?php
require_once("templates/header.php");

require_once("dao/ReportDAO.php");

// DAO dos filmes
$reportDao = new ReportDAO($conn, $BASE_URL);

$latestReports = $reportDao->getLatestReport();

$problema_climatico_Reports = $reportDao->getReportsByCategory("Problema Climático");

$transporte_publico_Reports = $reportDao->getReportsByCategory("Segurança Pública");

?>
<div id="main-container" class="container-fluid">
  <h3>Faça Sua Voz Ser Ouvida: Plataforma de Denúncias do Pará</h3>

  <h2 class="section-title">Relatos Novos</h2>
  <p class="section-description">Veja as críticas dos últimos relatos adicionados no elém</p>
  <div class="movies-container">
    <?php foreach ($latestReports as $report) : ?>
      <?php require("templates/report_card.php"); ?>
    <?php endforeach; ?>
    <?php if (count($latestReports) === 0) : ?>
      <p class="empty-list">Ainda não há relatos cadastrados!</p>
    <?php endif; ?>
  </div>
  <h2 class="section-title">Problemas Climáticos</h2>
  <p class="section-description">fique informado sobre os problemas climáticos</p>
  <div class="movies-container">
    <?php foreach ($problema_climatico_Reports as $report) : ?>
      <?php require("templates/report_card.php"); ?>
    <?php endforeach; ?>
    <?php if (count($problema_climatico_Reports) === 0) : ?>
      <p class="empty-list">Ainda não há relatos de problemas climáticos cadastrados!</p>
    <?php endif; ?>
  </div>
  <h2 class="section-title">Segurança Pública</h2>
  <p class="section-description">fique informado sobre os problemas de segurança pública</p>
  <div class="movies-container">
    <?php foreach ($transporte_publico_Reports as $report) : ?>
      <?php require("templates/report_card.php"); ?>
    <?php endforeach; ?>
    <?php if (count($transporte_publico_Reports) === 0) : ?>
      <p class="empty-list">Ainda não há problemas de segurança cadastrados!</p>
    <?php endif; ?>
  </div>
</div>
<?php
require_once("templates/footer.php");
?>