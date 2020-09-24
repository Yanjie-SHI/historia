<?php

class BookingModel extends MyPDO {

    public static function readBooking(string $mail): array {
        $req = "SELECT d_datetime_demande, a_reference, d_jeton, c_nom, c_url "
                . "FROM demande "
                . "JOIN archive ON d_fk_archive_identifiant = a_identifiant "
                . "JOIN centre ON a_fk_centre_identifiant = c_identifiant "
                . "WHERE d_etat = 'L' AND d_fk_utilisateur_mail != '$mail' "
                . "ORDER BY d_datetime_demande DESC";
        $result_set = self::getMyPDO()->query($req);
        return $result_set->fetchAll();
    }

    public static function addBooking(string $mail, string $demande, string $date): void {
        self::getMyPDO()->exec("INSERT INTO reservation VALUES ('$mail', '$demande', '$date')");
        self::getMyPDO()->exec("UPDATE demande SET d_etat = 'R' WHERE d_jeton = '$demande'");
    }

    public static function getBooking(string $token): array {
        $req = "SELECT r_date_reservation "
                . "FROM reservation "
                . "WHERE r_fk_demande_jeton = '$token'";
        $result_set = self::getMyPDO()->query($req);
        return $result_set->fetchAll();
    }

    public static function list(string $mail): array {
        $req = "SELECT d_datetime_demande, a_reference, d_jeton, c_nom, c_url, r_date_reservation "
                . "FROM reservation "
                . "JOIN demande ON r_fk_demande_jeton = d_jeton "
                . "JOIN archive ON d_fk_archive_identifiant = a_identifiant "
                . "JOIN centre ON a_fk_centre_identifiant = c_identifiant "
                . "WHERE r_fk_utilisateur_mail = '$mail' "
                . "ORDER BY r_date_reservation";
        $result_set = self::getMyPDO()->query($req);
        return $result_set->fetchAll();
    }

    public static function deleteBooking(string $token): void {
        self::getMyPDO()->exec("DELETE FROM reservation WHERE r_fk_demande_jeton = '$token'");
        self::getMyPDO()->exec("UPDATE demande SET d_etat = 'L' WHERE d_jeton = '$token'");
    }

    public static function search(string $mail, array $centres): array {
        $string = '';
        for ($i = 0; $i < count($centres); $i++) {
            if (($i + 1) < count($centres)) {
                $string .= $centres[$i] . ',';
            } else {
                $string .= $centres[$i];
            }
        }
        $req = "SELECT d_datetime_demande, a_reference, d_jeton, c_nom, c_url "
                . "FROM demande "
                . "JOIN archive ON d_fk_archive_identifiant = a_identifiant "
                . "JOIN centre ON a_fk_centre_identifiant = c_identifiant "
                . "WHERE d_etat = 'L' AND d_fk_utilisateur_mail != '$mail' AND c_identifiant IN ($string) "
                . "ORDER BY d_datetime_demande DESC";
        $result_set = self::getMyPDO()->query($req);
        return $result_set->fetchAll();
    }

}
