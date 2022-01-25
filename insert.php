<?php
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$$email=$_POST['email'];
$number=$_POST['number'];
$message=$_POST['message']

 if (!empty($username)|| !empty($lastname) || !empty($email) || !empty($number) || !empty($message)){

    $host="localhost";
    $dbuUername="root";
    $dbPassword=" ";
    $dbname="contactussample";

    $conn=new mysqli($host, $dbuUername, $dbPassword, $dbname);
    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }else{
        $SELECT="SELECT email FROM register Where email = ? Limit 1";
        $INSERT="INSERT INTO try ( firstname, lastname, email,number,message) values(?,?,?,?,?)";
    }
    $stmt=$conn->prepare($SELECT);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum=$stmt->num_rows;
    if(rnum==0){
        $stmt->close();
        $stmt=$conn->prepare($INSERT);
        $stmt->bind_param("sssis",$firstname,$lastname,$email,$number,$message);
        $stmt->execut();
    }else{
        echo "Someone already registered using this email";
    }
    $stmt->close();
    $conn->close();

}else{
    echo "All Feild Required";
    die();
}
?>