<?php
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model tests\models\Post */
?>


<?= TinyMce::widget([
    'model' => $model,
    'attribute' => 'message',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]);
