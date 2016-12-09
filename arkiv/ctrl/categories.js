angular.module('categories', []).controller('categoriesCtrl', function($scope, $http) {
  /*For post request we need to have an array with data like the variables below
  and then ng-model in html to be able to send the data with "data" in angular
  http method*/

  $scope.getCategories = function (){
    $http.get("api/get_categories.php")
    .success(function (response) {
      if(response.success == true){      
        $scope.categories = response.result;
      }else {
        $scope.categories_error = response.error;
      }
    });
  }

  $scope.getTagsForCategory = function (id){
    $http.get("api/get_tags_for_categoriy.php?category_id=" + id)
    .success(function (response) {
      if(response.success == true){      
        $scope.category_tags = response.result;
      }else {
        $scope.categories_error = response.error;
      }
    });
  }

  $scope.removeTagForCategory = function (tagId, categoryId){
    $scope.cId = categoryId;
    $http({
      url : "api/remove_tag_for_category.php?tag_id="+tagId+"&category_id="+categoryId,
      method : "POST"
    }).success(function (response) {
      if(response.success == true){
        $scope.getTagsForCategory($scope.cId); // för att visa nytt resultat efter borttagning av en tag

      }else {
        $scope.tag_error = response.errors.exists;
      }
    });
  }

});