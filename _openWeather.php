<div class="weather-widget">
        <div class="weather-widget__header">
            <h1><?= "Погода ". $place = $response[0]['five_days']['city']['name'] == "Earth" ? "рядом" : $response[0]['five_days']['city']['name']?></h1>
        <div class="mobile-wrapper__header">
            <div class="weather-widget__synopsis weather-day__ac" id="link-day1">
                <span class="weather-widget__syn__date">
                    <?= $weekday[0] ?>, <?= $days[$keys[0]][3].$days[$keys[0]][4] ?> <?= Yii::$app->weatherwidget->getMonth($days[$keys[0]]) ?>
                    <br>
                    <span>сегодня</span>
                </span>
                <span class="weather-widget__syn__temp">
                    <span><?= $minmax[0] = $minmax[0] > 0 ? "+".$minmax[0] : $minmax[0] ?></span><span><?= $$minmax[1] = $minmax[1] > 0 ? "+".$minmax[1] : $minmax[1] ?></span>
                </span>
                <span class="weather-widget__syn__ico">
                    <img height="65" src="https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/widgets/<?= $pic_day1th ?>" >
                </span>
                <span class="weather-widget__syn__sunrise-set sunrise-set">
                    ↑ Восход: [<?= date('d-m-Y H:i:s',$response[0]['one_day']['sys']['sunrise']) ?>]<br>
                    ↓ Закат: [<?= date('d-m-Y H:i:s',$response[0]['one_day']['sys']['sunset']) ?>] 
                </span>
            </div>
            <div class="weather-widget__syn__coordinates">
                Координаты начала пути <span>[Широта: <?= $response[0]['five_days']['city']['coord']['lat'] ?? "Нет данных" ?> | Долгота: <?= $response[0]['five_days']['city']['coord']['lon'] ?? "Нет данных" ?>]</span> 
            </div>
            <div class="weather-widget__syn__nextday" id="link-day2">
                <span class="weather-widget__syn__date">
                    <?= $weekday[1] ?>, <?= $days[$keys[1]][3].$days[$keys[1]][4] ?> <?= Yii::$app->weatherwidget->getMonth($days[$keys[1]]) ?>
                    <br>
                    <span>завтра</span>
                </span>
                <span class="weather-widget__syn__temp">
                    <span><?= $minmax[2] = $minmax[2] > 0 ? "+".$minmax[2] : $minmax[2] ?></span><span><?= $$minmax[3] = $minmax[3] > 0 ? "+".$minmax[3] : $minmax[3] ?></span>
                </span>
                <span class="weather-widget__syn__ico">
                    <img height="70" src="https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/widgets/<?= $response[0]['five_days']['list'][$keys[1]+4]['weather'][0]['icon'] ?>.png" >
                </span>
            </div>
            <div class="weather-widget__syn__nextday" id="link-day3">
                <span class="weather-widget__syn__date">
                    <?= $weekday[2] ?>, <?= $days[$keys[2]][3].$days[$keys[2]][4] ?> <?= Yii::$app->weatherwidget->getMonth($days[$keys[2]]) ?>
                </span>
                <span class="weather-widget__syn__temp">
                    <span><?= $minmax[4] = $minmax[4] > 0 ? "+".$minmax[4] : $minmax[4] ?></span><span><?= $minmax[5] = $minmax[5] > 0 ? "+".$minmax[5] : $minmax[5] ?></span>
                </span>
                <span class="weather-widget__syn__ico">
                    <img height="70" src="https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/widgets/<?= $response[0]['five_days']['list'][$keys[2]+4]['weather'][0]['icon'] ?>.png" >
                </span>
            </div>
            <div class="weather-widget__syn__nextday" id="link-day4">
                <span class="weather-widget__syn__date">
                    <?= $weekday[3] ?>, <?= $days[$keys[3]][3].$days[$keys[3]][4] ?> <?= Yii::$app->weatherwidget->getMonth($days[$keys[3]]) ?>
                </span>
                <span class="weather-widget__syn__temp">
                    <span><?= $minmax[6] = $minmax[6] > 0 ? "+".$minmax[6] : $minmax[6] ?></span><span><?= $minmax[7] = $minmax[7] > 0 ? "+".$minmax[7] : $minmax[7] ?></span>
                </span>
                <span class="weather-widget__syn__ico">
                    <img height="70" src="https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/widgets/<?= $response[0]['five_days']['list'][$keys[3]+4]['weather'][0]['icon'] ?>.png" >
                </span>
            </div>
        </div>
        </div>
        <div class="weather-widget__content" style="padding-bottom: 60px">
        <div class="mobile-wrapper__content">
            <div id="day1">
                <div class="weather-widget-cont__header">
                    <div class="weather-widget-cont__cell__stub"></div>
                <?php for($i = $keys[0];$i < $keys[1]; $i++): ?>
                    <div class="weather-widget-cont__cell">
                        <img width='100%'  height='100%' src='https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/widgets/<?= $response[0]['five_days']['list'][$i]['weather'][0]['icon'] ?>.png'/>
                        <span><?= substr($response[0]['five_days']['list'][$i]['dt_txt'], 11,2) ?><sup>00</sup></span>
                        <span><?= (int)$response[0]['five_days']['list'][$i]['main']['temp']; ?></span>
                    </div>
                <?php endfor; ?>
                </div>
                <div class="weather-widget-cont__detail">           
                    <div class="weather-widget-cont__detail-th">
                        <div><span>Давление</span></div>
                        <div><span>Давление н.у.м.</span></div>
                        <div><span>Влажность, %</span></div>
                        <div><span>Скорость ветра, м/с</span></div>
                        <div><span>Облачность, %</span></div>
                        <div><span>Дождь, mm</span></div>
                        <div><span>Снег, mm</span></div>
                    </div>
                    <?php for($i = $keys[0];$i < $keys[1];$i++): ?>
                    <div class="weather-widget-cont__detail-cell">
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['main']['pressure'] ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['main']['sea_level'] ?></span></div>
                        <div><span><?= $response[0]['five_days']['list'][$i]['main']['humidity'] ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['wind']['speed'] ?><?= Yii::$app->weatherwidget->convertDeg($response,$i) ?></span></div>
                        <div><span><?= $response[0]['five_days']['list'][$i]['clouds']['all'] ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['rain']['3h'] ?? "Без осадков" ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['snow']['3h'] ?? "Без осадков" ?></span></div>
                    </div>
                    <?php endfor; ?>  
                </div>
            </div>
            <div id="day2" style="display:none">
                <div class="weather-widget-cont__header">
                        <div class="weather-widget-cont__cell__stub"></div>
                    <?php for($i = $keys[1];$i < $keys[2]; $i++): ?>
                        <div class="weather-widget-cont__cell">
                            <img width='100%'  height='100%' src='https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/widgets/<?= $response[0]['five_days']['list'][$i]['weather'][0]['icon'] ?>.png'/>
                            <span><?= substr($response[0]['five_days']['list'][$i]['dt_txt'], 11,2) ?><sup>00</sup></span>
                            <span><?= (int)$response[0]['five_days']['list'][$i]['main']['temp']; ?></span>
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="weather-widget-cont__detail">           
                    <div class="weather-widget-cont__detail-th">
                        <div><span>Давление</span></div>
                        <div><span>Давление н.у.м.</span></div>
                        <div><span>Влажность, %</span></div>
                        <div><span>Скорость ветра, м/с</span></div>
                        <div><span>Облачность, %</span></div>
                        <div><span>Дождь, mm</span></div>
                        <div><span>Снег, mm</span></div>
                    </div>
                    <?php for($i=$keys[1];$i < $keys[2];$i++): ?>
                    <div class="weather-widget-cont__detail-cell">
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['main']['pressure'] ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['main']['sea_level'] ?></span></div>
                        <div><span><?= $response[0]['five_days']['list'][$i]['main']['humidity'] ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['wind']['speed'] ?><?= Yii::$app->weatherwidget->convertDeg($response,$i) ?></span></div>
                        <div><span><?= $response[0]['five_days']['list'][$i]['clouds']['all'] ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['rain']['3h'] ?? "Без осадков" ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['snow']['3h'] ?? "Без осадков" ?></span></div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div id="day3" style="display:none">
                <div class="weather-widget-cont__header">
                        <div class="weather-widget-cont__cell__stub"></div>
                    <?php for($i = $keys[2];$i < $keys[3]; $i++): ?>
                        <div class="weather-widget-cont__cell">
                            <img width='100%'  height='100%' src='https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/widgets/<?= $response[0]['five_days']['list'][$i]['weather'][0]['icon'] ?>.png'/>
                            <span><?= substr($response[0]['five_days']['list'][$i]['dt_txt'], 11,2) ?><sup>00</sup></span>
                            <span><?= (int)$response[0]['five_days']['list'][$i]['main']['temp']; ?></span>
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="weather-widget-cont__detail">           
                    <div class="weather-widget-cont__detail-th">
                        <div><span>Давление</span></div>
                        <div><span>Давление н.у.м.</span></div>
                        <div><span>Влажность, %</span></div>
                        <div><span>Скорость ветра, м/с</span></div>
                        <div><span>Облачность, %</span></div>
                        <div><span>Дождь, mm</span></div>
                        <div><span>Снег, mm</span></div>
                    </div>
                    <?php for($i = $keys[2];$i < $keys[3]; $i++): ?>
                    <div class="weather-widget-cont__detail-cell">
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['main']['pressure'] ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['main']['sea_level'] ?></span></div>
                        <div><span><?= $response[0]['five_days']['list'][$i]['main']['humidity'] ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['wind']['speed'] ?><?= Yii::$app->weatherwidget->convertDeg($response,$i) ?></span></div>
                        <div><span><?= $response[0]['five_days']['list'][$i]['clouds']['all'] ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['rain']['3h'] ?? "Без осадков" ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['snow']['3h'] ?? "Без осадков" ?></span></div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div id="day4" style="display:none">
                <div class="weather-widget-cont__header">
                        <div class="weather-widget-cont__cell__stub"></div>
                    <?php for($i=$keys[3];$i <= $keys[3] + 7;$i++): ?>
                        <div class="weather-widget-cont__cell">
                            <img width='100%'  height='100%' src='https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/widgets/<?= $response[0]['five_days']['list'][$i]['weather'][0]['icon'] ?>.png'/>
                            <span><?= substr($response[0]['five_days']['list'][$i]['dt_txt'], 11,2) ?><sup>00</sup></span>
                            <span><?= (int)$response[0]['five_days']['list'][$i]['main']['temp']; ?></span>
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="weather-widget-cont__detail">           
                    <div class="weather-widget-cont__detail-th">
                        <div><span>Давление</span></div>
                        <div><span>Давление н.у.м.</span></div>
                        <div><span>Влажность, %</span></div>
                        <div><span>Скорость ветра, м/с</span></div>
                        <div><span>Облачность, %</span></div>
                        <div><span>Дождь, mm</span></div>
                        <div><span>Снег, mm</span></div>
                    </div>
                    <!-- Оставлен старый цикл для дебага ошибки с памятью -->
                    <?php for($i=$keys[3];$i <= $keys[3]+7;$i++): ?>
                    <div class="weather-widget-cont__detail-cell">
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['main']['pressure'] ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['main']['sea_level'] ?></span></div>
                        <div><span><?= $response[0]['five_days']['list'][$i]['main']['humidity'] ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['wind']['speed'] ?><?= Yii::$app->weatherwidget->convertDeg($response,$i) ?></span></div>
                        <div><span><?= $response[0]['five_days']['list'][$i]['clouds']['all'] ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['rain']['3h'] ?? "Без осадков" ?></span></div>
                        <div><span><?= (int)$response[0]['five_days']['list'][$i]['snow']['3h'] ?? "Без осадков" ?></span></div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="weather-widget-cont__up-down">
                <a class="weather-widget-cont__link-down">развернуть дополнительные показатели <i class="fas fa-angle-down"></i></a>
                <a class="weather-widget-cont__link-up" style="display:none">свернуть дополнительные показатели <i class="fas fa-angle-up"></i></a>
            </div>          
        </div>
        </div>
    </div>


