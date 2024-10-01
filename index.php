<?php
/*
 * Plugin name: Indratravel
 * Description: Indratravel admin page
 * Author: LYJ
 * Version: 0.0.1
 * Text domain: Indratravel.com
 * 
*/

function indratravel_activation() {
  indratravel_create_db();
}

function  get_name_table($name) {
  global $wpdb;
  return $wpdb->prefix . 'indratravel_' . $name;
}

function indratravel_deactivation() {
  global $wpdb;
  $countries =  get_name_table('countries');
  $cities =  get_name_table('cities');
  $travel_packages =  get_name_table('travel_packages');
  $customers =  get_name_table('customers');
  $images =  get_name_table('images');

  $sql = "
    DROP TABLE IF EXISTS $countries;
    DROP TABLE IF EXISTS $cities;
    DROP TABLE IF EXISTS $travel_packages;
    DROP TABLE IF EXISTS $customers;
    DROP TABLE IF EXISTS $images;
  ";

  $wpdb->query( $sql );
}

function indratravel_create_db() {
	global $wpdb;
	$countries =  get_name_table('countries');
  $cities =  get_name_table('cities');
  $travel_packages =  get_name_table('travel_packages');
  $customers =  get_name_table('customers');
  $images =  get_name_table('images');
  $charset_collate = $wpdb->get_charset_collate();


	$sql = "
  CREATE TABLE $countries(
    ID MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
    NAME TEXT NOT NULL,
    PRIMARY KEY(ID)
  ) $charset_collate;
  
  CREATE TABLE $cities(
    ID MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
    NAME TEXT NOT NULL,
    COUNTRY_ID MEDIUMINT(9) REFERENCES $countries(ID),
    PRIMARY KEY(ID)
  ) $charset_collate;

  CREATE TABLE $images(
      ID MEDIUMINT(9) AUTO_INCREMENT PRIMARY KEY,
      URL TEXT NOT NULL,
      DESCRIPTION TEXT,
      COUNTRY_ID MEDIUMINT(9) REFERENCES $countries(ID),
      CITY_ID MEDIUMINT(9) REFERENCES $cities(ID)
  ) $charset_collate;
   
  CREATE TABLE $customers(
      ID MEDIUMINT(9) AUTO_INCREMENT PRIMARY KEY,
      FIRST_NAME TEXT NOT NULL,
      LAST_NAME TEXT NOT NULL,
      EMAIL TEXT UNIQUE NOT NULL,
      PHONE TEXT NOT NULL,
      ADDRESS TEXT
  ) $charset_collate;
   
  CREATE TABLE $travel_packages(
    ID MEDIUMINT(9) AUTO_INCREMENT,
    NAME TEXT NOT NULL,
    DESCRIPTION TEXT,
    PRICE NUMERIC(10, 2) NOT NULL,
    CITY_ID MEDIUMINT(9) REFERENCES $cities(ID),
    IMAGE_ID MEDIUMINT(9) REFERENCES $images(ID),
    START_DATE DATE NOT NULL,
    END_DATE DATE NOT NULL,
    ITINERARY TEXT,
    RATE NUMERIC(10, 2) NOT NULL,
    TEMPLATE TEXT NOT NULL,
    VIDEO TEXT,
    PRIMARY KEY(ID)
  ) $charset_collate;
  ";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta($sql);
}

function indratravel_custom_field() {
  add_meta_box(
      'indratravel_input_id',           // ID único del meta box
      'Subtítulo',            // Título del meta box
      'indratravel_input_html',  // Función de callback que muestra el HTML
      'post'                  // Pantalla donde se mostrará (post, page, etc.)
  );
}
add_action('add_meta_boxes', 'indratravel_custom_field');

function indratravel_input_html($post) {
  $value = get_post_meta($post->ID, '_indratravel_input_subtitile', true);
  ?>
  <label for="indratravel_subtitile">Subtítulo</label>
  <input type="text" name="indratravel_subtitile" id="indratravel_subtitile" value="<?php echo esc_attr($value); ?>" />
  <?php
}

function indratravel_save_postdata($post_id) {
  if (array_key_exists('indratravel_subtitile', $_POST)) {
      update_post_meta(
          $post_id,
          '_indratravel_input_subtitile',
          sanitize_text_field($_POST['indratravel_subtitile'])
      );
  }
}

if(!function_exists('indratravel_add_menu')){

  add_action('admin_menu', 'indratravel_add_menu');

  function indratravel_add_menu(){
    add_menu_page(
      'Indratravel', 
      'Indratravel', 
      'manage_options',
      plugin_dir_path(__FILE__).'indratravelAdmin.php',
      null,
      '', 
      6
    );
  }
}

add_action('save_post', 'indratravel_save_postdata');

register_activation_hook(__FILE__, 'indratravel_activation' );
register_deactivation_hook( __FILE__, 'indratravel_deactivation' );



//Registrar acciones realizadas al activar el plugin
register_activation_hook(__FILE__, 'asacoeo_instalar');
register_activation_hook(__FILE__, 'asacoeo_agregar_menu');
register_activation_hook(__FILE__, 'asacoeo_crear_tabla');

//Registrar acción realizada al desactivar
register_deactivation_hook(__FILE__, 'asacoeo_desactivar');

//Registrar acción realizada al momento de borrar el plugin
//Se invocará al archivo uninstall
register_uninstall_hook(__FILE__,'asacoeo_desinstalar');
?>
