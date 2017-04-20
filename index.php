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

            <header id="menuTop" class="mdl-layout__header mdl-layout__header--scroll">
                <div class="mdl-layout__header-row">
                    <!-- Title -->
                    <span class="mdl-layout-title">Mkt Virtual API</span>
                    <!-- Add spacer, to align navigation to the right -->
                    <div class="mdl-layout-spacer"></div>
                    <!-- Navigation -->
                    <nav class="mdl-navigation">
                        <a class="mdl-navigation__link" href="https://docs.google.com/document/d/1vyNkVNl8KjH8xN1vjC7XBuvUZ43gGnRlpTvDDbh7iF0" target="_blank">Documentação</a>
                    </nav>
                </div>
            </header>

            <div id="menuLeft" class="mdl-layout__drawer">
                <span class="mdl-layout-title">Mkt Virtual API</span>
                <!--<nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="">Link</a>
                </nav>-->
                
                <!-- SEO -->
                <form action="#">
                    <div class="seo-list-action mdl-list">
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-avatar">star</i>
                                <span>SEO</span>
                            </span>
                        </div>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield" style="width: 70%">
                        <input class="mdl-textfield__input" type="text" id="seoField">
                        <label class="mdl-textfield__label" for="seo">URL...</label>
                    </div>
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored" id="seoButton">
                        <i class="material-icons">add</i>
                    </button>
                </form>
                
                <!-- FACEBOOK -->
                <form action="#">                    
                    <div class="facebook-list-action mdl-list">
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-avatar">face</i>
                                <span>Facebook</span>
                            </span>
                        </div>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield" style="width: 70%">
                        <input class="mdl-textfield__input" type="text" id="facebookField">
                        <label class="mdl-textfield__label" for="facebook">ID...</label>
                    </div>
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored" id="facebookButton">
                        <i class="material-icons">add</i>
                    </button>
                    <!-- Accent-colored raised button with ripple -->
                    <!--<button id="facebookChartButton" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                      Gerar gráfico
                    </button>-->
                </form>
                
                <!-- INSTAGRAM -->
                <form action="#">                    
                    <div class="instagram-list-action mdl-list">
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-avatar">camera</i>
                                <span>Instagram</span>
                            </span>
                        </div>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield" style="width: 70%">
                        <input class="mdl-textfield__input" type="text" id="instagramField">
                        <label class="mdl-textfield__label" for="instagram">ID...</label>
                    </div>
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored" id="instagramButton">
                        <i class="material-icons">add</i>
                    </button>
                </form>
                
                <!-- TWITTER -->
                <form action="#">                    
                    <div class="twitter-list-action mdl-list">
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-avatar">whatshot</i>
                                <span>Twitter</span>
                            </span>
                        </div>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield" style="width: 70%">
                        <input class="mdl-textfield__input" type="text" id="twitterField">
                        <label class="mdl-textfield__label" for="twitter">ID...</label>
                    </div>
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored" id="twitterButton">
                        <i class="material-icons">add</i>
                    </button>
                </form>
                
                <!-- YOUTUBE -->
                <form action="#">                    
                    <div class="youtube-list-action mdl-list">
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-avatar">slideshow</i>
                                <span>Youtube</span>
                            </span>
                        </div>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield" style="width: 70%">
                        <input class="mdl-textfield__input" type="text" id="youtubeField">
                        <label class="mdl-textfield__label" for="youtube">ID...</label>
                    </div>
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored" id="youtubeButton">
                        <i class="material-icons">add</i>
                    </button>
                </form>
            </div>

            <main id="masterContainer" class="mdl-layout__content">
                <div class="page-content">
                    <h1>MKT API V0.3</h1>
                    <div id="seoContainer">
                        <p>
                            <div class="seo-list-action mdl-list">
                                <div class="mdl-list__item">
                                    <span class="mdl-list__item-primary-content">
                                        <i class="material-icons mdl-list__item-avatar">star</i>
                                        <span>SEO</span>
                                    </span>
                                </div>
                            </div>
                        </p>
                        <p id="chartBtns">
                           <button id="btnScore" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Score</button>
                           
                            <button id="btnBackLinks" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Back Links</button>
                            
                            <button id="btnDomainAuthority" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Domain Authority</button>
                            
                            <button id="btnAuthority" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Page Authority</button>
                        </p>
                        <p id="seoChartParent">
                            <canvas id="seoChart"></canvas>
                        </p>
                    </div>
                    <div id="facebookContainer">
                        <p>
                            <div class="facebook-list-action mdl-list">
                                <div class="mdl-list__item">
                                    <span class="mdl-list__item-primary-content">
                                        <i class="material-icons mdl-list__item-avatar">face</i>
                                        <span>Facebook</span>
                                    </span>
                                </div>
                            </div>
                        </p>
                        <p id="chartBtns">
                           <button id="btnScore" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Score</button>
                           
                           <button id="btnFans" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Page Fans</button>
                           
                           <button id="btnPostFrequency" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Post Frequency</button>
                           
                           <button id="btnPostEngagement" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Post Engagement</button>
                        </p>
                        <p id="facebookChartParent">
                            <canvas id="facebookChart" width="400" height="200"></canvas>
                        </p>
                    </div>
                    <div id="instagramContainer">
                        <p>
                            <div class="instagram-list-action mdl-list">
                                <div class="mdl-list__item">
                                    <span class="mdl-list__item-primary-content">
                                        <i class="material-icons mdl-list__item-avatar">camera</i>
                                        <span>Instagram</span>
                                    </span>
                                </div>
                            </div>
                        </p>
                        <p id="chartBtns">
                           <button id="btnScore" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Score</button>
                           
                           <button id="btnFollowers" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Followers</button>
                           
                           <button id="btnPostFrequency" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Post Frequency</button>
                           
                           <button id="btnPostEngagement" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Post Engagement</button>
                        </p>
                        <p id="instagramChartParent">
                            <canvas id="instagramChart"></canvas>
                        </p>                      
                    </div>
                    <div id="twitterContainer">
                        <p>
                            <div class="twitter-list-action mdl-list">
                                <div class="mdl-list__item">
                                    <span class="mdl-list__item-primary-content">
                                        <i class="material-icons mdl-list__item-avatar">whatshot</i>
                                        <span>Twitter</span>
                                    </span>
                                </div>
                            </div>
                        </p>
                        <p id="chartBtns">
                           <button id="btnScore" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Score</button>
                           
                           <button id="btnFollowers" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Followers</button>
                           
                           <button id="btnPostFrequency" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Post Frequency</button>
                           
                           <button id="btnPostEngagement" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Post Engagement</button>
                        </p>
                        <p id="twitterChartParent">
                            <canvas id="twitterChart"></canvas>
                        </p>                      
                    </div>
                    <div id="youtubeContainer">
                        <p>
                            <div class="instagram-list-action mdl-list">
                                <div class="mdl-list__item">
                                    <span class="mdl-list__item-primary-content">
                                        <i class="material-icons mdl-list__item-avatar">slideshow</i>
                                        <span>Youtube</span>
                                    </span>
                                </div>
                            </div>
                        </p>
                        <p id="chartBtns">
                           <button id="btnScore" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Score</button>
                           
                           <button id="btnSubscribers" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Subscribers</button>
                           
                           <button id="btnTotalVideos" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Total Videos</button>
                           
                           <button id="btnTotalViews" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Total Views</button>
                           
                           <button id="btnTotalComments" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Total Comments</button>
                        </p>
                        <p id="youtubeChartParent">
                            <canvas id="youtubeChart"></canvas>
                        </p>                         
                    </div>
                </div>
            </main>

        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Elements Control) -->
        <script src="js/apiControl.js"></script>
        <!-- Chart JS -->
        <script src="js/Chart.js/dist/Chart.bundle.js"></script>
        <!-- Format Numbers -->
        <script src="js/accounting.js"></script>
    </body>
</html>