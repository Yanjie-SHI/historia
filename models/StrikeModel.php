<?php

class StrikeModel extends MyPDO {

    public static function strike(array $user, string $strike): void {
        if (self::isValid($strike)) {
            self::getMyPDO()->exec("DELETE FROM strike_jeton WHERE s_jeton = '$strike'");
            $debut = date('Y-m-d H:i:s');
            if ($user['u_fk_strike_identifiant'] == null) {
                $fin = date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('n'), date('j') + 1, date('Y')));
                self::getMyPDO()->exec("INSERT INTO strike(s_gravite, s_datetime_debut, s_datetime_fin) VALUES('1', '$debut', '$fin')");
                $id = self::getMyPDO()->lastInsertId();
                self::getMyPDO()->exec("UPDATE utilisateur SET u_fk_strike_identifiant = $id, u_etat = 'B' WHERE u_jeton = '{$user['u_jeton']}'");
            } else {
                switch ($user['s_gravite']) {
                    case '1':
                        $fin = date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('n'), date('j') + 7, date('Y')));
                        self::getMyPDO()->exec("UPDATE strike SET s_datetime_debut = '$debut', s_datetime_fin = '$fin', s_gravite = '2' WHERE s_identifiant = {$user['u_fk_strike_identifiant']}");
                        self::getMyPDO()->exec("UPDATE utilisateur SET u_etat = 'B' WHERE u_jeton = '{$user['u_jeton']}'");
                        break;
                    case '2':
                        $fin = date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('n'), date('j'), date('Y') + 10));
                        self::getMyPDO()->exec("UPDATE strike SET s_datetime_debut = '$debut', s_datetime_fin = '$fin', s_gravite = '3' WHERE s_identifiant = {$user['u_fk_strike_identifiant']}");
                        self::getMyPDO()->exec("UPDATE utilisateur SET u_etat = 'B' WHERE u_jeton = '{$user['u_jeton']}'");
                }
            }
        } else {
            http_response_code(400);
            exit;
        }
    }

    public static function initToken(): string {
        $token = self::generateToken('strike_jeton');
        self::getMyPDO()->exec("INSERT INTO strike_jeton VALUES('$token')");
        return $token;
    }

    public static function isValid(string $strike): bool {
        $req = 'SELECT 1 '
                . 'FROM strike_jeton '
                . 'WHERE s_jeton = \'' . $strike . '\'';
        $result_set = self::getMyPDO()->query($req);
        return $result_set->rowCount() == 1;
    }

}
