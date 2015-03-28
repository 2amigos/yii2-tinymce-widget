<?php
/**
 * @link https://github.com/2amigos/yii2-tinymce-widget
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @license http://opensource.org/licenses/BSD-3-Clause
 */
namespace tests;

use tests\overrides\TestTinyMceLangAsset;
use yii\web\AssetBundle;

class TinyMceLangAssetTest extends TestCase
{
    public function testRegister()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        TestTinyMceLangAsset::register($view)->js[] = 'langs/es.js';
        $this->assertEquals(2, count($view->assetBundles));
        $this->assertTrue($view->assetBundles['tests\\overrides\\TestTinyMceLangAsset'] instanceof AssetBundle);
        $content = $view->renderFile('@tests/views/layouts/rawlayout.php');
        $this->assertContains('langs/es.js', $content);
    }
}
