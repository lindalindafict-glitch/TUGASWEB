<?php

require_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nim = $_POST["nim"];
    $nama = $_POST["nama"];
    $program_studi = $_POST["program_studi"];
    $email = $_POST["email"];
    $nomor_telepon = $_POST["nomor_telepon"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Format email tidak valid.");
    }

    $stmt = $conn->prepare(
        "INSERT INTO mahasiswa (nim, nama, program_studi, email, nomor_telepon)
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "sssss",
        $nim,
        $nama,
        $program_studi,
        $email,
        $nomor_telepon
    );

    if ($stmt->execute()) {
        header("Location: data_mahasiswa.php?status=sukses");
        exit;
    } else {
        echo "Data gagal disimpan.";
    }

    $stmt->close();
}

$conn->close();

?>