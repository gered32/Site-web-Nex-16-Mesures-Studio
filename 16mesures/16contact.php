<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact — 16 Mesures Records</title>

  <link rel="stylesheet" href="../css/16mesures.css" />
  <link rel="stylesheet" href="../css/16contact.css" />
</head>
<body>

  <!-- HEADER (identique au reste du site) -->
  <header class="main-header">
    <div class="logo-container">
      <a href="../index.html" title="Retour à l'accueil">
        <img class="logo-float" src="../img/16mesures_logo.png" alt="Logo 16 Mesures Records">
      </a>
    </div>

    <nav class="main-nav">
      <div class="burger-menu">
        <span></span><span></span><span></span>
      </div>
      <ul class="nav-list">
        <li><a href="../index.html">Accueil</a></li>
        <li><a href="prestation.php">Prestations</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>

    <a href="../authentification.php" class="nav-account">
      <img src="../img/profilutilisateuranon.png" alt="Compte utilisateur">
    </a>
  </header>

  <!-- CONTENU -->
  <main class="page-contact container">

    <header class="contact-head">
      <h1>Contact</h1>
      <p>
        Une question, un devis, une réservation ou simplement envie d’échanger sur ton projet 
        Écris-moi, je te répondrai rapidement.
      </p>
    </header>

    <section class="contact-grid">

      <!-- FORMULAIRE -->
      <form class="contact-form" action="contact.php" method="post">
        <label>
          Nom / Blaze
          <input type="text" name="name" required>
        </label>

        <label>
          Email
          <input type="email" name="email" required>
        </label>

        <label>
          Sujet
          <select name="subject" required>
            <option value="">Choisir…</option>
            <option>Réservation studio</option>
            <option>Devis Mix / Master</option>
            <option>Projet EP / Album</option>
            <option>Autre demande</option>
          </select>
        </label>

        <label>
          Message
          <textarea name="message" rows="6" placeholder="Explique-moi ton projet"></textarea>
        </label>

        <button type="submit" class="btn-primary">
          Envoyer le message
        </button>

        <p class="note">
          Réponse sous 24 à 48h maximum.
        </p>
      </form>

      <!-- INFOS -->
      <aside class="contact-infos">
        <h2>Infos pratiques</h2>

        <ul>
          <li><strong>Studio :</strong> 16 Mesures Records</li>
          <li><strong>Ville :</strong> Chambéry</li>
          <li><strong>Email :</strong> contact@16mesuresrecords.fr</li>
          <li><strong>Horaires :</strong> sur rendez-vous</li>
        </ul>

        <div class="socials">
          <h3>Réseaux</h3>
          <a href="#" aria-label="Instagram">Instagram</a>
          <a href="#" aria-label="YouTube">YouTube</a>
          <a href="#" aria-label="SoundCloud">SoundCloud</a>
        </div>

        <a href="prestation.php" class="btn-ghost">
          Réserver une session
        </a>
      </aside>

    </section>

  </main>

  <footer class="main-footer">
    <div class="footer-copy">
      <p>&copy; 2026 16 Mesures Records</p>
    </div>
    <div class="footer-links">
      <a href="mentions-legales.php">Mentions légales</a>
    </div>
  </footer>

</body>
</html>
