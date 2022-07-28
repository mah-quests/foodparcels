<?php 

    session_destroy ();
    $_SESSION['role'] = '';
    unset($_SESSION['role']);
    clearstatcache();
    
    header("refresh:0;url=index.php");

?>
