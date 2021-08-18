<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
<body>
    <?php
    $name = $email = $gender = $comment = $website = "";

    if ($_SERVER["REQUEST_METHOD"] =="POST"){
        $name = test_input($_POST["name"]);
        $class = test_input($_POST["class"]);
        $age = test_input($_POST["age"]);
        $comment = test_input($_POST["comment"]);
        $gender = test_input($_POST["gender"]);
    }

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <h2>PHP Form Validation Example</h2>
        <form method="POST" action="<?php echo
           htmlspecialchars($_SERVER["PHP_SELF"]);?>">
           
            Name: <input type="text" name="name" required><br><br>
            Class: <input type="text" name="class"><br><br>
            Age: <input type="number" name="age"><br><br>
            Comment: <textarea name="comment" rows="5" cols="40"></textarea><br><br>
            Gender: 
            <input type="radio" name="gender" value="female">Female
            <input type="radio" name="gender" value="male">Male<br><br>
            <button type="submit" name="submit">Submit</button>
        </form>

      <?php
//To send to database:
//$conn = new mysqli('localhost', 'root', '', 'test');
$conn = new mysqli('mysql-45447-0.cloudclusters.net', 'admin', 'yI0N6JET', 'The_Potentate_Schools', '17418');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}else{
    $stmt = $conn->prepare("INSERT INTO students(Name, Class, Age, Gender) VALUES(?,?,?,?)");
    $stmt->bind_param("ssis",$name,$class,$age,$gender);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>
       
       
                
</body>
</html>