<?php
/* models/BookmakrsModel.php */

namespace app\models;
use \PDO;
use app\core\Application;
use app\interfaces\Edit;

class BookmarksModel implements Edit
{
    protected string $condition = "";
    protected string $tables = "";

    public function createCondition(array $p)
    {
        if(count($p)>0) $this->condition="WHERE ";
        foreach($p as $key => $value)
        {               
            $this->condition .= "".$key." = ".$value." and ";
        }
        if(count($p)>0) $this->condition = substr($this->condition, 0, -4);

        return $this->condition;
        
    }

    public function createTables(array $t)
    {
        foreach($t as $key)
        {               
            $this->tables .= $key.", ";
        }
        if(count($t)>0) $this->tables = substr($this->tables, 0, -2);

        return $this->tables;
    }

    public function loadList(array $tables =[], array $param=[]):array
    {
        $sql = '
        SELECT *
        FROM '.$this->createTables($tables).'
        '.$this->createCondition($param).'
        ORDER BY name
        ';
        $db_request = Application::$core->con->pdo->prepare($sql);
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

        $db_request = Application::$core->con->pdo->prepare('
            SELECT LAST_INSERT_ID()
        ');
        $db_request->execute();
        $last_insert_id = $db_request->fetch();

        $db_request = Application::$core->con->pdo->prepare('
                                    INSERT INTO `relations` (id_bookmarks, id_group)
                                    VALUES (:id_bookmarks, :id_group)
        ');
        $db_request->execute(
            array(
                "id_bookmarks" => $last_insert_id['LAST_INSERT_ID()'],
                "id_group" => $getBody['category']
            )
        );        
    }   
}