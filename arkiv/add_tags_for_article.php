

<html>
  <head>
    <meta charset="utf-8">
    <title>Add tags</title>
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="lib/js/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.1/angular-sanitize.min.js"></script>
    <script src="lib/js/jquery.min.js"></script>
    <script src="lib/js/bootstrap.min.js"></script>
    <script src="ctrl/add_article.js"></script>
  </head>
  <div class="col-md-12 ag-white-bg"><img src="img/logo/agueli_logo.png"></div>
  <body ng-app="add_article" ng-controller="add_articleCtrl" ng-init="article_id=<?if(empty($_REQUEST['article_id'])){echo -1;}else{echo $_REQUEST['article_id'];}?>" ng-cloak>
    <?php require_once 'inc/navbar.php'; ?>
    <div class="container-fluid">
    <div class="col-md-10 col-md-offset-1" ng-init="getTagsForArticle(article_id)">
      <ul class="list-group">
        <li ng-repeat="article_tag in article_tags" class="list-group-item col-md-2"><a>{{article_tag.name}}</a><span ng-click="removeTagForArticle(article_tag.id, article_id)" class="glyphicon glyphicon-remove pull-right ag-red fake-button"></span></li>
      </ul>
    </div>
    <div class="row col-md-12">
    <br>
      <a href="articles.php"><button class="btn btn-primary col-md-2 col-md-offset-5">Done Adding Tags</button></a>
    </div>
    <div class="col-md-10 col-md-offset-1" ng-init="getTags()">
    <br><br>
    <ul class="list-group">
      <li ng-repeat="tag in tags" class="list-group-item col-md-2"><a>{{tag.name}}</a><span ng-click="addTagForArticle(tag.id, article_id)" class="glyphicon glyphicon-plus pull-right fake-button"></span></li>
    </ul>
    </div>
    </div>
  </body>