<?php $script = <<< JS
    $(document).ready(function(){
    $('.weather-widget-cont__link-down').click(function () {
        $('.weather-widget-cont__detail').css('display', 'table');
        $('.weather-widget-cont__link-down').css('display', 'none');
        $('.weather-widget-cont__link-up').css('display', 'block');
    });
    $('.weather-widget-cont__link-up').click(function () {
        $('.weather-widget-cont__detail').css('display', 'none');
        $('.weather-widget-cont__link-down').css('display', 'block');
        $('.weather-widget-cont__link-up').css('display', 'none');
    }); 
    $('#link-day1').click(function () {
        $('#link-day1').addClass('weather-day__ac');
        $('#link-day2').removeClass('weather-day__ac');
        $('#link-day3').removeClass('weather-day__ac');
        $('#link-day4').removeClass('weather-day__ac');

        $('#day1').css('display', 'block');
        $('#day2').css('display', 'none');
        $('#day3').css('display', 'none');
        $('#day4').css('display', 'none');
    });   
    $('#link-day2').click(function () {
        $('#link-day1').removeClass('weather-day__ac');
        $('#link-day2').addClass('weather-day__ac');
        $('#link-day3').removeClass('weather-day__ac');
        $('#link-day4').removeClass('weather-day__ac');

        $('#day1').css('display', 'none');
        $('#day2').css('display', 'block');
        $('#day3').css('display', 'none');
        $('#day4').css('display', 'none');
    }); 
    $('#link-day3').click(function () {
        $('#link-day1').removeClass('weather-day__ac');
        $('#link-day2').removeClass('weather-day__ac');
        $('#link-day3').addClass('weather-day__ac');
        $('#link-day4').removeClass('weather-day__ac');

        $('#day1').css('display', 'none');
        $('#day2').css('display', 'none');
        $('#day3').css('display', 'block');
        $('#day4').css('display', 'none');
    }); 
    $('#link-day4').click(function () {
        $('#link-day1').removeClass('weather-day__ac');
        $('#link-day2').removeClass('weather-day__ac');
        $('#link-day3').removeClass('weather-day__ac');
        $('#link-day4').addClass('weather-day__ac');

        $('#day1').css('display', 'none');
        $('#day2').css('display', 'none');
        $('#day3').css('display', 'none');
        $('#day4').css('display', 'block');
    });     
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
 ?>