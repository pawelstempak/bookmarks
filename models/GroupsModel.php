<?php
/* models/GroupsModel.php */

namespace app\models;
use \PDO;
use app\core\Application;
use app\interfaces\Edit;

class GroupsModel implements Edit
{
    public function loadName($id)
    {
        $db_request = Application::$core->con->pdo->prepare('
        SELECT name
        FROM groups
        WHERE id = '.$id.'
        ');
        $db_request->execute();

        $res = $db_request->fetch();

        return $res['name'];
    }

    public function loadList(array $tables=[], array $param=[]):array
    {
        $db_request = Application::$core->con->pdo->prepare('
                                    SELECT id, name
                                    FROM groups
                                    ORDER BY name
        ');
        $db_request->execute();
        
        $groupslist = $db_request->fetchAll(PDO::FETCH_ASSOC);

        return $groupslist;
    }

    public function loadOne(array $tables, int $id):array
    {
        $db_request = Application::$core->con->pdo->prepare('
                                    SELECT *
                                    FROM '.$tables.'
                                    WHERE id = '.$id.'
        ');
        $db_request->execute();
        
        $group_one = $db_request->fetch();

        return $group_one;        
    }

    public function saveNewOne($getBody)
    {
        $db_request = Application::$core->con->pdo->prepare('
                                    INSERT INTO `groups` (name, description)
                                    VALUES (:name, :description)
        ');
        $db_request->execute(
            array(
                "name" => $getBody['name'],
                "description" => $getBody['description']
            )
        );
        $db_request = Application::$core->con->pdo->prepare('
                                    SELECT LAST_INSERT_ID()
        ');
        $db_request->execute();
    }   

    public function deleteOne($table, $id)
    {
        $db_request = Application::$core->con->pdo->prepare('
                                    DELETE FROM '.$table.'
                                    WHERE id = '.$id.'
        ');
        $db_request->execute();        
    }
}