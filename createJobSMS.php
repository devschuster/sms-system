<?php

    //Requiring PHP Spreadsheets dependancy
    require __DIR__ . "/vendor/autoload.php";
    use PhpOffice\PhpSpreadsheet\IOFactory;



    // Checking if the form received a file.
    if (isset($_FILES['file']['name'])) {

        // Importing file to variables
        $fileName = $_FILES['file']['tmp_name'];
        $document = IOFactory::load($fileName);
        $totalSheets = $document -> getSheetCount();
        
        //Selecting current sheet
        $currentSheet = $document -> getSheet(0);
        // Counting total rows in the sheet
        $rowsNumber = $currentSheet -> getHighestDataRow();
    } 
    //Include global variables and db connection.
    include('./globals.php');

    // Form info pass through Session
    session_start();

    // Converting form info into Array
    $newJob = filter_input_array(INPUT_POST)['newJob'];
    $_SESSION['newJobs'][] = $newJob;

    // Form info array into separated variables
    $jobName = $newJob['name']; // Job Name
    if (empty($jobName)) {
        $_SESSION['msgErr'] = 'You need to set a Job Name';
    } else {
        $jobName = $jobName;
    }
    $jobDescription = $newJob['description']; //Job Description
    if (empty($jobDescription)) {
        $_SESSION['msgErr'] = 'You need to set a Job Description';
    } else {
        $jobDescription = $jobDescription;
    }
    $creationDate = $newJob['creationDate']; // When the job has been created
    if (empty($creationDate)) {
        $creationDate = $dateAndTime;
    } else {
        $creationDate = $creationDate;
    }
    $startDate = $newJob['startDate']; // When the Job started
    if (empty($startDate)) {
        $startDate = $dateAndTime;
    } else {
        $startDate = $startDate;
    }
    $endDate = $newJob['endDate']; // When the Job ended
    if (empty($endDate)) {
        $endDate = $dateAndTime;
    } else {
        $endDate = $endDate;
    }
    $jobStatus = $newJob['status']; // Job Status
    if (empty($jobStatus)) {
        $jobStatus = 'Open';
    } else {
        $jobStatus = $jobStatus;
    }
    $jobProgress = $newJob['progress']; // Percentage of the job progress
    if (empty($jobProgress)) {
        $jobProgress = '0%';
    } else {
        $jobProgress = $jobProgress;
    }
    $smsSent = $newJob['sent']; // Percentage of how many SMS has been sent
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

    $sqlJobs = "INSERT INTO jobs (
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

    $queryJobs = mysqli_query($conn, $sqlJobs);
    $fkJobID = mysqli_insert_id($conn);
    for ($i = 2; $i < $rowsNumber; $i++) {
        $smsPhone = $currentSheet -> getCellByColumnAndRow(1, $i);
        $smsMessage = $currentSheet -> getCellByColumnAndRow(2, $i);
        $sendDate = $dateAndTime;
        $smsStatus = 'Sending Message';


        $sqlSMS = "INSERT INTO sms (
            smsPhone,
            smsMessage,
            sendDate,
            smsStatus,
            jobID
        ) VALUES (
            '$smsPhone',
            '$smsMessage',
            '$sendDate',
            '$smsStatus',
            '$fkJobID'
        )";
        $querySMS = mysqli_query($conn, $sqlSMS);

    }


    if ($queryJobs && $querySMS){
        unset($_SESSION['newJobs']);
        header('location: ./ ');
    } else {
        $_SESSION['msgErr'] = 'No se pudo salvar en base de datos';      
        print_r($sqlSMS);
    }

?>