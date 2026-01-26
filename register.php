<?php
require_once "config.php";

if (is_logged_in()) {
  header("Location: dashboard.php");
  exit;
}

$error_msg = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = trim($_POST["username"] ?? "");
  $email = trim($_POST["email"] ?? "");
  $password = $_POST["password"] ?? "";

  if (strlen($username) < 2) {
    $error_msg = "Le nom d’utilisateur doit faire au moins 2 caractères.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_msg = "Email invalide.";
  } elseif (strlen($password) < 6) {
    $error_msg = "Le mot de passe doit faire au moins 6 caractères.";
  } else {
    $users = load_users();
    if (find_user_by_email($email, $users)) {
      $error_msg = "Un compte existe déjà avec cet email.";
    } else {
      $users[] = [
        "username" => $username,
        "email" => $email,
        "password_hash" => password_hash($password, PASSWORD_DEFAULT),
        "created_at" => date("c")
      ];
      save_users($users);

      // ✅ Connexion automatique après inscription
      $_SESSION["user"] = ["email" => $email, "username" => $username];
      header("Location: dashboard.php");
      exit;
    }
  }
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inscription</title>
  <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>
<main class="auth-container">
  <h1>Créer un compte</h1>

  <?php if ($error_msg): ?>
    <p class="error"><?php echo htmlspecialchars($error_msg); ?></p>
  <?php endif; ?>

  <form method="post" action="register.php" class="auth-form">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe (min 6)" required>
    <button type="submit" class="btn-homepage">Créer mon compte</button>
  </form>

  <p class="muted">Déjà un compte ? <a class="link" href="login.php">Se connecter</a></p>
  <a class="link" href="authentification.php">← Retour</a>
</main>
</body>
</html>
