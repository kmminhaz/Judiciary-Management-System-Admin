<?php
    include('./assets/config.php');
    session_destroy();
    header('location: '. SITEURL)
?>