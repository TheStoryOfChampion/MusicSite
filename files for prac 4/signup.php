<!DOCTYPE html>

<?php
    
    require_once "config.php";
    
    $nameErr = $surnameErr = $emailErr = "";
    $name = $surname = $email = "";
    
    if($_SERVER["REQUEST METHOD"] == "POST")
    {
        if(empty($_POST["name"]))
        {
            $nameErr = "Name is required...";
        }
        else
        {
            $name = test_input($_POST["$name"]);
            if(!preg_match("/^[a-zA-Z ]*$/", $name))
            {
                $surnameErr = "Enter a valid name please...";
            }
        }
        if(empty($_POST["surname"]))
        {
            $surnameErr = "Surame is required...";
        }
        elses
        {
            $surname = test_input($_POST["$surname"])};
            if(!preg_match("/^[a-zA-Z ]*$/", $surnamename))
            {
                $surnameErr = "Enter a valid surname please...";
            }
        }
        if(empty($_POST["email"]))
        {
            $emailErr = "Email is required...";
        }
        else
        {
            $email = test_input($_POST["email"]);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $emailErr = "Enter a valid email format please...";
            }
        }
    
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
?>
    
    <?php
$servername = "wheatley.cs.up.ac.za";
$username = "u18045881";
$password = "BV68YBgp";

// Create connection
$conn = new mysqli($servername, $username, $password, "u18045881_PA03");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
    $SELECT = "SELECT email FROM u18045881_PA03 WHERE email = email LIMIT 1";
    $INSERT = "INSERT INTO u18045881_PA03 (name, surname, email, password) values(?,?,?,?)";
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;
    
    if($rnum == 0)
    {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ssssii", $name, $surname, $email, $password);
        $stmt->execute();
        echo "WELCOME TO DA ELITE CLUB!!";
    }
    else
    {
        echo "This email is already in use...";
    }
?>

<html>
<body>
    <h2>Sign Up</h2>
    <p><span class="error">* required thingys</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Name: <input type="text" name="name">
        <span class="error">* <?php echo $nameErr;?></span>
        <br><br>
        Surname: <input type="text" name="surname">
        <span class="error">* <?php echo $surnameErr;?></span>
        <br><br>
        Email: <input type="email" name="email">
        <span class="error">* <?php echo $emailErr;?></span>
        <br><br>
        Password: <input type="password" name="password">
        <br><br>
        <input type="submit" name="submit" value="SignUp">
        <br><br>
        <div>
            <p>Already a member of da club? <a href="login.php">Login</a></p>
        </div>
    </form>
</body>



</html>
