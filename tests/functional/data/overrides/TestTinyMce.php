<?php
/**
 *
 * TestTinyMce.php
 *
 * Date: 06/03/15
 * Time: 14:00
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */

namespace tests\data\overrides;

use dosamigos\tinymce\TinyMce;
use dosamigos\tinymce\TinyMceAsset;
use yii\helpers\Json;
use yii\web\View;

class TestTinyMce extends TinyMce
{
    public function registerClientScript()
    {
        $js = [];
        $view = $this->getView();

        TinyMceAsset::register($view);

        $id = $this->options['id'];

        $this->clientOptions['selector'] = "#{$id}";
        if ($this->language !== null) {
            $this->clientOptions['language'] = $this->language;
        }

        $options = Json::encode($this->clientOptions);

        $js[] = "tinymce.init({$options});";
        if ($this->triggerSaveOnBeforeValidateForm) {
            $js[] = "$('#{$id}').parents('form').on('beforeValidate', function() { tinymce.triggerSave(); });";
        }
        $view->registerJs(implode("\n", $js), View::POS_READY, 'test-tinymce-js');
    }
}