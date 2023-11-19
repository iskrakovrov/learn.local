<?php
session_start();
include_once ('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$cat = $_REQUEST['id'];
set_time_limit(3600);



$message = '';
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload') {
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        // get details of the uploaded file
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $fileType = $_FILES['uploadedFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // sanitize file-name
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        // check if file has one of the following extensions
        $allowedfileExtensions = array('txt');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // directory in which the uploaded file will be moved
            $uploadFileDir = './tmp/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $message = 'File is successfully uploaded.';

                $trimmed = file($dest_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($trimmed as $key) {


                    $res = parse_key($key);
                    $sql = $res[0];

                    if (!empty($sql)) {
                        $argc = [$key];
                        $ins = insert($sql,$argc);

                    }


                }
                unlink($dest_path);
                header('Location: ' .$_SERVER['HTTP_REFERER']);
                exit();


            } else {
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
        } else {
            $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        }
    } else {
        $message = 'There is some error in the file upload. Please check the following error.<br>';
        $message .= 'Error:' . $_FILES['uploadedFile']['error'];
    }
}




$_SESSION['message'] = $message;
header('Location: ' .$_SERVER['HTTP_REFERER']);
