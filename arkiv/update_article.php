<html>
  <head>
    <meta charset="utf-8">
    <title>Add article</title>
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="lib/js/angular.min.js"></script>
    <script src="lib/js/jquery.min.js"></script>
    <script src="lib/js/bootstrap.min.js"></script>
    <script src="ctrl/add_article.js"></script>
  </head>
  <body ng-app="add_article" ng-controller="add_articleCtrl" ng-init="article_id=<?if(empty($_REQUEST['article_id'])){echo -1;}else{echo $_REQUEST['article_id'];}?>" ng-cloak>



    <div class="row">
      <div class="col-md-8 col-md-offset-2" ng-init="getArticle(article_id)">
                <form class="ag-update-border" action="api/update_title.php" method="post">
                  <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="hidden" value="{{article_id}}" name="article_id" id="article_id">
                    <input type="text" class="form-control" name="title" id="title" value="{{article.title}}">
                    <button type="submit" class="btn btn-primary">Uppdatera titel</button>
                  </div>
                  </form>
                  <form class="ag-update-border" action="api/update_summary.php" method="post">
                  <div class="form-group">
                    <label for="summary">Sammanfattning</label>
                    <input type="hidden" value="{{article_id}}" name="article_id" id="article_id">
                    <textarea class="form-control" rows="4" cols="25" name="summary" id="summary">{{article.summary}}</textarea>
                    <button type="submit" class="btn btn-primary">Uppdatera sammanfattning</button>
                  </div>
                  </form>
                  <form class="ag-update-border" action="api/update_cardImage.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                  <img class="img-thumbnail ag-small-img" src="img/{{card_image.url}}"></img>
                  <label>Nuvarande bild på kortet</label>
                  <br><br>
                  <input type="hidden" value="{{article_id}}" name="article_id" id="article_id">
                    <label for="image1">Välj bild och klicka uppdatera för att uppdatera bilden på kortet</label>
                    <input class="form-control" type="file" name="cardImage" id="cardImage">
                    <button type="submit" class="btn btn-primary">Uppdatera bilden på kortet</button><br><br><br>
                  </div>
                  </form>
                  <div class="form-group">
                  <div ng-repeat="body in bodies">
                  <form class="ag-update-border" action="api/update_body.php" method="post">
                  <input type="hidden" value="{{article_id}}" name="article_id" id="article_id">
                  <input type="hidden" value="{{$index}}" name="index" id="index">
                    <label for="body[{{$index}}]">Ändra text och klicka uppdatera för att uppdatera texten för sektion {{$index+1}}</label>
                      <textarea class="form-control" rows="4" cols="25" name="body[{{$index}}]" id="body[{{$index}}]">{{body.body}}</textarea>
                      <button type="submit" class="btn btn-primary">Uppdatera text för sektion {{$index+1}}</button>
                      <br><br><br>
                  </form>
                  </div>
                  <div>
                    <form class="ag-update-border" action="api/add_text_to_article.php" method="post">
                      <input type="hidden" value="{{article_id}}" name="article_id" id="article_id">
                      <input type="hidden" value="{{bodies.length+1}}" name="index" id="index">
                      <button type="submit" class="btn btn-primary">Lägg till text (sektion {{bodies.length+1}})</button>
                    </form>
                  </div>
                  </div>
                  <div class="form-group">
                    <div ng-repeat="body_image in body_images">
                    <form class="ag-update-border" action="api/update_bodyImage.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="{{article_id}}" name="article_id" id="article_id">
                    <input type="hidden" value="{{$index}}" name="index" id="index">
                      <img class="img-thumbnail ag-small-img" src="img/{{body_image.url}}"></img>
                      <label>Nuvarande bild efter sektion {{$index+1}}</label>
                      <br><br>
                      <label for="image[]">Välj bild och klicka uppdatera för att uppdatera bilden efter sektion {{$index+1}}</label>
                      <input class="form-control" type="file" name="image[]" id="image[]">
                      <button type="submit" class="btn btn-primary">Uppdatera bild efter sektion {{$index+1}}</button>
                      <br><br><br>
                    </form>
                    </div>
                  </div>
                  <div>
                    <form class="ag-update-border" action="api/add_image_to_article.php" method="post">
                      <input type="hidden" value="{{article_id}}" name="article_id" id="article_id">
                      <input type="hidden" value="{{body_images.length+1}}" name="index" id="index">
                      <button type="submit" class="btn btn-primary">Lägg till bild till sektion {{body_images.length+1}}</button>
                    </form>
                  </div>
                  <div class="form-group">
                    <div ng-repeat="image in images">
                    <form class="ag-update-border" action="api/update_bottomImage.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="{{article_id}}" name="article_id" id="article_id">
                    <input type="hidden" value="{{$index}}" name="index" id="index">
                      <img class="img-thumbnail ag-small-img" src="img/{{image.url}}"></img>
                      <label>Nuvarande galleribild</label>
                      <br><br>
                      <label for="fileToUpload[{{$index}}]">Välj bild och klicka uppdatera för att uppdatera bild i galleriet</label>
                      <input class="form-control" type="file" name="fileToUpload[{{$index}}]" id="fileToUpload[{{$index}}]">
                      <button type="submit" class="btn btn-primary">Uppdatera bild i galleriet</button>
                      <br><br><br>
                    </form>
                    </div>
                  </div>
          </div>
      </div>
    </div>
    <div class="container-fluid col-md-10 col-md-offset-1 ag-update-border">
    <div class="col-md-12 row" ng-init="getTagsForArticle(article_id)">
    <h3>Nuvarande taggar för artikeln:</h3>
      <ul class="list-group">
        <li ng-repeat="article_tag in article_tags" class="list-group-item col-md-2"><a>{{article_tag.name}}</a><span ng-click="removeTagForArticle(article_tag.id, article_id)" class="glyphicon glyphicon-remove pull-right ag-red fake-button"></span></li>
      </ul>
    </div>
    <div class="row col-md-12">
      <br><br><br>
      <div>
      <br>
      <h3>Taggar du kan lägga till:</h3>
      <ul class="list-group" ng-init="getTags()">
        <li ng-repeat="tag in updateTags" class="list-group-item col-md-2">{{tag.name}}</a><span ng-click="addTagForArticle(tag.id, article_id)" class="glyphicon glyphicon-plus pull-right fake-button"></span></li>
      </ul>
      </div>
    </div>
    <div class="row col-md-12">
    <br>
      <a href="articles.php"><button class="btn btn-primary col-md-2 col-md-offset-5">Done Updating Article</button></a>
    </div>
    </div>

</html>
