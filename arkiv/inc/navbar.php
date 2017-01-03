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
      <a ng-click="hideSlider()" class="navbar-brand" href="articles.php"><h3 class="ag-h3"><span class="glyphicon"></span>Digitalt Arkiv</h3></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <?php if(basename($_SERVER['PHP_SELF']) == "articles.php"){ ?>
        <li <? if($nav_current_page=="articles.php") echo 'class="active "' ?>><a href="#" ng-click="addTagToSearchByName('Tidningsartikel'); hideSlider()"><h3 class="ag-h3">Tidningsartiklar</h3></a></li>
        <li <? if($nav_current_page=="paintings.php") echo 'class="active "' ?>><a href="#" ng-click="addTagToSearchByName('Målning'); hideSlider()"><h3 class="ag-h3">Målningar</h3></a></li>
        <li <? if($nav_current_page=="letters.php") echo 'class="active "' ?>><a href="#" ng-click="addTagToSearchByName('Brev'); hideSlider()"><h3 class="ag-h3">Brev</h3></a></li>
        <li <? if($nav_current_page=="letters.php") echo 'class="active "' ?>><a href="#" data-target="#tagModal" data-toggle="modal" ng-click="getTagsForModal(); hideSlider()"><h3 class="ag-h3">Taggar</h3></a></li>
        <li <? if($nav_current_page=="letters.php") echo 'class="active "' ?>><a href="#" ng-click="getSlider()"><h3 class="ag-h3">Tidslinje</h3></a></li>
       <?php } ?>

        <?php session_start(); if($_SESSION['logged_in'] == true){ ?>
        <span class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Admin meny
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li <? if($nav_current_page=="add_article.php") echo 'class="active "' ?>><a href="add_article.php"><h3 class="ag-h3">Lägg till artikel</h3></a></li>
              <li <? if($nav_current_page=="categories.php") echo 'class="active "' ?>><a href="categories.php"><h3 class="ag-h3">Kategorier</h3></a></li>
              <li <? if($nav_current_page=="articles_admin.php") echo 'class="active "' ?>><a href="articles_admin.php"><h3 class="ag-h3">Artiklar (Admin)</h3></a></li>
              <li <? if($nav_current_page=="articles_admin.php") echo 'class="active "' ?>><a href="api/log_out.php"><h3 class="ag-h3">Logga ut</h3></a></li>
        <?php } ?>

        <?php if($_SESSION['admin'] == true){ ?>
          <li <? if($nav_current_page=="add_article.php") echo 'class="active "' ?>><a href="add_user.php"><h3 class="ag-h3">Lägg till användare</h3></a></li>
          <li <? if($nav_current_page=="add_article.php") echo 'class="active "' ?>><a href="users.php"><h3 class="ag-h3">Användare</h3></a></li>
        <?php } ?>
        </ul>
        </span>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
