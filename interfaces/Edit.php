<?php
namespace app\interfaces;
interface Edit
{
    public function loadList(array $tables=[], array $param=[]):array;

    public function loadOne(array $tables, array $param):array;

    public function saveNewOne(string $getBody);

    public function deleteOne(string $table, int $id);
}