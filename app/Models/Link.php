<?php

require_once 'app/Core/DB.php';

class Link
{
    private $long_link;
    private $short_link;

    private $_db = null;

    // Get DB object
    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    // Set link
    public function setLink($long_link, $short_link)
    {
        $this->long_link = $long_link;
        $this->short_link = $short_link;
    }

    // Add link to DB
    public function addLink($user_id)
    {
        // Prepare sql query
        $sql = 'INSERT INTO `links` (`full_link`, `short_link`, `user_id`) VALUES (:full_link, :short_link, :user_id)';
        $query = $this->_db->prepare($sql);

        // Execute query
        $query->execute(['full_link' => $this->long_link, 'short_link' => $this->short_link, 'user_id' => $user_id]);
    }

    public function getLink($url)
    {
        // Prepare sql query
        $sql = 'SELECT `full_link` FROM `links` WHERE `short_link` = :short_link';
        $query = $this->_db->prepare($sql);

        // Execute query
        $query->execute(['short_link' => $url]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    // Get link data from DB
    public function getLinks($user_id)
    {
        // Prepare sql query
        $sql = 'SELECT * FROM `links` WHERE `user_id` = :id';
        $query = $this->_db->prepare($sql);

        // Execute query
        $query->execute(['id' => $user_id]);

        if ($query->rowCount() == 0)
            return false;
        else
            return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // Delete link from DB
    public function deleteLink($id)
    {
        // Prepare sql query
        $sql = 'DELETE FROM `links` WHERE `id` = :id';
        $query = $this->_db->prepare($sql);

        // Execute query
        $query->execute(['id' => $id]);
    }

    // Validate link form
    public function validateLink()
    {
        // If fields are empty
        if ($this->long_link == '')
            return 'Введіть посилання';
        elseif ($this->short_link == '')
            return 'Введіть скорочену назву';

        // Prepare sql query
        $sql = 'SELECT `id` FROM `links` WHERE `short_link` = :short_link';
        $query = $this->_db->prepare($sql);

        // Execute query
        $query->execute(['short_link' => $this->short_link]);

        if ($query->rowCount() != 0)
            return 'Таке скорочення вже використовується';
        else
            return 'success';
    }
}