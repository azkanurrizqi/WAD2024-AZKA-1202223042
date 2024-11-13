<?php

include("dbconnection.php");

// buatkan function addStudent()
function addStudent()
{
    // variabel global
    global $conn;

    // Silakan buat variabel di bawah dengan data yang diambil dari form
    $NIM = $_POST["stuid"];
    $Nama = $_POST["stuname"];
    $Jurusan = $_POST["stuclass"];
    $Angkatan = $_POST["stuangkatan"];

    // Periksa apakah NIM sudah ada
    $ret = mysqli_query($conn, "SELECT * FROM tb_student WHERE nim = $NIM");

    if (mysqli_num_rows($ret) == 0) {
        // Masukkan data ke tabel tb_student
        $query = "INSERT INTO tb_student (stuid, stuname, stuclass, stuangkatan)
                  VALUES ('$NIM', '$Nama', '$Jurusan', '$Angkatan')";
        $result = mysqli_query($conn, $query);
        if (mysqli_affected_rows($conn) > 0) {
            header("Location : add-students.php");
        } else {
            echo "
            <script>
                alert ('Nim sudah ada');
                document.location.href = add-student.php;
            </script>
            ";
            exit;
        }

        /**
         * Buatlah logika untuk Memeriksa hasil dari operasi penambahan data mahasiswa.
         * 
         * Jika operasi berhasil, menampilkan pesan bahwa mahasiswa telah ditambahkan
         * dan mengarahkan pengguna ke halaman 'add-students.php'.
         * Jika operasi gagal, menampilkan pesan kesalahan.
         * Jika NIM sudah ada, menampilkan pesan bahwa NIM sudah ada.
         */
        
    }
}

function editStudent($id) {
    global $conn;

    // Ambil input dari form dan simpan dalam variabel
    $NIM = $_POST["stuid"];
    $Nama = $_POST["stuname"];
    $Jurusan = $_POST["stuclass"];
    $Angkatan = $_POST["stuangkatan"];


    // Isi query dibawah untuk update data mahasiswa berdasarkan ID
    $query = "UPDATE tb_student SET
              stuid = '$NIM',
              stuname = '$Nama',
              stuclass = '$Jurusan',
              stuangkatan = '$Angkatan',
              WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>alert("Student data has been updated.")</script>';
        echo "<script>window.location.href ='manage-students.php'</script>";
    } else {
        echo '<script>alert("Something Went Wrong. Please try again.")</script>';
    }
}


?>