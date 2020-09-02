<html>
<head>
<title>Upload Form</title>
</head>
<body>

<p><?php echo anchor('upload/viewPictures/', 'View All Pictures'); ?></p>
<p><?php echo anchor('upload/uploadProperties/', 'Upload Properties Images'); ?></p>
<p><?php echo anchor('upload/', 'Upload Sliders Images'); ?></p>

<?php echo $error;?>

<h1>UPLOAD SLIDER</h1>
<hr>
<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile[]" multiple size="20" required />

<br /><br />

<select name="picture_type" required>
	<!--<option value="">Choose Picture Type</option>-->
	<option value="sliders">Slider Picture</option>
</select>
<br /><br />
<input type="submit" value="upload" />

</form>

</body>
</html>
