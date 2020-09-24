<?php

class ListModel extends MyPDO {

    public static function readArchive(string $mail): array {
        $req = "SELECT a_reference, p_jeton, c_nom, c_url, c_identifiant "
                . "FROM possession "
                . "JOIN archive ON p_fk_archive_identifiant = a_identifiant "
                . "JOIN centre ON a_fk_centre_identifiant = c_identifiant "
                . "WHERE p_fk_utilisateur_mail = '$mail'";
        $result_set = self::getMyPDO()->query($req);
        return $result_set->fetchAll();
    }

    public static function addArchive(string $mail, string $reference, string $centre): bool {
        if (self::checkArchive($mail, $reference, $centre) == 0) {
            self::getMyPDO()->exec("INSERT INTO archive(a_reference, a_fk_centre_identifiant) VALUES('$reference', $centre)");
            $identifiant = self::getMyPDO()->lastInsertId();
            $jeton = self::generateToken('possession');
            self::getMyPDO()->exec("INSERT INTO possession VALUES('$mail', $identifiant, '$jeton')");
            return true;
        } else {
            return false;
        }
    }

    public static function deleteArchive(string $jeton): void {
        self::getMyPDO()->exec("DELETE FROM possession WHERE p_jeton = '$jeton'");
    }

    private static function checkArchive(string $mail, string $reference, string $centre): int {
        $req = "SELECT 1 "
                . "FROM possession "
                . "JOIN archive ON p_fk_archive_identifiant = a_identifiant "
                . "WHERE p_fk_utilisateur_mail = '$mail' AND a_reference = '$reference' AND a_fk_centre_identifiant = $centre";
        $result_set = self::getMyPDO()->query($req);
        return $result_set->rowCount();
    }

}
