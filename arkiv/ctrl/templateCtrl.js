angular.module('profile', ['mgcrea.ngStrap']).controller('profileCtrl', function($scope, $http) {

//Get function
  $scope.getCategories = function (){
    $http.get("api/get_categories.php")
    .success(function (response) {
      if(response.success == true){
        $scope.categories = response.result;
        $scope.categories_message = response.message;
      }else {
        $scope.categories_error = response.error;
      }
    });
  }

//Post function with parameters
  $scope.removeSkill = function (skillId, userId){

//setting parameters inside scope
    $scope.sId = skillId;
    $scope.usrId = userId;

    $http({
      //using scope variables to remove the right skill
      url : "api/remove_skill_for_user.php?skill_id="+$scope.sId+"&user_id="+$scope.usrId,
      method : "POST"
    }).success(function (response) {
      if(response.success == true){
        $scope.skill = response.result;
        $scope.skill_message = response.message;
        $scope.getSkills($scope.cId); // för att visa nytt resultat efter borttagning av en skill
        $scope.skill_error = "";
        $scope.category_error = "";

      }else {
        $scope.skill_error = response.errors.exists;
        $scope.skill_e = true;
      }
    });
  }

//standard post function
  $scope.processFormFirstName = function() {

    $http({
          method  : 'POST',
          url     : 'api/change_first_name.php',
          data    : $.param($scope.firstNameData),
          headers : {'Content-Type': 'application/x-www-form-urlencoded'}
         })
    .success(function(data) {
        if (!data.success) {
          // if not successful, bind errors to error variables
          $scope.errorFirstName = data.errors.firstName;
        } else {
          $scope.formMessageFirstName = data.message;
          $scope.errorFirstName = "";
          $scope.show.firstName = false;
          $scope.getUser();
        }
      });
  };

});
