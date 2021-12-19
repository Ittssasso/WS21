<?php
    echo '<script>alert("Mila esker zure bisitagatik eta laster arte!"); window.location="Layout.php";</script>';
    //header("location: Layout.php");
    include 'DecreaseGlobalCounter.php';
    include 'Layout.php';
    session_start();
    session_destroy();
?>