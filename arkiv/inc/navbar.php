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
      <a class="navbar-brand" href="#"><h3 class="ag-h3"><span class="glyphicon"></span>Agueli Arkiv</h3></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <? if($nav_current_page=="articles.php") echo 'class="active "' ?>><a href="#"><h3 class="ag-h3">Artiklar</h3></a></li>
        <li <? if($nav_current_page=="paintings.php") echo 'class="active "' ?>><a href="#"><h3 class="ag-h3">Målningar</h3></a></li>
        <li <? if($nav_current_page=="letters.php") echo 'class="active "' ?>><a href="#"><h3 class="ag-h3">Brev</h3></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <? if($_SESSION['admin'] == 1): ?>
          <li <? if($nav_current_page=="add_article.php") echo 'class="active "' ?>><a href="add_article.php"><h3 class="ag-h3">Lägg till artikel</h3></a></li>
          <li <? if($nav_current_page=="add_painting.php") echo 'class="active "' ?>><a href="add_painting.php"><h3 class="ag-h3">Lägg till målning</h3></a></li>
          <li <? if($nav_current_page=="add_letter.php") echo 'class="active "' ?>><a href="add_letter.php"><h3 class="ag-h3">Lägg till brev</h3></a></li>
        <? endif;?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
