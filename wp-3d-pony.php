<?php
/*
Plugin Name: WP 3D Pony
Plugin URI: https://github.com/juzeon/wp-3d-pony/
Description: 3D MLP:FiM pony based on live2dw and Frash's model.
Version: 1.1
Author: juzeon
Author URI: https://github.com/juzeon/
*/
class WP_3D_Pony{
	public $options;
	public $assetUrl;
	public function __construct(){
		$this->assetUrl=substr(wp_upload_dir()['baseurl'], strlen(home_url().'/')).'/wp-3d-pony/';
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
			'width'=>floatval($_POST['width']),
			'height'=>floatval($_POST['height']),
			'hOffset'=>floatval($_POST['hoffset']),
			'vOffset'=>floatval($_POST['voffset']),
			'scale'=>floatval($_POST['scale']),
			'mscale'=>floatval($_POST['mscale']),
			'opacityOnHover'=>floatval($_POST['opacityonhover']),
			'opacityDefault'=>floatval($_POST['opacitydefault']),
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
			if(!file_exists(wp_upload_dir()['basedir'].'/wp-3d-pony'))mkdir(wp_upload_dir()['basedir'].'/wp-3d-pony');
			copy(plugin_dir_path(__FILE__).'source/derpy.png',wp_upload_dir()['basedir'].'/wp-3d-pony/derpy.png');
			copy(plugin_dir_path(__FILE__).'source/rd.png',wp_upload_dir()['basedir'].'/wp-3d-pony/rd.png');
			copy(plugin_dir_path(__FILE__).'source/Pony.moc',wp_upload_dir()['basedir'].'/wp-3d-pony/Pony.moc');
			update_option('wp_3d_pony', array(
			'firstLoad'=>true,
			'texture'=>'rd.png',
			'position'=>'right',
			'width'=>80,
			'height'=>160,
			'hOffset'=>0,
			'vOffset'=>-20,
			'scale'=>1,
			'mscale'=>0.5,
			'opacityDefault'=>0.7,
			'opacityOnHover'=>0.2,
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
	"model": "<?php echo $this->assetUrl.'Pony.moc' ?>",
	"textures": [
		"<?php echo $this->assetUrl.$this->options['texture'] ?>"
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
					"jsonPath": "<?php echo home_url().'/?ponymodel=1' ?>",
					"scale": <?php echo $this->options['scale'] ?>
				},
				"display": {
					"position": "<?php echo $this->options['position'] ?>",
					"width": <?php echo $this->options['width'] ?>,
					"height": <?php echo $this->options['height'] ?>,
					"hOffset": <?php echo $this->options['hOffset'] ?>,
					"vOffset": <?php echo $this->options['vOffset'] ?>
				},
				"mobile": {
					"show": <?php echo ($this->options['mobile'])?'true':'false' ?>,
					"scale": <?php echo $this->options['mscale'] ?>
				},
				"react":{
					"opacityDefault":<?php echo $this->options['opacityDefault'] ?>,
					"opacityOnHover":<?php echo $this->options['opacityOnHover'] ?>
				}
			});
		</script>
			<?php
		}
}
add_action('init',function(){
	$wp_3d_pony=new WP_3D_Pony();
});
