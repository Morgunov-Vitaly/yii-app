<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">Click the button below to get the latest rates from https://openexchangerates.org.</p>

        <?= Html::button('Get the latest rates', ['id' => 'get-rates', 'class' => 'btn btn-primary']) ?>

        <div id="rates-output" style="margin-top: 20px; text-align: left"></div>
    </div>
</div>
<?php
$urlToAction = Url::to(['site/latest-rates']);
$this->registerJs(<<<JS
    $('#get-rates').on('click', function () {
        $.ajax({
            url: '$urlToAction',
            method: 'GET',
            success: function(response) {
                let output = '<h3>Base: ' + response.base + '</h3>';
                output += '<p>Timestamp: ' + new Date(response.timestamp * 1000).toLocaleString() + '</p>';
                output += '<h4>Rates:</h4><ul>';
                for (let currency in response.rates) {
                    output += '<li>' + currency + ': ' + response.rates[currency] + '</li>';
                }
                output += '</ul>';
                $('#rates-output').html(output);
            },
            error: function() {
                $('#rates-output').html('<p style="color: red;">Error fetching rates.</p>');
            }
        });
    });
JS
);
?>