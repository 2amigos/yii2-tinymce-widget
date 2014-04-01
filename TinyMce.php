<?php
/**
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\tinymce;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 *
 * TinyMCE renders a tinyMCE js plugin for WYSIWYG editing.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */
class TinyMce extends InputWidget
{
    /**
     * @var string the language to use. Defaults to null (en).
     */
    public $language;

    /**
     * @var array the options for the TinyMCE JS plugin.
     * Please refer to the TinyMCE JS plugin Web page for possible options.
     * @see http://www.tinymce.com/wiki.php/Configuration
     */
    public $clientOptions = [];

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }
        $this->registerClientScript();
    }

    /**
     * Registers Twitter TypeAhead Bootstrap plugin and the related events
     */
    protected function registerClientScript()
    {
        $view = $this->getView();

        TinyMceAsset::register($view);

        $id = $this->options['id'];

        $this->clientOptions['selector'] = "#$id";
        if($this->language !== null) {
            $this->clientOptions['language'] = $this->language;
        }

        $options = Json::encode($this->clientOptions);

        $view->registerJs("tinymce.init($options);");
    }
} 