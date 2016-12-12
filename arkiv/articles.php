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
  <body ng-app="article" ng-controller="articleCtrl" ng-init="getArticles(); getPopularTags(); getClickedTags()" ng-cloak>
    <?php require_once 'inc/navbar.php'; ?>
<div class="container-fluid">
  <div class="col-md-4 col-md-offset-4">
    <div>
        <span ng-repeat="filterTag in filterTags" ng-click="removeTagToSearch(filterTag.id); getFilteredArticles()" class="skill">{{filterTag.name}} <span class="glyphicon fake-button glyphicon-remove"></span></span>
        <span class="ag-padding"></span>
        <span data-target="#tagModal" data-toggle="modal" ng-click="getTagsForModal()" class="skill glyphicon glyphicon-plus fake-button">Tagg</span>
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
          <h4 class="ag-yellow">Innehållsrikaste taggarna:</h4>
          <span ng-repeat="popular_tag in popular_tags | orderBy : 'tag.name'" ng-class="{'fake-button ag-xs ag-white tag': popular_tag.size == 1 , 'fake-button ag-sm ag-white tag': popular_tag.size == 2,
              'fake-button ag-md ag-white tag': popular_tag.size == 3, 'fake-button ag-lg ag-white tag': popular_tag.size == 4 } " ng-click="addClickForTag(popular_tag.tag.id); addOneTagToSearch(popular_tag.tag.id); getFilteredArticles()">{{popular_tag.tag.name}} </span>
              <br><br><br><br><br><br><br>
          <h4 class="ag-yellow">Populäraste taggarna:</h4>
          <span ng-repeat="random_tag in random_tags | orderBy : 'tag.name'" ng-class="{'fake-button ag-xs ag-white tag': random_tag.size == 1 , 'fake-button ag-sm ag-white tag': random_tag.size == 2,
              'fake-button ag-md ag-white tag': random_tag.size == 3, 'fake-button ag-lg ag-white tag': random_tag.size == 4 } " ng-click="addClickForTag(random_tag.tag.id); addOneTagToSearch(random_tag.tag.id); getFilteredArticles()">{{random_tag.tag.name}} </span>
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
                    <span ng-repeat="tag in tags | orderBy : 'tag.name'" data-dismiss="modal" ng-class="{'fake-button ag-xs tag': tag.size == 1 , 'fake-button ag-sm tag': tag.size == 2,
                        'fake-button ag-md tag': tag.size == 3, 'fake-button ag-lg tag': tag.size == 4 } " ng-click="lastRead(article.id); addClickForTag(tag.tag.id); addTagToSearch(tag.tag.id); getFilteredArticles()">{{tag.tag.name}} </span>
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
  </div>
  </div>

  <!-- Modal -->
  <div class="modal fullscreen-modal fade" id="tagModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content ag-background-header-transparent">
        <div class="ag-modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h2 class="modal-title text-center" id="myModalLabel">Taggar</h2>
        </div>
        <div class="top-space ag-modal-content ag-background-transparent">
          <div class="container-fluid">
                <div class="col-md-10 col-md-offset-1">
                <br><br>
                <div class="col-md-12 ag-border">
                  <h4 class="text-center ag-padding-bottom">Valda taggar:</h4>
                  <div class="col-md-4 col-md-offset-4">
                  <span ng-repeat="filterTag in filterTags" ng-click="removeTagToSearch(filterTag.id); getFilteredArticles()" class="skill">{{filterTag.name}} <span class="glyphicon fake-button glyphicon-remove"></span></span>
                  </div>
                </div>
                <button class="btn btn-default col-md-2 col-md-offset-5 ag-padding-top">Klar</button>
                </div>
                <div class="col-md-12 row">
                <div class="col-md-3 col-md-offset-1">
                <h3>{{categoryOne.name}}</h3>
                  <span ng-repeat="categoryOne_tag in categoryOne_tags | orderBy : 'tag.name'" class="fake-button" ng-click="addClickForTag(categoryOne_tag.id); addTagToSearch(categoryOne_tag.id); getFilterTags()"><span>{{categoryOne_tag.name}} </span></span>
                </div>
                <div class="col-md-3 col-md-offset-1">
                <h3>{{categoryTwo.name}}</h3>
                </div>
                <div class="col-md-3 col-md-offset-1">
                <h3>{{categoryThree.name}}</h3>
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
  </div>
  </div>

  </body>
</html>
