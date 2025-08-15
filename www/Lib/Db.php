<?php

namespace Lib;

class Db
{
    protected static $instance = null;
    protected \PDO $dbh;

    public static function instance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct()
    {
        $this->dbh = new \PDO(
            Utils::env('DB_TYPE') . ":host=" . Utils::env('DB_HOST') . ";dbname=" . Utils::env('DB_NAME'),
            Utils::env('DB_USER'),
            Utils::env('DB_PASSWORD')
        );
    }

    public function query(string $sql, array $params = []): array
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);

        if (!$res) {
            throw new \Exception('Error query: ' . $sql);
        }

        return $sth->fetchAll();
    }
}
