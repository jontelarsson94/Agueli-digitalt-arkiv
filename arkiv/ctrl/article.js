  var app = angular.module('article', []);
  app.controller('articleCtrl', function getArticles($scope, $http) {
      $http.get("api/get_articles.php")
      .success(function successCallback(response) {
          $scope.articles = response.result;
      },function errorCallback(response) {
          $scope.errors = response.errors;
    });
  });
