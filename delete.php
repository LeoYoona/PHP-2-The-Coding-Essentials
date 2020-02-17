<?php

    $basedir = 'workdir/';
    $filename = $_GET['name'];

    unlink($basedir . $filename);

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>