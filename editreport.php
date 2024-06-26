<?php
  require_once("templates/header.php");

  // Verifica se usuário está autenticado
  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/ReportDAO.php");

  $user = new User();
  $userDao = new UserDao($conn, $BASE_URL);

  $userData = $userDao->verifyToken(true);

  $reportDao = new ReportDAO($conn, $BASE_URL);

  $id = filter_input(INPUT_GET, "id");

  if(empty($id)) {

    $message->setMessage("O relato não foi encontrado!", "error", "index.php");

  } else {

    $report = $reportDao->findById($id);

    // Verifica se o  existe
    if(!$report) {

      $message->setMessage("O relato não foi encontrado!", "error", "index.php");

    }

  }

  // Checar se o Relato tem imagem
  if($report->image == "") {
    $report->image = "report_cover.png";
  }

?>
  <div id="main-container" class="container-fluid">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6 offset-md-1">
          <h1><?= $report->title ?></h1>
          <p class="page-description">Altere os dados do relato no fomrulário abaixo:</p>
          <form id="edit-relato-form" action="<?= $BASE_URL ?>report_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <input type="hidden" name="id" value="<?= $report->id ?>">
            <div class="form-group">
              <label for="title">Nome do Relato:</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do seu relato" value="<?= $report->title ?>">
            </div>
            <div class="form-group">
              <label for="image">Imagem:</label>
              <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <div class="form-group">
              <label for="length">Duração:</label>
              <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do ocorrido..." value="<?= $report->length ?>">
            </div>
            <div class="form-group">
              <label for="category">Category:</label>
              <select name="category" id="category" class="form-control">
                <option value="">Selecione</option>    
                <option value="Problema Climático" <?= $report->category === "Problema Climático" ? "selected" : "" ?>>Problema Climático</option>
                <option value="Infraestrutura" <?= $report->category === "Infraestrutura" ? "selected" : "" ?>>Infraestrutura</option>
                <option value="Segurança Pública" <?= $report->category === "Segurança Pública" ? "selected" : "" ?>>Segurança Pública</option>
                <option value="Saúde-Bem-Estar" <?= $report->category === "Saúde-Bem-Estar" ? "selected" : "" ?>>Saúde-Bem-Estar</option>
                <option value="População" <?= $report->category === "População" ? "selected" : "" ?>>População</option>
                <option value="Transporte Público" <?= $report->category === "Transporte Público" ? "selected" : "" ?>>Transporte Público</option>
                <option value="Outros Problemas" <?= $report->category === "Outros Problemas" ? "selected" : "" ?>>Outros Problemas</option>
            </select>

            </div>
            <div class="form-group">
              <label for="trailer">Link do maps:</label>
              <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link (Google Maps/YouTube)" value="<?= $report->trailer ?>">
            </div>
            <div class="form-group">
              <label for="description">Descrição:</label>
              <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o relato..."><?= $report->description ?></textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Editar Relato">
          </form>
        </div>
        <div class="col-md-3">
          <div class="relato-image-container" style="background-image: url('<?= $BASE_URL ?>img/reports/<?= $report->image ?>')"></div>
        </div>
      </div>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>