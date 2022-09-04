<?php
/* migrations/Migration.php */

namespace app\migrations;
use app\core\Database;
use \PDO;

class Migration 
{
    public Database $con;

    public function __construct()
    {
        $this->con = new Database();
    }

    public function CreateTables()
    {
        $dbRequest = $this->con->pdo->prepare('
                                CREATE TABLE `users` (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                                    `lastname` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                                    `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                                    `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                                ALTER TABLE `users`
                                ADD PRIMARY KEY (`id`);
                                CREATE TABLE `bookmarks` (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `name` varchar(100) NOT NULL,
                                    `url` varchar(200) NOT NULL,
                                    `description` varchar(500) DEFAULT NULL,
                                    `star` int(1) DEFAULT NULL
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                                  ALTER TABLE `bookmarks`
                                ADD PRIMARY KEY (`id`);      
                                CREATE TABLE `groups` (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                                    `description` varchar(500) DEFAULT NULL
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                                  ALTER TABLE `groups`
                                  ADD PRIMARY KEY (`id`);       
                                  CREATE TABLE `relations` (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `id_bookmarks` int(11) NOT NULL,
                                    `id_group` int(11) NOT NULL
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                                  ALTER TABLE `relations`
                                  ADD PRIMARY KEY (`id`);
        ');
        try {
            $dbRequest->execute();
            echo "Tables have been created.<br />";
            return true;
        }
        catch(PDOException $e) {
            echo 'Migration has faild: ' . $e->getMessage();
            return false;
        }
    }

    public function InsertTablesData()
    {
        $dbRequest = $this->con->pdo->prepare('
                                INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`) 
                                VALUES (1, "Admin", "Admin", "pawelstempak@gmail.com", "amadeusz");
        ');
        try {
            $dbRequest->execute();
            echo "The data has been inserted.<br />";
            return true;
        }
        catch(PDOException $e) {
            echo 'Migration has faild: ' . $e->getMessage();
            return false;
        }

    }
}