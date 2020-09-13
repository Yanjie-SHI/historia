<?php

class CenterModel extends MyPDO {

    public static function readCenter(): array {
        $req = "SELECT DISTINCT c_type "
                . "FROM centre "
                . "ORDER BY c_type";
        $result_set = self::getMyPDO()->query($req);
        $types = $result_set->fetchAll();
        $types[10]['c_type'] = 'Rectorats, universités ou établissements d\\\'enseignement supérieur';
        foreach ($types as $type) {
            $req = "SELECT c_identifiant, c_nom, c_type "
                    . "FROM centre "
                    . "WHERE c_type = '{$type['c_type']}' "
                    . "ORDER BY c_nom";
            $result_set = self::getMyPDO()->query($req);
            $centres[] = $result_set->fetchAll();
        }
        return $centres;
    }

}
