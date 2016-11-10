angular.module('article', []).controller('articleCtrl', function($scope, $http) {
  /*For post request we need to have an array with data like the variables below
  and then ng-model in html to be able to send the data with "data" in angular
  http method*/

  $scope.articleData = {};

  $scope.getArticles = function (){
    $http.get("api/get_articles.php")
    .success(function (response) {
      if(response.success == true){
        $scope.articles = response.result;
        $scope.articles_message = response.message;
      }else {
        $scope.articles_error = response.error;
      }
    });
  }

  $scope.addArticle = function() {
    $http({
          method  : 'POST',
          url     : 'api/add_article.php',
          data    : $.param($scope.articleData),
          headers : {'Content-Type': 'application/x-www-form-urlencoded'}
         })
    .success(function(data) {
      alert('success');
        if (!data.success) {
           //if not successful, bind errors to error variables
          $scope.errorTitle = data.errors.title;
          $scope.errorBody = data.errors.body;
        } else {
          $scope.formMessageArticle = data.message;
          $scope.errorArticle = "";
        }
      });
  }


});
