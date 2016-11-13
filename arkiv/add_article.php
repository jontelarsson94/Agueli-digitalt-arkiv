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
                    <label for="body">Text</label>
                    <textarea class="form-control" rows="10" cols="25" name="body" id="body" ng-model="articleData.body">{{articleData.body}}</textarea>
                  </div>
                  <div class="input_fields_wrap">
                    <button class="add_field_button">Add More Fields</button>
                    <div class="form-group"><input class="form-control" type="file" name="fileToUpload[]"></div>
                  </div>
                  <div class="form-group">
                    <label for="tags">Taggar</label>
                    <input class="form-control" type="text" name="tags">
                  </div>
                  <button type="submit" class="btn btn-default" name="submit">Submit</button>
            </form>
      </div>
    </div>

  </body>
</html>
