<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Books extends \Core\Model
{

    /**
     * Get all as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM books');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get by id as an associative array
     *
     * @return array
     */
    public static function getById($id)
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM books WHERE id = ' . $id . '');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Update user by id
     *
     * @return bool
     */
    public static function update($id, $title, $desc, $price, $image, $categories, $authorId)
    {
        try {
            $db = static::getDB();
            $db->query('UPDATE books SET title = "' . $title .
                '", description = "' . $desc .
                '", price = "' . $price .
                '", image = "' . $image .
                '", categories = "' . $categories .
                '", authorId = "' . $authorId .
                '" WHERE id = ' . $id . ' ');
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Delete by id
     *
     * @return bool
     */
    public static function deleteById($id)
    {
        try {
            $db = static::getDB();
            $db->query('DELETE FROM books WHERE id = ' . $id . ' ');
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Insert into db
     *
     * @return bool
     */
    public static function insert($title, $desc, $price, $image, $categories, $authorId)
    {
        try {
            $db = static::getDB();
            $db->query('INSERT INTO users (id, title, description, price, image, categories, authorId) VALUES (NULL, "' .
                $title . '","' . $desc . '","' . $price . '","' . $image . '","' . $categories . '","' . $authorId . '")');
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
