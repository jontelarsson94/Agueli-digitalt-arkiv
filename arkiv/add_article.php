<html ng-app="article" ng-controller="articleCtrl">
  <head>
    <meta charset="utf-8">
    <title>Add article</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="lib/js/angular.min.js"></script>
    <script src="lib/js/jquery.min.js"></script>
  </head>
  <body>

    <div class="section group">
      <div class="col span_2_of_12"></div>
      <div class="col span_8_of_12">
          <div class="col span_12_of_12">
            <form action="api/add_article.php" method="post">
                  <input type="text" class="" name="title" id="title">
                  <textarea rows="5" cols="25" name="body" id="body"></textarea>
                  <button type="submit" name="submit">Submit</button>
            </form>
          </div>
      </div>
      <div class="col span_2_of_12"></div>
    </div>

  </body>
</html>
