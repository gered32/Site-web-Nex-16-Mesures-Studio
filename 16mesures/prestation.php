<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Prestations — 16 Mesures Records</title>
  <link rel="stylesheet" href="../css/16mesures.css" />
  <!-- Si tu veux isoler le style, tu peux créer prestations.css -->
  <link rel="stylesheet" href="../css/prestations.css" />
</head>
<body>

  <!-- HEADER (tu peux garder ton header actuel) -->
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
        <li><a href="prestations.html">Prestations</a></li>
        <li><a href="16contact.php">Contact</a></li>
      </ul>
    </nav>

    <a href="../authentification.php" class="nav-account" aria-label="Compte">
      <img src="../img/profilutilisateuranon.png" alt="Compte utilisateur" />
    </a>
  </header>

  <main class="page">

    <!-- HERO -->
    <section class="hero container">
      <h1>Prestations</h1>
      <p class="lead">
        Enregistrement, mixage, mastering : des formules claires, adaptées aux artistes indépendants.
      </p>

      <div class="hero-actions">
        <a class="btn-primary" href="#reservation">Réserver une session</a>
        <a class="btn-ghost" href="contact.php">Demander un devis</a>
      </div>
    </section>

    <!-- PACKS STUDIO -->
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
            <span class="price">à partir de 30€</span>
            <a class="btn-primary" href="#reservation">Réserver</a>
          </div>
        </article>

        <article class="card">
          <h3>Pack Session — 2h</h3>
          <ul>
            <li>Enregistrement complet (1 morceau)</li>
            <li>Édition légère (respirations / coupes)</li>
            <li>Exports WAV + MP3</li>
          </ul>
          <div class="card-footer">
            <span class="price">à partir de 60€</span>
            <a class="btn-primary" href="#reservation">Réserver</a>
          </div>
        </article>

        <article class="card highlight">
          <div class="badge">Le plus choisi</div>
          <h3>Pack Track — 4h</h3>
          <ul>
            <li>Enregistrement + direction artistique</li>
            <li>Nettoyage voix + pré-mix (balance)</li>
            <li>Exports stems si besoin</li>
          </ul>
          <div class="card-footer">
            <span class="price">à partir de 100€</span>
            <a class="btn-primary" href="#reservation">Réserver</a>
          </div>
        </article>
      </div>

      <p class="note">
        * Les tarifs varient selon la complexité du projet. Possibilité de devis sur mesure.
      </p>
    </section>

    <!-- MIX / MASTER -->
    <section class="section container" id="mixmaster">
      <div class="section-head">
        <h2>Mix & Master</h2>
        <p>Pour un rendu propre, équilibré et prêt pour les plateformes.</p>
      </div>

      <div class="cards two">
        <article class="card">
          <h3>Mixage</h3>
          <ul>
            <li>Équilibrage, EQ, compression, FX</li>
            <li>1 à 2 révisions incluses</li>
            <li>Export WAV + MP3</li>
          </ul>
          <div class="card-footer">
            <span class="price">à partir de 50€</span>
            <a class="btn-ghost" href="contact.php">Devis Mix</a>
          </div>
        </article>

        <article class="card">
          <h3>Mastering</h3>
          <ul>
            <li>Optimisation loudness / dynamique</li>
            <li>Rendu streaming-ready</li>
            <li>Formats : WAV 24bit / 16bit</li>
          </ul>
          <div class="card-footer">
            <span class="price">à partir de 30€</span>
            <a class="btn-ghost" href="contact.php">Devis Master</a>
          </div>
        </article>

        <article class="card">
          <h3>Mix + Master</h3>
          <ul>
            <li>Pack complet pour sortir ton morceau</li>
            <li>Révisions incluses</li>
            <li>Livraison propre & organisée</li>
          </ul>
          <div class="card-footer">
            <span class="price">à partir de 120€</span>
            <a class="btn-primary" href="contact.php">Demander un devis</a>
          </div>
        </article>

        <article class="card">
          <h3>Option : Enregistrement + Mix</h3>
          <ul>
            <li>Tu viens enregistrer au studio</li>
            <li>Mixage du morceau</li>
            <li>Idéal pour gagner du temps</li>
          </ul>
          <div class="card-footer">
            <span class="price">à partir de 150€</span>
            <a class="btn-primary" href="#reservation">Réserver</a>
          </div>
        </article>
      </div>
    </section>

    <!-- RESERVATION -->
    <section class="section container" id="reservation">
      <div class="section-head">
        <h2>Réserver une session</h2>
        <p>Choisis un créneau et décris ton besoin. Je te confirme rapidement.</p>
      </div>

      <div class="booking">
        <!-- Grille de créneaux simple (exemple) -->
        <div class="slots">
          <h3>Créneaux disponibles (exemple)</h3>
          <div class="slot-grid">
            <button type="button" class="slot">Lun 18:00</button>
            <button type="button" class="slot">Mar 19:00</button>
            <button type="button" class="slot">Mer 17:00</button>
            <button type="button" class="slot">Jeu 20:00</button>
            <button type="button" class="slot">Ven 18:00</button>
            <button type="button" class="slot">Sam 14:00</button>
          </div>
          <p class="note">
            <!-- * Exemple visuel. Si tu veux un vrai système, je te mets Google Calendar/Calendly en place. -->
          </p>
        </div>

        <!-- Formulaire -->
        <form class="booking-form" action="reservation.php" method="post">
          <label>
            Nom / Blaze
            <input type="text" name="name" required>
          </label>

          <label>
            Email
            <input type="email" name="email" required>
          </label>

          <label>
            Prestation
            <select name="service" required>
              <option value="">Choisir…</option>
              <option>Pack Découverte (1h)</option>
              <option>Pack Session (2h)</option>
              <option>Pack Track (4h)</option>
              <option>Mixage</option>
              <option>Mastering</option>
              <option>Mix + Master</option>
            </select>
          </label>

          <label>
            Date / Heure souhaitée
            <input type="text" name="datetime" placeholder="Ex : Mer 17:00" required>
          </label>

          <label>
            Détails (BPM, nombre de pistes, deadline…)
            <textarea name="details" rows="5" placeholder="Dis-moi ce dont tu as besoin"></textarea>
          </label>

          <button class="btn-primary" type="submit">Envoyer la demande</button>
          <p class="note">Tu recevras une confirmation avant validation définitive.</p>
        </form>
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