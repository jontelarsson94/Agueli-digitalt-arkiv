angular.module('add_article', []).controller('add_articleCtrl', function($scope, $http) {

	$scope.tagData = [];
  $scope.addTagData = {};
  $scope.articleData = {};

  $scope.addTag = function (id){
    //$scope.tagData = $scope.tagData + "," + id;
    $scope.tagData.push(id);
    //alert($scope.tagData);
  }

  $scope.removeTag = function (id){
    for(var i=0;i<$scope.tagData.length;i++) {
      if($scope.tagData[i] == id){
        $scope.tagData.splice(i, 1);
      }
    }
  }

  $scope.addTagForArticleText = function(id) {
    $http({
          method  : 'POST',
          url     : 'api/add_tag_for_article_text.php?article_id=' + id,
          data    : $.param($scope.addTagData),
          headers : {'Content-Type': 'application/x-www-form-urlencoded'}
         })
    .success(function(data) {
        if (!data.success) {
          // if not successful, bind errors to error variables
          //$scope.errorTag = data.errors;
        } else {
          $scope.formMessageCategory = data.message;
          $scope.addTagData.tag = "";
          $scope.getTagsForArticle(id);
        }
      });
  }

  $scope.updateTitle = function(id) {
    $http({
          method  : 'POST',
          url     : 'api/update_title.php?article_id=' + id,
          data    : $.param($scope.article),
          headers : {'Content-Type': 'application/x-www-form-urlencoded'}
         })
    .success(function(data) {
        if (!data.success) {
          // if not successful, bind errors to error variables
          $scope.errorTitle = "Du måste ha en titel";
          $scope.errorSummary = "";
        } else {
          $scope.errorSummary = "";
          $scope.errorTitle = "Uppdaterat titel!";
          //alert(JSON.stringify(data.title));
          //alert(JSON.stringify(data.article_id));
        }
      });
  }

  $scope.updateSummary = function(id) {
    $http({
          method  : 'POST',
          url     : 'api/update_summary.php?article_id=' + id,
          data    : $.param($scope.article),
          headers : {'Content-Type': 'application/x-www-form-urlencoded'}
         })
    .success(function(data) {
        if (!data.success) {
          alert("hej");
          $scope.errorTitle = "";
          // if not successful, bind errors to error variables
          //$scope.errorTitle = "Du måste ha en titel";
        } else {
          $scope.errorTitle = "";
          $scope.errorSummary = "Uppdaterat sammanfattning!";
          //alert(JSON.stringify(data.title));
          //alert(JSON.stringify(data.article_id));
        }
      });
  }

  $scope.addTextToArticle = function (articleId, index){
    $http({
      url : "api/add_text_to_article.php?index="+index+"&article_id="+articleId,
      method : "POST"
    }).success(function (response) {
      if(response.success == true){
        $scope.getArticle(articleId); // för att visa nytt resultat efter borttagning av en tag
      }else {
        //$scope.tag_error = response.errors.exists;
      }
    });
  }

  $scope.addImageToArticle = function (articleId, index){
    $http({
      url : "api/add_image_to_article.php?index="+index+"&article_id="+articleId,
      method : "POST"
    }).success(function (response) {
      if(response.success == true){
        $scope.getArticle(articleId); // för att visa nytt resultat efter borttagning av en tag
      }else {
        //$scope.tag_error = response.errors.exists;
      }
    });
  }

  $scope.addGalleryImageToArticle = function (articleId, index){
    $http({
      url : "api/add_galleryImage_to_article.php?index="+index+"&article_id="+articleId,
      method : "POST"
    }).success(function (response) {
      if(response.success == true){
        $scope.getArticle(articleId); // för att visa nytt resultat efter borttagning av en tag
      }else {
        //$scope.tag_error = response.errors.exists;
      }
    });
  }

  $scope.getTagsToAdd = function (articleId){
    $http.get("api/get_tags_to_add.php?article_id="+articleId)
    .success(function (response) {
      if(response.success == true){
        $scope.updateTags = response.result;
      }else {
        //alert('error');
      }
    });
  }

  $scope.getTagsForArticle = function (id){
    $http.get("api/get_tags_for_article.php?article_id=" + id)
    .success(function (response) {
      if(response.success == true){ 
      	$scope.article_tags = response.result; 
        $scope.getTagsToAdd(id);
      }else {
      }
    });
  }

$scope.addTagForArticle = function (tagId, articleId){
    $http({
      url : "api/add_tag_for_article.php?tag_id="+tagId+"&article_id="+articleId,
      method : "POST"
    }).success(function (response) {
      if(response.success == true){
        $scope.getTagsForArticle(articleId); // för att visa nytt resultat efter borttagning av en tag
        $scope.getTagsToAdd(articleId);
      }else {
        $scope.tag_error = response.errors.exists;
      }
    });
  }

  $scope.getArticle = function (id){
    $http.get("api/get_article_for_id.php?article_id="+id)
    .success(function (response) {
      if(response.success == true){
        $scope.article = response.article;
        $scope.articleData.title = $scope.article.title;
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

$scope.removeTagForArticle = function (tagId, articleId){
    $http({
      url : "api/remove_tag_for_article.php?tag_id="+tagId+"&article_id="+articleId,
      method : "POST"
    }).success(function (response) {
      if(response.success == true){
        $scope.getTagsForArticle(articleId); // för att visa nytt resultat efter borttagning av en tag
      }else {
        $scope.tag_error = response.errors.exists;
      }
    });
  }

});


$(document).ready(function() {
    var max_fields      = 8; //maximum input boxes allowed
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

    var max_fields_body      = 10; //maximum input boxes allowed
    var wrapper_body         = $(".body_fields_wrap"); //Fields wrapper
    var add_button_body      = $(".add_body_button"); //Add button ID

    var x_body = 1; //initlal text box count
    $(add_button_body).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_body < max_fields_body){ //max input box allowed
            x_body++; //text box increment
            $(wrapper_body).append('<div class="form-group"><label for="body[]">Frivillig text (sektion ' + x_body + ')</label><textarea class="form-control" rows="10" cols="25" name="body[]"></textarea><br><label for="image[]">Frivillig bild efter sektion ' + x_body + '</label><input class="form-control" type="file" name="image[]"><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });

    $(wrapper_body).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_body--;
    })

    $( "#add-article-form" ).submit(function( event ) {
      if(document.getElementById("cardImage").value == "") {
        var r = confirm("You havent choosen an image for your card, it will not look very nice.\nAre you sure you want to continue?");
        if (r == true) {
        } else {
          event.preventDefault();
        }
     }
     if(document.getElementById("title").value == ""){
        event.preventDefault();
        alert("You need to input a title!");
     }
    });

    $( "#deleteArticle" ).submit(function( event ) {
      
        var r = confirm("Are you sure you want to delete this article?");
        if (r == true) {
        } else {
          event.preventDefault();
        }

    });
});
