<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="articles.php"><h3 class="ag-h3"><span class="glyphicon"></span>Digitalt Arkiv</h3></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <? if($nav_current_page=="articles.php") echo 'class="active "' ?>><a href="#" ng-click="addTagToSearchByName('Artikel'); getFilteredArticles()"><h3 class="ag-h3">Tidningsartiklar</h3></a></li>
        <li <? if($nav_current_page=="paintings.php") echo 'class="active "' ?>><a href="#" ng-click="addTagToSearchByName('Målning'); getFilteredArticles()"><h3 class="ag-h3">Målningar</h3></a></li>
        <li <? if($nav_current_page=="letters.php") echo 'class="active "' ?>><a href="#" ng-click="addTagToSearchByName('Brev'); getFilteredArticles()"><h3 class="ag-h3">Brev</h3></a></li>
        <li <? if($nav_current_page=="letters.php") echo 'class="active "' ?>><a href="#" data-target="#tagModal" data-toggle="modal" ng-click="getTagsForModal()"><h3 class="ag-h3">Taggar</h3></a></li>
        <li <? if($nav_current_page=="add_article.php") echo 'class="active "' ?>><a href="add_article.php"><h3 class="ag-h3">Lägg till artikel</h3></a></li>
        <li <? if($nav_current_page=="categories.php") echo 'class="active "' ?>><a href="categories.php"><h3 class="ag-h3">Kategorier</h3></a></li>
        <li <? if($nav_current_page=="articles_admin.php") echo 'class="active "' ?>><a href="articles_admin.php"><h3 class="ag-h3">Artiklar (Admin)</h3></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <? if($_SESSION['admin'] == 1): ?>
          <li <? if($nav_current_page=="add_article.php") echo 'class="active "' ?>><a href="add_article.php"><h3 class="ag-h3">Lägg till artikel</h3></a></li>
          <li <? if($nav_current_page=="add_painting.php") echo 'class="active "' ?>><a href="add_painting.php"><h3 class="ag-h3">Lägg till målning</h3></a></li>
          <li <? if($nav_current_page=="add_letter.php") echo 'class="active "' ?>><a href="add_letter.php"><h3 class="ag-h3">Lägg till brev</h3></a></li>
          <li <? if($nav_current_page=="add_article.php") echo 'class="active "' ?>><a href="#"><h3 class="ag-h3">Lägg till artikel</h3></a></li>
          <li <? if($nav_current_page=="categories.php") echo 'class="active "' ?>><a href="#"><h3 class="ag-h3">Kategorier</h3></a></li>
          <li <? if($nav_current_page=="articles_admin.php") echo 'class="active "' ?>><a href="#"><h3 class="ag-h3">Artiklar (Admin)</h3></a></li>
        <? endif;?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
