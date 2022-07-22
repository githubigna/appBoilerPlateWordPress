<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       uri
 * @since      1.0.0
 *
 * @package    Whatspro_Flowy
 * @subpackage Whatspro_Flowy/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<form method="post" action="<?php
                echo $_SERVER['PHP_SELF'];
                ?>" name="update_settings">
            <table class="form-table" align="center" style="margin-top: 16px; width: inherit;">
                <tbody>
                <tr>
                    <th scope="row" style="text-align: center; vertical-align: middle;"><label for="intercom_app_id">App ID</label></th>
                    <td>
                        <input id="intercom_app_id" value="0" name="app_id" type="text" ">
                        <button type="submit" class="btn btn__primary cta__submit">Save</button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div>
                <?php
                    echo get_option('whatspro');
                ?>
            </div>