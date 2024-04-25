<?php

require_once("templates/header.php");

?>

<div class="container-info">
    <h3 id="title-help">Serviços de Suporte do Estado do Pará</h3>
    <div class="container-info" id="policia">
        <h2 onclick="toggleDetails('policia')">Polícia</h2>
        <div class="esconder-detalhes">
            <ul>
                <li>Número da Polícia: 190</li>
            </ul>
        </div>
    </div>
    <div class="container-info" id="ambulancia">
        <h2 onclick="toggleDetails('ambulancia')">Ambulância</h2>
        <div class="esconder-detalhes">
            <ul>
                <li>Número da Ambulância:192</li>
            </ul>
        </div>
    </div>
    <div class="container-info" id="bombeiro">
        <h2 onclick="toggleDetails('bombeiro')">Bombeiro</h2>
        <div class="esconder-detalhes">
            <ul>
                <li>Número dos Bombeiros:193</li>
            </ul>
        </div>
    </div>
    
</div>

<script src="<?= $BASE_URL ?>/js/script.js"></script>
<?php

require_once("templates/footer.php");

?>