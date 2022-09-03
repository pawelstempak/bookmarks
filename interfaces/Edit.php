<?php
namespace app\interfaces;
interface Edit
{
    public function LoadList():array;

    public function SaveNewOne(string $getBody);
}