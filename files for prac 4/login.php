<!DOCTYPE html>

<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: index.php");
    exit;
}
require_once "config.php";

$email = $password = "";
$emailErr = $passwordErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(empty($_POST[email]))
    {
        $emailErr = "Email is required...";
    }
    else
    {
        $email = trim($_POST["username"]);
    }
    
    if(empty($_POST["password"]))
    {
        $passwordErr = "Prove that you are you... Enter your password...";
    }
    else
    {
        $password = trim($_POST["password"]);
    }
    
    if(empty($emailErr) && empty($passwordErr))
    {
        $SELECT = "SELECT id, Name, Surname, Email, Password FROM u18045881_PA03 WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $SELECT))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            $param_email = $email;
            
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $name, $surname, $email, $hashedpassword);
                    
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashedpassword))
                        {
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSIONS["email"] = $email;
                            
                            header("location: index.php");
                        }
                        else
                        {
                            $passwordErr = "Liar!! You are not who you sy you are!! Try agin.";
                        }
                    }
                }
                else
                {
                    $emailErr = "It appears you are not a member... Or your email is not in the Database... Try again Or create an account...";
                }
            }
            else
            {
                echo "Hol up, wait a minute, somethin ain't right!! Please try again later...";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}

?>

<html>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group <?php echo ( !empty($emailErr)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $emailErr; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($passwordErr)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $passwordErr; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="login">
            </div>
            <p>Not a member of da club yet? <a href="signup.php">Create an account</a>.</p>
        </form>
    </div>
    
</body>
</html>