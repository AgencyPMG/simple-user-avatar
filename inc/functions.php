<?php
/**
 * This file is part of Simple User Avatar Plugin
 * It initialises our plugin
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

use PMG\SimpleUserAvatar as SUA;

function pmg_simpleuseravatar_load()
{
    SUA\AvatarDisplay::init();

    if (is_admin()) {
        SUA\AvatarUpload::init();
    }
}
