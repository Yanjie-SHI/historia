<?php

class MyPDO {

    private static $myPDO = null;

    private $dsn = 'mysql:dbname=historia;host=127.0.0.1';
    private $user = 'root';

    public static function getMyPDO(): ?PDO {
        if (isset(self::$myPDO)) {
            return self::$myPDO;
        } else {
            new MyPDO();
            return null;
        }
    }

    protected static function checkToken(string $token, string $table): bool {
        $result_set = self::getMyPDO()->query("SELECT 1 FROM $table WHERE $table[0]_jeton = '$token'");
        return $result_set->rowCount() == 1;
    }

    protected static function generateToken(string $table): string {
        for ($i = 48; $i <= 57; $i++) {
            $chars[] = chr($i);
        }
        for ($i = 65; $i <= 90; $i++) {
            $chars[] = chr($i);
        }
        for ($i = 97; $i <= 122; $i++) {
            $chars[] = chr($i);
        }
        do {
            $token = '';
            for ($i = 1; $i <= 23; $i++) {
                $token .= $chars[mt_rand(0, 45)];
            }
        } while (self::checkToken($token, $table));
        return $token;
    }

    private function __construct() {
        try {
            self::$myPDO = new PDO($this->dsn, $this->user, null, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
