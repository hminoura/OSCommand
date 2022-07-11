<?php
$upload_dir = "/var/www/html/uploads/";
if (!file_exists($upload_dir))
    mkdir($upload_dir);

$msg = "";
if (isset($_FILES["upload_file"])) {
    move_uploaded_file($_FILES["upload_file"]["tmp_name"], $upload_dir . $_FILES["upload_file"]["name"]);
    $msg = $_FILES["upload_file"]["name"] . "(" . $_FILES["upload_file"]["size"] . "byte) has been uploaded.";
}
if (isset($_GET["download_file"])) {
    $filename = $_GET["download_file"];
    $filepath = $upload_dir . $filename;
    if (file_exists($filepath)) {
        header('Content-Type: application/octet-stream');
        header('Content-Length: '. filesize($filepath));
        header('Content-Disposition: attachment; filename=' . $filename); 
        
        readfile($filepath);
        exit();
    } else
        $msg = $filename . " does NOT exist.";
}

$files = array_diff(scandir($upload_dir), array('..', '.'));
?>

<html>
  <body>
    <h1>ファイル置き場</h1>
    <hr>
    <h2>アップロード</h2>
    <form enctype="multipart/form-data" action="storage.php" method="POST">
      <input type="file" name="upload_file">
      <input type="submit" value="upload">
    </form>
    <hr>
    <h2>ダウンロード</h2>
    <form action="storage.php" method="GET">
<?php
foreach ($files as $file)
  echo '      <input type="radio" name="download_file" value="' . $file . '">' . $file . "<br>\n";
?>
      <input type="submit" value="download">
    </form>
    <hr>
<?php echo $msg ?>
  </body>
</html>
     
