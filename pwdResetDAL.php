<?php
require_once "UserDAL.php";

mysqli_report(MYSQLI_REPORT_STRICT);

class pwdResetDAL extends UserDAL
{
    public function deleteEmailAdd($userEmail) //deletes record of the email address from the temp password reset table in the DB if the email alreasdy exists
    {
        try 
        {
            $conn=$this->DBobject->ReturnConnectionObject();
            $sql = "DELETE FROM passReset WHERE pwdResetEmail=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $userEmail);
            $stmt->execute();
        } 
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function insertTempPwdInfo($userEmail, $selector, $token, $expires) //to insert temporary password reset information in the DB
    {
       try 
        {
            $conn=$this->DBobject->ReturnConnectionObject();
            $sql = "INSERT INTO passReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?) ;" ;
            $stmt = $conn->prepare($sql);
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
            $stmt->bind_param("ssss", $userEmail, $selector, $hashedToken, $expires);
            $stmt->execute();
        } 
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function CheckTokenExpiry($selector) //to check if the reset link with the corresponding selector is already expired or notthe DB
    {
        try 
        {
            $conn=$this->DBobject->ReturnConnectionObject();  
            $select = mysqli_real_escape_string($conn, $selector);
            $currentDate = date("U");

            $sql = "SELECT * FROM passReset WHERE pwdResetSelector= '".$select."'  AND pwdResetExpires >=  ".$currentDate." ;";
            
            $query = mysqli_query($conn,$sql);
            // while ($row = mysqli_fetch_assoc($query)) //use while loop to print multiple records, but if there is just one record use the if else below
            // {
            // echo "<br>".$row['id']."<br>".$row['name'];            
            // }       
            
            if ($row = mysqli_fetch_assoc($query)) {
               // echo "An error occoured." ;
                //return NULL;
                return $row;
            }
            // else
            // {
            //     //echo "<br>".$row['pwdResetSelector']."<br>".$row['pwdResetExpires'];  
            //     return $row;
            // }
        } 
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    
    }

    public function selectTokenEmail($tokenEmail) 
    {
       try 
        {
            $conn=$this->DBobject->ReturnConnectionObject();
            $tEmail = mysqli_real_escape_string($conn, $tokenEmail);
            $sql = "SELECT * FROM Users WHERE email = '".$tEmail."'; " ;          
            $query = mysqli_query($conn,$sql);
            
            if ($row = mysqli_fetch_assoc($query)) 
            {
                return $row;
            }
        } 
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function updatePassword($pwd, $tokenEmail)
    {
        try 
        {
            $conn=$this->DBobject->ReturnConnectionObject();
            $sql = "UPDATE Users SET password=? WHERE email=?" ;
            $stmt = $conn->prepare($sql);
            $newPwdHash = password_hash($pwd, PASSWORD_DEFAULT);
            $stmt->bind_param("ss", $newPwdHash, $tokenEmail);
            $stmt->execute();

            $this->deleteEmailAdd($tokenEmail);  //after updating the password, delete it from the password reset records
        } 
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    
    // public function TEST()    //gets password from the user
    // {
    //     echo "<strong> 방탄 </strong>";
    // }
 }

?>