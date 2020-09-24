<?php

class UserModel extends MyPDO {

    public static function createUser(string $mail, string $mot_de_passe, string $pseudo): array {
        $token = self::generateToken('utilisateur');
        $number_rows = self::getMyPDO()->exec("INSERT INTO utilisateur VALUES('$mail', '$mot_de_passe', '$pseudo', 100, '$token', 'C', NULL)");
        return compact('token', 'number_rows');
    }

    public static function validateUser(string $token): string {
        if (self::checkToken($token, 'utilisateur')) {
            $result_set = self::getMyPDO()->query("SELECT u_etat FROM utilisateur WHERE u_jeton = '$token'");
            $user = $result_set->fetch();
            switch ($user['u_etat']) {
                case 'C':
                    self::getMyPDO()->exec("UPDATE utilisateur SET u_etat = 'V' WHERE u_jeton = '$token'");
                    return 'Votre compte vient d\'être confirmé';
                    break;
                case 'V':
                    return 'Votre comtpe est déjà confirmé';
                    break;
                case 'B':
                    return 'Votre compte est bloqué !';
            }
        } else {
            return 'Confirmation de votre compte impossible : identifiant invalide';
        }
    }

    public static function connectUser(string $mail, string $mot_de_passe): array {
        $req = 'SELECT * '
                . 'FROM utilisateur '
                . 'LEFT JOIN strike ON u_fk_strike_identifiant = s_identifiant '
                . 'WHERE u_mail = \'' . $mail . '\'';
        $result_set = self::getMyPDO()->query($req);
        $user = $result_set->fetch();
        if ($result_set->rowCount() == 1 && password_verify($mot_de_passe, $user['u_mot_de_passe'])) {
            switch ($user['u_etat']) {
                case 'V':
                    return $user;
                case 'C':
                    return ['Vous devez d\'abord confirmer votre compte avant de pouvoir vous y connecter.<br>'
                        . 'Confirmez-le en cliquant sur le lien contenu dans le mail que vous avez reçu à l\'adresse indiquée pendant l\'inscription'];
                case 'B':
                    if (date('Y-m-d H:i:s') >= $user['s_datetime_fin']) {
                        self::getMyPDO()->exec("UPDATE utilisateur SET u_etat = 'V' WHERE u_mail = '$mail'");
                        return $user;
                    } else {
                        return ["Votre compte est bloqué jusqu'au {$user['s_datetime_fin']} pour partage abusif"];
                    }
            }
        } else {
            return ['Vos identifiants sont incorrects'];
        }
    }

    public static function getUser(string $token): array {
        $req = 'SELECT * '
                . 'FROM utilisateur '
                . 'LEFT JOIN strike ON u_fk_strike_identifiant = s_identifiant '
                . 'WHERE u_jeton = \'' . $token . '\'';
        $result_set = self::getMyPDO()->query($req);
        return $result_set->fetchAll();
    }

}
