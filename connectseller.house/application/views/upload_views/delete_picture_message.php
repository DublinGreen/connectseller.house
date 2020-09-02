<html>
<head>
<title>Delete Uploaded Picture</title>
</head>
<body>

<h3>Delete Uploaded Pictues</h3>

<p><?php echo $deletedPicture;?> has been deleted.</p>

<p><?php echo anchor('upload', 'Upload File!'); ?></p>


<p><?php echo anchor('upload/viewSliderPictures/', 'View Sliders Pictures'); ?></p>
<p><?php echo anchor('upload/viewPropertiesPictures/', 'View Properties Pictures'); ?></p>

</body>
</html>
