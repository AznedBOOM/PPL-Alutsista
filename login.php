<?php
// Koneksi ke database (ganti nilai sesuai konfigurasi database Anda)
$host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'ppl_alutsista';

$conn = mysqli_connect($host, $db_user, $db_password, $db_name);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil data dari form
$email = $_POST['email'];
$password = $_POST['password'];

// Lindungi dari serangan SQL Injection
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

// Query untuk memeriksa informasi login
$query = "SELECT * FROM alutsista WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Pengecekan jumlah baris hasil query
    $row_count = mysqli_num_rows($result);

    if ($row_count == 1) {
        // Login berhasil
        session_start();
        $_SESSION['email'] = $email;
        header('Location: dashboard.html'); // Redirect ke halaman setelah login sukses
    } else {
        // Login gagal
        echo "Login gagal. Periksa email dan password Anda.";
    }
} else {
    // Kesalahan eksekusi query
    echo "Error: " . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);
?>
