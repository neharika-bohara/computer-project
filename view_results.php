<?php
include 'db.php';

if(isset($_POST['view'])) {
    $roll_no = $_POST['roll_no'];
    $sql = "SELECT s.name, s.class, r.subject, r.marks 
            FROM students s
            JOIN results r ON s.id = r.student_id
            WHERE s.roll_no = '$roll_no'";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<h2>Result of Roll No: $roll_no</h2>";
        while($row = $result->fetch_assoc()) {
            echo "Name: " . $row['name'] . "<br>";
            echo "Class: " . $row['class'] . "<br>";
            echo "Subject: " . $row['subject'] . " - Marks: " . $row['marks'] . "<br><br>";
        }
    } else {
        echo "No results found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>View Student Results</h2>
    <form method="POST" action="">
        <label>Enter Roll No:</label>
        <input type="text" name="roll_no" required><br><br>
        <button type="submit" name="view">View Results</button>
    </form>
</body>
</html>
