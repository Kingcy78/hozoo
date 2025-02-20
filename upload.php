<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = "/var/www/html/uploads/";
    $uploadFile = $uploadDir . basename($_FILES["backup"]["name"]);

    if (move_uploaded_file($_FILES["backup"]["tmp_name"], $uploadFile)) {
        echo "File berhasil diunggah!";
        
        // Ekstrak ke Docker Volume (Gantilah dengan lokasi sesuai kebutuhan)
        $containerName = "termux-novnc";
        shell_exec("docker cp $uploadFile $containerName:/root/");
        shell_exec("docker exec $containerName tar -xvzf /root/" . basename($_FILES["backup"]["name"]) . " -C /root/");
        
        echo "<br>Backup telah dipulihkan!";
    } else {
        echo "Gagal mengunggah file.";
    }
}
?>
