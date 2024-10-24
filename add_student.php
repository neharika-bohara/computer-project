<?php
include 'db.php';

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $class = $_POST['class'];
    $email = $_POST['email'];
    
    $sql = "INSERT INTO students (name, roll_no, class, email) VALUES ('$name', '$roll_no', '$class', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        $student_id = $conn->insert_id;
        
        // Adding student marks
        foreach ($_POST['subject'] as $index => $subject) {
            $marks = $_POST['marks'][$index];
            $sql_marks = "INSERT INTO results (student_id, subject, marks) VALUES ('$student_id', '$subject', '$marks')";
            $conn->query($sql_marks);
        }

        echo "Student added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Add Student</h2>
    <form method="POST" action="">
        <label>Name:</label>
        <input type="text" name="name" required><br><br>
        
        <label>Roll No:</label>
        <input type="text" name="roll_no" required><br><br>
        
        <label>Class:</label>
        <input type="text" name="class" required><br><br>
        
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        
        <label>Subject:</label><br>
        <input type="text" name="subject[]" required placeholder="Subject 1"><br>
        <input type="text" name="subject[]" required placeholder="Subject 2"><br>
        <input type="text" name="subject[]" required placeholder="Subject 3"><br>
        
        <label>Marks:</label><br>
        <input type="number" name="marks[]" required><br>
        <input type="number" name="marks[]" required><br>
        <input type="number" name="marks[]" required><br>
        
        <button type="submit" name="submit">Add Student</button>
    </form>
</body>
</html>
