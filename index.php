<?php

    include('./globals.php');
    session_start();    

    $sql = $conn -> query ("SELECT * FROM jobs");

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
            <!-- Registered SMS Job -->
    <div class="row">
        <div class="col-md-12">
            <div id="success_message"></div>
                <div class="job-sms-table">
                    <div class="job-sms-table-header">
                        <h4>SMS Jobs</h4>
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
                                    <th>Job ID</th>
                                    <th>Job Name</th>
                                    <th>Job Description</th>
                                    <th>Creation Date</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                    <th>% Sent</th>
                                    <th>% Delivered</th>
                                    <th>% Undelivered</th>
                                    <th>% Failed</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php                                        
                                    while ($fetchJobRow = $sql -> fetch_array()){
                                ?>
                                <tr>
                                    <td><?php echo $fetchJobRow['jobID']?></td>
                                    <td><?php echo $fetchJobRow['jobName']?></td>
                                    <td><?php echo $fetchJobRow['jobDescription']?></td>
                                    <td><?php echo $fetchJobRow['creationDate']?></td>
                                    <td><?php echo $fetchJobRow['startDate']?></td>
                                    <td><?php echo $fetchJobRow['endDate']?></td>
                                    <td><?php echo $fetchJobRow['jobStatus']?></td>
                                    <td><?php echo $fetchJobRow['jobProgress']?></td>
                                    <td><?php echo $fetchJobRow['smsSent']?></td>
                                    <td><?php echo $fetchJobRow['smsDelivered']?></td>
                                    <td><?php echo $fetchJobRow['smsUndelivered']?></td>
                                    <td><?php echo $fetchJobRow['smsFailed']?></td>
                                    <td><a href="./smsCampaing.php?id=<?php echo $fetchJobRow['jobID'] ?>" class="update-user btn btn-primary btn-sm">Editar</a></td>
                                    <td><a href="javascript:deleteJob(<?php echo $fetchJobRow['jobID'] ?>)" class="delete-user btn btn-danger btn-sm">Eliminar</a></td>
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
        <div class="row">
            <div class="col-md-4 mt-4">
                <?php
                    if(isset($_SESSION['message'])){
                        echo "<h4>".$_SESSION['message']."</h4>";
                        unset($_SESSION['message']);
                    }
                ?>

                <div class="card">
                    <div class="card-header">
                        <h5>New SMS Job</h5>
                    </div>
                    <div class="card-body">

                        <form action="./createJobSMS.php" method="POST" enctype="multipart/form-data">
                            
                            <label for="file">File to import</label>
                                <input 
                                    type="file" 
                                    name="file" 
                                    id="file" 
                                    class="form-control" 
                                    onchange= "return fileValidation()" 
                                    required 
                                />
                                
                            <label for="newJob[name]"></label>
                                <input 
                                    type="text" 
                                    name="newJob[name]" 
                                    id="name" 
                                    class="form-control" 
                                    placeholder="Job Name" 
                                    required 
                                />
                            <label for="newJob[description]"></label>
                                <input 
                                    type="text" 
                                    name="newJob[description]" 
                                    id="description" 
                                    class="form-control" 
                                    placeholder="Job Description" 
                                    required 
                                />
                            <label for="newJob[creationDate]"></label>
                                <input 
                                    type="hidden" 
                                    class="form-control" 
                                    value="<?php echo $dateAndTime ?>" 
                                    id="creationDate" 
                                    name="newJob[creationDate]"
                                >
                            <button type="submit" name="createJobSMS" class="btn btn-primary mt-3">
                                Import Job
                            </button>

                        </form>

                    </div>
                </div>
            </div>
            <script 
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous"
            ></script>
        </div>
    </div>
    <script src="./scriptsFunctions.js"></script>
</body>

</html>