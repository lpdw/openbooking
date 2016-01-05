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
    <h2><?php _e( 'Openbooking Events', 'openbooking' ); ?></h2>
    <p><?php _e( 'Events are managed here', 'openbooking' ); ?></p>
    <?php $members = array(
        array(
            "id"=>"2",
            "name"=>"Toto",
            "email"=>"toto@gmail.com",
        ),
        array(
            "id"=>"5",
            "name"=>"Tata",
            "email"=>"tata@gmail.com"
        )
    );
    if( count($members) > 0 ) : ?>

        <table class="wp-list-table widefat fixed posts">
            <thead>
            <tr>
                <th class="column-name"><?php _e( 'Name', 'openbooking' ); ?></th>
                <th class="column-email"><?php _e( 'Email', 'openbooking' ); ?></th>
                <th class="column-edit"><?php _e( 'Edit', 'openbooking' ); ?></th>
            </tr>
            </thead>
            <tbody data-post-type="product">
            <?php  foreach( $members as $members_index=>$member ) :?>
                <tr id="post-<?php echo $member['id'];?>">
                    <td class="column-name"><?php echo $member['name'] ?></td>
                    <td class="column-email"><?php echo $member['email'] ?></td>
                    <td class="column-edit"><a href="#edit-member-<?php echo $member['id'];?>"><?php _e( 'Edit', 'openbooking' ); ?></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <th class="column-name"><?php _e( 'Name', 'openbooking' ); ?></th>
                <th class="column-email"><?php _e( 'Email', 'openbooking' ); ?></th>
                <th class="column-edit"><?php _e( 'Edit', 'openbooking' ); ?></th>
            </tr>
            </tfoot>

        </table>

    <?php else: ?>

        <p><?php _e( 'No events found, why not <a href="#">create one?', 'openbooking' ); ?></a></p>

    <?php endif; ?>
    <?php wp_reset_postdata(); // Don't forget to reset again! ?>
</div><!-- .wrap -->