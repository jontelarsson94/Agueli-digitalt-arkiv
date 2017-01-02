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
  <body id="dynamicBody" ng-app="admin" ng-controller="adminCtrl">
    <?php require_once 'inc/navbar.php'; ?>
<div class="container-fluid">
  <div class="col-md-8 col-md-offset-2">
        <h3>Lägg till användare</h3>
        <div class="form-group">
        <br>
          <form action="api/add_user.php" method="post">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email" id="email" placeholder="Email">
              <br>
              <label for="password1">Lösenord:</label>
              <input type="password" class="form-control" name="password1" id="password1" placeholder="Lösenord">
              <br>
              <label for="password2">Skriv in lösenordet igen:</label>
              <input type="password" class="form-control" name="password2" id="password2" placeholder="Lösenord">
              <br>
              <label for="admin">Roll:</label>
              <div class="radio">
                <label><input type="radio" name="admin" value="Admin">Admin</label>
              </div>
              <div class="radio">
                <label><input type="radio" name="admin" checked="checked" value="Editor">Editor</label>
              </div>
              <br><br>
              <div class="col-md-4 col-md-offset-4">
                <button type="submit" class="col-md-12 btn btn-primary">Lägg till</button>
              </div>
          </form>
        </div>
  </div>
</div>

  </body>
</html>