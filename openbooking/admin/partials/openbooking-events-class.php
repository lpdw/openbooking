<?php
//TODO: better datetime display. We can do something with date_i18n( get_option( 'date_format' ), strtotime( $datetime ) );
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}
if ( !class_exists( 'obEventsTable' ) ) {
    /**
     * Events Table Class
     *
     * Extends WP_List_Table to display the list of events in a format similar to
     * the default WordPress post tables.
     *
     * @since 1.0.0
     */

    class obEventsTable extends WP_List_Table
    {
        /** Class constructor */
        public function __construct() {

            parent::__construct( [
                'singular' => __( 'Event', 'sp' ), //singular name of the listed records
                'plural'   => __( 'Events', 'sp' ), //plural name of the listed records
                'ajax'     => false //should this table support ajax?
            ] );

        }

        /**
         * Truncate strings. Useful for long descriptions !
         *
         * @param $string
         * @param int $length
         * @param string $append
         * @return array|string
         */
        private function truncate($string, $length=100, $append="&hellip;") {
            $string = trim($string);

            if(strlen($string) > $length) {
                $string = wordwrap($string, $length);
                $string = explode("\n", $string, 2);
                $string = $string[0] . $append;
            }

            return $string;
        }

        /**
         * Retrieve events’ data from the api
         *
         * @param int $per_page
         * @param int $page_number
         *
         * @return mixed
         */
        public static function get_events( $per_page = 5, $page_number = 1 ) {
            /*
            // The wordpress way, for exemple only :

            global $wpdb;

            $sql = "SELECT * FROM {$wpdb->prefix}customers";

            if ( ! empty( $_REQUEST['orderby'] ) ) {
                $sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
                $sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
            }

            $sql .= " LIMIT $per_page";

            $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;


            $result = $wpdb->get_results( $sql, 'ARRAY_A' );

            return $result;

            */

            if (isset($_REQUEST['paged'])) {
                $page_number = $_REQUEST['paged'];
            }


            if ( !function_exists('convertToArray')){
                function convertToArray(&$item, $key) {
                    $item = (array)$item;
                }
            }

            $allevents_obj = \OpenBooking\_Class\Metier\Event::getAll(true,$per_page,$page_number);

            array_walk($allevents_obj, 'convertToArray');

            $result = $allevents_obj;

            return $result;

        }

        /**
         * Delete an event.
         *
         * @param int $id event id
         */
        public static function delete_event( $id ) {
            /*
            // The wordpress way, for exemple only :

            global $wpdb;

            $wpdb->delete(
                "{$wpdb->prefix}events",
                [ 'id' => $id ],
                [ '%d' ]
            );

            */
            echo "event $id fake-deleted";
        }

        /**
         * Returns the count of records in the database.
         *
         * @return null|string
         */
        public static function record_count() {

            $result = count(\OpenBooking\_Class\Metier\Event::getAll(true));
            return $result;

        }

        /** Text displayed when no data is available */
        public function no_items() {
            _e( 'No events avaliable.', 'openbooking' );
        }

        /**
         * Method for name column
         *
         * @param array $item an array of DB data
         *
         * @return string
         */
        function column_name( $item ) {

            // create nonce
            $delete_nonce = wp_create_nonce( 'ob_delete_event' );

            $title = '<strong>' . $item['name'] . '</strong>';

            $actions = [
                'view' => sprintf( '<a href="/event/?event_id=%s">'.__( 'View' , 'openbooking' ).'</a>', absint( $item['id'] ) ), //TODO : dynamic event page slug
                'edit' => sprintf( '<a href="?page=%s&action=%s&id=%s">'.__( 'Edit' , 'openbooking' ).'</a>', 'openbooking-new-event', 'edit', absint( $item['id'] ) ),
                'delete' => sprintf( '<a href="?page=%s&action=%s&id=%s&_wpnonce=%s">'.__( 'Delete' , 'openbooking' ).'</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['id'] ), $delete_nonce )
            ];

            return $title . $this->row_actions( $actions );
        }

        /**
         * Render a column when no column specific method exists.
         *
         * @param array $item
         * @param string $column_name
         *
         * @return mixed
         */
        public function column_default( $item, $column_name ) {

            switch ( $column_name ) {
                case 'name':
                case 'date' :
                case 'open_to_registration' :
                case 'cancelled':
                    return $item[ $column_name ];
                case 'description':
                    return $this->truncate($item[ $column_name ],150); //TODO : customisable value from options ?
                case 'organizer' :
                    return '<a href="mailto:'.$item[ 'organizer_email' ].'">'.$item[ $column_name ].'</a>';
                default:
                    return print_r( $item, true ); //Show the whole array for troubleshooting purposes
            }

        }

        /**
         * Render the bulk edit checkbox
         *
         * @param array $item
         *
         * @return string
         */
        function column_cb( $item ) {
            return sprintf(
                '<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['id']
            );
        }

        /**
         *  Associative array of columns
         *
         * @return array
         */
        function get_columns() {
            $columns = [
                'cb'    => '<input type="checkbox" />',
                'name'  => __( 'Name', 'openbooking' ),
                'description' => __( 'Description', 'openbooking' ),
                'date' => __( 'Date', 'openbooking' ),
                'organizer' => __( 'Organizer', 'openbooking' ),
                'open_to_registration' => __( 'Open', 'openbooking' ),
                'cancelled' => __( 'Cancelled', 'openbooking' )
            ];

            return $columns;
        }

        /**
         * Columns to make sortable.
         *
         * @return array
         */
        public function get_sortable_columns() {
            $sortable_columns = array(
                'name'          => array( 'name', false ),
                'description'   => array( 'description', false ),
                'date'          => array( 'date', false ),
                'organizer'     => array( 'organizer', false ),
                'open_to_registration' => array( 'open_to_registration', false ),
                'cancelled'      => array( 'cancelled', false )
            );

            return $sortable_columns;
        }

        /**
         * Returns an associative array containing the bulk action
         *
         * @return array
         */
        public function get_bulk_actions() {
            $actions = [
                'bulk-delete' => __( 'Delete', 'openbooking' )
            ];

            return $actions;
        }

        /**
         * Handles data query and filter, sorting, and pagination.
         */
        public function prepare_items() {
            //$this->_column_headers = $this->get_column_info();

            // FIXME : this block is a hack. It needs refactoring (we should use get_column_info() but it returns nothing)
            $this->_column_headers = array(
                $this->get_columns(),
                array(), //hidden columns if applicable
                //$this->get_sortable_columns()
            );

            /** Process bulk action */
            $this->process_bulk_action();

            $per_page     = $this->get_items_per_page( 'events_per_page', 5 );
            $current_page = $this->get_pagenum();
            $total_items  = self::record_count();

            $this->set_pagination_args( [
                'total_items' => $total_items, //WE have to calculate the total number of items
                'per_page'    => $per_page //WE have to determine how many items to show on a page
            ] );


            $this->items = self::get_events( $per_page, $current_page );
        }

        public function process_bulk_action() {

            //Detect when a bulk action is being triggered...
            if ( 'delete' === $this->current_action() ) {

                // In our file that handles the request, verify the nonce.
                $nonce = esc_attr( $_REQUEST['_wpnonce'] );

                if ( ! wp_verify_nonce( $nonce, 'ob_delete_event' ) ) {
                    die( 'Go get a life script kiddies' );
                }
                else {
                    self::delete_event( absint( $_GET['event'] ) );

                    wp_redirect( esc_url( add_query_arg() ) );
                    exit;
                }

            }

            // If the delete bulk action is triggered
            if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' )
                || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' )
            ) {

                $delete_ids = esc_sql( $_POST['bulk-delete'] );

                // loop over the array of record ids and delete them
                foreach ( $delete_ids as $id ) {
                    self::delete_event( $id );

                }

                wp_redirect( esc_url( add_query_arg() ) );
                exit;
            }
        }
    }
}