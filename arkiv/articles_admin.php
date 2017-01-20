

<html>
  <head>
    <meta charset="utf-8">
    <title>Add article</title>
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/rzslider.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="lib/js/jquery.min.js"></script>
    <script src="lib/js/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.1/angular-sanitize.min.js"></script>
    <script src="lib/js/rzslider.min.js"></script>
    <script src="lib/js/bootstrap.min.js"></script>
    <script src="ctrl/article.js"></script>
  </head>
  <body ng-app="article" ng-controller="articleCtrl" ng-init="getArticles(); getPopularTags(); getClickedTags()" ng-cloak>
    <?php require_once 'inc/navbar.php'; ?>
    <div class="container-fluid">
        <div class="row-fluid" ng-init="getArticlesAdmin()">
        <h1 class="center-text">Click On Article To Change It</h1>
          <div class="col-md-12">
            <div class="col-md-10">
              <div ng-repeat="article in articles">
                <div class="col-lg-3 col-md-4 col-sm-6"><div><a href="update_article.php?article_id={{article.id}}"><img ng-if="main_images[$index].url != NULL" src="img/{{main_images[$index].url}}" alt="..." class="img-responsive ag-img-thumbnail ag-big-div ag-card-image"><img ng-if="main_images[$index].url == NULL" src="img/white.jpg" alt="..." class="img-responsive ag-img-thumbnail ag-big-div ag-card-image"><div class="transparent"><h4 class="ag-overlay-text">{{article.title.substring(0, 24)}}<span ng-if="article.title.length > 24">-</span></h4><h4 class="ag-overlay-text">{{article.title.substring(24, 48)}}</h4></div></img></a></div></div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </body>