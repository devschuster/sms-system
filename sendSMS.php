<?php    
    include('./globals.php');

    if (isset ($_GET['id'])){
        session_start();
        $sid = $_SESSION['sid'];
        $token = $_SESSION['token'];
        $twilioPhone = $_SESSION['twilioPhone'];
        $id = ($_GET['id']);
        $sqlSMS = $conn -> query ("SELECT * FROM sms WHERE smsID = $id");
    }

    require_once './vendor/autoload.php'; // Loads the library
    use Twilio\Rest\Client;    
    
    $fetchSMSData = $sqlSMS -> fetch_array();
    $smsPhone = '+'.$fetchSMSData['smsPhone'];
    $smsMessage = $fetchSMSData['smsMessage'];
    $client = new Client($sid, $token);

    $client->messages->create(
        "$smsPhone",[
            'from' => "$twilioPhone",
            'body' => "$smsMessage"
        ]
    );


?>