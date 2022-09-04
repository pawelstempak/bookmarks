<?php
namespace app\interfaces;
interface Edit
{
    public function loadList(array $tables=[], array $param=[]):array;

    public function saveNewOne(string $getBody);
}