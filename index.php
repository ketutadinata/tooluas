<?php
include 'includes/db.php';

$sql = "SELECT * FROM members";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">

    <title>Zuki Fitness</title>


</head>
<body>
<header class="site-header">
        <div class="logo">
            <img src="logogym.png" alt="Gym Logo">
        </div>
        <h1 class="site-title">Gocek Fitness</h1>
        <nav class="main-nav">
            <ul>
            <a href="index.html" class="ahome">Home</a>
            <a href="index.php" class="amember">Member</a>
            </ul>
        </nav>
    </header>
        



    <div class="container">
        <h1>List Member Gocek Fitness</h1>

        <table>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Membership</th>
                <th>Action</th>
            </tr>
            
            <?php
            if ($result) {
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . (isset($row['nama']) ? $row['nama'] : '') . "</td>";
                        echo "<td>" . (isset($row['umur']) ? $row['umur'] : '') . "</td>";
                        echo "<td>" . (isset($row['jeniskelamin']) ? $row['jeniskelamin'] : '') . "</td>";
                        echo "<td>" . (isset($row['alamat']) ? $row['alamat'] : '') . "</td>";
                        echo "<td>" . (isset($row['notelp']) ? $row['notelp'] : '') . "</td>";
                        echo "<td>" . (isset($row['member']) ? $row['member'] : '') . "</td>";
                      

                        echo "<td><a href='update.php?nama=" . (isset($row['nama']) ? $row['nama'] : '') . "'>Edit</a> | <a href='delete.php?nama=" . (isset($row['nama']) ? $row['nama'] : '') . "'>Delete</a></td>";
                        echo "</tr>";

                        


                       
                    }
                    

                    
                } else {
                    echo "<tr><td colspan='8'>No members found</td></tr>";
                }
            } else {
        
                echo "<tr><td colspan='8'>Error executing the query</td></tr>";
            }
            ?>

        </table>
        <a href="create.php"class="button">Daftar Sekarang!</a>
    </div>

    <footer class="site-footer">
        <p>&copy; 2023 Gocek Fitness.</p>
    </footer>

</body>
</html>

<?php
$conn->close();
?>
