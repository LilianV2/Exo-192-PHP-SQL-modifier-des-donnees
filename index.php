<?php
/**
 * 1. Le dossier SQL contient l'export de ma table user.
 * 2. Trouvez comment importer cette table dans une des bases de données que vous avez créées, si vous le souhaitez vous pouvez en créer une nouvelle pour cet exercice.
 * 3. Assurez vous que les données soient bien présentes dans la table.
 * 4. Créez votre objet de connexion à la base de données comme nous l'avons vu
 * 5. Insérez un nouvel utilisateur dans la base de données user
 * 6. Modifiez cet utilisateur directement après avoir envoyé les données ( on imagine que vous vous êtes trompé )
 */

// TODO Votre code ici.



try {
    $server = "localhost";
    $db = "modif_bdd";
    $user = 'root';
    $password = '';

    $conn = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
    DROP TABLE IF EXISTS `user`;
    CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `prenom` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rue` varchar(70) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `numero` smallint(5) UNSIGNED NOT NULL,
  `code_postal` smallint(5) UNSIGNED NOT NULL,
  `ville` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pays` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mail` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique` (`mail`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

        INSERT INTO user (id, nom, prenom, rue, numero, code_postal, ville, pays, mail) VALUES
(1, 'Doe', 'John', 'Rue de chez pas quoi', 5, 59610, 'Fourmies', 'France', 'j.doe@fondationface.org'),
(2, 'Honor', 'Sarah', 'Rue de la Mairie', 2, 59610, 'Fourmies', 'France', 'conor.s@gmail.com'),
(3, 'Doe', 'Jane', 'Rue de la haut', 9, 59610, 'Fourmies', 'France', 'doe@example.fr');
    ";

    /**$conn->exec($sql);*/
    echo "table créée avec succès";

} catch (PDOException $e){
    echo "Erreur de connexion : " . $e->getMessage();
}

try {
    $nom = "Jesus";
    $id = 3;

    $sql = $conn->prepare("UPDATE user SET nom = :nom WHERE id = :id");
    $sql->bindParam(':nom', $nom);
    $sql->bindParam(':id', $id);

    $sql->execute();
}catch (PDOException $e){
    echo "Erreur de connexion : " . $e->getMessage();
}


/**
 * Théorie
 * --------
 * Pour obtenir l'ID du dernier élément inséré en base de données, vous pouvez utiliser la méthode: $bdd->lastInsertId()
 *
 * $result = $bdd->execute();
 * if($result) {
 *     $id = $bdd->lastInsertId();
 * }
 */