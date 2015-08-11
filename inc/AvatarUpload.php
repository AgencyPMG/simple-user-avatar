<?php
/**
 * This file is part of Simple User Avatar Plugin
 * It creates the avatar upload functionality on the user profile page
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

class AvatarUpload extends Setup
{
    const NONCE = 'pmg_sua_upload_nonce';

    function hook()
    {
        add_action('show_user_profile', array($this, 'addAvatarUploadSection'));
        add_action('edit_user_profile', array($this, 'addAvatarUploadSection'));
        add_action('personal_options_update', array($this, 'saveUserAvatar'));
        add_action('edit_user_profile_update', array($this, 'saveUserAvatar'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    public function addAvatarUploadSection($user)
    {
        wp_nonce_field(self::NONCE.$user->ID, self::NONCE, false);

        $image = get_the_author_meta(self::ID, $user->ID);
        ?>
        <h3><?php _e('Custom Display Picture', 'pmg'); ?></h3>

        <table class="form-table">
            <tr>
                <th><label for="<?php echo self::ID; ?>"><?php _e('Image Upload',  'pmg'); ?></label></th>
                <td>
                    <?php if ($image): ?>
                        <img src="<?php echo esc_url($image); ?>" style="width:150px;"><br />
                    <?php endif; ?>
                    <input type="text" name="<?php echo self::ID; ?>" id="<?php echo self::ID; ?>" value="<?php echo esc_url_raw($image); ?>" class="regular-text" />
                    <input type='button' class="additional-user-image button-primary" value="<?php _e('Select Image',  'pmg'); ?>" id="uploadimage"/><br />
                    <span class="description"><?php _e('Upload an additional image for your user profile.',  'pmg'); ?></span>
                </td>
            </tr>
        </table>
        <?php
    }

    function saveUserAvatar($user_id)
    {
        if (!current_user_can('edit_user', $user_id)) {
            return;
        }

        if (
            empty($_POST[self::NONCE]) ||
            !wp_verify_nonce($_POST[self::NONCE], self::NONCE.$user_id)
        ) {
            return;
        }

        if (empty($_POST[self::ID])) {
            delete_user_meta($user_id, self::ID);
        } else {
            update_user_meta($user_id, self::ID, $_POST[self::ID]);
        }
    }

    public function enqueue($hook)
    {
        if (!in_array($hook, array('profile.php', 'user-edit.php'))) {
            return;
        }

        wp_enqueue_media();

        wp_enqueue_script(
            'pmg-simpleuseravatar-js',
            PMG_SIMPLEUSERAVATAR_URL . 'js/pmg-simpleuseravatar.js',
            array('jquery'),
            self::VERSION,
            true
        );
    }
}
