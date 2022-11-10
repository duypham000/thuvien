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
        $stmt = $db->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get users by id as an associative array
     *
     * @return array
     */
    public static function getById($id)
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM users WHERE id = ' . $id . '');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Update user by id
     *
     * @return bool
     */
    public static function update($id, $name, $password, $role)
    {
        try {
            $db = static::getDB();
            $db->query('UPDATE users SET username = "' . $name . '", password = "' . $password . '", role = "' . $role . '" WHERE id = ' . $id . ' ');
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Delete user by id
     *
     * @return bool
     */
    public static function deleteById($id)
    {
        try {
            $db = static::getDB();
            $db->query('DELETE FROM users WHERE id = ' . $id . ' ');
            return true;
        } catch (\Throwable $th) {
            return false;
        }
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
            $db->query('INSERT INTO users (id, username, password, role) VALUES (NULL, "' . $name . '","' . $password . '","' . $role . '")');
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
