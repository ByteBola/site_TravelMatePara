<footer id="footer">
    <div id="social-container">
        <ul>
            <li>
                <a href="#"><i class="fab fa-facebook-square"></i></a>
            </li>
            <li>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </li>
            <li>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </li>
        </ul>
    </div>
    <div id="footer-links-container">
        <ul>
            <li class="fas fa-cloud"><a href="<?= $BASE_URL ?>informacao_clima.php">Previsão do Tempo</a></li>
            <li class="fas fa-question-circle"><a href="<?= $BASE_URL ?>help.php">Ajuda com Informações</a></li>
            <?php if ($userData) : ?>
                <li class="far fa-plus-square"><a href="<?= $BASE_URL ?>newreport.php">Incluir relatos</a></li>
                <li class="fas fa-file-alt"><a href="<?= $BASE_URL ?>dashboard.php">Meus Relatos</a></li>
                <li><a href="<?= $BASE_URL ?>editprofile.php" class="nav-link bold"><?= $userData->name ?></a></li>
                <a href="<?= $BASE_URL ?>orientacoes.php" class="nav-link"><i class="fas fa-lightbulb"></i>Orientações de Publicações</a>
            <?php else : ?>
                <li><a href="<?= $BASE_URL ?>logout.php">Entrar / Cadastrar</a></li>
            <?php endif; ?>
            
            
            
        </ul>
    </div>
    <p>&copy;2024-TravelMateHelp</p>
</footer>
<!-- BOOSTRAP JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>