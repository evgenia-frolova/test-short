<?php
use xj\qrcode\QRcode;
use xj\qrcode\widgets\Text;

/* @var $this yii\web\View */

$this->title = 'Сервис коротких ссылок + QR';

?>

<div>
    <p>
        <a href="<?=$link?>" target="_blank" id="shortClick"><?=$shortLink?></a>
    </p>    
    
    <?php echo Text::widget([
        'outputDir' => '@webroot/upload/qrcode',
        'outputDirWeb' => '@web/upload/qrcode',
        'ecLevel' => QRcode::QR_ECLEVEL_L,
        'text' => $link,
        'size' => 6,
    ]); ?>
</div>

<?php 
$url = yii\helpers\Url::toRoute('site/redirect');
$this->registerJs(
"
$('#shortClick').click(function() {
    var date = $(this).text();
    
    $.ajax({
        url: '".$url."',
        data: {link : date},
        method: 'post',
        dataType: 'json',
        success: function () {
            alert('success');
        },
        error: function (response) {
            console.log(response);
        }
    })
});
", yii\web\View::POS_END);
