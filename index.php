<?php

/*
 * 1 - Uniquement pour la pratique, reproduisez via mysql workbench le schémas proposé.
 * 2 - Exportez le résultat de manière à créer les tables en base de données.
 * 3 - Ajoutez des utilisateurs, des rôles et ajoutez des données dans la table user_role ( attention, au moins un utilisateur doit avoir deux rôles au moins ).
 * 4 - A l'aide d'un simple print_r, afficher les rôles de chaque utilisateur.
 * 5 - FIN !
 */

$server = 'localhost';
$user = 'root';
$pwd = '';
$db = 'mon_role';

try {
    $connect = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);

    $user = $connect->prepare("
            SELECT user_role.id, user.username, user.password, user.email, role.role
            FROM user_role
            INNER JOIN user ON user.id = user_role.user_fk
            INNER JOIN role ON role.id = user_role.role_fk
    ");

    $liste = $user->execute();

    if($liste) {
        foreach ($user->fetchAll() as $value) {
            echo "<pre>";
            print_r($value);
            echo "</pre>";
        }
    }
}
catch (PDOException $exception) {
    echo "Erreur de connexion: " . $exception->getMessage();
}