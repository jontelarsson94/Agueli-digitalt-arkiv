<html ng-app="article" ng-controller="articleCtrl">
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
  <body ng-app="article" ng-controller="articleCtrl">



    <div class="row">
      <div class="col-md-8 col-md-offset-2">
            <form action="api/add_article.php" id="add-article-form" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="text" class="form-control" name="title" id="title" ng-model="articleData.title">
                  </div>
                  <div class="form-group">
                    <label for="summary">Summary</label>
                    <textarea class="form-control" rows="4" cols="25" name="summary" id="summary" ng-model="articleData.summary"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="image1">Choose your image to show on the card (VERY RECOMMENDED)</label>
                    <input class="form-control" type="file" name="cardImage" id="cardImage"></div>
                  <div class="form-group">
                    <label for="image1">Optional image before section 1</label>
                    <input class="form-control" type="file" name="image1"></div>
                  <div class="form-group">
                    <label for="body[]">Optional text (section 1)</label>
                    <textarea class="form-control" rows="10" cols="25" name="body[]"></textarea>
                  </div>
                  <div class="body_fields_wrap">
                    <button class="add_body_button">Add more sections of image and text</button>
                  </div>
                  <br>
                  <div class="input_fields_wrap">
                    <button class="add_field_button">Add more fields for gallery images</button>
                    <div class="form-group"><input class="form-control" type="file" name="fileToUpload[]"></div>
                  </div>
                  <div class="form-group">
                    <label for="tags">Tags</label>
                    <input class="form-control" type="text" name="tags">
                  </div>
                  <button type="submit" class="btn btn-default" name="submit">Submit</button>
            </form>
      </div>
    </div>
    </div>
    </div>
    </div>

  </body>
</html>
