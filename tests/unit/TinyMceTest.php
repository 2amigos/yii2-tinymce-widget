<?php
/**
 *
 * TinyMceTest.php
 *
 * Date: 06/03/15
 * Time: 13:53
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */

namespace tests;


use dosamigos\tinymce\TinyMce;
use tests\data\models\Post;
use tests\data\overrides\TestTinyMce;
use yii\web\View;

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
        $class = new \ReflectionClass('tests\\data\\overrides\\TestTinyMce');
        $method = $class->getMethod('registerClientScript');
        $method->setAccessible(true);
        $model = new Post();
        $widget = TestTinyMce::begin(
            [
                'model' => $model,
                'attribute' => 'message',
            ]
        );
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
        $widget = TestTinyMce::begin(
            [
                'id' => 'test-id',
                'name' => 'test-name'
            ]
        );
        $widget->language = 'es';
        $view = $this->getView();
        $widget->setView($view);
        $widget->end();
        $test = <<<JS
tinymce.init({"selector":"#test-id","language":"es"});
JS;
        $this->assertEquals($test, $view->js[View::POS_READY]['test-tinymce-js']);
    }
}