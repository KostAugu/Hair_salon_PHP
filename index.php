<?php
session_start();
$dateErr=$clientErr=$hairdresserErr=$activeErr=$client_idErr=$visitsErr=$nameErr=$first_nameErr=$last_nameErr='';
$date=$client=$hairdresser=$active=$client_id=$visits=$name=$first_name=$last_name="";
$id = null;
$modalWindow=$reservation=$client=$clientSessionId = '';
$message = '';
$clients=$hairdressers=[];
$searchParameters = [];
$searchIntervalParameters = [];
require_once "resources/get.php";
require_once "resources/functions.php";
$offsetLink = offsetLink ();
require_once "resources/connection.php";
require_once "resources/html.php";
require_once "resources/databaseFunctions.php";
require_once "resources/databaseMain.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hair Salon</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="public/css/style.css" >
    <link type="text/css" rel="stylesheet" href="public/css/style2.css" >
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container links d-flex justify-content-start">
        <a class="navbar-brand" href="/"><i class="fas fa-home"></i></a>
        <a class="navbar-brand" href="/clients">Klientams</a>
        <a class="navbar-brand" href="/employees">Darbuotojams</a>
    </div>  
</nav>                    
<?php
require_once "resources/modalWindows.php";
// Grabs the URI and breaks it apart in case we have querystring stuff
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

$case = explode('index.php', $_SERVER['PHP_SELF'])[0];
//Route it up!
switch ($request_uri[0]) {
    // Home page
    case $case[0]:
        require 'views/home.php';
        break;
    // clients page
    case $case[0] . 'clients':
        require 'views/clients.php';
        break;
    // employees page
    case $case[0] . 'employees':
        require 'views/employees.php';
        break;   
    // employees page
    case $case[0] . 'addclient':
        require 'views/addClient.php';
        break;  
    // employees page
    case $case[0] . 'addemployee':
        require 'views/addEmployee.php';
        break;    
    // clients list page
    case $case[0] . 'clientslist':
        require 'views/clientslist.php';
        break;                            
    // Everything else
    default:
        require 'views/404.php';
        break;
}
?>



    <script src="public/script/script.js"></script>
</body>
</html>            
