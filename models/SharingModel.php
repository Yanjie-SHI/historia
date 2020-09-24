<?php

class SharingModel extends MyPDO {

    public static function readSharing(string $mail, array $archives): array {
        $sharings = [];
        foreach ($archives as $archive) {
            $req = "SELECT d_datetime_demande, a_reference, d_jeton, c_nom, c_url "
                    . "FROM demande "
                    . "JOIN archive ON d_fk_archive_identifiant = a_identifiant "
                    . "JOIN centre ON a_fk_centre_identifiant = c_identifiant "
                    . "WHERE a_reference = '{$archive['a_reference']}' AND c_identifiant = {$archive['c_identifiant']} AND d_etat = 'L' AND d_fk_utilisateur_mail != '$mail' "
                    . "ORDER BY d_datetime_demande DESC";
            $result_set = self::getMyPDO()->query($req);
            $rows = $result_set->fetchAll();
            if (count($rows) > 0) {
                foreach ($rows as $sharing) {
                    $sharings[] = $sharing;
                }
            }
        }
        return $sharings;
    }

    public static function getSharing(string $token): array {
        $req = "SELECT d_datetime_demande, a_reference, u_pseudo, d_jeton, u_mail, c_nom, c_url, d_description "
                . "FROM demande "
                . "JOIN utilisateur ON d_fk_utilisateur_mail = u_mail "
                . "JOIN archive ON d_fk_archive_identifiant = a_identifiant "
                . "JOIN centre ON a_fk_centre_identifiant = c_identifiant "
                . "WHERE d_jeton = '$token'";
        $result_set = self::getMyPDO()->query($req);
        return $result_set->fetchAll();
    }

    public static function doSharing(string $seeder, string $leecher, string $token, string $number_pages): void {
        $myPDO = self::getMyPDO();
        $myPDO->exec("UPDATE utilisateur SET u_ratio = u_ratio + $number_pages WHERE u_mail = '$seeder'");
        $myPDO->exec("UPDATE utilisateur SET u_ratio = u_ratio - $number_pages WHERE u_mail = '$leecher'");
        $myPDO->exec("DELETE FROM reservation WHERE r_fk_demande_jeton = '$token'");
        $myPDO->exec("DELETE FROM demande WHERE d_jeton = '$token'");
    }

}
