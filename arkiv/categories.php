<html>
  <head>
    <meta charset="utf-8">
    <title>Add article</title>
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="lib/js/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.1/angular-sanitize.min.js"></script>
    <script src="lib/js/jquery.min.js"></script>
    <script src="lib/js/bootstrap.min.js"></script>
    <script src="ctrl/categories.js"></script>
  </head>
  <div class="col-md-12 ag-white-bg"><img src="img/logo/agueli_logo.png"></div>
  <body ng-app="categories" ng-controller="categoriesCtrl" ng-init="category_id=<?if(empty($_REQUEST['category_id'])){echo -1;}else{echo $_REQUEST['category_id'];}?>" ng-cloak>
    <?php require_once 'inc/navbar.php'; ?>
    <div class="container-fluid">

    <!--The interface for all categories -->
      <ul ng-if="category_id == -1" ng-init="getCategories()" class="list-group">
        <li ng-repeat="category in categories" class="list-group-item col-md-3"><a href="categories.php?category_id={{category.id}}">{{category.name}}</a></li>
      </ul>

    <!-- the interface for specific category -->
      <ul ng-if="category_id != -1" ng-init="getTagsForCategory(category_id)" class="list-group">
        <li ng-repeat="tag in category_tags" class="list-group-item col-md-2"><a>{{tag.name}}</a><span ng-click="removeTagForCategory(tag.id, category_id)" class="glyphicon glyphicon-remove pull-right fake-button"></span></li>
      </ul>
      <br><br>
      <div class="row">
        <form class="col-md-4 col-md-offset-4" role="form" ng-submit="addTagForCategory();" class="form-inline">
          <input type="text" class="form-control" placeholder="Tag name" name="tag" id="tag" ng-model="tagData.tag">
          <button type="submit" class="btn btn-default">Add tag</button>
        </form>
      </div>

    </div>
  </body>