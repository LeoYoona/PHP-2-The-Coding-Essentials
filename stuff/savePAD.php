<input type="hidden" name="selector" value =" <?php echo $selector; ?>" >
            <input type="hidden" name="validator" value =" <?php echo $validator; ?>">

//////////////////////////////////////////////////////////////////////////////
<?php
include "AutoLoaderIncl.php";
if (isset($_POST["reset-password-submit"])) 
{
    $users = new pwdRest_Service();    
    $conn=$users->GetConnectionObject();
    
    $selector=$_POST["selector"];
    $validator=$_POST["validator"];
    $pwd=$_POST["pwd"];
    $pwdRepeat=$_POST["pwdRepeat"];

    if (empty($pwd) || empty($pwdRepeat)) {
        header("location: index.pwdreset.php?newpwd=empty");
        exit();
    }
    else if($pwd!= $pwdRepeat)
    {
        header("location: index.pwdreset.php?newpwd=PasswordsDonotMatch");
    }

 
 

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql))
		{
			echo "There was an error ";
			exit();
		}
		else
		{
			mqsqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
            mqsqli_stmt_execute($stmt);
            
            $result = mysqsli_stmt_get_result($stmt);
            if (!$row = mysqli_fetch_assoc($result)) {
                echo "You need to re-submit your password reset request." ;
                exit();
            }
            else
            {
                $tokenBin = hex2bin($validator);
                $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

                if ($tokenCheck == false) {
                    echo "you need to re-submit your password reset request." ;
                    exit();
                }
                elseif ($toke == true) {
                    $tokenEmail = $row["pwdResetEmail"];

                    $sql= "SELECT * FROM Users WHERE email = ?; ";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql))
                    {
                        echo "There was an error ";
                        exit();
                    }
                    else
                    {
                        mqsqli_stmt_bind_param($stmt, "s", $tokenEmail);
                        mqsqli_stmt_execute($stmt);

                        $result = mysqsli_stmt_get_result($stmt);
                        if (!$row = mysqli_fetch_assoc($result)) {
                            echo "An error occoured." ;
                            exit();
                        }
                        else
                        {
                            $sql = "UPDATE Users SET password=? WHERE email=?";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql))
                            {
                                echo "There was an error ";
                                exit();
                            }
                            else
                            {   
                                $newPwdHash = password_hash($pwd, PASSWORD_DEFAULT)
                                mqsqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                                mqsqli_stmt_execute($stmt);

                                $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ? ;";
                                $stmt = mysqli_stmt_init($conn);
                                if(!mysqli_stmt_prepare($stmt, $sql))
                                {
                                    echo "There was an error ";
                                    exit();
                                }
                                else
                                {  
                                    mqsqli_stmt_bind_param($stmt, "s",$tokenEmail);
                                    mqsqli_stmt_execute($stmt);
    
                                    header("location: index.php?newpwd=PasswordUpdated")
                                }
                            }
                        }
                    }               
                }
            }
        }

}


 else
{
    header("Location: index.php");
    exit();
}




//-----------------------------------------------------------------------------------------------




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
        
        if (!$row = mysqli_fetch_assoc($query)) {
            echo "An error occoured." ;
            return false;
            
        }
        else
        {
            echo "<br>".$row['id']."<br>".$row['name'];  
        }
    } 
    catch (mysqli_sql_exception $e) 
    {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

}

?>