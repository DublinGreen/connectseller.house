<html>
<head>
<title>Upload Form</title>
</head>
<body>

<p><?php echo anchor('upload/viewPictures/', 'View All Pictures'); ?></p>
<p><?php echo anchor('upload/uploadProperties/', 'Upload Properties Images'); ?></p>
<p><?php echo anchor('upload/', 'Upload Sliders Images'); ?></p>

<?php 
	$properties = $this->DatabaseModel->getAllProperties();
?>

<?php echo $error;?>

<h1>UPLOAD PROPERTIES</h1>
<hr>

<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile[]"  size="20" required  multiple/>

<br /><br />

<select name="property_id" required>
	<option value="">Properties ID</option>
	<?php
		foreach($properties as $property){
			echo("<option value='{$property->id}'>{$property->id}</option>");	
		}
	?>
</select>

<br><br>
<select name="picture_type" required>
	<!--<option value="">Choose Picture Type</option>-->
	<option value="properties">Properties Picture</option>
</select>
<br /><br />
<input type="submit" value="upload" />

</form>

</body>
</html>
