<?php
/*
Plugin Name: Pratik Yemek Tarifleri
Description:
Version: 1
Author: pratikbilgiler.gen.tr
Author URI: http://pratikbilgiler.gen.tr
*/
 
function tarifler_func( $atts ) {

 
$rss = fetch_feed( 'http://pratikbilgiler.gen.tr/kategori/yemek/feed/');

$maxitems = 0;

if ( ! is_wp_error( $rss ) ) : 
 
    $maxitems = $rss->get_item_quantity( 5 ); 
    $rss_items = $rss->get_items( 0, $maxitems );

endif;
?>

<ul>
    <?php if ( $maxitems == 0 ) : ?>
        <li><?php _e( 'Tarif Bulunamadı', 'pratikbilgilergen' ); ?></li>
    <?php else : ?>
        <?php // Loop through each feed item and display each item as a hyperlink. ?>
        <?php foreach ( $rss_items as $item ) : ?>
            <li>
                <a href="<?php echo esc_url( $item->get_permalink() ); ?>"  title="<?php printf( __( 'Tarih %s', 'pratikbilgilergen' ), $item->get_date('j F Y | g:i a') ); ?>">
                    <?php echo esc_html( $item->get_title() ); ?>
                </a>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>

<?php 
 
}
add_shortcode( 'tarifler', 'tarifler_func' );

?>