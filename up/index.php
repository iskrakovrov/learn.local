<!--File uploading script -->
<?php include 'upload.php'; ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>Upload Multiple Images And Store In Database Using PHP And MySQL by CodeAT21</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="App">
		<h1> Upload Multiple Images And Store In Database Using PHP And MySQL </h1>
		<div class="wrapper">
			<div class="form__field">
				<?php if(!empty($statusMsg)){ ?>
					<p class="status__msg"><?php echo $statusMsg; ?></p>
				<?php } ?>
				<form action="" method="post" enctype="multipart/form-data">
					<input type="file" name="images[]" class="form__field__img" multiple>
					<input type="submit" name="submit" value="Upload" class="btn__default">
				</form>
			</div>

	<!-- gallery view of uploaded images --> 
	<div class="gallery">
				<h2>Uploaded Images</h2>
				<?php include 'dbConfig.php';
					$query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");
					if($query->num_rows > 0){
						while($row = $query->fetch_assoc()){
							$imageURL = $row["file_name"];
						?>
							<img src="<?php echo $imageURL; ?>" alt="" />
						<?php }
					}else{ ?>
						<p>No image(s) found...</p>
				<?php } ?>
			</div>
	</div>
</body>
</html>
