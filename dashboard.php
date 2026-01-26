<?php
require_once "config.php";
require_login();

$user = $_SESSION["user"];
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<main class="auth-container">
  <h1>Bienvenue 👋</h1>
  <p class="muted">
    Connecté en tant que <strong><?php echo htmlspecialchars($user["username"]); ?></strong>
    (<?php echo htmlspecialchars($user["email"]); ?>)
  </p>

  <div class="auth-actions">
    <a href="index.html" class="btn--ghost-homepage">Retour au site</a>
    <a href="logout.php" class="btn-homepage">Se déconnecter</a>
  </div>
</main>
</body>
</html>
