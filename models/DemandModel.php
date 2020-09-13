<?php

class DemandModel extends MyPDO {

    public static function readDemand(string $mail): array {
        $req = "SELECT d_description, a_reference, c_nom, c_url, d_jeton, d_datetime_demande "
                . "FROM demande "
                . "JOIN archive ON d_fk_archive_identifiant = a_identifiant "
                . "JOIN centre ON a_fk_centre_identifiant = c_identifiant "
                . "WHERE d_fk_utilisateur_mail = '$mail' "
                . "ORDER BY d_datetime_demande DESC";
        $result_set = self::getMyPDO()->query($req);
        return $result_set->fetchAll();
    }

    public static function addDemand(string $mail, string $reference, string $description, string $centre, string $date): bool {
        if (self::checkDemand($mail, $reference, $centre) == 0) {
            $jeton = self::generateToken('demande');
            self::getMyPDO()->exec("INSERT INTO archive(a_reference, a_fk_centre_identifiant) VALUES ('$reference', $centre)");
            $identifiant = self::getMyPDO()->lastInsertId();
            self::getMyPDO()->exec("INSERT INTO demande VALUES ('$mail', $identifiant, '$description', '$jeton', '$date')");
            return true;
        } else {
            return false;
        }
    }

    public static function deleteDemand(string $jeton): void {
        self::getMyPDO()->exec("DELETE FROM demande WHERE d_jeton = '$jeton'");
    }

    private static function checkDemand(string $mail, string $reference, string $centre): int {
        $req = "SELECT 1 "
                . "FROM demande "
                . "JOIN archive ON d_fk_archive_identifiant = a_identifiant "
                . "WHERE d_fk_utilisateur_mail = '$mail' AND a_reference = '$reference' AND a_fk_centre_identifiant = $centre";
        $result_set = self::getMyPDO()->query($req);
        return $result_set->rowCount();
    }

}
