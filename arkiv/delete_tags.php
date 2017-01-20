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
<body ng-app="categories" ng-controller="categoriesCtrl" ng-init="category_id=<?if(empty($_REQUEST['category_id'])){echo -1;}else{echo $_REQUEST['category_id'];}?>" ng-cloak>
<?php require_once 'inc/navbar.php'; ?>
<div class="container-fluid" ng-init="getTags()">
    <!-- the interface for specific category -->
    <h3 class="col-md-2 col-md-offset-5">Radera Taggar</h3><div class="col-md-5"></div>
    <div class="row col-md-12">
        <ul class="list-group">
            <li ng-repeat="tag in tags" class="list-group-item col-md-2"><a>{{tag.name}}</a><span ng-click="removeTag(tag.id)" class="glyphicon glyphicon-remove pull-right fake-button ag-red"></span></li>
        </ul>
    </div>

</div>
</body>