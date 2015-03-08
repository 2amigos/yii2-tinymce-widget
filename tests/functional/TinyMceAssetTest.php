<?php
/**
 *
 * TinyMceAssetTest.php
 *
 * Date: 06/03/15
 * Time: 13:44
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */

namespace tests;

use dosamigos\tinymce\TinyMceAsset;
use yii\web\AssetBundle;

class TinyMceAssetTest extends TestCase
{
    public function testRegister()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        TinyMceAsset::register($view);
        $this->assertEquals(1, count($view->assetBundles));
        $this->assertTrue($view->assetBundles['dosamigos\\tinymce\\TinyMceAsset'] instanceof AssetBundle);
        $content = $view->renderFile('@tests/data/views/rawlayout.php');
        $this->assertContains('tinymce.js', $content);
    }
}