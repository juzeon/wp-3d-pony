<?php
/*
Plugin Name: WP 3D Pony
Plugin URI: https://github.com/juzeon/
Description: 3D MLP:FiM pony based on live2dw and Frash's model.
Version: 1.1
Author: juzeon
Author URI: http://www.skyju.cc
*/
class WP_3D_Pony{
	public $options;
	public function __construct(){
		$this->options=get_option('wp_3d_pony');
		$this->firstLoad();
		add_action('admin_menu',function(){
			add_options_page('WP 3D Pony', 'WP 3D Pony', 'manage_options', 'wp_3d_pony',array($this,'settings'));
		});
		if(isset($_GET['ponymodel']))$this->ponyModel();
		if($this->options['activation'])add_action('wp_head',array($this,'head'));
	}
	public function settings(){
		if('POST' == $_SERVER['REQUEST_METHOD']){
			update_option('wp_3d_pony', array(
			'firstLoad'=>true,
			'texture'=>esc_attr($_POST['texture']),
			'position'=>esc_attr($_POST['position']),
			'width'=>intval($_POST['width']),
			'height'=>intval($_POST['height']),
			'mobile'=>($_POST['mobile'])?true:false,
			'activation'=>($_POST['activation'])?true:false
			));
			$this->options=get_option('wp_3d_pony');
			?>
			<div class="notice notice-success is-dismissible">
      	  <p>Changes saved.</p>
   		</div>
			<?php
		}
		
		include plugin_dir_path(__FILE__).'settings.php';
	}
	public function firstLoad(){
		if($this->options['firstLoad']!=true){
			update_option('wp_3d_pony', array(
			'firstLoad'=>true,
			'texture'=>'wp-content/plugins/wp-3d-pony/live2dw/assets/pony/texture.png',
			'position'=>'right',
			'width'=>80,
			'height'=>160,
			'mobile'=>true,
			'activation'=>true
			));
			$this->options=get_option('wp_3d_pony');
		}
	}
	public function ponyModel(){
		?>
		{
	"type": "Live2D Model Setting",
	"name": "Pony",
	"model": "wp-content/plugins/wp-3d-pony/live2dw/assets/Pony.moc",
	"textures": [
		"<?php echo $this->options['texture'] ?>"
	]
}
		<?php
		exit;
	}
	public function head(){
			?>
			<script src="<?php echo plugin_dir_url(__FILE__).'live2dw/lib/L2Dwidget.min.js' ?>"></script>
		<script>
			L2Dwidget.init({
				"model": {
					"jsonPath": "<?php echo home_url().'/?ponymodel=1' ?>"
				},
				"display": {
					"position": "<?php echo $this->options['position'] ?>",
					"width": <?php echo $this->options['width'] ?>,
					"height": <?php echo $this->options['height'] ?>
				},
				"mobile": {
					"show": <?php echo ($this->options['mobile'])?'true':'false' ?>
				}
			});
		</script>
			<?php
		}
}
add_action('init',function(){
	$wp_3d_pony=new WP_3D_Pony();
});