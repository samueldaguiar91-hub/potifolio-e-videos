<?php
$dataFile = 'data.json';
$uploadDir = 'uploads/';

if(isset($_GET['file'])){
    $fileName = basename($_GET['file']);
    $filePath = $uploadDir . $fileName;

    // Apaga o arquivo da pasta uploads
    if(file_exists($filePath)){
        unlink($filePath);
    }

    // Atualiza o data.json removendo a entrada
    if(file_exists($dataFile)){
        $json = file_get_contents($dataFile);
        $media = json_decode($json, true);

        $media = array_filter($media, function($m) use ($filePath) {
            return $m['path'] !== $filePath;
        });

        file_put_contents($dataFile, json_encode(array_values($media), JSON_PRETTY_PRINT));
    }

    header('Location: index.php');
    exit;
}
?>
