<?php
class AuthentificationException extends Exception{
    protected $alert; // code
    protected $message ;


    public function getMessage()
    {
        return $this->message;
    }

    public function getAlert()
    {
        return $this->alert;
    }
    public function __construct(string $message , string $alert){
        this.$message = $message ;
        this.$alert=$alert;
    }

}

