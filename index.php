<?php
require_once('vendor/autoload.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Mkt Virtual API</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css">
        
        <link rel="stylesheet" href="css/apiControl.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>

    </head>
    <body>
        <div class="mdl-layout mdl-js-layout">

            <header class="mdl-layout__header mdl-layout__header--scroll">
                <div class="mdl-layout__header-row">
                    <!-- Title -->
                    <span class="mdl-layout-title">Mkt Virtual API</span>
                    <!-- Add spacer, to align navigation to the right -->
                    <div class="mdl-layout-spacer"></div>
                    <!-- Navigation -->
                    <nav class="mdl-navigation">
                        <a class="mdl-navigation__link" href="">Link</a>
                    </nav>
                </div>
            </header>

            <div class="mdl-layout__drawer">
                <span class="mdl-layout-title">Mkt Virtual API</span>
                <!--<nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="">Link</a>
                </nav>-->
                <form action="#">
                    <div class="demo-list-action mdl-list">
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-avatar">star</i>
                                <span>SEO</span>
                            </span>
                        </div>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield" style="width: 70%">
                        <input class="mdl-textfield__input" type="text" id="seoField">
                        <label class="mdl-textfield__label" for="sample1">URL...</label>
                    </div>
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored" id="seoButton">
                        <i class="material-icons">add</i>
                    </button>
                </form>
            </div>

            <main class="mdl-layout__content">
                <div class="page-content">
                    <h1>MKT API</h1>
                    <div id="seoContainer"></div>

                </div>
            </main>

        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Elements Control) -->
        <script src="js/apiControl.js"></script>
    </body>
</html>