<?php
require_once "config.php";

if (is_logged_in()) {
  header("Location: dashboard.php");
  exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Compte — Connexion / Inscription</title>
  <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>
<main class="auth-container">
  <h1>Compte utilisateur</h1>
  <p class="muted">Choisis une option :</p>

  <div class="auth-actions">
    <a href="login.php" class="btn-homepage">Se connecter</a>
    <a href="register.php" class="btn--ghost-homepage">Créer un compte</a>
  </div>

  <a class="link" href="#" onclick="history.back();">← Retour</a>
 
</main>
</body>
</html>
