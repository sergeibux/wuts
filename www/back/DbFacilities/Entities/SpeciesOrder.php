<?php

class SpeciesOrder
{
    private $id;
    private $scientificTerms;
    private $frenchTerms;
    private $descriptive;
    private $id_specieClass;
    
    public function __construct(int $id, string $scientificTerms, string $frenchTerms, string $descriptive, int $id_specieClass){
        $this->$id = $id;
        $this->$scientificTerms = $scientificTerms;
        $this->$frenchTerms = $frenchTerms;
        $this->$descriptive = $descriptive;
        $this->$id_specieClass = $id_specieClass;
    }
    
    public function __construct(string $scientificTerms, string $frenchTerms, string $descriptive, int $id_specieClass){
        $this->$scientificTerms = $scientificTerms;
        $this->$frenchTerms = $frenchTerms;
        $this->$descriptive = $descriptive;
        $this->$id_specieClass = $id_specieClass;
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
        return $this->id_specieClass;
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
        $this->id_specieClass = $id_specieClass;
    }

}

