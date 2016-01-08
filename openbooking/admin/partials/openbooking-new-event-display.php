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
    if ($_GET['success'] == true) {
        echo "<script>alert('Event added with success !');</script>";
    } else {
        echo "<script>alert('Error : event not added !');</script>";
    }
}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
    <h2><?php _e( 'Openbooking', 'openbooking' ); ?></h2>
    <h2><?php _e( 'Openbooking New Event', 'openbooking' ); ?></h2>
    <p><?php _e( 'Add New Event', 'openbooking' ); ?></p>

    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-2">
                <div id="post-body-content">
                    <div id="postbox-container-1" class="postbox-container">
                        <div id="side-sortables" class="meta-box-sortables ui-sortable"><div id="submitdiv" class="postbox ">
                                <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Open/close bloc</span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span>Submit</span></h2>
                                <div class="inside">
                                    <div class="submitbox" id="submitpost">

                                        <div id="minor-publishing">

                                            <div id="misc-publishing-actions">

                                                <fieldset class="misc-pub-section misc-pub-post-status">

                                                    <!-- Multiple Radios -->
                                                    <div class="form-group">
                                                        <label>Open to registration</label>

                                                        <div class="radio">
                                                            <label for="open-1" class="radiolabel">
                                                                <input type="radio" name="open_to_registration" id="open-1" value="1" checked="checked">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="open-0" class="radiolabel">
                                                                <input type="radio" name="open_to_registration" id="open-0" value="0">
                                                                No
                                                            </label>
                                                        </div>
                                                    </div>

                                                </fieldset><!-- .misc-pub-section -->

                                            </div>
                                        </div>
                                        <div id="major-publishing-actions">
                                            <div id="delete-action">
                                                <a class="submitdelete deletion" href="http://lpdw-openbooking.dev/wp-admin/post.php?post=0&amp;action=trash&amp;_wpnonce=5be40467e2">Delete</a></div> <!-- TODO : true deletion -->

                                            <div id="publishing-action">
                                                <span class="spinner" deluminate_imagetype="gif"></span>
                                                <input type="hidden" name="action" value="custom_form_submit">
                                                <input type="hidden" name="data" value="id">
                                                <input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Add Event"></div>
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
                                        <label for="name">Name
                                            <input id="name" name="name" type="text" placeholder="Event name" required>
                                        </label>
                                    </div>

                                    <!-- Date input-->
                                    <div class="form-group">
                                        <label for="date">Date
                                            <input id="date" name="date" type="date" placeholder="Event date" required>
                                        </label>
                                        <!-- TODO: add time support and format date + time
                                        <label for="time">Time
                                            <input id="time" name="time" type="time" placeholder="Event time" required>
                                        </label>
                                        -->
                                    </div>

                                    <!-- Number input-->
                                    <div class="form-group">
                                        <label for="participants_max">Max participants
                                            <input id="participants_max" name="participants_max" type="number" min="0" placeholder="Max number of participants" required>
                                        </label>
                                    </div>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label for="organizer">Organizer
                                            <input id="organizer" name="organizer" type="text" placeholder="Organizer name" required>
                                        </label>
                                    </div>

                                    <!-- Email input-->
                                    <div class="form-group">
                                        <label for="organizer_email">Organizer email
                                            <input id="organizer_email" name="organizer_email" type="email" placeholder="Organizer email" required>
                                        </label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <div id="localisation" class="postbox ">
                            <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Open / Close bloc</span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span>Event localisation</span></h2>
                            <div class="inside">
                                <!--TODO : better integration than a pure crappy copy-paste -->
                                <style>
                                    #map {
                                        height: 100%;
                                    }
                                    .controls {
                                        margin-top: 10px;
                                        border: 1px solid transparent;
                                        border-radius: 2px 0 0 2px;
                                        box-sizing: border-box;
                                        -moz-box-sizing: border-box;
                                        height: 32px;
                                        outline: none;
                                        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
                                    }

                                    #pac-input {
                                        background-color: #fff;
                                        font-family: Roboto;
                                        font-size: 15px;
                                        font-weight: 300;
                                        margin-left: 12px;
                                        padding: 0 11px 0 13px;
                                        text-overflow: ellipsis;
                                        width: 300px;
                                    }

                                    #pac-input:focus {
                                        border-color: #4d90fe;
                                    }

                                    .pac-container {
                                        font-family: Roboto;
                                    }

                                    #type-selector {
                                        color: #fff;
                                        background-color: #4d90fe;
                                        padding: 5px 11px 0px 11px;
                                    }

                                    #type-selector label {
                                        font-family: Roboto;
                                        font-size: 13px;
                                        font-weight: 300;
                                    }

                                </style>
                                <input id="pac-input" class="controls" type="text" name="localisation"
                                       placeholder="Enter a location">
                                <div id="type-selector" class="controls">
                                    <input type="radio" name="type" id="changetype-all" checked="checked">
                                    <label for="changetype-all">All</label>

                                    <input type="radio" name="type" id="changetype-establishment">
                                    <label for="changetype-establishment">Establishments</label>

                                    <input type="radio" name="type" id="changetype-address">
                                    <label for="changetype-address">Addresses</label>

                                    <input type="radio" name="type" id="changetype-geocode">
                                    <label for="changetype-geocode">Geocodes</label>
                                </div>
                                <div id="map"></div>

                                <script>
                                    function initMap() {
                                        var map = new google.maps.Map(document.getElementById('map'), {
                                            center: {lat: 48.935813, lng: 2.3032069},
                                            zoom: 18
                                        });
                                        var input = /** @type {!HTMLInputElement} */(
                                            document.getElementById('pac-input'));

                                        var types = document.getElementById('type-selector');
                                        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                                        map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

                                        var autocomplete = new google.maps.places.Autocomplete(input);
                                        autocomplete.bindTo('bounds', map);

                                        var infowindow = new google.maps.InfoWindow();
                                        var marker = new google.maps.Marker({
                                            map: map,
                                            anchorPoint: new google.maps.Point(0, -29)
                                        });

                                        autocomplete.addListener('place_changed', function() {
                                            infowindow.close();
                                            marker.setVisible(false);
                                            var place = autocomplete.getPlace();
                                            if (!place.geometry) {
                                                window.alert("Autocomplete's returned place contains no geometry");
                                                return;
                                            }

                                            // If the place has a geometry, then present it on a map.
                                            if (place.geometry.viewport) {
                                                map.fitBounds(place.geometry.viewport);
                                            } else {
                                                map.setCenter(place.geometry.location);
                                                map.setZoom(17);  // Why 17? Because it looks good.
                                            }
                                            marker.setIcon(/** @type {google.maps.Icon} */({
                                                url: place.icon,
                                                size: new google.maps.Size(71, 71),
                                                origin: new google.maps.Point(0, 0),
                                                anchor: new google.maps.Point(17, 34),
                                                scaledSize: new google.maps.Size(35, 35)
                                            }));
                                            marker.setPosition(place.geometry.location);
                                            marker.setVisible(true);

                                            var address = '';
                                            if (place.address_components) {
                                                address = [
                                                    (place.address_components[0] && place.address_components[0].short_name || ''),
                                                    (place.address_components[1] && place.address_components[1].short_name || ''),
                                                    (place.address_components[2] && place.address_components[2].short_name || '')
                                                ].join(' ');
                                            }

                                            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                                            infowindow.open(map, marker);
                                        });

                                        // Sets a listener on a radio button to change the filter type on Places
                                        // Autocomplete.
                                        function setupClickListener(id, types) {
                                            var radioButton = document.getElementById(id);
                                            radioButton.addEventListener('click', function() {
                                                autocomplete.setTypes(types);
                                            });
                                        }

                                        setupClickListener('changetype-all', []);
                                        setupClickListener('changetype-address', ['address']);
                                        setupClickListener('changetype-establishment', ['establishment']);
                                        setupClickListener('changetype-geocode', ['geocode']);
                                    }

                                </script>
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDElAE3sSgxRF-vl-PVEry5Ir_3xJf-DVU&signed_in=true&libraries=places&callback=initMap"
                                        async defer></script>
                            </div>
                        </div>

                        <div id="event-description" class="postbox ">
                            <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Open / Close bloc</span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span>Event description</span></h2>
                            <div class="inside">
                                <!-- Textarea TinyMCE -->
                                <?php wp_editor( '', 'description', array('media_buttons'=>false,'textarea_name'=>'description','teeny'=>true) ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>