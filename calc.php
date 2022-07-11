<?php
$cmd="";
if (isset($_POST["eq"])) {
    $cmd = 'qalc "' . $_POST["eq"] . '"';
}
?>
 <html>
   <head>
     <style type="text/css"><!-- pre {font-size:16px} --></style>
   </head>
   <body>
     <h1>簡易電卓</h1>
     <form action="calc.php" method="POST">
     <input type="text" name="eq" size="30" autofocus>
     <input type="submit" value="計算">
     </form>
     <pre>
<?php system($cmd); ?>
     </pre>
     <hr>
     <h2>サーバでは以下のコマンドを実行</h2>
     <pre>
<?php echo htmlspecialchars($cmd, ENT_QUOTES); ?>
     </pre>
    </body>
</html>
     
