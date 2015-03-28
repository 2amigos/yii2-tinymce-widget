<?php
/**
 * @link https://github.com/2amigos/yii2-tinymce-widget
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @license http://opensource.org/licenses/BSD-3-Clause
 */
namespace tests\models;

use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    public $message;
    public static $db;

    public static function getDb()
    {
        return self::$db;
    }
}
