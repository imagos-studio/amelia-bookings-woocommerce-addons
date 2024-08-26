// Hook to initiate the function when the order is completed
add_action('woocommerce_order_status_completed', 'whps_set_order_item_name_from_ameliabooking', 10, 1);

function whps_set_order_item_name_from_ameliabooking($order_id) {
    // Get the order object
    $order = wc_get_order($order_id);

    // Get all order items
    $order_items = $order->get_items();

    // Loop through each order item
    foreach ($order_items as $item_id => $item) {
        // Get 'ameliabooking' order item meta data
        $ameliabooking_meta = wc_get_order_item_meta($item_id, 'ameliabooking', true);

        // Check if 'ameliabooking' meta exists and has 'name'
        if (is_array($ameliabooking_meta) && !empty($ameliabooking_meta['name'])) {
            // Get the order item name
            $order_item_name = $item->get_name();
            //var_dump($order_item_name);

            // Use 'name' from 'ameliabooking' to update 'order_item_name'
            wc_update_order_item($item_id, array('order_item_name' => esc_html($ameliabooking_meta['name'])));
        }
    }
}
