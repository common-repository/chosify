<?php

namespace Chosify\Wordpress;

class WooCommerce
{
    public function __construct()
    {
        add_action('woocommerce_thankyou', [$this, 'pushToDatalayer']);
    }

    public function pushToDatalayer($order_id)
    {
        $order = wc_get_order($order_id);
        ?>
        <script type='text/javascript'>
            window._chosify = window._chosify || [];
            window._chosify.push({
                'event': 'purchase',
                'products': [
                    <?php
                    foreach ( $order->get_items() as $key => $item ) :
                    $product = $order->get_product_from_item($item);
                    $variant_name = ($item['variation_id']) ? wc_get_product($item['variation_id']) : '';
                    ?>
                    {
                        'id': '<?php echo $item['product_id']; ?>',
                        'name': '<?php echo $item['name']; ?>',
                        'price': '<?php echo number_format($product->get_price(), 2, ".", ""); ?>',
                        'brand': '',
                        'category': '<?php echo strip_tags($product->get_categories(', ', '', '')); ?>',
                        'variant': '<?php echo ($variant_name) ? implode("-", $variant_name->get_variation_attributes()) : ''; ?>',
                        'quantity': <?php echo $item['qty']; ?>,
                        'coupon': ''
                    },
                    <?php endforeach; ?>
                ],
            });
        </script>

        <?php
    }
}
