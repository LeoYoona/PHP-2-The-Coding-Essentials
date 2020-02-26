<?php
require_once "UserDAL.php";
include "showErrors.php";

class insertDataCsvXls extends UserDAL
{

    public function insertCol1($column)
    {
        $conn=$this->DBobject->ReturnConnectionObject();
        try 
        {
            $sql = "INSERT INTO test_imported_data (col1)
            VALUES(?); " ;
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $column[0]);
            $stmt->execute(); 
        } 
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function insertCol1Col2($column)
    {
        $conn=$this->DBobject->ReturnConnectionObject();
        try 
        {
            $sql = "INSERT INTO test_imported_data (col1, col2)
            VALUES(?,?); " ;
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $column[0], $column[1]);
            $stmt->execute();  
        } 
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    
    public function insertCol1Col2Col3($column)
    {
        $conn=$this->DBobject->ReturnConnectionObject();

        try 
        {
            $sql = "INSERT INTO test_imported_data (col1, col2, col3)
            VALUES(?,?,?); " ;
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $column[0], $column[1],$column[2]);
            $stmt->execute(); 
        } 
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


}    