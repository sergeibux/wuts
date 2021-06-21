<?php
include_once 'SpeciesClass.php';
include_once  $_SERVER['DOCUMENT_ROOT'] . "/back/DbFacilities/Dbo.php";

class SpeciesOrder
{
    private $id;
    private $scientificTerms;
    private $frenchTerms;
    private $descriptive;
    private $id_speciesClass;
    
    
    public function __construct(string $scientificTerms, string $frenchTerms, string $descriptive,
        SpeciesClass $speciesClass){
        
            $this->scientificTerms = $scientificTerms;
            $this->frenchTerms = $frenchTerms;
            $this->descriptive = $descriptive;
            $this->id_speciesClass = $speciesClass->dbSave();
            $this->id = $this->dbSave();
    }
    
    public function dbSave(){
        $db = new Dbo();
        $table = "speciesOrder";
        $columns = array("scientificTerms", "descriptive", "frenchTerms", "id_speciesClass");
        $values = array($this->scientificTerms, $this->descriptive, $this->frenchTerms, $this->id_speciesClass[0]);
        $this->id = $db->addToTable($table, $columns, $values);
        return $this->id;
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getScientificTerms()
    {
        return $this->scientificTerms;
    }

    /**
     * @return string
     */
    public function getFrenchTerms()
    {
        return $this->frenchTerms;
    }

    /**
     * @return string
     */
    public function getDescriptive()
    {
        return $this->descriptive;
    }

    /**
     * @return int
     */
    public function getId_specieClass()
    {
        return $this->id_speciesClass;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setScientificTerms(string $scientificTerms)
    {
        $this->scientificTerms = $scientificTerms;
    }

    public function setFrenchTerms(string $frenchTerms)
    {
        $this->frenchTerms = $frenchTerms;
    }

    public function setDescriptive(string $descriptive)
    {
        $this->descriptive = $descriptive;
    }

    public function setId_specieClass(int $id_specieClass)
    {
        $this->id_speciesClass = $id_specieClass;
    }

}

