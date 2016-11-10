<html ng-app="article" ng-controller="articleCtrl">
  <head>
    <meta charset="utf-8">
    <title>Add article</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="lib/js/angular.min.js"></script>
    <script src="lib/js/jquery.min.js"></script>
    <script src="ctrl/article.js"></script>
  </head>
  <body ng-app="article" ng-controller="articleCtrl">



    <div class="section group">
      <div class="col span_2_of_12"></div>
      <div class="col span_8_of_12">
          <div class="col span_12_of_12">
            <form action="api/add_article.php" method="post" enctype="multipart/form-data">
                  <input type="text" class="" name="title" id="title" ng-model="articleData.title">
                  <textarea rows="5" cols="25" name="body" id="body" ng-model="articleData.body">{{articleData.body}}</textarea>
                  <div class="input_fields_wrap">
                    <button class="add_field_button">Add More Fields</button>
                    <div><input type="file" name="fileToUpload[]"></div>
                  </div>
                  <input type="text" name="tags">
                  <button type="submit" name="submit">Submit</button>
            </form>
            {{formMessage}}
          </div>
      </div>
      <div class="col span_2_of_12"></div>
    </div>

  </body>
</html>
