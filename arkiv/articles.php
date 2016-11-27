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
    <script src="lib/js/ng-infinite-scroll.min.js"></script>
    <script src="ctrl/article.js"></script>
  </head>
  <div class="col-md-12 ag-white-bg"><img src="img/logo/agueli_logo.png"></div>
  <body ng-app="article" ng-controller="articleCtrl" ng-init="getArticles()" ng-cloak>
    <?php require_once 'inc/navbar.php'; ?>
<div class="container-fluid" ng-init="getRandomTags()">
    <div class="row" infinite-scroll="getArticles()">
      <div class="col-md-12">
        <div class="col-md-10">
          <div ng-repeat="article in articles | limitTo:page" ng-if="$index % 3 == 0" class="row">
            <div class="col-md-4"><div ng-click="getArticle(articles[$index].id)" data-toggle="modal" data-target="#myModal"><a href=""><img src="img/{{main_images[$index].url}}" alt="..." class="img-responsive img-thumbnail ag-img-thumbnail ag-big-div"><div class="transparent"><h3 class="ag-overlay-text">{{articles[$index].title}}</h3></div></img></a></div></div>
            <div class="col-md-4 ag-big-div"><div ng-click="getArticle(articles[$index + 1].id)" data-toggle="modal" data-target="#myModal" ng-if="articles.length > ($index + 1)"><a href=""><img src="img/{{main_images[$index + 1].url}}" alt="..." class="img-responsive img-thumbnail ag-img-thumbnail ag-big-div"><div class="transparent"><h3 class="ag-overlay-text">{{articles[$index + 1].title}}</h3></div></img></a></div></div>
            <div class="col-md-4 ag-big-div"><div ng-click="getArticle(articles[$index + 2].id)" data-toggle="modal" data-target="#myModal" ng-if="articles.length > ($index + 2)"><a href=""><img src="img/{{main_images[$index + 2].url}}" alt="..." class="img-responsive img-thumbnail ag-img-thumbnail ag-big-div"><div class="transparent"><h3 class="ag-overlay-text">{{articles[$index + 2].title}}</h3></div></img></a></div></div>
          </div>
        </div>
        <div class="col-md-2">
          <h4>Taggar:</h4>
          <a ng-repeat="random_tag in random_tags | orderBy : 'tag.name'" ng-class="{'btn btn-primary btn-xs tag': random_tag.size == 1 , 'btn btn-primary btn-sm tag': random_tag.size == 2,
              'btn btn-primary tag': random_tag.size == 3, 'btn btn-primary btn-lg tag': random_tag.size == 4 } " ng-click="addClickForTag(random_tag.tag.id)">{{random_tag.tag.name}}</a>
        </div>
      </div>
    </div>
  </div>
  <div ng-if="showScrollButton == 1" class="col-md-2 col-md-offset-5"><button class="btn btn-default" ng-click="loadMore()">Load more</button></div>

	<!-- Modal -->
	<div ng-if="article.title != NULL" class="modal fullscreen-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content ag-background-header-transparent">
	      <div class="ag-modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h2 class="modal-title text-center" id="myModalLabel">{{article.title}}</h2>
	      </div>
	      <div class="top-space ag-modal-content ag-background-transparent">
          <div class="container-fluid">
                <div class="col-md-11 col-md-offset-1">
                  <div class="col-md-7">
                    <br>
                    <div ng-if="image1.url != NULL">
                      <img src="img/{{image1.url}}" alt="..." class="img-responsive center-block thumbnail">
                    </div>
                    <p>{{article.body1}}</p>
                    <div ng-if="image2.url != NULL">
                      <img src="img/{{image2.url}}" alt="..." class="img-responsive center-block thumbnail">
                    </div>
                      <p>{{article.body2}}</p>
                    <div ng-if="image3.url != NULL">
                      <img src="img/{{image3.url}}" alt="..." class="img-responsive center-block thumbnail">
                    </div>
                    <p>{{article.body3}}</p>
                  </div>
                  <div class="col-md-4 col-md-offset-1">
                    <h4>Taggar:</h4>
                    <a ng-repeat="tag in tags | orderBy : 'tag.name'" ng-class="{'btn btn-primary btn-xs tag': tag.size == 1 , 'btn btn-primary btn-sm tag': tag.size == 2,
                        'btn btn-primary tag': tag.size == 3, 'btn btn-primary btn-lg tag': tag.size == 4 } " ng-click="addClickForTag(tag.tag.id)">{{tag.tag.name}}</a>
                  </div>
	      </div>
	      <div class="modal-footer">
          <div class="col-md-7 col-md-offset-1">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-3" ng-repeat="image in images" ng-if="$index < 4">
                <a target="_blank" href="img/{{image.url}}"><img class="img-responsive thumbnail" src="img/{{image.url}}" alt="gallery-image"/></a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-3" ng-repeat="image in images" ng-if="$index >= 4">
                <a target="_blank" href="img/{{image.url}}"><img class="img-responsive thumbnail" src="img/{{image.url}}" alt="gallery-image"/></a>
              </div>
            </div>
          </div>
	      </div>
      </div>
	    </div>
	  </div>
	</div>

  </body>
</html>
