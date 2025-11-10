<?php
$dataFile = 'data.json';
$uploadDir = 'uploads/';

// Cria a pasta uploads se não existir
if (!is_dir($uploadDir)) {
    if(!mkdir($uploadDir, 0777, true)) {
        die("Erro ao criar a pasta de uploads.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $fileName = basename($_FILES['file']['name']);
    $fileType = $_FILES['file']['type'];
    $targetPath = $uploadDir . time() . "_" . $fileName;

    // Verifica se o arquivo foi enviado corretamente
    if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
        die("Nenhum arquivo enviado ou erro no upload.");
    }

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
        $newEntry = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'path' => $targetPath,
            'type' => $fileType
        ];

        $media = [];
        if (file_exists($dataFile)) {
            $json = file_get_contents($dataFile);
            $media = json_decode($json, true);
        }

        $media[] = $newEntry;
        file_put_contents($dataFile, json_encode($media, JSON_PRETTY_PRINT));

        header('Location: index.php');
        exit;
    } else {
        die("Erro ao mover o arquivo para a pasta uploads. Verifique permissões.");
    }
}
?>
