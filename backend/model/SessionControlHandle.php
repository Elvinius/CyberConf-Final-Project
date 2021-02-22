<?php
/* Carefully read and refer to ERROR CODE BELOW !!! */

#define SUCCESS 0 Private Function excuted
#define INPUTFL 1 Input is failed
#define SQLCONNFL  2 Connection to SQL database failed
#define REGFL   3 Registration failed
#define LOGFL   4 Loggin failed
#define SESSFL  5 Session failed
#define TIMEOUT 6 Session expired
#define NULL 13 Returns a null object
#define FINISH 20 The Entire Program is complete without errors

class SessionControlHandle
{

    public function SessionControl()
    {

        return $this->Session_Exist();
        exit();
    }

    private function Session_Exist(): int
    {

        session_start();

        //User logged in and it has not passed 3600 seconds
        if (((isset($_SESSION["HOST_SESSION"])) && (!empty($_SESSION["HOST_SESSION"])))
            && (time() - $_SESSION["HOST_ALIVE_TIME"] <= 60 * 60)) {
            return 20;
            //User logged in and passed 3600 seconds will delete session
        } elseif (((isset($_SESSION["HOST_SESSION"])) && (!empty($_SESSION["HOST_SESSION"])))
            && (time() - $_SESSION["HOST_ALIVE_TIME"] > 60 * 60)) {
            unset($_SESSION["HOST_SESSION"]);
            unset($_SESSION["HOST_ALIVE_TIME"]);
            session_destroy();
            return 6;
            // if user does not have anything
        } else {
            session_destroy();
            return 5;
        }
    } // ENDOF function Session_Exist
}