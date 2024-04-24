<?php
  require_once("templates/header.php");

  // Verifica se usuário está autenticado
  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/ReportDAO.php");

  $user = new User();
  $userDao = new UserDao($conn, $BASE_URL);
  $reportDao = new ReportDAO($conn, $BASE_URL);

  $userData = $userDao->verifyToken(true);

  $userReports = $reportDao->getReportByUserId($userData->id);

?>
  <div id="main-container" class="container-fluid">
    <h2 class="section-title">Dashboard</h2>
    <p class="section-description">Adicione ou atualize as informações dos filmes que você enviou</p>
    <div class="col-md-12" id="add-movie-container">
      <a href="<?= $BASE_URL ?>newreport.php" class="btn card-btn">
        <i class="fas fa-plus"></i> Adicionar Relato
      </a>
    </div>
    <div class="col-md-12" id="movies-dashboard">
      <table class="table">
        <thead>
          <th scope="col">#</th>
          <th scope="col">Nome do Relato</th>
          <th scope="col">Nota</th>
          <th scope="col" class="actions-column">Relatorio</th>
        </thead>
        <tbody>
          <?php foreach($userReports as $report): ?>
          <tr>
            <td scope="row"><?= $report->id ?></td>
            <td><a href="<?= $BASE_URL ?>report.php?id=<?= $report->id ?>" class="table-movie-title"><?= $report->title ?></a></td>
            <td><i class="fas fa-star"></i> <?= $report->rating ?></td>
            <td class="actions-column">
              <a href="<?= $BASE_URL ?>editreport.php?id=<?= $report->id ?>" class="edit-btn">
                <i class="far fa-edit"></i> Editar
              </a>
              <form action="<?= $BASE_URL ?>report_process.php" method="POST">
                <input type="hidden" name="type" value="delete">
                <input type="hidden" name="id" value="<?= $report->id ?>">
                <button type="submit" class="delete-btn">
                  <i class="fas fa-times"></i> Deletar
                </button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>