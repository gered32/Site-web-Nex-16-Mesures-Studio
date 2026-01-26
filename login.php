<?php
require_once "config.php";

if (is_logged_in()) {
  header("Location: dashboard.php");
  exit;
}

$error_msg = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = trim($_POST["email"] ?? "");
  $password = $_POST["password"] ?? "";

  $users = load_users();
  $user = find_user_by_email($email, $users);

  if (!$user) {
    $error_msg = "Aucun compte n’est associé à cet email.";
  } elseif (!password_verify($password, $user["password_hash"])) {
    $error_msg = "Mot de passe incorrect.";
  } else {
    // ✅ Connexion OK : on “retient” l’utilisateur
    $_SESSION["user"] = [
      "email" => $user["email"],
      "username" => $user["username"] ?? "Utilisateur"
    ];
    header("Location: dashboard.php");
    exit;
  }
}

if (!$error_msg && isset($_GET["error"]) && $_GET["error"] === "login_required") {
  $error_msg = "Tu dois être connecté pour accéder à cette page.";
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Connexion</title>
  <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>
<main class="auth-container">
  <h1>Connexion</h1>

  <?php if ($error_msg): ?>
    <p class="error"><?php echo htmlspecialchars($error_msg); ?></p>
  <?php endif; ?>

  <form method="post" action="login.php" class="auth-form">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit" class="btn-homepage">Se connecter</button>
  </form>

  <p class="muted">Pas de compte ? <a class="link" href="register.php">Créer un compte</a></p>
  <a class="link" href="authentification.php">← Retour</a>
</main>
</body>
</html>

