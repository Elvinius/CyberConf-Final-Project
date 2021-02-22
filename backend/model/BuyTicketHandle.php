<?php

/* Carefully read and refer to ERROR CODE BELOW !!! */

#define SUCCESS 0 Private Function excuted
#define INPUTFL 1 Input is failed
#define SQLCONNFL  2 Connection to SQL database failed
#define REGFL   3 Registration failed
#define LOGFL   4 Loggin failed
#define SESSFL  5 Session failed
#define NULL 13 Returns a null object
#define FINISH 20 The Entire Program is complete without errors

class Buy_TicketHandle
{

    //Client
    private $ticket_price;
    private $ticket_type;
    private $email;

    //Server
    private $dbh;
    private $PROCESS_STATUS;

    public function __construct($ticket_price = '')
    {
        //Client
        $this->ticket_price = $ticket_price;
        $this->ticket_type = '';
        $this->email = $_SESSION["HOST_SESSION"];

        //Server
        $this->dbh = '';
        $this->PROCESS_STATUS;
    }

    public function Buy_Ticket()
    {

        $this->DataBase_Connect();
        //ERROR CHECK
        if ($this->PROCESS_STATUS != 0) {
            return $this->PROCESS_STATUS;
            exit();
        }


        if ((!is_string($this->Identify_Ticket()))) {
            return $this->PROCESS_STATUS = 2;
            exit();
        }

        $this->Assign_Ticket();
        //ERROR CHECK
        if ($this->PROCESS_STATUS != 0) {
            return $this->PROCESS_STATUS;
            exit();
        }

        return 20;

    } //ENDOF function f


    private function DataBase_Connect(): int
    {


       $SQLuser = 'WT26';
       $SQLpassword = 'szjRvpQEtd';
       $SQLdns = 'mysql:dbname=WT26;host=anysql.itcollege.ee';

        try {
            //logging into SQL database.
            $in_dbh = new PDO($SQLdns, $SQLuser, $SQLpassword);
            $in_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh = $in_dbh; //Return database

            return 0;
        } catch (PDOException $err) {
            echo $err->getMessage(); #THIS IS FOR DEBUGGING PURPOSE SOLELY.
            return $this->PROCESS_STATUS = 2; #CONNFL 2 = Connection to SQL database failed
        }
    } //ENDOF function DataBase_Connect

    private function Identify_Ticket(): string
    {

        switch ($this->ticket_price) {
            case 50:
                return $this->ticket_type = 'Early Bird';
                break;
            case 100:
                return $this->ticket_type = 'Middle Bird';
                break;
            case 150:
                return $this->ticket_type = 'Late Bird';
                break;
        }
    } //ENDOF function

    private function Assign_Ticket(): int
    {

        try {

            //SQL statement
            $sql = "UPDATE ticket_status SET ticket_type = :ticket_type, `purchase_status` = 1 WHERE ticket_holder = :email";

            //Preparing SQL
            $stmt = $this->dbh->prepare($sql);
            //Binding parameteres
            $stmt->bindParam(
                ":email",
                $this->email,
                PDO::PARAM_STR
            );

            $stmt->bindParam(
                ":ticket_type",
                $this->ticket_type,
                PDO::PARAM_STR
            );

            //excute SQL
            $stmt->execute();
            

            return $this->PROCESS_STATUS = 0;

        } catch (PDOException $e) {
            //echo $e->getMessage(); THIS IS FOR DEBUGGING SOLELY
            return $this->PROCESS_STATUS = 3;
        }

    }
}