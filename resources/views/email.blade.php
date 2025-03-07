<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
</head>
<body>
    <div>
        <p>Bonjour {{ $username }},</p>
        <p>Bienvenue sur notre plateforme !</p>
        <p>Voici vos informations de connexion :</p>
        <ul>
            <li><strong>Email :</strong> {{ $email }}</li>
            <li><strong>Mot de passe :</strong> {{ $password }}</li>
        </ul>
        <p>Nous vous recommandons de changer votre mot de passe dès que possible pour plus de sécurité.</p>
        <p>Merci, <br> L'équipe de support</p>
    </div>
</body>
</html>
