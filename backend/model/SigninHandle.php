<?php

/* Carefully read and refer to ERROR CODE BELOW !!! */

#define SUCCESS 0 Private Function excuted
#define INPUTFL 1 Input is failed
#define SQLCONNFL  2 Connection to SQL database failed
#define REGFL   3 Registration failed
#define LOGFL   4 Loggin failed
#define SESSFL  5 Session failed
#define NULL 13 Returns a null object I did not use it yet
#define FINISH 20 The Entire Program is complete without errors

class SigninHandle
{

    //Client
    private $email;
    private $password;

    //Server
    private $dbh;
    private $PROCESS_STATUS;

    public function __construct($email = '', $password = '')
    {

        //Client
        $this->email = $email;
        $this->password = $password;

        //Server

        $this->PROCESS_STATUS = ''; //ERROR CODE STATUS
        $this->dbh = '';

    }

    public function Signin()
    {

        $this->DataBase_Connect();
        //ERROR CHECK
        if ($this->PROCESS_STATUS != 0) {
            return $this->PROCESS_STATUS;
            exit();
        }
        $this->Fetch_User();
        //ERROR CHECK
        if ($this->PROCESS_STATUS != 0) {
            return $this->PROCESS_STATUS;
            exit();
        }

        $this->Secure_session_regenerate_id();
        //ERROR CHECK
        if ($this->PROCESS_STATUS != 0) {
            return $this->PROCESS_STATUS;
            exit();
        }

        return 20;

    } //ENDOF function execute

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
            return $this->PROCESS_STATUS = 2; #CONNFL 2 = Connection to SQL database failed
        }
    } //ENDOF function DataBase_Connect

    private function Fetch_User(): int
    {

        try {

            //SQL statement
            $sql = "SELECT * FROM users where email = :email";

            //Preparing SQL
            $stmt = $this->dbh->prepare($sql);

            //Binding parameteres
            $stmt->bindParam(
                ":email",
                $this->email,
                PDO::PARAM_STR
            );

            //excute SQL
            $stmt->execute();

            //Matched email data will be returned
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            //Check if password correspond with an INPUT
            if (password_verify($this->password, $result['password'])) {

                return $this->PROCESS_STATUS = 0; //SUCESS 0

            } else {

                return $this->PROCESS_STATUS = 4; //LOGFL   4 Login failed

            } // ENDOF IF
        } catch (PDOException $e) {
            //echo $e->getMessage(); THIS IS FOR DEBUGGING SOLELY
        }

    } //ENDOF function Signin

    private function Secure_session_regenerate_id(): int
    {
        try {

            session_start(); //To create a session

            $newsid = session_create_id('');
            // session_regenerated_id will update a SSID, does not destroy
            // whereas session_create_id will create and discard an old SSID

            $_SESSION["HOST_ALIVE_TIME"] = time();
            $_SESSION["HOST_SESSION"] = $this->email;

            // session use strict mode is temporality deactivated to change PHPSESSID
            ini_set('session.use_strict_mode', 0);

            //Set SSID
            session_id($newsid);

            //write it as a file
            session_commit();

            //Start session with newly customized SSID
            session_start();

            // session use strict mode is activated
            ini_set('session.use_strict_mode', 1);
  

            return $this->PROCESS_STATUS = 0; //Success

        } catch (Exception $e) {
            //echo $e->getMessage(); THIS IS FOR DEBUGGING SOLELY
            return $this->PROCESS_STATUS = 5; //Session Failed;

        } //ENDOF IF
    } // ENDOF function secure_session_regenerate_id
} // ENDOF class SigninHandle