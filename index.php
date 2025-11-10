<?php
// Carrega dados do JSON
$dataFile = 'data.json';
$media = [];

if(file_exists($dataFile)){
    $json = file_get_contents($dataFile);
    $media = json_decode($json, true);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Portfólio Samuel Aguiar</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Orbitron', sans-serif; }
body { 
    min-height:100vh; 
    padding:20px;
    background: 
        radial-gradient(circle at 20% 40%, #313e47ff, transparent 60%),
        radial-gradient(circle at 80% 70%, #0a635cff, transparent 60%),
        radial-gradient(circle at 50% 50%, #041d41ff, transparent 70%);
    background-color: #001f3f;
    background-blend-mode: screen;
    color:#fff; 
}
h1 { text-align:center; margin-bottom:20px; font-size:3em; }
form { background:rgba(255,255,255,0.05); padding:20px; border-radius:15px; max-width:600px; margin:0 auto 40px; }
input, textarea { width:100%; padding:10px; margin-bottom:10px; border-radius:10px; border:none; }
button { padding:10px 20px; border:none; border-radius:15px; background:#ff69b4; color:#fff; font-weight:bold; cursor:pointer; transition:0.3s; }
button:hover { background:#ff85c1; }
.gallery { display:flex; flex-wrap:wrap; gap:20px; justify-content:center;}
.item { background:rgba(255,255,255,0.05); padding:10px; border-radius:15px; width:300px; text-align:center;}
.item video, .item img { width:100%; border-radius:15px; }
.item h3 { margin-top:10px; }
.item p { font-size:0.9em; color:#ccc; }
.contacts { text-align:center; padding:40px 20px; }
.contacts a { display:inline-block; margin:10px 15px; padding:12px 25px; border:2px solid #fff; border-radius:25px; text-decoration:none; color:#fff; font-weight:bold; transition:0.3s; }
.contacts a:hover { background:#fff; color:#06132f; }
footer { text-align:center; padding:20px; color:#ccc; margin-top:40px; }
@media(max-width:768px) { .gallery { flex-direction:column; align-items:center; } }
</style>
</head>
<body>

<h1>Portfólio Samuel Aguiar</h1>

<!-- Formulário de Upload -->
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Título do vídeo/imagem" required>
    <textarea name="description" placeholder="Descrição" rows="3" required></textarea>
    <input type="file" name="file" accept="video/*,image/*" required>
    <button type="submit">Enviar</button>
</form>

<!-- Galeria -->
<div class="gallery">
<?php foreach($media as $m): ?>
    <div class="item">
        <?php if(strpos($m['type'], 'video') !== false): ?>
            <video controls>
                <source src="<?php echo $m['path']; ?>" type="<?php echo $m['type']; ?>">
                Seu navegador não suporta vídeo.
            </video>
        <?php else: ?>
            <img src="<?php echo $m['path']; ?>" alt="<?php echo htmlspecialchars($m['title']); ?>">
        <?php endif; ?>
        <h3><?php echo htmlspecialchars($m['title']); ?></h3>
        <p><?php echo htmlspecialchars($m['description']); ?></p>
    </div>
<?php endforeach; ?>
</div>

<!-- Contatos -->
<div class="contacts">
    <a href="https://www.instagram.com/Aguiar._.s/" target="_blank">Instagram</a>
    <a href="mailto:samueldaguiar91@gmail.com">E-mail</a>
    <a href="https://wa.me/5592993466386" target="_blank">WhatsApp</a>
</div>

<footer>&copy; 2025 Samuel Aguiar</footer>

</body>
</html>
