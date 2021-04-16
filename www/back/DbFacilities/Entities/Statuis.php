<?php

class Statuis
{
    private $id;
    private $name;
    
    public function __construct(int $id, string $name){
        $this->$id = $id;
        $this->$name = $name;
    }
    
    public function __construct(string $name){
        $this->$name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

}

