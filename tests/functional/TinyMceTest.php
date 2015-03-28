<?php
/**
 * @link https://github.com/2amigos/yii2-tinymce-widget
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @license http://opensource.org/licenses/BSD-3-Clause
 */
namespace tests;


use dosamigos\tinymce\TinyMce;
use tests\models\Post;
use tests\overrides\TestTinyMce;
use yii\web\View;
use Yii;

class TinyMceTest extends TestCase
{
    public function testRenderWithModel()
    {
        $model = new Post();
        $out = TinyMce::widget(
            [
                'model' => $model,
                'attribute' => 'message'
            ]
        );
        $expected = '<textarea id="post-message" name="Post[message]"></textarea>';
        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testRenderWithNameAndValue()
    {
        $out = TinyMce::widget(
            [
                'id' => 'test',
                'name' => 'test-editor-name',
                'value' => 'test-editor-value'
            ]
        );
        $expected = '<textarea id="test" name="test-editor-name">test-editor-value</textarea>';
        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testTinyMceRegisterClientScriptMethod()
    {
        $class = new \ReflectionClass('tests\\overrides\\TestTinyMce');
        $method = $class->getMethod('registerClientScript');
        $method->setAccessible(true);
        $model = new Post();
        $widget = TestTinyMce::begin(
            [
                'model' => $model,
                'attribute' => 'message'
            ]
        );
        $class->getProperty('triggerSaveOnBeforeValidateForm')->setValue($widget, false);
        $view = $this->getView();
        $widget->setView($view);
        $method->invoke($widget);
        $test = <<<JS
tinymce.init({"selector":"#post-message"});
JS;
        $this->assertEquals($test, $view->js[View::POS_READY]['test-tinymce-js']);
    }

    public function testTinyMceRegisterClientScriptMethodWithLanguage()
    {
        $class = new \ReflectionClass('tests\\overrides\\TestTinyMce');
        $method = $class->getMethod('registerClientScript');
        $method->setAccessible(true);
        $model = new Post();
        $widget = TestTinyMce::begin(
            [
                'model' => $model,
                'attribute' => 'message'
            ]
        );
        $view = $this->getView();
        $widget->setView($view);
        $class->getProperty('language')->setValue($widget, 'es');
        $method->invoke($widget);
        $test = <<<JS
tinymce.init({"selector":"#post-message","language_url":"/1/langs/es.js"});
$('#post-message').parents('form').on('beforeValidate', function() { tinymce.triggerSave(); });
JS;
        $this->assertEquals($test, $view->js[View::POS_READY]['test-tinymce-js']);
    }

    public function testWidget(){
        $model = new Post();
        $view = Yii::$app->getView();
        $content = $view->render('//tinymce-widget', ['model' => $model]);
        $actual = $view->render('//layouts/main', ['content' => $content]);

        $expected = file_get_contents(__DIR__ . '/data/test-tinymce-widget.bin');
        $this->assertEquals($expected, $actual);
    }
}
