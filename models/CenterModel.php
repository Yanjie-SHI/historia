<?php

class CenterModel extends MyPDO {

    public static function readCenter(array $types): array {
        foreach ($types as $type) {
            $req = "SELECT c_identifiant, c_nom, c_type "
                    . "FROM centre "
                    . "WHERE c_type = '$type' "
                    . "ORDER BY c_nom";
            $result_set = self::getMyPDO()->query($req);
            $centres[] = $result_set->fetchAll();
        }
        return $centres;
    }

}
