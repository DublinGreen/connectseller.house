<html>
<head>
<title>Uploaded Slider Pictures</title>
</head>
<body>

<h3>Uploaded Slider Pictues</h3>

<p><?php echo anchor('upload', 'Upload File!'); ?></p>
<p><?php echo anchor('upload/viewPictures/', 'View All Pictures'); ?></p>

<?php 

	foreach($sliderMap as $picture){
		$cleanName  = $picture;
		$cleanName = strstr($cleanName, '.', true);
		echo("<p>{$picture}</br><img src='". base_url() . "uploads/sliders/{$picture}' alt='Uploaded Picture {$picture}' title='{$cleanName}'/>
			<span><a class='confirmation' href='". base_url() . "upload/deletePicture/{$picture}/sliders'  title='delete {$picture}'>Delete Picture</a></span>
		</p> <br/><br/>");
	}
	
?>
<script>
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>
</body>
</html>