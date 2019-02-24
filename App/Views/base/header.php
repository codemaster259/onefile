<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo HTTP_ROOT;?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png" />
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Taskboard</title>
    
    <!-- FakeJS -->
    <link href="assets/css/fakejs.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Datepicker CSS -->
    <link href="assets/css/bootstrap-datepicker.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="assets/css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="assets/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="assets/css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- Real Custom CSS -->
    <link href="assets/css/custom.css" rel="stylesheet">
    
    <!-- jQuery v2.1.3-->
    <script src="assets/js/jquery.min.js"></script>
    
    <?php if(session_exists("LOGGED")):?>
    <script> var LOGGED = true;</script>
    <?php else:?>
    <script> var LOGGED = false;</script>
    <?php endif;?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
    function onload(callback)
    {
        callback = callback || function(){};
        document.addEventListener("DOMContentLoaded", function(){
            callback();
        });
    }
    </script>
</head>
<body>
    <div id="loader" class="oculto">
        <div class="spinner lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div id="alert-panel"></div>