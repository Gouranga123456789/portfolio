<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Basic validation
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: https://gouranga123456789.github.io/portfolio/?error=invalid");
        exit;
    }

    // ================== CHANGE THESE CREDENTIALS ==================
    $servername = "sql100.infinityfree.com";     // Check your exact hostname in InfinityFree control panel
    $db_username = "if0_40998614";                 // Your InfinityFree username (if0_xxxxxx)
    $db_password = "72D5aftiSa1SCkp";       // Your InfinityFree account password
    $dbname      = "if0_40998614_contact_db";          // Your full database name (e.g. if0_123456_myport)
    // ==============================================================

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        header("Location: https://gouranga123456789.github.io/portfolio/?error=db");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        header("Location: https://gouranga123456789.github.io/portfolio/?success=1");
    } else {
        header("Location: https://gouranga123456789.github.io/portfolio/?error=db");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: https://gouranga123456789.github.io/portfolio/");
}
?>