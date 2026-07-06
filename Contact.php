<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Sovergin_awards";

// Connect
$conn = new mysqli($servername, $username, $password, $dbname);

// Check
if ($conn->connect_error) {
    echo "<script>alert('❌ Database connection failed!'); window.history.back();</script>";
    exit();
}

$company_name = $_POST['company_name'];
$your_name    = $_POST['your_name'];
$email        = $_POST['email'];
$whatsapp     = $_POST['whatsapp'];
$category     = $_POST['category'];
$agree        = isset($_POST['agree']) ? 1 : 0;

// Insert
$stmt = $conn->prepare("INSERT INTO nominations (whatsapp, company_name, your_name, email, category, agree) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssi", $whatsapp, $company_name, $your_name, $email, $category, $agree);

if ($stmt->execute()) {
    echo "<script>
        alert('✅ Nomination submitted successfully!');
        window.location.href = 'sovreign.html';
    </script>";
} else {
    if ($conn->errno == 1062) {
        echo "<script>
            alert('⚠️ This WhatsApp number has already submitted.');
            window.history.back();
        </script>";
    } else {
        echo "<script>
            alert('❌ Submission failed. Please try again.');
            window.history.back();
        </script>";
    }
}

$stmt->close();
$conn->close();
?>
