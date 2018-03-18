<div class="">
	<h1>WP 3D Pony Settings</h1>
	<form action="" method="post">
		<table>
			<tr><td>Activation: </td><td>
				<select name="activation">
					<option <?php echo ($this->options['activation'])?'selected="selected"':'' ?> value="1">Active</option>
					<option <?php echo ($this->options['activation'])?'':'selected="selected"' ?> value="0">Disabled</option>
				</select>
			</td></tr>
			<tr><td>Texture Path: </td><td>
				<input type="text" name="texture" style="width: 400px;" id="texture" value="<?php echo $this->options['texture'] ?>" />
				*Only a relative path is allowed
			</td></tr>
			<tr><td>Position: </td><td>
				<select name="position">
					<option <?php echo ($this->options['position']=='right')?'selected="selected"':'' ?> value="right">right</option>
					<option <?php echo ($this->options['position']=='left')?'selected="selected"':'' ?> value="left">left</option>
				</select>
			</td></tr>
			<tr><td>Width: </td><td>
				<input type="text" name="width" id="width" value="<?php echo $this->options['width'] ?>" />px
			</td></tr>
			<tr><td>Height: </td><td>
				<input type="text" name="height" id="height" value="<?php echo $this->options['height'] ?>" />px
			</td></tr>
			<tr><td>Horizontal Offset: </td><td>
				<input type="text" name="hoffset" id="hoffset" value="<?php echo $this->options['hOffset'] ?>" />px
			</td></tr>
			<tr><td>Vertical Offset: </td><td>
				<input type="text" name="voffset" id="voffset" value="<?php echo $this->options['vOffset'] ?>" />px
			</td></tr>
			<tr><td>Common Scale: </td><td>
				<input type="text" name="scale" id="scale" value="<?php echo $this->options['scale'] ?>" />times
			</td></tr>
			<tr><td>Default Opacity: </td><td>
				<input type="text" name="opacitydefault" id="opacitydefault" value="<?php echo $this->options['opacityDefault'] ?>" />%
			</td></tr>
			<tr><td>Opacity On Hover: </td><td>
				<input type="text" name="opacityonhover" id="opacityonhover" value="<?php echo $this->options['opacityOnHover'] ?>" />%
			</td></tr>
			<tr><td>Mobile Display: </td><td>
				<select name="mobile">
					<option <?php echo ($this->options['mobile'])?'selected="selected"':'' ?> value="1">Active</option>
					<option <?php echo ($this->options['mobile'])?'':'selected="selected"' ?> value="0">Disabled</option>
				</select>
			</td></tr>
			<tr><td>Mobile Scale: </td><td>
				<input type="text" name="mscale" id="mscale" value="<?php echo $this->options['mscale'] ?>" />times
			</td></tr>
		</table>
		<input type="submit" class="button-primary" value="更改"/><br />
	</form>
	<br /><br /><br />
	Developed by <a href="https://github.com/juzeon/" target="_blank">@juzeon</a>. Details for this plugin: <a href="https://github.com/juzeon/wp-3d-pony" target="_blank">https://github.com/juzeon/wp-3d-pony</a>
</div>