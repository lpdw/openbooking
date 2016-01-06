<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.lp-dw.com/
 * @since      1.0.0
 *
 * @package    Openbooking
 * @subpackage Openbooking/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
    <h2><?php _e( 'Openbooking', 'openbooking' ); ?></h2>
    <h2><?php _e( 'Openbooking Participants', 'openbooking' ); ?></h2>
    <p><?php _e( 'Participants are managed here', 'openbooking' ); ?></p>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-1">
            <div id="post-body-content">
                <div class="meta-box-sortables ui-sortable">
                    <form method="post">
                        <?php
                        $this->participants_obj->prepare_items();
                        $this->participants_obj->display(); ?>
                    </form>
                </div>
            </div>
        </div>
        <br class="clear">
    </div>
</div>