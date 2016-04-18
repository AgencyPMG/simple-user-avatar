<?php
/**
 * This file is part of Simple User Avatar Plugin
 * It replaces the gravatar (get_avatar) with the simple user avatar
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

class AvatarDisplay extends Setup
{
    function hook()
    {
        add_filter('get_avatar', array($this, 'replaceGravatar'), 1, 4);
    }

    public function replaceGravatar($avatar, $id_or_email, $size="47")
    {
        $currentUser = $this->getUser($id_or_email);

        if ($currentUser) {
            $suaImage = get_the_author_meta(Setup::ID, $currentUser->ID);
            $thumb_id = get_post_thumbnail_id($currentUser->ID);
            $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);

            if (!$suaImage) {
                $suaImage = PMG_SIMPLEUSERAVATAR_URL.'img/default-user.png';
            }

            $format = '<img alt="%s" src="%s" class="avatar avatar-%3$s photo" height="%3$s" width="%3$s" />';
            $avatar = sprintf(
                $format,
                esc_attr($alt),
                esc_attr($suaImage),
                esc_attr($size)
            );

        }
        return $avatar;
    }

    function getUser($id_or_email)
    {
        $user = null;
        if (is_numeric($id_or_email)) {
            $user = get_user_by('id' , (int) $id_or_email);
        } elseif (is_object($id_or_email)) {
            if (!empty($id_or_email->user_id)) {
                $user = get_user_by('id' , (int) $id_or_email->user_id);
            }
        } else {
            $user = get_user_by('email', $id_or_email);
        }

        return $user;
    }
}
