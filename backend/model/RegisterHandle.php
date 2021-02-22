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

class RegisterHandle
{
    //Client
    private $full_name;
    private $password;
    private $email;
    private $gender;
    private $birthdate;
    private $country;
    private $occupation;
    private $education;

    //Server
    private $dbh;
    private $PROCESS_STATUS;


    public function __construct($full_name = '', $password = '', $email = '', $gender = '', $birthdate = '', $country = '', $occupation = '', $education = '')
    {
        //Client
        $this->full_name = $full_name;
        $this->password = $password;
        $this->email = $email;
        $this->gender = $gender;
        $this->birthdate = $birthdate;
        $this->country = $country;
        $this->occupation = $occupation;
        $this->education = $education;

        //Server
        $this->dbh = '';
        $this->PROCESS_STATUS = '';
    }

    public function Register()
    {

        $this->Input_Test();
        if ($this->PROCESS_STATUS != 0) {
            return $this->PROCESS_STATUS; //1
            exit();
        }

        $this->DataBase_Connect();
        if ($this->PROCESS_STATUS != 0) {
            return $this->PROCESS_STATUS; //2
            exit();
        }

        $this->Register_User();
        if ($this->PROCESS_STATUS != 0) {
            return $this->PROCESS_STATUS; //3
            exit();
        }

        return 20;

    } //ENDOF function execute


    private function Input_Test(): int
    {

        if (empty($this->password) or !preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $this->password)) {
            return $this->PROCESS_STATUS = 1; #INPUTFL 1 = Input is failed
        } else {
            return $this->PROCESS_STATUS = 0;
        }
    } //ENDOF function Input_Test

    // DataBase_Connect Returns ? PDO : 2
    private function DataBase_Connect(): int
    {

        $SQLuser = 'WT26';
        $SQLpassword = 'szjRvpQEtd';
        $SQLdns = 'mysql:dbname=WT26;host=anysql.itcollege.ee';

        try {
            //logging into SQL database.
            $in_dbh = new PDO($SQLdns, $SQLuser, $SQLpassword);

            $in_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->dbh = $in_dbh;

            return $this->PROCESS_STATUS = 0;
        } catch (PDOException $err) {
            //echo $err->getMessage(); #THIS IS FOR DEBUGGING PURPOSE SOLELY.
            return $this->PROCESS_STATUS = 2; #CONNFL 2 = Connection to SQL database failed
        }
    } //ENDOF function Database_Connect

    private function Register_User(): int
    {

        try {
            //SQL Statement.
            $sql = "INSERT INTO users (full_name, password, email, birthdate, register_time, gender, country, occupation, education) VALUES(:full_name, :password, :email, :birthdate, :register_time, :gender, :country, :occupation, :education)";
            $sub_sql = "INSERT INTO ticket_status (id, ticket_holder, ticket_type, purchase_status) VALUES ((SELECT id FROM users WHERE id = LAST_INSERT_ID()), :email, 0, 0)";
            //Preparing the sql statement
            $stmt = $this->dbh->prepare($sql);
            $sub_stmt = $this->dbh->prepare($sub_sql);

            //Binding the values to sql statement
            $stmt->bindParam(":full_name", $this->full_name, PDO::PARAM_STR);
            $stmt->bindParam(":password", password_hash($this->password, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue(":birthdate", date("Y-m-d", $this->birthdate), PDO::PARAM_STR);
            $stmt->bindValue(":register_time", date("Y-m-d"), PDO::PARAM_STR);
            $stmt->bindParam(":gender", $this->gender, PDO::PARAM_STR);
            $stmt->bindParam(":country", $this->country, PDO::PARAM_STR);
            $stmt->bindParam(":occupation", $this->occupation, PDO::PARAM_STR);
            $stmt->bindParam(":education", $this->education, PDO::PARAM_STR);

            $sub_stmt->bindParam(":email", $this->email, PDO::PARAM_STR);

            //Excute sql
            $stmt->execute();
            $sub_stmt->execute();

            return $this->PROCESS_STATUS = 0;

        } catch (PDOException $e) {
            // echo $e->getMessage(); // FOR DEBUGGING
            return $this->PROCESS_STATUS = 3;
        }
    } //ENDOF function

} //ENDOF class