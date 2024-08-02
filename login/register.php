<?php 
//Register file to handle the signIn and SignUp forms
include 'connect.php';
//the condition checks if the signUp form is set
#the condition evaluates to true if the signup 
#form element is present in the form that submitted the data

if(isset($_POST['signUp'])){
    $firstName=$_POST['fName'];
    $lastName=$_POST['lName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    //encrypting password
    $password=md5($password);

     $checkEmail="SELECT * From users where email='$email'";
     $result=$conn->query($checkEmail);
     //after retrieving all records from the users table where the email matches the one submitted
     //if the number of rows returned is more than 0 it means the email already exists
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     //if the details from the form do not exist it is inserted into the database
     else{
        $insertQuery="INSERT INTO users(firstName,lastName,email,password)
                       VALUES ('$firstName','$lastName','$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location: index.php");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
   

}
//creating the signIn form

if(isset($_POST['signIn'])){
   $email=$_POST['email'];
   $password=$_POST['password'];
   $password=md5($password) ;
   
   $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
   $result=$conn->query($sql);
   //if the details match the database it starts a seesion
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['email']=$row['email'];
    header("Location: homepage.php");
    exit();
   }
   else{
    echo "Not Found, Incorrect Email or Password";
   }

}
?>