<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "siswa";

    // Enable error reporting for debugging
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect data from the form
    $nis = $_POST["nis"];
    $nama = $_POST["nama"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $telp = $_POST["telp"];
    $alamat = $_POST["alamat"];

    $stmt = $conn->prepare("INSERT INTO siswa (nis, nama, jenis_kelamin, telp, alamat, foto) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind parameters dan execute statement
    if ($stmt) {
        $stmt->bind_param("ssssss", $nis, $nama, $jenis_kelamin, $telepon, $alamat, $target_file);
        if (!$stmt->execute()) {
            // Menampilkan error jika ada
            echo "Execute failed: " . htmlspecialchars($stmt->error);
        } else {
            echo "Siswa baru berhasil ditambahkan.";
        }
        $stmt->close();
    } else {
        echo "Prepare failed: " . htmlspecialchars($conn->error);
    }
    
    
// Attempt to upload the file
$target_dir = "/opt/lampp/htdocs/crud_upload/";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);

if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
    // Success
} else {
    // Fail
    echo "Maaf, terdapat kesalahan saat mengunggah file.";
}

if ($_FILES["foto"]["error"] > 0) {
    echo "Error: " . $_FILES["foto"]["error"];
} else {
    // Coba pindahkan file
}
}
?>

