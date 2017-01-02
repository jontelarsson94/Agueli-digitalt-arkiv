<?PHP

require_once "../inc/check_admin.php";

if(checkAdmin() != "nothing"){

session_start();
session_destroy();

echo '<script type="text/javascript">window.location = "../articles.php"</script>';
}

?>