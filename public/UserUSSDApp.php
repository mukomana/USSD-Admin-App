<?php header('Content-type: application/x-www-form-urlencoded');
require_once('DatabaseConnector.php');

$msisdn         = $_POST['msisdn'];
$sessionId      = $_POST['sessionid'];
$network        = $_POST['network'];
$request        = $_POST['request'];
$dialString     = $_POST['dialstring'];
$type           = $_POST['type'];
$mno            = $_POST['mno'];

if($type == 1){
    /**
     *
     * @var Database $database
     */
    $database = new Database();

    //get database connection
    $database->connect();

    //create SELECT sql statement
    $sql = "SELECT msisdn FROM student WHERE msisdn = '".$msisdn."'";

    //Retrieve a record from the database using $msisdn
    $result = $database->selectRecord($sql);

    //Check if the query returned records
    if($result->num_rows > 0){
       $response = 'text=Welcome to CM registration portal. \nPlease enter your first name.&session=1';
    }else {
            $response = 'text=A record for this number already exists.&session=0';
    }
}
 
if($type == 2) {
    if(!apc_fetch('name')) {
       apc_store('name', $request, 60);
       $response = "text=May you please enter you surname.&session=1";
    } else if(!apc_fetch('surname')) {
       apc_store('surname', $request, 60);
       $response = "text=May you please enter you score.&session=1";
    } else {
       apc_store('score', $request, 60);
       $response='text='.apc_fetch('name').' your score is '.apc_fetch('score').'.&session=0';
            
       /**
        * @var Database $database
        */
        $database = new Database();

       //get database connection
       $database->connect();

       //create INSERT SQL statement
       $sql = "INSERT INTO student (msisdn, name, surname, score) VALUES (".msisdn.", ".apc_fetch('name').", ".apc_fetch('surname').", ".apc_fetch('score').")";

       //insert the new record into a mysql database
       $response = $database->insertRecord($sql);
    }
}

echo $response;
