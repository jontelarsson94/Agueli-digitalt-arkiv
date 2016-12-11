<html>
  <head>
    <meta charset="utf-8">
    <title>Add article</title>
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="lib/js/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.1/angular-sanitize.min.js"></script>
    <script src="lib/js/jquery.min.js"></script>
    <script src="lib/js/bootstrap.min.js"></script>
    <script src="ctrl/article.js"></script>
  </head>
  <div class="col-md-12 ag-white-bg"><img src="img/logo/agueli_logo.png"></div>
  <body ng-app="article" ng-controller="articleCtrl" ng-init="getArticles()" ng-cloak>
    <?php require_once 'inc/navbar.php'; ?>
<div class="container-fluid" ng-init="getRandomTags()">
  <div class="col-md-4 col-md-offset-4">
    <div>
        <button ng-repeat="filterTag in filterTags" ng-click="removeTagToSearch(filterTag.id); getFilteredArticles()" class="skill btn btn-danger">{{filterTag.name}} <span class="glyphicon glyphicon-remove"></span></button>
    </div>
    <br>
  </div>
    <div class="row-fluid" ng-init="getArticles()">
      <div class="col-md-12">
        <div class="col-md-10">
          <div ng-repeat="article in articles | limitTo:page">
            <div ng-if="articles_lastRead[$index].id" class="col-lg-4 col-md-6"><div ng-click="getArticle(articles_lastRead[$index].id); lastRead(articles_lastRead[$index].id);" data-target="#myModal" data-toggle="modal"><a href=""><img src="img/{{main_images_lastRead[$index].url}}" alt="..." class="img-responsive img-thumbnail ag-img-thumbnail ag-big-div"><div class="transparent"><h4 class="ag-overlay-text">{{articles_lastRead[$index].title}}</h4></div><span class="pull-right glyphicon glyphicon-eye-open ag-glyph-overlay"></span></img></a></div></div>
            <div ng-if="articles_starred[$index].id" class="col-lg-4 col-md-6"><div ng-click="getArticle(articles_starred[$index].id); lastRead(articles_starred[$index].id);" data-target="#myModal" data-toggle="modal"><a href=""><img src="img/{{main_images_starred[$index].url}}" alt="..." class="img-responsive img-thumbnail ag-img-thumbnail ag-big-div"><div class="transparent"><h4 class="ag-overlay-text">{{articles_starred[$index].title}}</h4></div><span class="pull-right glyphicon glyphicon-star ag-glyph-overlay"></span></img></a></div></div>
            <div class="col-lg-4 col-md-6"><div ng-click="getArticle(article.id); lastRead(article.id);" data-target="#myModal" data-toggle="modal"><a href=""><img src="img/{{main_images[$index].url}}" alt="..." class="img-responsive img-thumbnail ag-img-thumbnail ag-big-div"><div class="transparent"><h4 class="ag-overlay-text">{{articles[$index].title}}</h4></div></img></a></div></div>
          </div>
        </div>
        <div class="col-md-2">
          <button ng-if="lastReadId != 0" data-toggle="modal" data-target="#myModal" class="btn btn-warning">Go back to last read</button>
          <h4>Taggar:</h4>
          <a ng-repeat="random_tag in random_tags | orderBy : 'tag.name'" ng-class="{'btn btn-primary btn-xs tag': random_tag.size == 1 , 'btn btn-primary btn-sm tag': random_tag.size == 2,
              'btn btn-primary tag': random_tag.size == 3, 'btn btn-primary btn-lg tag': random_tag.size == 4 } " ng-click="addClickForTag(random_tag.tag.id); addTagToSearch(random_tag.tag.id); getFilteredArticles()">{{random_tag.tag.name}}</a>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div ng-if="showScrollButton == 1" class="col-md-2 col-md-offset-5"><button class="btn btn-default" ng-click="loadMore()">Load more</button></div>

	<!-- Modal -->
	<div class="modal fullscreen-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                    <div ng-repeat="body in bodies">
                      <div ng-repeat="image in body_images" ng-if="image.section == body.section">
                        <img src="img/{{image.url}}" alt="..." class="img-responsive center-block thumbnail">
                      </div>
                      <p compile="body.body"></p>
                    </div>
                    <div ng-if="bodies.length < body_images.length" ng-repeat="image in body_images">
                        <img ng-if="$index >= bodies.length" src="img/{{image.url}}" alt="..." class="img-responsive center-block thumbnail">
                    </div>
                  </div>
                  <div class="col-md-4 col-md-offset-1">
                    <h4>Taggar:</h4>
                    <a ng-repeat="tag in tags | orderBy : 'tag.name'" data-dismiss="modal" ng-class="{'btn btn-primary btn-xs tag': tag.size == 1 , 'btn btn-primary btn-sm tag': tag.size == 2,
                        'btn btn-primary tag': tag.size == 3, 'btn btn-primary btn-lg tag': tag.size == 4 } " ng-click="lastRead(article.id); addClickForTag(tag.tag.id); addTagToSearch(tag.tag.id); getFilteredArticles()">{{tag.tag.name}}</a>
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
