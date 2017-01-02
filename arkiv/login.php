<html>
  <head>
    <meta charset="utf-8">
    <title>Logga in</title>
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="lib/js/angular.min.js"></script>
    <script src="lib/js/jquery.min.js"></script>
    <script src="lib/js/bootstrap.min.js"></script>
    <script src="ctrl/login.js"></script>
  </head>
  <div class="col-md-12 ag-white-bg"><img src="img/logo/agueli_logo.png"></div>
  <body id="dynamicBody" ng-app="login" ng-controller="loginCtrl" ng-init="getArticles(); getPopularTags(); getClickedTags()" ng-cloak>
    <?php require_once 'inc/navbar.php'; ?>
<div class="container-fluid">
  <div class="col-md-8 col-md-offset-2">
    <form ng-submit="updateTitle(article_id);" role="form">
        <h3>Logga in</h3>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email">
            <br>
            <label for="password">Lösenord:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            <br><br>
            <div class="col-md-4 col-md-offset-4">
              <button type="submit" class="col-md-12 btn btn-primary">Logga in</button>
            </div>
        </div>
    </form>
  </div>
</div>

  </body>
</html>
