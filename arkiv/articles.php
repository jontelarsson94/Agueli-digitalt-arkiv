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
    <p></p>
  <div class="container-fluid" ng-init="getArticle()" ng-if="article_id != -1">
        <div class="col-md-11 col-md-offset-1">
          <div class="col-md-7">
            <div ng-if="image1.url != NULL">
              <img src="img/{{image1.url}}" alt="..." class="img-responsive center-block">
              <br>
            </div>
            <p>{{article.body1}}</p>
            <div ng-if="image2.url != NULL">
              <img ng-if="image2.url != NULL" src="img/{{image2.url}}" alt="..." class="img-responsive center-block">
              <br>
            </div>
              <p>{{article.body2}}</p>
            <div ng-if="image3.url != NULL">
              <img ng-if="image3.url != NULL" src="img/{{image3.url}}" alt="..." class="img-responsive center-block">
              <br>
            </div>
            <p>{{article.body3}}</p>
            <div class="row">
              <div class="col-md-12">
                <img class="col-md-3 img-responsive" ng-repeat="image in images" ng-if="$index < 4" src="img/{{image.url}}" alt="gallery-image" />
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-3" ng-repeat="image in images" ng-if="$index >= 4">
                  <img class="img-responsive" src="img/{{image.url}}" alt="gallery-image"/>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-md-offset-1">
            <h4>Taggar:</h4>
            <a ng-repeat="tag in tags" ng-class="{'btn btn-primary btn-xs tag': tag.size == 1 , 'btn btn-primary btn-sm tag': tag.size == 2,
                'btn btn-primary tag': tag.size == 3, 'btn btn-primary btn-lg tag': tag.size == 4 } " href="tags.php?tag_id={{tag.tag.id}}">{{tag.tag.name}}</a>
          </div>
        </div>
  </div>


  </body>
</html>
