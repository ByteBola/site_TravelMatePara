<?php
// Inclui o cabeçalho da página
require_once("templates/header.php");

// Verifica se o usuário está autenticado
require_once("models/User.php");
require_once("dao/UserDAO.php");

$userDao = new UserDao($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);

?>
<div id="main-container" class="container-fluid">
  <div class="offset-md-4 col-md-4 new-report-container">
    <h1 class="page-title">Adicionar Relato</h1>
    <p class="page-description">Compartilhe o seu Relato</p>

    <!-- Formulário para adicionar um novo relato -->
    <form action="<?= $BASE_URL ?>report_process.php" id="add-report-form" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="type" value="create">

      <!-- Nome do relato -->
      <div class="form-group">
        <label for="title">Nome do Relato:</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Digite o nome do relato..." required>
      </div>

      <!-- Imagem para o relato -->
      <div class="form-group">
        <label for="image">Imagem:</label>
        <input type="file" class="form-control-file" name="image" id="image" accept="image/*">
      </div>

      <!-- Duração do Relato -->
      <div class="form-group">
        <label for="length">Duração do Relato:</label>
        <input type="text" class="form-control" id="length" name="length" placeholder="registre o tempo do ocorrido...">
      </div>

      <!-- Categoria do relato -->
      <div class="form-group">
        <label for="category">Categoria do Relato:</label>
        <select name="category" id="category" class="form-control" required>
          <option value="">Selecione</option>
          <option value="Problema Climático">Problema Climático</option>
          <option value="Infraestrutura">Infraestrutura</option>
          <option value="Segurança Pública">Segurança Pública</option>
          <option value="Saúde e Bem-Estar">Saúde</option>
          <option value="Poluição">Poluição</option>
          <option value="Transporte Público">Transporte Público</option>
          <option value="Outros Problemas">Outros Problemas</option>
        </select>
      </div>


      <!-- Link para mídia (Google Maps, YouTube, etc.) -->
      <div class="form-group">
        <label for="trailer">Mídia:</label>
        <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link (Google Maps/YouTube)">
      </div>

      <!-- Descrição do relato -->
      <div class="form-group">
        <label para o="description">Descrição:</label>
        <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o relato..." required></textarea>
      </div>

      <!-- Botão para submeter o formulário -->
      <input type="submit" class="btn card-btn" value="Adicionar Relato">
    </form>
  </div>
</div>

<?php
// Inclui o rodapé da página
require_once("templates/footer.php");
?>