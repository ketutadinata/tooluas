<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Periksa apakah parameter 'nama' ada di URL
    if (isset($_GET["nama"])) {
        $nama = $_GET["nama"];

        // Validasi dan lakukan penghapusan
        if (!empty($nama)) {
            $sql = "DELETE FROM members WHERE nama = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("s", $nama);

                if ($stmt->execute()) {
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error deleting record: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error during prepare: " . $conn->error;
            }
        } else {
            echo "No name specified for deletion.";
        }
    } else {
        echo "Invalid request. Missing 'nama' parameter.";
    }
} else {
    echo "Invalid request. Use GET method.";
}

$conn->close();
?>
