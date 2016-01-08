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

if (isset($_GET['success'])) {
    if ($_GET['success'] == "addok") {
        echo "<script>alert('Participant added with success !');</script>";
    } elseif($_GET['success'] == "updateok") {
        echo "<script>alert('Participant updated with success !');</script>";
    } else {
        echo "<script>alert('Participant : event not added or updated');</script>";
    }
}

//TODO :
/*$event_array = array('id'=>null,'first_name'=>null, 'last_name'=>null, 'email'=>null);
if (isset($_GET['id']) && $_GET['action']=='edit') {
    $id = $_GET['id'];
    $event_obj = new \OpenBooking\_Class\Metier\Participant($id);
    $event_array = (array)$event_obj->get();
}*/
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
    <h2><?php _e( 'Openbooking', 'openbooking' ); ?></h2>
    <h2><?php _e( 'Openbooking New Participant', 'openbooking' ); ?></h2>
    <p><?php _e( 'Add New Participant', 'openbooking' ); ?></p>

    <form method="post" action="<?php echo admin_url('admin-post.php?type=participant'); ?>">
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-2">
                <div id="post-body-content">
                    <div id="postbox-container-1" class="postbox-container">
                        <div id="side-sortables" class="meta-box-sortables ui-sortable"><div id="submitdiv" class="postbox ">
                                <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Open/close bloc</span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span>Submit</span></h2>
                                <div class="inside">
                                    <div class="submitbox" id="submitpost">
                                        <div id="major-publishing-actions">
                                            <div id="delete-action">
                                                <a class="submitdelete deletion" href="http://lpdw-openbooking.dev/wp-admin/post.php?post=0&amp;action=trash&amp;_wpnonce=5be40467e2">Delete</a></div> <!-- TODO : true deletion -->

                                            <div id="publishing-action">
                                                <span class="spinner" deluminate_imagetype="gif"></span>
                                                <input type="hidden" name="action" value="custom_form_submit">
                                                <input type="hidden" name="data" value="id">
                                                <input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Add Participant"></div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="postbox-container-2" class="postbox-container">
                        <div id="event-info" class="postbox ">
                            <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Open / Close bloc</span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span>Event info</span></h2>
                            <div class="inside">
                                <fieldset class="ob_admin_wrap">
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label for="first_name">First name
                                            <input id="first_name" name="first_name" type="text" placeholder="First name" required>
                                        </label>
                                    </div>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label for="last_name">Last name
                                            <input id="last_name" name="last_name" type="text" placeholder="Last name" required>
                                        </label>
                                    </div>

                                    <!-- Email input-->
                                    <div class="form-group">
                                        <label for="email">Email
                                            <input id="email" name="email" type="email" placeholder="email@example.com" required>
                                        </label>
                                    </div>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label for="password">Password
                                            <input id="password" name="password" type="password" placeholder="Password" required>
                                        </label>
                                    </div>

                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>