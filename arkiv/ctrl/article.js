angular.module('article', []).controller('articleCtrl', function($scope, $http) {
  /*For post request we need to have an array with data like the variables below
  and then ng-model in html to be able to send the data with "data" in angular
  http method*/

  $scope.articleData = {};
  $scope.lastReadId = 0;
  $scope.tagData = [];
  $scope.tagDataString = ""
  $scope.page = 7;
  $scope.maxArticles = 0;
  $scope.showScrollButton = 1;
  $scope.currentChar = "";

  $scope.getArticles = function (){
    $scope.isSelection = 0;
    $http.get("api/get_articles.php")
    .success(function (response) {
      if(response.success == true){
        $scope.page = 7;
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

  $scope.getArticlesAdmin = function (){
    $scope.isSelection = 0;
    $http.get("api/get_articles_admin.php")
    .success(function (response) {
      if(response.success == true){
        $scope.articles = response.result;
        $scope.main_images = response.main_images;
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

  $scope.addOneTagToSearch = function (id){
    //$scope.tagData = $scope.tagData + "," + id;
    $scope.tagData = [];
    $scope.tagData.push(id);
    //alert($scope.tagData);
  }

  $scope.addTagToSearchFromText = function (id){
    $scope.tagData = [];
    $scope.tagData.push(id);
  }

  $scope.removeTagToSearch = function (id){
    for(var i=0;i<$scope.tagData.length;i++) {
      if($scope.tagData[i] == id){
        $scope.tagData.splice(i, 1);
      }
    }
  }

  $scope.loadMore = function (){
    $scope.page = $scope.page+7;
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

  $scope.getFilterTags = function (categoryOne_id, categoryTwo_id, categoryThree_id){
      $scope.tagString = ""
      for(var i=0;i<$scope.tagData.length;i++) {
        $scope.tagString = $scope.tagString + "," + $scope.tagData[i];
      }
      $http.get("api/get_filter_tags.php?tags="+$scope.tagString+"&categoryOne_id="+categoryOne_id+"&categoryTwo_id="+categoryTwo_id+"&categoryThree_id="+categoryThree_id)
      .success(function (response) {
        if(response.success == true){
          $scope.filterTags = response.tags;
          $scope.categoryOne_tags = response.categoryOne_tags;
          $scope.categoryTwo_tags = response.categoryTwo_tags;
          $scope.categoryThree_tags = response.categoryThree_tags;
        }else {
          $scope.articles_error = response.error;
        }
    });
  }

  $scope.getPopularTags = function (){
    $http.get("api/get_popular_tags.php")
    .success(function (response) {
      if(response.success == true){
        $scope.popular_tags = response.tags;
      }else {
        $scope.articles_error = response.error;
      }
    });
  }

  $scope.getTagsForModal = function (){
    $http.get("api/get_tags_for_modal.php")
    .success(function (response) {
      if(response.success == true){
        $scope.categoryOne = response.categoryOne;
        $scope.categoryTwo = response.categoryTwo;
        $scope.categoryThree = response.categoryThree;
        $scope.categoryOne_tags = response.categoryOne_tags;
        $scope.categoryTwo_tags = response.categoryTwo_tags;
        $scope.categoryThree_tags = response.categoryThree_tags;
        $scope.getFilterTags($scope.categoryOne.id, $scope.categoryTwo.id, $scope.categoryThree.id);
      }else {
        $scope.articles_error = response.error;
      }
    });
  }

  $scope.setCurrentChar = function(char){
    $scope.currentChar = char;
  }

  $scope.getTagsForChar = function (categoryOne, categoryTwo, categoryThree){
    if($scope.currentChar != ""){
    //alert("api/get_tags_for_char.php?char=" + char + "&categoryOne_id=" + categoryOne + "&categoryTwo_id=" + categoryTwo + "&categoryThree_id=" + categoryThree + "&tags="+$scope.tagString)
    $http.get("api/get_tags_for_char.php?char=" + $scope.currentChar + "&categoryOne_id=" + categoryOne + "&categoryTwo_id=" + categoryTwo + "&categoryThree_id=" + categoryThree + "&tags="+$scope.tagString)
    .success(function (response) {
      if(response.success == true){
        $scope.filterTags = response.tags;
        $scope.char_tags = response.char_tags;
      }else {
        $scope.articles_error = response.error;
      }
    });
  }
  }

  $scope.getTags = function (){
    $http.get("api/get_tags.php")
    .success(function (response) {
      if(response.success == true){
        $scope.tags = response.tags;
      }else {
        $scope.articles_error = response.error;
      }
    });
  }

  $scope.getClickedTags = function (){
    $http.get("api/get_clicked_tags.php")
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
        $scope.article = response.article;
        $scope.tags = response.tags;
        $scope.images = response.images;
        $scope.card_image = response.card_image;
        $scope.body_images = response.body_images;
        $scope.bodies = response.bodies;
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

angular.module('article').directive('compile', ['$compile', function ($compile) {
    return function(scope, element, attrs) {
        scope.$watch(
            function(scope) {
                // watch the 'compile' expression for changes
                return scope.$eval(attrs.compile);
            },
            function(value) {
                // when the 'compile' expression changes
                // assign it into the current DOM
                element.html(value);

                // compile the new DOM and link it to the current
                // scope.
                // NOTE: we only compile .childNodes so that
                // we don't get into infinite loop compiling ourselves
                $compile(element.contents())(scope);
            }
        );
    };
}]);