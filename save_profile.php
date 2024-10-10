<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload .zpprofile File</title>
</head>
<body>
<h2>Upload .zpprofile File</h2>
<form action="up_prof.php" method="post" enctype="multipart/form-data">
    <label for="file">Choose .zpprofile file:</label>
    <input type="file" name="file" id="file" accept=".zpprofile" required>
    <input type="submit" name="submit" value="Upload">
</form>
</body>
</html>