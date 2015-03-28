<?php
/**
 * @link https://github.com/2amigos/yii2-tinymce-widget
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @license http://opensource.org/licenses/BSD-3-Clause
 */
namespace tests\overrides;

use dosamigos\tinymce\TinyMceLangAsset;

class TestTinyMceLangAsset extends TinyMceLangAsset
{
    public $sourcePath = '@tests/../../src/assets';
}
