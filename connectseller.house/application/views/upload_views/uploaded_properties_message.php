<html>
<head>
<title>Uploaded Product Pictures</title>
</head>
<body>

<h3>Uploaded Properties Folder</h3>

<p><?php echo anchor('upload', 'Upload File!'); ?></p>
<p><?php echo anchor('upload/viewPictures/', 'View All Pictures'); ?></p>
<p>Count : <?php echo count($productMap); ?></p><hr>
<?php 

	foreach($productMap as $picture){
		$cleanName  = $picture;
		$cleanName = strstr($cleanName, '.', true);
		echo("<p>{$picture}</br><img src='". base_url() . "uploads/box.png' alt='Directory Folder' title='{$cleanName}'/>
			<span></br><a class='confirmation' href='". base_url() . "upload/deleteFolder/{$picture}'  title='delete {$picture}'>Delete Folder  {$picture}</a></span>
		</p> </br></br>");
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
