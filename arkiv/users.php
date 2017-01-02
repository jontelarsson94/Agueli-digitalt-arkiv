

<html>
  <head>
    <meta charset="utf-8">
    <title>Användare</title>
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="lib/js/angular.min.js"></script>
    <script src="lib/js/jquery.min.js"></script>
    <script src="lib/js/bootstrap.min.js"></script>
    <script src="ctrl/admin.js"></script>
  </head>
  <div class="col-md-12 ag-white-bg"><img src="img/logo/agueli_logo.png"></div>
  <body id="dynamicBody" ng-app="admin" ng-controller="adminCtrl">
    <?php require_once 'inc/navbar.php'; ?>
<div class="container-fluid" ng-init="getUsers()">
  <div class="col-md-8 col-md-offset-2">
        <h3>Användare</h3>
        <div class="col-md-12">
          <ul class="list-group">
            <li ng-repeat="user in users" class="list-group-item"><a>{{user.email}}</a><span ng-click="removeUser(user.id)" class="glyphicon glyphicon-remove pull-right fake-button ag-red"></span></li>
          </ul>
        </div>
  </div>
</div>

  </body>
</html>