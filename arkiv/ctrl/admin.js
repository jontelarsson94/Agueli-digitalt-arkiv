angular.module('admin', []).controller('adminCtrl', function($scope, $http) {

$scope.getUsers = function (){
    $http.get("api/get_users.php")
    .success(function (response) {
      if(response.success == true){
        $scope.users = response.users;
      }else {
        $scope.articles_error = response.error;
      }
    });
  }

$scope.removeUser = function (id){
    $http({
      url : "api/remove_user.php?id="+id,
      method : "POST"
    }).success(function (response) {
      if(response.success == true){
        $scope.getUsers(); // för att visa nytt resultat efter borttagning av en användare
      }else {
        $scope.tag_error = response.errors.exists;
      }
    });
  }

});
