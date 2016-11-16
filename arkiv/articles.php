<html>
  <head>
    <meta charset="utf-8">
    <title>Add article</title>
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="lib/js/angular.min.js"></script>
    <script src="lib/js/jquery.min.js"></script>
    <script src="lib/js/bootstrap.min.js"></script>
    <script src="ctrl/article.js"></script>
  </head>
  <body ng-app="article" ng-controller="articleCtrl" ng-cloak ng-init="article_id=<?if(empty($_REQUEST['article_id'])){echo -1;}else{echo $_REQUEST['article_id'];}?>">

<div class="container-fluid">
    <div class="row" ng-init="getArticles()" ng-if="article_id == -1">
      <div class="col-md-10">
          <ul class="list-group">
            <li class="list-group-item" ng-repeat="article in articles">
              <a href="articles.php?article_id={{article.id}}">{{article.title}}</a>
            </li>
          </ul>
      </div>
    </div>

    <div class="row" ng-init="getArticle()" ng-if="article_id != -1">
      <div class="col-md-12">
        <h1 class="text-center">{{article.title}}</h1>
    </div>
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="col-md-9">
          <div class="col-md-6">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item active" ng-repeat="image in images" ng-if="$index < 1">
              <img src="img/{{image.url}}" alt="...">
            </div>
            <div class="item" ng-repeat="image in images" ng-if="$index > 0">
              <img src="img/{{image.url}}" alt="..." class="img-responsive">
            </div>
          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        </div>
        <div>
        <p>{{article.body}}</p>
      </div>
        </div>
        <div class="col-md-3">
          <a ng-repeat="tag in tags" ng-class="{'btn btn-primary btn-xs tag': tag.size == 1 , 'btn btn-primary btn-sm tag': tag.size == 2,
              'btn btn-primary tag': tag.size == 3, 'btn btn-primary btn-lg tag': tag.size == 4 } " href="tags.php?tag_id={{tag.tag.id}}">{{tag.tag.name}}</a>
        </div>
</div>
      </div>
    </div>
  </div>


  </body>
</html>
