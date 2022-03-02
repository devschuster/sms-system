<?php
    session_start();
    
    $sid = 'ACfb15e6bc6de5fc5a39865c1fea09b4db';
    $token = '65f09ffa9cb922eb9bc142d42dce07fc';
    $twilioPhone = '+19033005086';

    $_SESSION['sid'] = $sid;
    $_SESSION['token'] = $token;
    $_SESSION['twilioPhone'] = $twilioPhone;

    echo $_SESSION['sid'];
?>