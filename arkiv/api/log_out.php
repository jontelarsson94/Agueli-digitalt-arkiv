<?PHP


require_once "../inc/check_admin.php";

if(checkAdmin() != "nothing"){

if (isset($_COOKIE['XSRF-TOKEN'])) {
    unset($_COOKIE['XSRF-TOKEN']);
    setcookie('XSRF-TOKEN', null, -1, '/');
}

session_start();
session_destroy();

echo '<script type="text/javascript">window.location = "../index.php"</script>';
}

?>