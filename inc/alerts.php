<?php
if ($_SESSION['alert']==1) {
    $msgAlert ='<div class="alert alert-primary" role="alert" id="alert">Database UPDATE</div>';

}
if ($_SESSION['alert']==2) {
    $msgAlert ='<div class="alert alert-success" role="alert" id="alert">Accounts added</div>';

}
if ($_SESSION['alert']==3) {
    $msgAlert ='<div class="alert alert-danger" role="alert" id="alert">Login or password wrong</div>';

}


echo $msgAlert;
$_SESSION['alert']=0;
