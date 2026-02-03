<?php
// On charge la config (Le ../ suppose que ce fichier est dans un dossier, ex: /pages/)
// Si ce fichier est à la racine, mettez juste "config.php"
require_once "../config.php"; 

// 1. PROTECTION : Si pas connecté, on renvoie au login
if (!is_logged_in()) {
    header("Location: ../login.php?error=login_required");
    exit;
}

// Initialisation de la "réservation en cours"
if (!isset($_SESSION['reservation_item'])) {
    $_SESSION['reservation_item'] = null;
}

$message = "";

// 2. TRAITEMENT DES ACTIONS
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // --- A. SÉLECTIONNER UN PACK (Mise en mémoire) ---
    if (isset($_POST['select_service'])) {
        $_SESSION['reservation_item'] = $_POST['select_service'];
        // On redirige vers l'ancre #reservation pour une expérience fluide
        header("Location: prestations.php#reservation"); 
        exit;
    }

    // --- B. ANNULER LA SÉLECTION ---
    if (isset($_POST['cancel_service'])) {
        $_SESSION['reservation_item'] = null;
    }

    // --- C. VALIDER LA RÉSERVATION (Vérification du MDP) ---
    if (isset($_POST['confirm_booking'])) {
        $mdp_saisi = $_POST['password_verif'];
        $email_actuel = $_SESSION['user']['email'];
        
        // Données du formulaire
        $date_souhaitee = $_POST['datetime'];
        $details = $_POST['details'];
        $service_choisi = $_SESSION['reservation_item'];

        // Chargement des utilisateurs pour vérifier le vrai hash
        $users = load_users(); 
        $user_info = find_user_by_email($email_actuel, $users);

        if ($user_info && password_verify($mdp_saisi, $user_info['password_hash'])) {
            // C'est ici qu'on enregistrerait la réservation dans une BDD ou on enverrait un mail
            $message = "<div class='success-box'>✅ Réservation confirmée pour <strong>$service_choisi</strong> !<br>Date : $date_souhaitee. On revient vers toi vite.</div>";
            $_SESSION['reservation_item'] = null; // On vide la sélection
        } else {
            $message = "<div class='error-box'>❌ Mot de passe incorrect. Réservation non validée.</div>";
        }
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Prestations — 16 Mesures Records</title>
  <link rel="stylesheet" href="../css/16mesures.css" />
  <link rel="stylesheet" href="../css/prestations.css" />
  
  <style>
      /* Petit style inline pour les messages PHP (à mettre dans ton CSS idéalement) */
      .success-box { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0; text-align: center; border: 1px solid #c3e6cb; }
      .error-box { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin: 20px 0; text-align: center; border: 1px solid #f5c6cb; }
      .selected-service-info { background: #e2e6ea; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #333; }
  </style>
</head>
<body>

  <header class="main-header">
    <div class="logo-container">
      <a href="../index.html" title="Retour à l'accueil">
        <img class="logo-float" alt="Logo 16 Mesures Records" src="../img/16mesures_logo.png" />
      </a>
    </div>

    <nav class="main-nav">
      <div class="burger-menu">
        <span></span><span></span><span></span>
      </div>
      <ul class="nav-list">
        <li><a href="../index.html">Accueil</a></li>
        <li><a href="prestations.php" class="active">Prestations</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>

    <a href="../authentification.php" class="nav-account" aria-label="Compte">
      <span style="font-size: 0.8rem; margin-right: 10px; color: white;"><?= htmlspecialchars($_SESSION['user']['username']) ?></span>
      <img src="../img/profilutilisateuranon.png" alt="Compte utilisateur" />
    </a>
  </header>

  <main class="page">

    <section class="hero container">
      <h1>Prestations</h1>

      <?= $message ?>
    </section>

    <section class="section container" id="packs">
      <div class="section-head">
        <h2>Packs Studio</h2>
        <p>Idéal pour enregistrer des voix propres et avancer rapidement sur ton morceau.</p>
      </div>

      <div class="cards">
        <article class="card">
          <h3>Pack Découverte — 1h</h3>
          <ul>
            <li>Réglage micro & niveaux</li>
            <li>Prise voix / test</li>
            <li>Export WAV</li>
          </ul>
          <div class="card-footer">
            <span class="price">30€</span>
            <form method="post">
                <input type="hidden" name="select_service" value="Pack Découverte (1h)">
                <button type="submit" class="btn-primary">Sélectionner</button>
            </form>   
          </div>
        </article>

        <article class="card">
          <h3>Pack Session — 2h</h3>
          <ul>
            <li>Enregistrement complet (1 morceau)</li>
            <li>Édition légère</li>
            <li>Exports WAV + MP3</li>
          </ul>
          <div class="card-footer">
            <span class="price">60€</span>
            <form method="post">
                <input type="hidden" name="select_service" value="Pack Session (2h)">
                <button type="submit" class="btn-primary">Sélectionner</button>
            </form>
          </div>
        </article>

        <article class="card highlight">
          <div class="badge">Le plus choisi</div>
          <h3>Pack Track — 4h</h3>
          <ul>
            <li>Enregistrement + DA</li>
            <li>Nettoyage voix + pré-mix</li>
            <li>Exports stems si besoin</li>
          </ul>
          <div class="card-footer">
            <span class="price">100€</span>
            <form method="post">
                <input type="hidden" name="select_service" value="Pack Track (4h)">
                <button type="submit" class="btn-primary">Sélectionner</button>
            </form>
          </div>
        </article>
      </div>
    </section>

    <section class="section container" id="mixmaster">
      <div class="section-head">
        <h2>Mix & Master</h2>
        <p>Pour un rendu propre, équilibré et prêt pour les plateformes.</p>
      </div>

      <div class="cards two">
        <article class="card">
          <h3>Mixage</h3>
          <ul>
            <li>Équilibrage, EQ, compression</li>
            <li>2 révisions incluses</li>
          </ul>
          <div class="card-footer">
            <span class="price">50€</span>
            <form method="post">
                <input type="hidden" name="select_service" value="Mixage Simple">
                <button type="submit" class="btn-ghost">Sélectionner</button>
            </form>
          </div>
        </article>

        <article class="card">
            <h3>Mastering</h3>
            <ul>
              <li>Optimisation loudness</li>
              <li>Rendu streaming-ready</li>
            </ul>
            <div class="card-footer">
              <span class="price">30€</span>
              <form method="post">
                  <input type="hidden" name="select_service" value="Mastering">
                  <button type="submit" class="btn-ghost">Sélectionner</button>
              </form>
            </div>
          </article>
      </div>
    </section>

    <section class="section container" id="reservation">
      <div class="section-head">
        <h2>Réserver une session</h2>
        <p>Choisis un créneau et valide avec ton mot de passe.</p>
      </div>

      <div class="booking">
        
        <?php if (!$_SESSION['reservation_item']): ?>
            <div style="text-align: center; padding: 40px; background: #fff; border-radius: 8px;">
                <h3>Aucune prestation sélectionnée</h3>
                <p>Veuillez choisir un pack ci-dessus pour accéder au formulaire de réservation.</p>
                <a href="#packs" class="btn-primary">Choisir un Pack</a>
            </div>

        <?php else: ?>
            
            <div class="selected-service-info">
                <h3>Prestation choisie : <span style="color: #007bff;"><?= htmlspecialchars($_SESSION['reservation_item']) ?></span></h3>
                <form method="post" style="display:inline;">
                    <button type="submit" name="cancel_service" style="background:none; border:none; text-decoration:underline; cursor:pointer; color: red;">(Changer de pack)</button>
                </form>
            </div>

            <form class="booking-form" method="post">
                <label>
                    Nom / Blaze (Compte)
                    <input type="text" value="<?= htmlspecialchars($_SESSION['user']['username']) ?>" disabled style="background:#eee;">
                </label>

                <label>
                    Email de contact
                    <input type="email" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" disabled style="background:#eee;">
                </label>

                <label>
                    Date / Heure souhaitée
                    <input type="text" name="datetime" placeholder="Ex : Mercredi 12 Oct à 17h00" required>
                </label>

                <label>
                    Détails du projet (BPM, mood, instru...)
                    <textarea name="details" rows="5" placeholder="Dis-moi ce dont tu as besoin..." required></textarea>
                </label>

                <hr style="margin: 20px 0; border: 0; border-top: 1px solid #ddd;">
                
                <label style="font-weight: bold; color: #333;">
                    Confirmer la réservation avec votre mot de passe :
                    <input type="password" name="password_verif" placeholder="Mot de passe du compte" required style="margin-top: 5px;">
                </label>

                <button class="btn-primary" type="submit" name="confirm_booking">Valider la demande</button>
                <p class="note">En validant, vous vous engagez à être présent au studio.</p>
            </form>

        <?php endif; ?>

      </div>
    </section>

  </main>

  <footer class="main-footer">
    <div class="footer-copy">
      <p>&copy; 2026 16 Mesures Records</p>
    </div>
    <div class="footer-links">
      <a href="contact.php">Contact</a>
      <a href="mentions-legales.php">Mentions Légales</a>
    </div>
  </footer>

</body>
</html>