<?php
    session_start();

    $ses_id = (isset($_SESSION['ses_id']) && $_SESSION['ses_id'] != '') ? $_SESSION['ses_id'] : '';
    $ses_grade = (isset($_SESSION['ses_grade']) && $_SESSION['ses_grade'] != '') ? $_SESSION['ses_grade'] : '';
?>