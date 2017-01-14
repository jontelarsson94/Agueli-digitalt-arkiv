

<html>
  <head>
    <meta charset="utf-8">
    <title>Add article</title>
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/rzslider.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="lib/js/jquery.min.js"></script>
    <script src="lib/js/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.1/angular-sanitize.min.js"></script>
    <script src="lib/js/rzslider.min.js"></script>
    <script src="lib/js/bootstrap.min.js"></script>
    <script src="ctrl/article.js"></script>
  </head>
  <div class="col-md-12 ag-white-bg"><img src="img/logo/agueli_logo.png"></div>
  <body id="dynamicBody" ng-app="article" ng-controller="articleCtrl" ng-init="getArticles(); getPopularTags(); getClickedTags()" ng-cloak>
    <?php require_once 'inc/navbar.php'; ?>
<div class="container-fluid">
  <div class="col-md-4 col-md-offset-4">
  <div ng-if="timeline" class="ag-white-bg ag-tag-padding" ng-init="getSlider()">
    <rzslider
      rz-slider-model="slider.min"
      rz-slider-high="slider.max"
      rz-slider-options="slider.options">
    </rzslider>
  </div>
    <div ng-if="!timeline">
        <div class="col-md-8">
        <button ng-repeat="filterTag in filterTags" ng-click="removeTagToSearch(filterTag.id); getFilteredArticles()" class="skill">{{filterTag.name}} <span class="glyphicon fake-button glyphicon-remove"></span></button>
        <button ng-if="filterTags.length > 0" data-target="#tagModal" data-toggle="modal" ng-click="getTagsForModal()" class="skill">Tagg<span class="glyphicon glyphicon-plus pull-left"></span></button>
        </div>
        <br><br>
    </div>
    <br>
  </div>
    <div class="row-fluid" ng-init="getArticles()">
      <div class="col-md-12">
        <div class="col-md-10">
          <div ng-repeat="article in articles | limitTo:page">
            <div ng-if="article.starred == 1 && article.read == 0" ng-init="divideHeadline(article.title)" class="col-lg-3 col-md-6"><div ng-click="getArticle(article.id); lastRead(article.id);" data-target="#myModal" data-toggle="modal"><a href=""><img src="img/{{main_images[$index].url}}" alt="..." class="img-responsive ag-img-thumbnail ag-big-div ag-card-image"><div class="transparent"><h4 class="ag-overlay-text">{{article.title.substring(0, 24)}}</h4><h4 class="ag-overlay-text">{{article.title.substring(24, 48)}}</h4></div><span class="pull-right glyphicon glyphicon-star ag-glyph-overlay"></span></img></a></div></div>
            <div ng-if="article.starred == 0 && article.read == 0" ng-init="divideHeadline(article.title)" class="col-lg-3 col-md-6"><div ng-click="getArticle(article.id); lastRead(article.id);" data-target="#myModal" data-toggle="modal"><a href=""><img src="img/{{main_images[$index].url}}" alt="..." class="img-responsive ag-img-thumbnail ag-big-div ag-card-image"><div class="transparent"><h4 class="ag-overlay-text">{{article.title.substring(0, 24)}}</h4><h4 class="ag-overlay-text">{{article.title.substring(24, 48)}}</h4></div><span class="pull-right glyphicon ag-glyph-overlay"></span></img></a></div></div>
            <div ng-if="article.read == 1" ng-init="divideHeadline(article.title)" class="col-lg-3 col-md-6"><div ng-click="getArticle(article.id); lastRead(article.id);" data-target="#myModal" data-toggle="modal"><a href=""><img src="img/{{main_images[$index].url}}" alt="..." class="img-responsive ag-img-thumbnail ag-big-div ag-card-image"><div class="transparent"><h4 class="ag-overlay-text">{{article.title.substring(0, 24)}}</h4><h4 class="ag-overlay-text">{{article.title.substring(24, 48)}}</h4></div><span class="pull-right glyphicon glyphicon-eye-open ag-glyph-overlay"></span></img></a></div></div>

          </div>
        </div>
        <div class="col-md-2">
          <button ng-if="lastReadId != 0" data-toggle="modal" data-target="#myModal" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left"></span> Senast lästa</button>
          <h4 ng-if="!timeline" class="ag-yellow">Föreslagna taggar:</h4>
          <span ng-if="!timeline" name="tag" ng-repeat="popular_tag in popular_tags | orderBy : 'tag.name'" ng-class="{'fake-button ag-xs ag-white tag': popular_tag.size == 1 , 'fake-button ag-sm ag-white tag': popular_tag.size == 2,
              'fake-button ag-md ag-white tag': popular_tag.size == 3, 'fake-button ag-lg ag-white tag': popular_tag.size == 4 } " ng-click="gotoTop(); addClickForTag(popular_tag.tag.id); addOneTagToSearch(popular_tag.tag.id); getFilteredArticles()">{{popular_tag.tag.name}} </span>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div ng-if="showScrollButton == 1" class="col-md-2 col-md-offset-5"><button class="btn btn-default" ng-click="loadMore()">Load more</button></div>

	<!-- Modal -->
	<div class="modal fullscreen-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content ag-background-header-transparent">
	      <div class="ag-modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h2 class="modal-title text-center" id="myModalLabel">{{article.title}}</h2>
	      </div>
	      <div class="top-space ag-modal-content ag-background-transparent ag-white">
          <div class="container-fluid">
                <div class="col-md-11 col-md-offset-1">
                  <div class="col-md-7">
                    <br>
                    <div ng-repeat="body in bodies">
                      <p class="ag-black">{{body.body}}</p>
                      <div ng-repeat="image in body_images" ng-if="image.section == body.section && image.url != NULL">
                        <img src="img/{{image.url}}" alt="..." class="img-responsive center-block thumbnail">
                      </div>
                    </div>
                    <div ng-if="bodies.length < body_images.length" ng-repeat="image in body_images">
                        <img ng-if="$index >= bodies.length" src="img/{{image.url}}" alt="..." class="img-responsive center-block thumbnail">
                    </div>
                  </div>
                  <div class="col-md-4 col-md-offset-1">
                    <h4>Taggar:</h4>
                    <span ng-repeat="tag in tags | orderBy : 'tag.name'" data-dismiss="modal" ng-class="{'fake-button ag-xs tag ag-black': tag.size == 1 , 'fake-button ag-sm tag ag-black': tag.size == 2,
                        'fake-button ag-md tag ag-black': tag.size == 3, 'fake-button ag-lg tag ag-black': tag.size == 4 } " ng-click="gotoTop(); lastRead(article.id); addClickForTag(tag.tag.id); addOneTagToSearch(tag.tag.id); getFilteredArticles()">{{tag.tag.name}} </span>
                  </div>
	      </div>
	      <div class="modal-footer">
          <div class="col-md-7 col-md-offset-1">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-3" ng-repeat="image in images" ng-if="$index < 4">
                <a ng-if="image.url != NULL" target="_blank" href="img/{{image.url}}"><img class="img-responsive thumbnail" src="img/{{image.url}}" alt="gallery-image"/></a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-3" ng-repeat="image in images" ng-if="$index >= 4">
                <a ng-if="image.url != NULL" target="_blank" href="img/{{image.url}}"><img class="img-responsive thumbnail" src="img/{{image.url}}" alt="gallery-image"/></a>
              </div>
            </div>
          </div>
	      </div>
      </div>
	    </div>
	  </div>
	</div>
  </div>
  </div>

  <!-- Modal -->
  <div class="modal fullscreen-modal fade" id="tagModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content ag-background-header-transparent">
        <div class="ag-modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h2 class="modal-title text-center" id="myModalLabel">Taggar</h2>
        </div>
        <div class="top-space ag-modal-content ag-background-transparent-dark">
          <div class="container-fluid">
                <div class="col-md-10 col-md-offset-1">
                <br><br>
                <div class="col-md-12 ag-border">
                  <h4 class="text-center ag-padding-bottom">Valda taggar:</h4>
                  <div class="col-md-6 col-md-offset-3 row">
                  <button ng-repeat="filterTag in filterTags" ng-click="removeTagToSearch(filterTag.id); getFilterTags(categoryOne.id, categoryTwo.id, categoryThree.id); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" class="skill">{{filterTag.name}} <span class="glyphicon fake-button glyphicon-remove"></span></button>
                  </div>
                </div>
                <button ng-click="getFilteredArticles()" data-dismiss="modal" class="btn btn-default col-md-2 col-md-offset-5 ag-padding-top">Klar</button>
                </div>
                <div class="col-md-12 row">
                <div class="col-md-3 col-md-offset-1">
                <h3 class="ag-yellow">{{categoryOne.name}}</h3>
                  <span ng-repeat="categoryOne_tag in categoryOne_tags | orderBy : 'tag.name'" class="fake-button ag-white" ng-click="gotoTop(); addClickForTag(categoryOne_tag.id); addTagToSearch(categoryOne_tag.id); getFilterTags(categoryOne.id, categoryTwo.id, categoryThree.id); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)"><span ng-class="{'ag-xs': categoryOne_tag.size == 1 , 'ag-sm': categoryOne_tag.size == 2, 'ag-md': categoryOne_tag.size == 3, 'ag-lg': categoryOne_tag.size == 4 }"><span ng-if="categoryOne_tag.articlesExists==1 && categoryOne_tag.tagExists==0">{{categoryOne_tag.name}} </span> <span ng-if="categoryOne_tag.tagExists==1" class="ag-yellow">{{categoryOne_tag.name}} </span> <span ng-if="categoryOne_tag.articlesExists==0 && categoryOne_tag.tagExists!=1" class="ag-stroke">{{categoryOne_tag.name}} </span></span></span>
                </div>
                <div class="col-md-3 col-md-offset-1">
                <h3 class="ag-yellow">{{categoryTwo.name}}</h3>
                <span ng-repeat="categoryTwo_tag in categoryTwo_tags | orderBy : 'tag.name'" class="fake-button ag-white" ng-click="gotoTop(); addClickForTag(categoryTwo_tag.id); addTagToSearch(categoryTwo_tag.id); getFilterTags(categoryOne.id, categoryTwo.id, categoryThree.id); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)"><span ng-class="{'ag-xs': categoryTwo_tag.size == 1 , 'ag-sm': categoryTwo_tag.size == 2, 'ag-md': categoryTwo_tag.size == 3, 'ag-lg': categoryTwo_tag.size == 4 }"><span ng-if="categoryTwo_tag.articlesExists==1 && categoryTwo_tag.tagExists==0">{{categoryTwo_tag.name}} </span> <span ng-if="categoryTwo_tag.tagExists==1" class="ag-yellow">{{categoryTwo_tag.name}} </span> <span ng-if="categoryTwo_tag.articlesExists==0 && categoryTwo_tag.tagExists!=1" class="ag-stroke">{{categoryTwo_tag.name}} </span></span></span>
                </div>
                <div class="col-md-3 col-md-offset-1">
                <h3 class="ag-yellow">{{categoryThree.name}}</h3>
                <span ng-repeat="categoryThree_tag in categoryThree_tags | orderBy : 'tag.name'" class="fake-button ag-white" ng-click=" gotoTop();addClickForTag(categoryThree_tag.id); addTagToSearch(categoryThree_tag.id); getFilterTags(categoryOne.id, categoryTwo.id, categoryThree.id); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)"><span ng-class="{'ag-xs': categoryThree_tag.size == 1 , 'ag-sm': categoryThree_tag.size == 2, 'ag-md': categoryThree_tag.size == 3, 'ag-lg': categoryThree_tag.size == 4 }"><span ng-if="categoryThree_tag.articlesExists==1 && categoryThree_tag.tagExists==0">{{categoryThree_tag.name}} </span> <span ng-if="categoryThree_tag.tagExists==1" class="ag-yellow">{{categoryThree_tag.name}} </span> <span ng-if="categoryThree_tag.articlesExists==0 && categoryThree_tag.tagExists!=1" class="ag-stroke">{{categoryThree_tag.name}} </span></span></span>
                </div>

                <div class="col-md-12 row">
          <br><br><br>
          <ul class="ag-line-list">
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('A'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">A</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('B'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">B</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('C'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">C</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('D'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">D</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('E'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">E</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('F'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">F</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('G'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">G</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('H'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">H</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('I'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">I</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('J'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">J</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('K'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">K</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('L'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">L</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('M'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">M</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('N'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">N</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('O'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">O</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('P'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">P</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('Q'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">Q</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('R'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">R</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('S'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">S</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('T'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">T</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('U'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">U</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('V'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">V</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('W'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">W</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('X'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">X</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('Y'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">Y</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('Z'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">Z</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('Å'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">Å</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('Ä'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">Ä</a>
            </li>
            <li>
              <a class="ag-yellow" ng-click="setCurrentChar('Ö'); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)" href="">Ö</a>
            </li>
          </ul>
          </div>
          <div class="col-md-12">
            <h2 class="col-md-1 ag-white">{{currentChar}}</h2>
            <div class="col-md-11"></div>
          </div>
          <div class="col-md-12">
          <div class="col-md-4">
            <span ng-repeat="char_tag in char_tags | orderBy : 'tag.name'" class="fake-button ag-white" ng-click="gotoTop(); addClickForTag(char_tag.id); addTagToSearch(char_tag.id); getFilterTags(categoryOne.id, categoryTwo.id, categoryThree.id); getTagsForChar(categoryOne.id, categoryTwo.id, categoryThree.id)"><span ng-class="{'ag-xs': char_tag.size == 1 , 'ag-sm': char_tag.size == 2, 'ag-md': char_tag.size == 3, 'ag-lg': char_tag.size == 4 }"><span ng-if="char_tag.articlesExists==1 && char_tag.tagExists==0">{{char_tag.name}}&nbsp; </span> <span ng-if="char_tag.tagExists==1" class="ag-yellow">{{char_tag.name}}&nbsp; </span> <span ng-if="char_tag.articlesExists==0 && char_tag.tagExists!=1" class="ag-stroke">{{char_tag.name}}&nbsp; </span></span></span>
          </div>
          </div>
          </div>
        <div class="modal-footer">
          
      </div>
      </div>
    </div>
  </div>
  </div>
  </div>

  </body>
</html>
