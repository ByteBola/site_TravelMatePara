<?php

require_once("templates/header.php");

?>

<div id="container-temp">
    <h2>Fique atento a previsão do tempo na sua cidade!</h2>
    <form id="search-temp">
        <i class="fa-solid fa-location-dot"></i>
        <input type="search" name="city_name" id="city_name" placeholder="Buscar cidade ">
        <button type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>

    <div id="weather">
        <h1 id="title">Rolante, BR</h1>

        <div id="infos">
            <div id="temp">
                <img id="temp_img" src="http://openweathermap.org/img/wn/04d@2x.png" alt="">

                <div>
                    <p id="temp_value">
                        32
                    </p>
                    <p id="temp_description">
                        Ensolarado
                    </p>
                </div>
            </div>

            <div id="other_infos">
                <div class="info">
                    <i id="temp_max_icon" class="fa-solid fa-temperature-high"></i>

                    <div>
                        <h2>Temp. max</h2>

                        <p id="temp_max">
                            32 <sup>C°</sup>
                        </p>
                    </div>
                </div>

                <div class="info">
                    <i id="temp_min_icon" class="fa-solid fa-temperature-low"></i>

                    <div>
                        <h2>Temp. min</h2>

                        <p id="temp_min">
                            12 <sup>C°</sup>
                        </p>
                    </div>
                </div>

                <div class="info">
                    <i id="humidity_icon" class="fa-solid fa-droplet"></i>

                    <div>
                        <h2>Humidade</h2>

                        <p id="humidity">
                            50%
                        </p>
                    </div>
                </div>

                <div class="info">
                    <i id="wind_icon" class="fa-solid fa-wind"></i>

                    <div>
                        <h2>Vento</h2>

                        <p id="wind">
                            50 km/h
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="alert"></div>
</div>
<script src="<?= $BASE_URL ?>/js/script.js"></script>
<?php

require_once("templates/footer.php");

?>