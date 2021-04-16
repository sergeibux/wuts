<?php
namespace back\DbFacilities\Entities;

class SpeciesGender
{
    private $id;
    private $scientificTerms;
    private $frenchTerms;
    private $descriptive;
    private $id_specieFamily;
    
    
    public function __construct(int $id, string $scientificTerms, string $frenchTerms, string $descriptive, int $id_specieFamily){
        $this->$id = $id;
        $this->$scientificTerms = $scientificTerms;
        $this->$frenchTerms = $frenchTerms;
        $this->$descriptive = $descriptive;
        $this->$id_specieFamily = $id_specieFamily;
    }
    
    
    public function __construct(string $scientificTerms, string $frenchTerms, string $descriptive, int $id_specieFamily){
        $this->$scientificTerms = $scientificTerms;
        $this->$frenchTerms = $frenchTerms;    
        $this->$descriptive = $descriptive;    
        $this->$id_specieFamily = $id_specieFamily;
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
    public function getId_specieFamily()
    {
        return $this->id_specieFamily;
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

    public function setId_specieFamily(int $id_specieFamily)
    {
        $this->id_specieFamily = $id_specieFamily;
    }

}

