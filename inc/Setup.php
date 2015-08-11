<?php
/**
 * This file is part of Simple User Avatar Plugin
 * It is called by all classes
 *
 * Copyright (c) 2014 PMG <http://pmg.com>
 *
 * For full copyright and license information please see the LICENSE
 * file that was distributed with this source code.
 *
 * @category    WordPress
 * @copyright   2014 PMG <http://pmg.com>
 * @license     http://opensource.org/licenses/Apache-2.0 Apache-2.0
 */

namespace PMG\SimpleUserAvatar;

!defined('ABSPATH') && exit;

abstract class Setup
{
    const ID = 'pmg_simple_user_avatar'; //manually entered in js/pmg-simpleuseravatar.js
    const VERSION = '1.0';

    private static $registry = array();

    public static function instance()
    {
        $cls = get_called_class();
        if (!isset(self::$registry[$cls])) {
            self::$registry[$cls] = new $cls();
        }
        return self::$registry[$cls];
    }

    public static function init()
    {
        static::instance()->hook();
    }

    abstract public function hook();
}
