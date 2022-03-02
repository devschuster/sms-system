<?php

    include('./globals.php');
    session_start();    

    if (isset ($_GET['id'])){
        $id = ($_GET['id']);
        $_SESSION['id'] = $id;
        $sqlJob = "SELECT * FROM jobs WHERE jobID = $id";
        $queryJob = mysqli_query($conn, $sqlJob);
        if (mysqli_num_rows($queryJob) == 1) {
            $fetchJobData = mysqli_fetch_array($queryJob);
            $jobName = $fetchJobData['jobName'];
        }
        $sqlSMS = $conn -> query ("SELECT * FROM sms  WHERE jobID = $id");
    }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
        rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
        crossorigin="anonymous"
    >
    <title>Document</title>
</head>

<body>
<div class="container">
            <!-- Registered Phone and messages -->
    <div class="row">
        <div class="col-md-12">
            <div id="success_message"></div>
                <div class="sms-table">
                    <div class="sms-table-header">
                        <h4>Job name: <?php echo $jobName?></h4>
                        <?php
                            if(isset($_SESSION['msgErr'])){
                                echo "<h4>".$_SESSION['msgErr']."</h4>";
                                unset($_SESSION['msgErr']);
                            }
                        ?>
                    </div>
                    <div class="job-sms-table-body">
                        <table class="table table-bordered table-stipred">
                            <thead>
                                <tr>
                                    <th>SMS ID</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Send Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php                                        
                                    while ($fetchSMSData = $sqlSMS -> fetch_array()){
                                ?>
                                <tr>
                                    <td><?php echo $fetchSMSData['smsID']?></td>
                                    <td><?php echo $fetchSMSData['smsPhone']?></td>
                                    <td><?php echo $fetchSMSData['smsMessage']?></td>
                                    <td><?php echo $fetchSMSData['sendDate']?></td>
                                    <td><?php echo $fetchSMSData['smsStatus']?></td>
                                    <td><a href="./sendSMS.php?id=<?php echo $fetchSMSData['smsID'] ?>" class="send-SMS btn btn-primary btn-sm">Editar</a></td>
                                    <td><a href="javascript:deleteSMS(<?php echo $fetchSMSData['smsID'] ?>)" class="delete-SMS btn btn-danger btn-sm">Eliminar</a></td>
                                </tr>
                                <?php 
                                    } 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"
    ></script>
    <script src="./scriptsFunctions.js"></script>
</body>

</html>