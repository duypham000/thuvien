<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class User extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT *, name FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Insert a user into db
     *
     * @return bool
     */
    public static function insert($name, $password, $role)
    {
        try {
            $db = static::getDB();
            $db->query('INSERT INTO `users` (`id`, `name`, `password`, `role` ) VALUES (NULL, "' . $name . '","' . $password . '","' . $role . '",)');
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
