<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="<?= $baseUrl; ?>/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="<?= $baseUrl; ?>/js/main.js"></script>
        <script type="text/javascript" src="<?= $baseUrl; ?>/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?= $baseUrl; ?>/js/messages_ru.js"></script>

        <link rel="stylesheet" type="text/css" href="<?= $baseUrl; ?>/css/main.css?v=1" media="screen">
    </head>
    <body>
    <!--wrapper-->
        <div class="wrapper">
            <!--main container-->
            <div class="container">
                <?php if ($title) { ?>
                    <h1><?= $title; ?></h1>
                <?php } ?>