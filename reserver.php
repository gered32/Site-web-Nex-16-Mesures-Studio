<?php
require_once "config.php"; // On charge vos outils (load_users, session, etc.)

// 1. PROTECTION : Si pas connecté, on renvoie au login
if (!is_logged_in()) {
    header("Location: login.php?error=login_required");
    exit;
}

// Initialisation du panier
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

$message = "";

// 2. TRAITEMENT DU FORMULAIRE
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // --- A. AJOUTER AU PANIER ---
    if (isset($_POST['article'])) {
        $article = $_POST['article'];
        // Règle : 1 seul exemplaire de chaque
        if (!in_array($article, $_SESSION['panier'])) {
            $_SESSION['panier'][] = $article;
        }
    }

    // --- B. VALIDER L'ACHAT (Vérification du MDP JSON) ---
    if (isset($_POST['confirmer_achat'])) {
        $mdp_saisi = $_POST['password_verif'];
        $email_actuel = $_SESSION['user']['email']; // L'email de la session en cours

        // On charge les utilisateurs depuis le JSON via vos fonctions existantes
        $users = load_users(); 
        $user_info = find_user_by_email($email_actuel, $users);

        // On vérifie le mot de passe avec le hash du JSON
        if ($user_info && password_verify($mdp_saisi, $user_info['password_hash'])) {
            $message = "<div class='success'>✅ Paiement accepté ! Merci " . htmlspecialchars($user_info['username']) . ".</div>";
            $_SESSION['panier'] = []; // On vide le panier
        } else {
            $message = "<div class='error'>❌ Mot de passe incorrect.</div>";
        }
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Boutique</title>
  <link rel="stylesheet" href="./CSS/reserver.css">
</head>

<body class="boutique-page">

<main class="auth-container"> 
  <h1>Boutique VIP</h1>
  <p>Connecté en tant que : <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong></p>
  
  <?= $message ?>

  <div class="catalogue">
      <div class="card">
          <h3>PC Gamer</h3>
          <form method="post">
              <input type="hidden" name="article" value="PC Gamer">
              <?php if(in_array("PC Gamer", $_SESSION['panier'])): ?>
                  <button disabled>Déjà ajouté</button>
              <?php else: ?>
                  <button type="submit" class="btn-homepage">Acheter</button>
              <?php endif; ?>
          </form>
      </div>

      <div class="card">
          <h3>Console</h3>
          <form method="post">
              <input type="hidden" name="article" value="Console">
              <?php if(in_array("Console", $_SESSION['panier'])): ?>
                  <button disabled>Déjà ajouté</button>
              <?php else: ?>
                  <button type="submit" class="btn-homepage">Acheter</button>
              <?php endif; ?>
          </form>
      </div>

      <div class="card">
          <h3>Casque VR</h3>
          <form method="post">
              <input type="hidden" name="article" value="Casque VR">
              <?php if(in_array("Casque VR", $_SESSION['panier'])): ?>
                  <button disabled>Déjà ajouté</button>
              <?php else: ?>
                  <button type="submit" class="btn-homepage">Acheter</button>
              <?php endif; ?>
          </form>
      </div>
  </div>

  <?php if (!empty($_SESSION['panier'])): ?>
      <div class="panier-box">
          <h2>Votre Panier</h2>
          <ul>
              <?php foreach ($_SESSION['panier'] as $prod): ?>
                  <li><?= $prod ?></li>
              <?php endforeach; ?>
          </ul>

          <hr>
          <h3>Confirmer l'achat</h3>
          <p>Pour sécurité, retapez le mot de passe de votre compte :</p>
          
          <form method="post" class="auth-form">
              <input type="password" name="password_verif" placeholder="Votre mot de passe actuel" required>
              <button type="submit" name="confirmer_achat" class="btn-homepage">Valider et Payer</button>
          </form>
      </div>
  <?php endif; ?>

  <br>
  <a class="link" href="logout.php">Se déconnecter</a>
</main>

</body>
</html>