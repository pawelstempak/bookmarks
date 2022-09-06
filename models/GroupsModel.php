<?php
/* models/GroupsModel.php */

namespace app\models;
use \PDO;
use app\core\Application;
use app\interfaces\Edit;

class GroupsModel implements Edit
{
    private string $condition = "";
    private string $tables = "";

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

    private function createTables(array $t)
    {
        foreach($t as $key)
        {               
            $this->tables .= $key.", ";
        }
        if(count($t)>0) $this->tables = substr($this->tables, 0, -2);
        return $this->tables;
    }

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

    public function loadOne(array $tables, array $param):array
    {
        $db_request = Application::$core->con->pdo->prepare('
                                    SELECT *
                                    FROM '.$this->createTables($tables).'
                                    '.$this->createCondition($param).'
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
    }   

    public function saveGroup($getBody, $id)
    {
        $db_request = Application::$core->con->pdo->prepare('
                                    UPDATE `groups` 
                                    SET name=:name, description=:description
                                    WHERE id = '.$id.'
        ');
        $db_request->execute(
            array(
                "name" => $getBody['name'],
                "description" => $getBody['description']
            )
        );
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