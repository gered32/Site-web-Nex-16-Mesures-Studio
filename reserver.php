<?php
session_start();

// 1. Configuration (Simule une base de données et un utilisateur)
$produits = [
    1 => ["nom" => "PC Gamer", "prix" => 1200, "image" => "💻"],
    2 => ["nom" => "Console Next-Gen", "prix" => 500, "image" => "🎮"],
    3 => ["nom" => "Casque VR", "prix" => 350, "image" => "🥽"]
];

$mot_de_passe_compte = "1234"; // Le mot de passe pour valider l'achat
$message = "";

// Initialisation du panier s'il n'existe pas
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// 2. Traitement des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Action : Ajouter au panier
    if (isset($_POST['ajouter_id'])) {
        $id = $_POST['ajouter_id'];
        // On vérifie si le produit n'est pas déjà dans le panier (Règle : 1 exemplaire max)
        if (!in_array($id, $_SESSION['panier'])) {
            $_SESSION['panier'][] = $id;
        }
    }

    // Action : Valider l'achat
    if (isset($_POST['valider_achat'])) {
        $mdp_saisi = $_POST['password'];
        if ($mdp_saisi === $mot_de_passe_compte) {
            $message = "<div class='success'>✅ Achat confirmé ! Merci pour votre commande.</div>";
            $_SESSION['panier'] = []; // Vide le panier
        } else {
            $message = "<div class='error'>❌ Mot de passe incorrect. Réessayez.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mini Boutique</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; background: #f4f4f4; }
        .catalogue { display: flex; gap: 20px; justify-content: space-around; }
        .card { background: white; padding: 20px; border-radius: 8px; text-align: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: 30%; }
        .card button { background: #007bff; color: white; border: none; padding: 10px; cursor: pointer; border-radius: 4px; }
        .card button:disabled { background: #ccc; cursor: not-allowed; }
        .panier-section { background: #fff; margin-top: 30px; padding: 20px; border-radius: 8px; border-top: 4px solid #28a745; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 20px; }
        .icon { font-size: 3em; display: block; margin-bottom: 10px; }
    </style>
</head>
<body>

    <h1>Mon Mini Catalogue</h1>
    
    <?= $message ?>

    <div class="catalogue">
        <?php foreach ($produits as $id => $prod): ?>
            <div class="card">
                <span class="icon"><?= $prod['image'] ?></span>
                <h3><?= $prod['nom'] ?></h3>
                <p><?= $prod['prix'] ?> €</p>
                
                <form method="POST">
                    <input type="hidden" name="ajouter_id" value="<?= $id ?>">
                    <?php if (in_array($id, $_SESSION['panier'])): ?>
                        <button type="button" disabled>Déjà dans le panier</button>
                    <?php else: ?>
                        <button type="submit">Ajouter au panier</button>
                    <?php endif; ?>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (!empty($_SESSION['panier'])): ?>
        <div class="panier-section">
            <h2>Votre Panier</h2>
            <ul>
                <?php foreach ($_SESSION['panier'] as $id): ?>
                    <li><?= $produits[$id]['nom'] ?> - <?= $produits[$id]['prix'] ?> €</li>
                <?php endforeach; ?>
            </ul>
            
            <hr>
            <h3>Confirmer l'achat (Gratuit)</h3>
            <p>Veuillez entrer votre mot de passe pour valider (Indice: 1234)</p>
            <form method="POST">
                <input type="password" name="password" placeholder="Mot de passe du compte" required>
                <button type="submit" name="valider_achat" style="background: #28a745; color: white; border: none; padding: 10px 20px; cursor: pointer;">Payer</button>
            </form>
        </div>
    <?php endif; ?>

</body>
</html>