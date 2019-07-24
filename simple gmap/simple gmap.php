<?php
/**
 * Plugin Name: simple gmap
 * Description: Add a simple goole map to any page with some customisation
 * Version: 1.0.0
 * License: GPL2
 */
 
add_shortcode('simple-gmap', 'get_the_map');
function get_the_map( $atts ){

	//print_r($atts);
	$a = shortcode_atts( array(
        'lat' => '0',
        'lng' => '0',
		'z' => '15',
		'icon' => '',
		'height' => '400px',
		'key' => ''
    ), $atts ); 
	
	ob_start(); ?>
	<div id="simple_g_map" style="<?php echo 'height:'.$a['height']; ?>"></div>
	<script>
		var map;
		function initMap() {
			var lat = <?php echo $a['lat']; ?>;
			var lng = <?php echo $a['lng']; ?>;
			if ( lat && lng ) { 
				map = new google.maps.Map(document.getElementById('simple_g_map'), {
				  center: { lat: lat, lng: lng },
				  zoom: <?php echo $a['z']; ?>
				});
				var marker = new google.maps.Marker({
				  position: { lat: lat, lng: lng },
				  <?php echo $a['icon'] ? "icon: '" . $a['icon'] . "'," : ''; ?>
				  map: map
				});
			}
		}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $a['key']; ?>&callback=initMap" async defer></script>
	
<?php 
	return ob_get_clean(); 
} 
?>