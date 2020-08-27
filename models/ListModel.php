<?php

class ListModel extends MyPDO {

    public static function readArchive(string $mail, bool $format = false): array {
        $req = "SELECT p_fk_archive_reference "
                . "FROM possession "
                . "WHERE p_fk_utilisateur_mail = '$mail'";
        $result_set = self::getMyPDO()->query($req);
        $rows = $result_set->fetchAll();
        if (!$format) {
            return $rows;
        } else {
            return self::format($rows);
        }
    }

    public static function addArchive(string $mail, string $reference): bool {
        if (self::checkArchive($mail, $reference) == 0) {
            self::getMyPDO()->exec("INSERT INTO archive VALUES('$reference')");
            self::getMyPDO()->exec("INSERT INTO possession VALUES('$mail', '$reference')");
            return true;
        } else {
            return false;
        }
    }

    public static function deleteArchive(string $mail, string $reference): bool {
        if (self::checkArchive($mail, $reference) == 1) {
            self::getMyPDO()->exec("DELETE FROM possession WHERE p_fk_utilisateur_mail = '$mail' AND p_fk_archive_reference = '$reference'");
            return true;
        } else {
            return false;
        }
    }

    private static function checkArchive(string $mail, string $reference): int {
        $req = "SELECT 1 "
                . "FROM possession "
                . "WHERE p_fk_utilisateur_mail = '$mail' AND p_fk_archive_reference = '$reference'";
        $result_set = self::getMyPDO()->query($req);
        return $result_set->rowCount();
    }

    private static function format(array $rows): array {
        $archives = '';
        $size = count($rows);
        for ($i = 0; $i < $size; $i++) {
            if ($i < $size - 1) {
                $archives .= self::getMyPDO()->quote($rows[$i]['p_fk_archive_reference']) . ', ';
            } else {
                $archives .= self::getMyPDO()->quote($rows[$i]['p_fk_archive_reference']);
            }
        }
        if (strlen($archives) > 0) {
            return ['references' => $archives];
        } else {
            return ['references' => 'NULL'];
        }
    }

}
