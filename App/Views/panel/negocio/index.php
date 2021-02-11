<?php
block_open("content");
//block_extends("base/layout_panel.php")->add("content", function(){
?>

Hola Mundo!!!

<?php
//});
echo view("base/layout_panel.php", ['content' => block_close("content")]);
?>


