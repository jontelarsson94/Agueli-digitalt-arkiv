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
  <body ng-app="add_article" ng-controller="add_articleCtrl">



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
                  <div class="body_fields_wrap">
                    <div class="form-group">
                    <label for="image[]">Optional image before section 1</label>
                    <input class="form-control" type="file" name="image[]"></div>
                  <div class="form-group">
                    <label for="body[]">Optional text (section 1)</label>
                    <textarea class="form-control" rows="10" cols="25" name="body[]"></textarea>
                  </div>
                  </div>
                  <button class="add_body_button">Add more sections of image and text</button>
                  <div class="input_fields_wrap">
                  <br><br>
                    <div class="form-group"><input class="form-control" type="file" name="fileToUpload[]"></div>
                  </div>
                  <button class="add_field_button">Add more fields for gallery images</button>
                  <div class="form-group">
                    <br><br>
                    <label>Add as favorite:</label>
                    <label class="radio-inline"><input type="radio" name="favorite" value="1">Yes</label>
                    <label class="radio-inline"><input type="radio" name="favorite" value="0" checked="checked">No</label>
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
