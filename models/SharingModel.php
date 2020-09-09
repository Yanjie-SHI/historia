<?php

class SharingModel extends MyPDO {

    public static function readSharing(string $mail, string $references): array {
        $req = "SELECT d_datetime_demande, d_fk_archive_reference, u_pseudo, d_jeton "
                . "FROM demande "
                . "JOIN utilisateur ON d_fk_utilisateur_mail = u_mail "
                . "WHERE d_fk_archive_reference IN ($references) AND d_fk_utilisateur_mail != '$mail' "
                . "ORDER BY d_datetime_demande DESC";
        $result_set = self::getMyPDO()->query($req);
        return $result_set->fetchAll();
    }

    public static function getSharing(string $token): array {
        $req = "SELECT d_datetime_demande, d_fk_archive_reference, u_pseudo, d_jeton, u_mail "
                . "FROM demande "
                . "JOIN utilisateur ON d_fk_utilisateur_mail = u_mail "
                . "WHERE d_jeton = '$token'";
        $result_set = self::getMyPDO()->query($req);
        return $result_set->fetchAll();
    }

    public static function doSharing(string $mail, string $token): void {
        $myPDO = self::getMyPDO();
        // mon_ratio += nb de pages de l'archive
        // son_ratio -= nb de pages de l'archive
        $myPDO->exec("DELETE FROM demande WHERE d_jeton = '$token'");
    }

}
