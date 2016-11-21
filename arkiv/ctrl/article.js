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
        $scope.main_images = response.main_images;
        $scope.articles_message = response.message;
      }else {
        $scope.articles_error = response.error;
      }
    });
  }

  $scope.getRandomTags = function (){
    $http.get("api/get_random_tags.php")
    .success(function (response) {
      if(response.success == true){
        $scope.random_tags = response.tags;
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

  $scope.getArticle = function (id){
    $http.get("api/get_article_for_id.php?article_id="+id)
    .success(function (response) {
      if(response.success == true){
        $scope.image1 = response.image1;
        $scope.image2 = response.image2;
        $scope.image3 = response.image3;
        $scope.article = response.article;
        $scope.tags = response.tags;
        $scope.images = response.images;
        $scope.article_message = response.message;
      }else {
        $scope.article_error = response.error;
      }
    });
  }


});

$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="form-group"><input class="form-control" type="file" name="fileToUpload[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
