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

use tests\data\overrides\TestTinyMceLangAsset;
use yii\web\AssetBundle;

class TinyMceLangAssetTest extends TestCase
{
    public function testRegister()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        TestTinyMceLangAsset::register($view)->js[] = 'langs/es.js';
        $this->assertEquals(1, count($view->assetBundles));
        $this->assertTrue($view->assetBundles['tests\\data\\overrides\\TestTinyMceLangAsset'] instanceof AssetBundle);
        $content = $view->renderFile('@tests/data/views/rawlayout.php');
        $this->assertContains('langs/es.js', $content);
    }
}