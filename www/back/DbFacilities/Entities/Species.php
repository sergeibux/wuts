<?php
include_once 'SpeciesGender.php';
include_once  $_SERVER['DOCUMENT_ROOT'] . "/back/DbFacilities/Dbo.php";

class Species
{
    private $id;
    private $scientificName;
    private $frenchName;
    private $englishName;
    private $picture;
    private $identKeys;
    private $id_specieGender;

    function __construct(
        string $scientificName,
        string $frenchName,
        string $englishName,
        string $picture,
        string $identKeys,
        SpeciesGender $speciesGender){

            echo "-sp-28";
            $this->scientificName = $scientificName;
            $this->frenchName = $frenchName;
            $this->englishName = $englishName;
            $this->picture = $picture;
            $this->identKeys = $identKeys;
            $this->id_specieGender = $speciesGender->getId();
            $this->id = $this->dbSave();
    }
    
    public function dbSave(){
        $db = new Dbo();
        $table = "Species";
        $columns = array("scientificName", "picture", "frenchName", "englishName", "id_speciesGender");
        $values = array($this->scientificName, $this->picture, $this->frenchName, $this->englishName, $this->id_specieGender);
        $this->id = $db->addToTable($table, $columns, $values);
        return $this->id;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getScientificName()
    {
        return $this->scientificName;
    }
    
    public function getFrenchName()
    {
        return $this->frenchName;
    }
    
    public function getPicture()
    {
        return $this->picture;
    }

    public function getIdentificationKeys()
    {
        return $this->identificationKeys;
    }

    public function getId_specieGender()
    {
        return $this->id_specieGender;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
    
    public function setScientificName(string $name)
    {
        $this->scientificName = $name;
    }
    
    public function setFrenchName(string $name)
    {
        $this->frenchName = $name;
    }

    public function setPicture(string $picture)
    {
        $this->picture = $picture;
    }

    public function setIdentificationKeys(string $identKeys)
    {
        $this->identificationKeys = $identKeys;
    }

    public function setId_specieGender(int $id_specieGender)
    {
        $this->id_specieGender = $id_specieGender;
    }
    
    static function getAllSpecies(){
        $db = new Dbo();
        $table = "Species";
        $list = array("id", "scientificName", "picture", "frenchName", "englishName", "id_speciesGender");
        $hays = array("scientificName", "frenchName");
        $sort = "ASC";
        $limit = 500;
        $result = $db->listSomeMatchesFromTable($list, $table, (array) "", $hays, $sort, $limit);
        return $result;
    }
    
    static function getSomeSpeciesMatching(string $needle, int $limit){
        $db = new Dbo();
        $table = "Species";
        $list = array("id", "scientificName", "picture", "frenchName", "englishName", "id_speciesGender");
        $hays = array("scientificName", "frenchName");
        $sort = "ASC";
        $result = $db->listSomeMatchesFromTable($list, $table, (array) $needle, $hays, $sort, $limit);
        return $result;
    }
    
    static function getSpeciesWithGenderId(array $genderIds){
        $db = new Dbo();
        $table = "Species";
        $list = array("id", "scientificName", "picture", "frenchName", "englishName", "id_speciesGender");
        $hays = array("id_speciesGender");
        $sort = "ASC";
        $preciseMatching = true;
        $result = $db->listSomeMatchesFromTable($list, $table, $needles, $hays, $sort, $limit, $preciseMatching);
        return $result;
    }

    
}

