<html>
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
          <div class="col span_12_of_12" ng-init="getArticles()">
            <ul>
              <li ng-repeat="article in articles">
                {{article.title}}
              </li>
            </ul>
          </div>
      </div>
      <div class="col span_2_of_12"></div>
    </div>

  </body>
</html>
