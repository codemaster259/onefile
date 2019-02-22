<?php

echo view("base/header.php");

echo view("base/menu_public.php");

echo isset($content) ? $content : "Vacio...";

echo view("base/footer.php");