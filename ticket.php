<?php
$success = false;
$error = false;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Database config
    $host = "localhost";
    $user = "root"; // default for XAMPP
    $pass = "";
    $db = "ticket_booking";

    // Connect to DB
    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        $error = "Database connection failed: " . $conn->connect_error;
    } else {
        // Escape and assign form values
        $first = $conn->real_escape_string($_POST["first_name"]);
        $last = $conn->real_escape_string($_POST["last_name"]);
        $company = $conn->real_escape_string($_POST["company_name"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $whatsapp = $conn->real_escape_string($_POST["whatsapp"]);
        $designation = $conn->real_escape_string($_POST["designation"]);
        $country = $conn->real_escape_string($_POST["country"]);

        // Insert into DB
        $sql = "INSERT INTO bookings (first_name, last_name, company_name, email, whatsapp, designation, country)
                VALUES ('$first', '$last', '$company', '$email', '$whatsapp', '$designation', '$country')";

        if ($conn->query($sql) === TRUE) {
            $success = true;
        } else {
            $error = "Error inserting data: " . $conn->error;
        }

        $conn->close();
    }
}
?>

<!-- Alerts -->
<?php if ($success): ?>
    <script>
    alert("Ticket successfully booked!");
    window.location.href = "home.html";
    </script>
<?php elseif ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
