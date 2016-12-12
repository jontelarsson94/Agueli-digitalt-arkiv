angular.module('categories', []).controller('categoriesCtrl', function($scope, $http) {
  /*For post request we need to have an array with data like the variables below
  and then ng-model in html to be able to send the data with "data" in angular
  http method*/

  $scope.tagData = {};
  $scope.categoryData = {};

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
    $http.get("api/get_tags_for_category.php?category_id=" + id)
    .success(function (response) {
      if(response.success == true){   
        $scope.category = response.category;
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

  $scope.addTagForCategory = function() {

    $http({
          method  : 'POST',
          url     : 'api/add_tag_for_category.php?category=' + $scope.category_id,
          data    : $.param($scope.tagData),
          headers : {'Content-Type': 'application/x-www-form-urlencoded'}
         })
    .success(function(data) {
        if (!data.success) {
          // if not successful, bind errors to error variables
          $scope.errorTag = data.errors;
        } else {
          $scope.formMessageCategory = data.message;
          $scope.tagData.tag = "";
          $scope.getTagsForCategory($scope.category_id);
        }
      });
  }

  $scope.addCategory = function() {
    $http({
          method  : 'POST',
          url     : 'api/add_category.php',
          data    : $.param($scope.categoryData),
          headers : {'Content-Type': 'application/x-www-form-urlencoded'}
         })
    .success(function(data) {
        if (!data.success) {
          // if not successful, bind errors to error variables
          $scope.errorCategory = data.errors;
        } else {
          $scope.exists = data.exists;
          $scope.categoryData.category = "";
          $scope.getCategories();
        }
      });
  }

  $scope.removeCategory = function (categoryId){
    $http({
      url : "api/remove_category.php?category_id="+categoryId,
      method : "POST"
    }).success(function (response) {
      if(response.success == true){
        $scope.getCategories(); // för att visa nytt resultat efter borttagning av en tag
      }else {
        $scope.tag_error = response.errors.exists;
      }
    });
  }

});