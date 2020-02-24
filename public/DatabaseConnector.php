<?php

require_once(__DIR__.'/private/config.php');

class Database {
    
    private $dbConnection;
    private $Credentials;

    /**
     * Establishs a database connection
     */
    function connect() {
        
        // Create connection
        $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        
        // Check if connection was successful
        if ($db->connect_error) {
            $response = "text=An error was encountered. Please try again later.&session=0";
        } else {
            $this->dbConnection = $db;
        }
    }

    /**
     * Closes a database connection
     */
    function close() {
        mysqli_close($dbConnection);
    }

    /**
     * Inserts a new record into the database
     */
    public function insertRecord($sql){
        if (mysqli_query($this->dbConnection, $sql)) {
            $response = "text=New record created successfully.&session=0";
        } else {
            $response = "text=An error was encountered whilst trying to save the record.&session=0";
        }
        
        return $response;
    }

    /**
     * Select record a from the database
     */
    public function selectRecord($sql){
        $result = $this->dbConnection->query($sql);

        return $result;
    }
}

