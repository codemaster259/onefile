<?php

echo view("base/header.php");

echo view("base/menu_panel.php");

echo isset($content) ? $content : "Vacio...";

echo view("base/footer.php");