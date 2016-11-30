angular.module('article', []).controller('articleCtrl', function($scope, $http) {
  /*For post request we need to have an array with data like the variables below
  and then ng-model in html to be able to send the data with "data" in angular
  http method*/

  $scope.articleData = {};
  $scope.lastReadId = 0;
  $scope.tagData = [];
  $scope.tagDataString = ""
  $scope.page = 4;
  $scope.maxArticles = 0;
  $scope.showScrollButton = 1;

  $scope.getArticles = function (){
    $scope.isSelection = 0;
    $http.get("api/get_articles.php")
    .success(function (response) {
      if(response.success == true){
        $scope.page = 4;
        $scope.maxArticles = response.result.length;
        if($scope.page >= $scope.maxArticles){
          $scope.showScrollButton = 0;
        }
        $scope.articles = response.result;
        $scope.main_images = response.main_images;
        $scope.articles_starred = response.result_starred;
        $scope.main_images_starred = response.main_images_starred;
        $scope.articles_lastRead = response.result_lastRead;
        $scope.main_images_lastRead = response.main_images_lastRead;
        $scope.articles_message = response.message;
      }else {
        $scope.articles_error = response.error;
      }
    });
  }

  $scope.addTagToSearch = function (id){
    //$scope.tagData = $scope.tagData + "," + id;
    $scope.tagData.push(id);
    //alert($scope.tagData);
  }

  $scope.removeTagToSearch = function (id){
    for(var i=0;i<$scope.tagData.length;i++) {
      if($scope.tagData[i] == id){
        $scope.tagData.splice(i, 1);
      }
    }
  }

  $scope.loadMore = function (){
    $scope.page = $scope.page+5;
    if($scope.page >= $scope.maxArticles){
      $scope.showScrollButton = 0;
    }
  }

  $scope.lastRead = function (id){
    $scope.lastReadId = id;
  }

  $scope.lastRead = function (id){
    $scope.lastReadId = id;
    $http.get("api/set_last_read.php?lastRead="+$scope.lastReadId)
    .success(function (response) {
      if(response.success == true){
        //alert('success');
      }else {
        //alert('error');
      }
    });
  }

//should use a $scope.filter for if the user has pressed article, painting or letter
  $scope.getFilteredArticles = function (){
      $scope.tagString = ""
      for(var i=0;i<$scope.tagData.length;i++) {
        $scope.tagString = $scope.tagString + "," + $scope.tagData[i];
      }
      $http.get("api/get_filtered_articles.php?tags="+$scope.tagString)
      .success(function (response) {
        if(response.success == true){
          $scope.maxArticles = response.result.length;
          $scope.page = response.page;
          if($scope.page >= $scope.maxArticles){
            $scope.showScrollButton = 0;
          }
          else{
            $scope.showScrollButton = 1;
          }
          $scope.filterTags = response.tags;
          $scope.articles = response.result;
          $scope.main_images = response.main_images;
          $scope.articles_starred = response.result_starred;
          $scope.main_images_starred = response.main_images_starred;
          $scope.articles_lastRead = response.result_lastRead;
          $scope.main_images_lastRead = response.main_images_lastRead;
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

  $scope.addClickForTag = function (id){
    $http.get("api/add_click.php?tag_id_click="+id)
    .success(function (response) {
      if(response.success == true){
        $scope.tags = response.success
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
    $( "#add-article-form" ).submit(function( event ) {
      if(document.getElementById("cardImage").value == "") {
        var r = confirm("You havent choosen an image for your card, it will not look very nice.\nAre you sure you want to continue?");
        if (r == true) {
        } else {
          event.preventDefault();
        }
     }
    });
});
