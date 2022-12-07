<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Location extends \Core\Model
{

    /**
     * Get all as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM locations');
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
        $stmt = $db->query('SELECT * FROM locations WHERE id = ' . $id . '');
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    /**
     * Update by id
     *
     * @return bool
     */
    public static function update($id, $name, $location)
    {
        try {
            $db = static::getDB();
            $db->query('UPDATE locations SET name = "' . $name . '", location = "' . $location . '" WHERE id = ' . $id . ' ');
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
            $db->query('DELETE FROM locations WHERE id = ' . $id . ' ');
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
    public static function insert($name, $location)
    {
        try {
            $db = static::getDB();
            $db->query('INSERT INTO locations (id, name, location) VALUES (NULL, "' . $name . '", "' . $location . '")');
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
