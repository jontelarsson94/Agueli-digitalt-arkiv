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
    <div class="row" ng-init="getArticles()">
      <div class="col-md-12">
        <div class="col-md-11">
          <div ng-repeat="article in articles" ng-if="$index % 3 == 0" class="row">
            <div class="col-md-3 thumbnail"><button data-toggle="modal" data-target="#article-{{article.id}}"><img src="img/{{main_images[$index].url}}" alt="..." class="img-responsive center-block ag-overlay-image"><h2 class="text-center">{{articles[$index].title}}</h2></button></div>
            <div class="col-md-3 thumbnail ag-thumbnail" ng-if="articles.length > ($index + 1)"><a data-toggle="modal" data-target="#article-{{articles[$index + 1].id}}"><img src="img/{{main_images[$index + 1].url}}" alt="..." class="img-responsive center-block"><h2 class="text-center">{{articles[$index + 1].title}}</h2></a></div>
            <div class="col-md-3 thumbnail ag-thumbnail" ng-if="articles.length > ($index + 2)"><a data-toggle="modal" data-target="#article-{{articles[$index + 2].id}}"><img src="img/{{main_images[$index + 2].url}}" alt="..." class="img-responsive center-block"><h2 class="text-center">{{articles[$index + 2].title}}</h2></a></div>
          </div>
        </div>
        <div class="col-md-1">
          <!--here we should put tags, maybe need to change column size-->
        </div>
      </div>
    </div>

	<!-- Modal -->
	<div ng-repeat="article in articles" class="modal fullscreen-modal fade" id="article-{{article.id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="ag-modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h2 class="modal-title text-center" id="myModalLabel">{{article.title}}</h2>
	      </div>
	      <div class="top-space ag-modal-content">
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
                    <a ng-repeat="tag in tags" ng-class="{'btn btn-primary btn-xs tag': tag.size == 1 , 'btn btn-primary btn-sm tag': tag.size == 2,
                        'btn btn-primary tag': tag.size == 3, 'btn btn-primary btn-lg tag': tag.size == 4 } " href="tags.php?tag_id={{tag.tag.id}}">{{tag.tag.name}}</a>
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
