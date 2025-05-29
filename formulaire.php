<?php

$price = "0.00";
$discout = "0.00";

// Verifier le présence des variables $_POST
if ( !isset($_POST['prixOrigine']) || !isset($_POST['remise']) ) 
{
    $msg = "Merci de remplir les 2 champs du formulaire.";
}
else {

    // Conserver les valeurs saisies dans les champs du formulaire
    $price = number_format($_POST['prixOrigine'], 2, ".");
    $discout = number_format($_POST['remise'], 2, ".");

    // Vérifier coté PHP que les valeurs saisies ne soient inferieurs ou égal à zéro
    if ($_POST['prixOrigine'] <= 0 || $_POST['remise'] <= 0) 
    {
        $msg = "La valeur Zéro ou inferieur n'est pas autorisée.";
    }
    else 
    {
        $msg = "Le prix final du produit est de ".calculateDiscount( $price, $discout);
    }
}

function calculateDiscount( int|float $prixOrigine, int|float $taux) {

    $remise = ($prixOrigine * $taux) / 100;

    $prixFinal = number_format(($prixOrigine - $remise), 2, ",", ",");

    return  $prixFinal." €";
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculer une remise</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Calculer une remise</h2>
        <div class="message"><?= $msg ?></div>
        <form action="formulaire.php" method="POST">
            <div class="form-group">
                <label for="nom">Prix d'origine (€) :</label>
                <input type="number" value="<?= $price ?>" id="prixOrigine" name="prixOrigine" step="0.01" min="0.01" required>
            </div>
            <div class="form-group">
                <label for="nom">Remise (%) :</label>
                <input type="number" value="<?= $discout ?>" id="remise" name="remise" step="0.01" min="0.01" required> 
            </div>
            <div class="form-group">
                <button type="submit">Calculer</button>
            </div>
        </form>
    </div>
</body>
</html>