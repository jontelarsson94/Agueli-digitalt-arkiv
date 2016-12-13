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
    <script src="ctrl/add_article.js"></script>
  </head>
  <body ng-app="add_article" ng-controller="add_articleCtrl" ng-init="article_id=<?if(empty($_REQUEST['article_id'])){echo -1;}else{echo $_REQUEST['article_id'];}?>" ng-cloak>



    <div class="row">
      <div class="col-md-8 col-md-offset-2" ng-init="getArticle(article_id)">
                <form action="api/update_article.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="hidden" value="{{article_id}}" name="article_id" id="article_id">
                    <input type="text" class="form-control" name="title" id="title" value="{{article.title}}">
                  </div>
                  <div class="form-group">
                    <label for="summary">Summary</label>
                    <textarea class="form-control" rows="4" cols="25" name="summary" id="summary">{{article.summary}}</textarea>
                  </div>
                  <div class="form-group">
                  <img class="img-thumbnail ag-small-img" src="img/{{card_image.url}}"></img>
                  <label>Current Card Image</label>
                  <br><br>
                    <label for="image1">Choose image if you want to update card image</label>
                    <input class="form-control" type="file" name="cardImage" id="cardImage"><br><br><br>
                  </div>
                  <div class="form-group" ng-if="body_images.length > bodies.length">
                    <div ng-repeat="body_image in body_images">
                      <img class="img-thumbnail ag-small-img" src="img/{{body_image.url}}"></img>
                      <label>Current Image for section {{$index+1}}</label>
                      <br><br>
                    </div>
                  </div>
                  <div class="form-group" ng-if="body_images.length <= bodies.length">
                    <div ng-repeat="body_image in body_images">
                      <img class="img-thumbnail ag-small-img" src="img/{{body_image.url}}"></img>
                      <label>Current Image before section {{$index+1}}</label>
                      <br><br>
                      <label for="image[]">Choose image if you want to update image before section {{$index+1}}</label>
                      <input class="form-control" type="file" name="image[]" id="image[]"></div>
                      <br><br><br>
                    </div>
                  </div>
                </form>
          </div>
      </div>
    </div>

  </body>
</html>
