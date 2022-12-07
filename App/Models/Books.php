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
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    /**
     * Update user by id
     *
     * @return bool
     */
    public static function update(
        $id,
        $title,
        $desc,
        $image,
        $categories,
        $authorId,
        $quantity,
        $numOfGood,
        $locationId,
        $dateIn
    ) {
        try {
            $db = static::getDB();
            $db->query('UPDATE books SET title = "' . $title .
                '", description = "' . $desc .
                '", image = "' . $image .
                '", categories = "' . $categories .
                '", authorId = "' . $authorId .
                '", quantity = "' . $quantity .
                '", locationId = "' . $locationId .
                '", numOfGood = "' . $numOfGood .
                '", dateIn = "' . $dateIn .
                '" WHERE id = ' . $id . ' ');
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Update user by id
     *
     * @return bool
     */
    public static function changeQuantity(
        $id,
        $quantityLeft
    ) {
        try {
            $db = static::getDB();
            $db->query('UPDATE books SET quantityLeft = "' . $quantityLeft .
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
    public static function insert(
        $title,
        $desc,
        $image,
        $categories,
        $authorId,
        $quantity,
        $numOfGood,
        $locationId,
        $dateIn
    ) {
        try {
            $db = static::getDB();
            $db->query('INSERT INTO books (id, title, description, image, categories, authorId, quantity, numOfGood, locationId, dateIn) VALUES (NULL, "' .
                $title . '","' .
                $desc . '","' .
                $image . '","' .
                $categories . '","' .
                $authorId . '","' .
                $quantity . '","' .
                $numOfGood . '","' .
                $locationId . '","' .
                $dateIn . '")');
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
