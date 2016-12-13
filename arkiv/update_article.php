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
                <form class="ag-update-border" action="api/update_title.php" method="post">
                  <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="hidden" value="{{article_id}}" name="article_id" id="article_id">
                    <input type="text" class="form-control" name="title" id="title" value="{{article.title}}">
                    <button type="submit" class="btn btn-primary">Update Title</button>
                  </div>
                  </form>
                  <form class="ag-update-border" action="api/update_summary.php" method="post">
                  <div class="form-group">
                    <label for="summary">Summary</label>
                    <input type="hidden" value="{{article_id}}" name="article_id" id="article_id">
                    <textarea class="form-control" rows="4" cols="25" name="summary" id="summary">{{article.summary}}</textarea>
                    <button type="submit" class="btn btn-primary">Update Summary</button>
                  </div>
                  </form>
                  <form class="ag-update-border" action="api/update_cardImage.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                  <img class="img-thumbnail ag-small-img" src="img/{{card_image.url}}"></img>
                  <label>Current Card Image</label>
                  <br><br>
                  <input type="hidden" value="{{article_id}}" name="article_id" id="article_id">
                    <label for="image1">Choose image and click update if you want to update card image</label>
                    <input class="form-control" type="file" name="cardImage" id="cardImage">
                    <button type="submit" class="btn btn-primary">Update Card Image</button><br><br><br>
                  </div>
                  </form>
                  <div class="form-group">
                  <div ng-repeat="body in bodies">
                  <form class="ag-update-border" action="api/update_body.php" method="post">
                  <input type="hidden" value="{{article_id}}" name="article_id" id="article_id">
                  <input type="hidden" value="{{$index}}" name="index" id="index">
                    <label for="body[]">Write text and click update to update text to section {{$index+1}}</label>
                      <textarea class="form-control" rows="4" cols="25" name="body[]" id="body[]">{{body.body}}</textarea>
                      <button type="submit" class="btn btn-primary">Update Text at section {{$index+1}}</button>
                      <br><br><br>
                  </form>
                  </div>
                  </div>
                  <div class="form-group">
                    <div ng-repeat="body_image in body_images">
                    <form class="ag-update-border" action="api/update_bodyImage.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="{{article_id}}" name="article_id" id="article_id">
                    <input type="hidden" value="{{$index}}" name="index" id="index">
                      <img class="img-thumbnail ag-small-img" src="img/{{body_image.url}}"></img>
                      <label>Current Image before section {{$index+1}}</label>
                      <br><br>
                      <label for="image[]">Choose image and click update if you want to update image before section {{$index+1}}</label>
                      <input class="form-control" type="file" name="image[]" id="image[]">
                      <button type="submit" class="btn btn-primary">Update image before section {{$index+1}}</button>
                      <br><br><br>
                    </form>
                    </div>
                  </div>
                  <div class="form-group">
                    <div ng-repeat="image in images">
                    <form class="ag-update-border" action="api/update_bottomImage.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="{{article_id}}" name="article_id" id="article_id">
                    <input type="hidden" value="{{$index}}" name="index" id="index">
                      <img class="img-thumbnail ag-small-img" src="img/{{image.url}}"></img>
                      <label>Current image at bottom of article</label>
                      <br><br>
                      <label for="fileToUpload[]">Choose image and click update to update image at bottom of article</label>
                      <input class="form-control" type="file" name="fileToUpload[]" id="fileToUpload[]">
                      <button type="submit" class="btn btn-primary">Update image at bottom</button>
                      <br><br><br>
                    </form>
                    </div>
                  </div>
          </div>
      </div>
    </div>

  </body>
</html>
