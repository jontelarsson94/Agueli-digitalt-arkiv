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
            <form action="api/add_article.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="text" class="form-control" name="title" id="title" ng-model="articleData.title">
                  </div>
                  <div class="form-group">
                    <label for="summary">Summary</label>
                    <textarea class="form-control" rows="4" cols="25" name="summary" id="summary" ng-model="articleData.summary">{{articleData.summary}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="image1">Optional image before section 1</label>
                    <input class="form-control" type="file" name="image1"></div>
                  <div class="form-group">
                    <label for="body1">Optional text (section 1)</label>
                    <textarea class="form-control" rows="10" cols="25" name="body1" id="body1" ng-model="articleData.body1">{{articleData.body1}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="image2">Optional image between section 1 and 2</label>
                    <input type="file" name="image2"></div>
                  <div class="form-group">
                    <label for="body2">Optional text (section 2)</label>
                    <textarea class="form-control" rows="10" cols="25" name="body2" id="body2" ng-model="articleData.body2">{{articleData.body2}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="image3">Optional image between section 2 and 3</label>
                    <input class="form-control" type="file" name="image3"></div>
                  <div class="form-group">
                    <label for="body3">Optional text (section 3)</label>
                    <textarea class="form-control" rows="10" cols="25" name="body3" id="body3" ng-model="articleData.body3">{{articleData.body3}}</textarea>
                  </div>
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
