<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $umur = $_POST["umur"];
    $jeniskelamin = $_POST["jeniskelamin"];
    $alamat = $_POST["alamat"];
    $notelp = $_POST["notelp"];
    $member = $_POST["member"];

    $sql = "UPDATE members SET umur=?, jeniskelamin=?, alamat=?, notelp=?, member=? WHERE nama=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ississ", $umur, $jeniskelamin, $alamat, $notelp, $member, $nama);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
 
    if (isset($_GET["nama"])) {
        $nama = $_GET["nama"];

        $sql = "SELECT * FROM members WHERE nama = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nama);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Record not found";
          
        }
        $stmt->close();
    } else {
        echo "Parameter 'nama' tidak ditemukan dalam URL";
    }
}


$id = $_GET["nama"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleupdate.css">
    <title>Edit Member</title>
</head>
<body>

    <div class="container">
        <h1>Edit Member</h1>
        <form method="post" action="">
            
            <label for="nama">Name:</label>
            <input type="text" name="nama" value="<?php echo isset($row['nama']) ? $row['nama'] : ''; ?>" required placeholder="Masukkan Nama yang ingin diganti!">

        
            <label for="umur">Age:</label>
            <input type="number" name="umur" value="<?php echo isset($row['umur']) ? $row['umur'] : ''; ?>" required  placeholder="Masukkan Umur yang ingin diganti!">

            <label for="jeniskelamin">Gender:</label>
            <select name="jeniskelamin" required>
                <option value="Male" <?php echo (isset($row['jeniskelamin']) && $row['jeniskelamin'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo (isset($row['jeniskelamin']) && $row['jeniskelamin'] == 'Female') ? 'selected' : ''; ?>>Female</option>
            </select>

            <label for="alamat">Address:</label>
            <input type="text" name="alamat" value="<?php echo isset($row['alamat']) ? $row['alamat'] : ''; ?>" required placeholder="Masukkan Alamat yang ingin diganti!">

            <label for="notelp">Phone:</label>
            <input type="tel" name="notelp" value="<?php echo isset($row['notelp']) ? $row['notelp'] : ''; ?>" required placeholder="Masukkan No Telepon yang ingin diganti!">

            <label for="member">Membership:</label>
            <select name="member" required>
                <option value="3 months" <?php echo (isset($row['member']) && $row['member'] == '3 months') ? 'selected' : ''; ?>>3 months</option>
                <option value="6 months" <?php echo (isset($row['member']) && $row['member'] == '6 months') ? 'selected' : ''; ?>>6 months</option>
                <option value="12 months" <?php echo (isset($row['member']) && $row['member'] == '12 months') ? 'selected' : ''; ?>>12 months</option>
            </select>

            <button type="submit">Update</button>
            <button class="kembali">Kembali</button>
        </form>
    </div>

</body>
</html>
