<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Submission Result</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        table { border-collapse: collapse; margin-top: 20px; width: 300px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h1>Form Submission Result</h1>

    <?php
    
    include('db_connect.php');

    function insertUser($conn, $name) {
        $stmt = $conn->prepare("INSERT INTO users (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['name'])) {
        $name = htmlspecialchars($_GET['name']);
        if (insertUser($conn, $name)) {
            echo "<p class='success'>Data received via <strong>GET</strong> method!</p>";
            echo "<p>Hello, <strong>$name</strong>! Your data was saved successfully.</p>";
        } else {
            echo "<p class='error'>Error inserting data.</p>";
        }
    }

    elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
        $name = htmlspecialchars($_POST['name']);
        if (insertUser($conn, $name)) {
            echo "<p class='success'>Data received via <strong>POST</strong> method!</p>";
            echo "<p>Hello, <strong>$name</strong>! Your data was saved successfully.</p>";
        } else {
            echo "<p class='error'>Error inserting data.</p>";
        }
    }

    else {
        echo "<p class='error'>No valid form data received.</p>";
        echo "<p>Please return to the form and submit your information.</p>";
    }

    echo "<h2>All Users in Database</h2>";
    $result = $conn->query("SELECT * FROM users ORDER BY id DESC");

    if ($result && $result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Name</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['id'] . "</td><td>" . htmlspecialchars($row['name']) . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No records found.</p>";
    }
    $conn->close();
    ?>

    <p><a href="index.html">Go back to the form</a></p>
</body>
</html>
