<?php

class Habitat
{
    private $id_habitatPrimaire;
    private $name;
    private $description;
    private $picture; 
    
    public function __construct(int $id, string $name, string $description, string $picture){
        $this->$id_habitatPrimaire = $id;
        $this->$name = $name;
        $this->$description = $description;
        $this->$picture = $picture;
    }
    
    /*
     * use this functiononly if you do not know ID 
     */
    public function __construct(string $name, string $description, string $picture){
        $this->$name = $name;
        $this->$description = $description;
        $this->$picture = $picture;
    }
    
    /**
     * @return int
     */
    public function getId_habitatPrimaire()
    {
        return $this->id_habitatPrimaire;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string (utri)
     */
    public function getPicture()
    {
        return $this->picture;
    }

    public function setId_habitatPrimaire(int $id_habitatPrimaire)
    {
        $this->id_habitatPrimaire = $id_habitatPrimaire;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function setPicture(string $picture)
    {
        $this->picture = $picture;
    }
}

