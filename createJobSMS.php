<?php    
    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    include('./globals.php');

    session_start();

    $newJob = filter_input_array(INPUT_POST)['newJob'];
    $_SESSION['newJobs'][] = $newJob;


    $jobName = $newJob['name'];
    if (empty($jobName)) {
        $_SESSION['msgErr'] = 'You need to set a Job Name';
    } else {
        $jobName = $jobName;
    }
    $jobDescription = $newJob['description'];
    if (empty($jobDescription)) {
        $_SESSION['msgErr'] = 'You need to set a Job Description';
    } else {
        $jobDescription = $jobDescription;
    }
    $creationDate = $newJob['creationDate'];
    if (empty($creationDate)) {
        $creationDate = $dateAndTime;
    } else {
        $creationDate = $creationDate;
    }
    $startDate = $newJob['startDate'];
    if (empty($startDate)) {
        $startDate = $dateAndTime;
    } else {
        $startDate = $startDate;
    }
    $endDate = $newJob['endDate'];
    if (empty($endDate)) {
        $endDate = $dateAndTime;
    } else {
        $endDate = $endDate;
    }
    $jobStatus = $newJob['status'];
    if (empty($jobStatus)) {
        $jobStatus = 'Open';
    } else {
        $jobStatus = $jobStatus;
    }
    $jobProgress = $newJob['progress'];
    if (empty($jobProgress)) {
        $jobProgress = '0%';
    } else {
        $jobProgress = $jobProgress;
    }
    $smsSent = $newJob['sent'];
    if (empty($smsSent)) {
        $smsSent = '0%';
    } else {
        $smsSent = $smsSent;
    }
    $smsDelivered = $newJob['delivered'];
    if (empty($smsDelivered)) {
        $smsDelivered = '0%';
    } else {
        $smsDelivered = $smsDelivered;
    }
    $smsUndelivered = $newJob['undelivered'];
    if (empty($smsUndelivered)) {
        $smsUndelivered = '0%';
    } else {
        $smsUndelivered = $smsUndelivered;
    }
    $smsFailed = $newJob['failed'];
    if (empty($smsFailed)) {
        $smsFailed = '0%';
    } else {
        $smsFailed = $smsFailed;
    }

    $sql = "INSERT INTO jobs (
        jobName,
        jobDescription,
        creationDate,
        startDate,
        endDate,
        jobStatus,
        jobProgress,
        smsSent,
        smsDelivered,
        smsUndelivered,
        smsFailed
    ) VALUES (
        '$jobName',
        '$jobDescription',
        '$creationDate',
        '$startDate',
        '$endDate',
        '$jobStatus',
        '$jobProgress',
        '$smsSent',
        '$smsDelivered',
        '$smsUndelivered',
        '$smsFailed'
    )";

    $query = mysqli_query($conn, $sql);

    if ($query){        
        unset($_SESSION['newJobs']);
        header('location: ./');

    } else {
        $_SESSION['msgErr'] = 'No se pudo salvar en base de datos';
        var_dump($_SESSION['msgErr']);
        echo '<br/>';
        var_dump(empty($smsPhone));
        print_r($smsPhone);
        echo '<br/>';
        var_dump(empty($smsPhone));
        print_r($smsPhone);
    }

?>