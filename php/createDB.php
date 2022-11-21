<?php

class Programm{


    public $dbname;
    public $username;
    public $servername;
    public $tablename;
    public $password;
    public $conn;

    // create class constructor

    public function __construct(
        $dbname = "Newdb",
        $tablename = "Productdb",
        $servername = "localhost",
        $username = "root",
        $password =""
    )
    {
        $this->dbname = $dbname;
        $this->username = $username;
        $this->$servername = $servername;
        $this->tablename = $tablename;
        $this->password = $password;

        //create connection

        $this->conn = mysqli_connect($servername,$username,$password);

        //check connection

        if(!$this->conn){
            die("Connection failed:" .mysqli_connect_error());
        }

        //create database

        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        //execute query

        if(mysqli_query($this->conn,$sql)){
            //if does not exsist databses in same name the can be create database
            $this->conn = mysqli_connect($servername,$username,$password,$dbname);

            //create a table

            $sql = "CREATE TABLE IF NOT EXISTS $tablename
                    (ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    Product_name VARCHAR(25) NOT NULL,
                    Product_price FLOAT,
                    Product_image VARCHAR(100)
                    );";

            if(!mysqli_query($this->conn,$sql)){
                echo "Creating table gave error:".mysqli_error($this->conn);
            }

        }else{
            return false;
        }
    }

    //get product infomation from database

    public function getData(){
        $sql = "SELECT * FROM $this->tablename";

        $result = mysqli_query($this->conn,$sql);

        if(mysqli_num_rows($result)>0){
            return $result;
        }
    }
}