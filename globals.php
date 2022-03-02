<?php
    include('./dbconfig.php');
    $dateAndTime = date('Y-m-d h:i:s', time()); 
    $conn = connect();
    if(isset($_GET['deleteJob'])){
        $sqlDeleteJob="DELETE FROM jobs WHERE jobID=".$_GET['deleteJob'];
        $queryDeleteJob = mysqli_query($conn, $sqlDeleteJob);
        header("Location: ./");
    }
    if(isset($_GET['deleteSMS'])){
        session_start();
        $sqlDeleteSMS="DELETE FROM sms WHERE smsID=".$_GET['deleteSMS'];
        $queryDeleteSMS = mysqli_query($conn, $sqlDeleteSMS);
        header('Location: ./smsCampaing.php?id='.$_SESSION['id']);
        unset($_SESSION['id']);
    }
?>