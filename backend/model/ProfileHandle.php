<?php

/* Carefully read and refer to ERROR CODE BELOW !!! */

#define SUCCESS 0 Private Function executed
#define INPUTFL 1 Input is failed
#define SQLCONNFL  2 Connection to SQL database failed
#define REGFL   3 Registration failed
#define LOGFL   4 Loggin failed
#define SESSFL  5 Session failed
#define NULL 13 Returns a null object I did not use it yet
#define FINISH 20 The Entire Program is complete without errors

class ProfileHandle
{

    //Client
    private $email;

    //Server
    private $dbh;
    private $PROCESS_STATUS;
    private $profile;

    public function __construct()
    {

        //client
        $this->email = $_SESSION["HOST_SESSION"];

        //Server
        $this->PROCESS_STATUS = ''; //ERROR CODE STATUS
        $this->dbh = '';
        $this->profilel;

    }


    public function Profile()
    {


        $this->DataBase_Connect();
        //ERROR CHECK
        if ($this->PROCESS_STATUS != 0) {
            return $this->PROCESS_STATUS;
            exit();
        }

        $this->Fetch_Profile();
        //ERROR CHECK
        if ($this->PROCESS_STATUS != 0) {
            return $this->PROCESS_STATUS;
            exit();
        }

        return array_diff_key($this->profile, array_flip(array('password', 'birthdate'))); //returns except password and birthdate

    } //ENDOF function 


    private function DataBase_Connect(): int
    {
        $SQLuser = 'WT26';
        $SQLpassword = 'szjRvpQEtd';
        $SQLdns = 'mysql:dbname=WT26;host=anysql.itcollege.ee';

        try {
            //logging into SQL database.
            $in_dbh = new PDO($SQLdns, $SQLuser, $SQLpassword);
            $in_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh = $in_dbh; //Makes database

            return $this->PROCESS_STATUS = 0;
        } catch (PDOException $err) {
            //echo $err->getMessage(); #THIS IS FOR DEBUGGING PURPOSE SOLELY.
            return $this->PROCESS_STATUS = 2;
        }
    } //ENDOF function 


    private function Fetch_Profile()
    {

        try {

            //SQL statement SELECT * MIGHT BE RISKY MOVE IN PRACTICAL SITUATION
            $sql = "SELECT * 
        FROM users u  
        LEFT JOIN ticket_status t
        ON t.ticket_holder = u.email
        WHERE u.email = ?";

            //Preparing SQL
            $stmt = $this->dbh->prepare($sql);

            //Binding parameteres
            $stmt->bindParam(
                1,
                $this->email,
                PDO::PARAM_STR
            );

            //excute SQL
            $stmt->execute();

            //Matched full_name data will be returned
            $this->profile = $stmt->fetch(PDO::FETCH_ASSOC);

            return $this->PROCESS_STATUS = 0;
        } catch (PDOException $e) {
            echo $e->getMessage();

            return $this->PROCESS_STATUS = 13; //Connection is null

        }

    }
}