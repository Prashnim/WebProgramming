<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

    $account=new Account($con);

    if(isset($_POST["submitButton"])) {
        
        $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
        $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

        $success=  $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);
        
        if($success) {
            $_SESSION["userLoggedIn"] = $username;
            header("Location: index.php");
        }
    }

    function getInputValue($name){
        if(isset($_POST[$name]))
            echo $_POST[$name];
    }
?>

<!DOCTYPE HTML>

<html>
<head>
    <title>Welcome to Sparkle</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css">  
    <style>
    body{
        background-image: url('stars.jpg');
        background-size:100% 100%;
        background-repeat: no-repeat;
    
    }
</style>   
</head>


<body>

<div class="signInContainer">
       
    <div class="column">
        <div class="header">
        <img src="assets/images/sparkleLogo.png" alt="SPARKLE" title="Logo">
            <h3>Sign Up</h3>
            <span>to become a member</span>
            

        </div>
        <form method="POST">
            <?php echo $account->getError(Constants::$firstNameCharacters); ?>
            <input type="text" name="firstName" value="<?php getInputValue("firstName"); ?>" placeholder="FirstName" required>
          
            <?php echo $account->getError(Constants::$lastNameCharacters); ?>
           <input type="text" name="lastName" value="<?php getInputValue("lastName"); ?>" placeholder="LastName" required>

           <?php echo $account->getError(Constants::$usernameCharacters); ?>
           <?php echo $account->getError(Constants::$usernameTaken); ?>
           <input type="text" name="username" value="<?php getInputValue("username"); ?>" placeholder="Username" required>

           <label for="male"><input type="radio" id="male" name="gender" value="male">Male</label><br>
            
           <label for="female"> <input type="radio" id="female" name="gender" value="female">Female</label><br>
            

           <?php echo $account->getError(Constants::$emailsDontMatch); ?>
           <?php echo $account->getError(Constants::$emailInvalid); ?>
           <?php echo $account->getError(Constants::$emailTaken); ?>
           <input type="email" name="email" value="<?php getInputValue("email"); ?>" placeholder="Email" required>  
           <input type="email" name="email2" value="<?php getInputValue("email2"); ?>" placeholder="Confirm Email" required>
          
          
           <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
           <?php echo $account->getError(Constants::$passwordLength); ?>
           <input type="password" name="password" placeholder="Password" required>
           <input type="password" name="password2" placeholder="Confirm Password" required>  

            <label for="tc"> 
            <input type="checkbox" id="tc" name="tc" value="tc">
            I accept the terms & conditions</label><br>

           <input type="submit" name="submitButton" Value="Submit">
           <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a></br>
           <a href="paymentOptions.php" class="pay">To know about Payment Options Click here</a></br>
           <a href="feedback.html" class="feedback">Feedback</a>
        </form>
        <style>
            .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 30%;
            height:7%;
            background-color: blue;
            color: white;
            text-align: center;
            }
            </style>

            <div class="footer">
            <p style="color:white;">Contact:sparkle@gmail.com</p>
            </div>
       

    </div>
</div>    
</body>

</html>