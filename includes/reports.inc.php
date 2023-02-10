<?php

if (isset($_POST['report-office-btn'])) {

    // include other php process
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    if (empty($_POST['user_id'])) {
        header("location: ../reports.php?m=noid");
        exit();
    }

    $osid = $_POST['os_item'];
    $des = $_POST['report_description'];
    $by = $_POST['user_id'];

    $sql = "INSERT INTO `epiz_33456032_ssms`.`reports` (`os_id`, `report_description`, `report_by`, `report_date`) VALUES ('$osid', '$des', '$by', now());";

    if ($conn->query($sql) === TRUE) {
        // succeed
        header("location: ../reports.php?m=success");
        exit();
    } else {
        // failed
        echo $conn->error;
    }
}

if (isset($_POST['report-tech-btn'])) {

    // include other php process
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    if (empty($_POST['user_id'])) {
        header("location: ../reports.php?m=noid");
        exit();
    }

    $tsid = $_POST['ts_item'];
    $des = $_POST['report_description'];
    $by = $_POST['user_id'];

    $sql = "INSERT INTO `epiz_33456032_ssms`.`reports` (`ts_id`, `report_description`, `report_by`, `report_date`) VALUES ('$tsid', '$des', '$by', now());";

    if ($conn->query($sql) === TRUE) {
        // succeed
        header("location: ../reports.php?m=success");
        exit();
    } else {
        // failed
        echo $conn->error;
    }
}
