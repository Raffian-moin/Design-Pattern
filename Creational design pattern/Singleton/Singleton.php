<?php

class DatabaseConnection
{
    private static $connectionInstances = null;

    // Can't make instance directly
    private function __construct()
    {

    }

    // Singleton should not be cloned
    private function __clone()
    {

    }

    // Singleton should be unserialize
    // Because by unserializing we can make another copy of the object
    public function __wakeup()
    {
        throw new \Exception("Can't unserialize singleton object", 1);

    }

    public static function getInstance()
    {
        if (empty(self::$connectionInstances)) {
            self::$connectionInstances = new static();
        }

        return self::$connectionInstances;

    }
}

$obj1 = DatabaseConnection::getInstance();
$obj2 = DatabaseConnection::getInstance();

if ($obj1 === $obj2) {
    echo "Singleton returns only one instance";
} else {
    echo "Singleton returns different instances";
}