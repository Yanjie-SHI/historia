<?php

class DemandModel extends MyPDO {

    public static function readDemand(string $mail): array {
        $req = "SELECT d_fk_archive_reference, d_description, d_centre, d_datetime_demande "
                . "FROM demande "
                . "WHERE d_fk_utilisateur_mail = '$mail' "
                . "ORDER BY d_datetime_demande DESC";
        $result_set = self::getMyPDO()->query($req);
        return $result_set->fetchAll();
    }

    public static function addDemand(string $mail, string $reference, string $description, string $centre, string $date): bool {
        if (self::checkDemand($mail, $reference) == 0) {
            $token = self::generateToken('demande');
            self::getMyPDO()->exec("INSERT INTO archive VALUES ('$reference')");
            self::getMyPDO()->exec("INSERT INTO demande VALUES ('$mail', '$reference', '$description', '$centre', '$token', '$date')");
            return true;
        } else {
            return false;
        }
    }

    public static function deleteDemand(string $mail, string $reference): bool {
        if (self::checkDemand($mail, $reference) == 1) {
            self::getMyPDO()->exec("DELETE FROM demande WHERE d_fk_utilisateur_mail = '$mail' AND d_fk_archive_reference = '$reference'");
            return true;
        } else {
            return false;
        }
    }

    private static function checkDemand(string $mail, string $reference): int {
        $req = "SELECT 1 "
                . "FROM demande "
                . "WHERE d_fk_utilisateur_mail = '$mail' AND d_fk_archive_reference = '$reference'";
        $result_set = self::getMyPDO()->query($req);
        return $result_set->rowCount();
    }

}
