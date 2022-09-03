<?php
/* models/BookmakrsModel.php */

namespace app\models;
use \PDO;
use app\core\Application;
use app\interfaces\Edit;

class BookmarksModel implements Edit
{
    public function loadList():array
    {
        $db_request = Application::$core->con->pdo->prepare('
                                    SELECT id, name, url, description, star
                                    FROM bookmarks
                                    ORDER BY name
        ');
        $db_request->execute();
        
        $list = $db_request->fetchAll(PDO::FETCH_ASSOC);

        return $list;
    }

    public function saveNewOne($getBody)
    {
        $db_request = Application::$core->con->pdo->prepare('
                                    INSERT INTO `bookmarks` (name, url, description, star)
                                    VALUES (:name, :url, :description, :star)
        ');
        $db_request->execute(
            array(
                "name" => $getBody['name'],
                "url" => $getBody['url'],
                "description" => $getBody['description'],
                "star" => $getBody['star']
            )
        );
    }   
}