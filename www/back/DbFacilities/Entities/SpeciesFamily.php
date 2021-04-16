<?php

class speciesFamily
{
    private $id;
    private $scientificTerms;
    private $descriptive;
    private $frenchTerms;
    private $id_specieOrder;
    
    
    public function __construct(int $id, string $scientificTerms, string $descriptive, string $frenchTerms, int $id_specieOrder) {
        $this->$id = $id;
        $this->$scientificTerms = $scientificTerms;
        $this->$descriptive = $descriptive;
        $this->$frenchTerms = $frenchTerms;
        $this->$id_specieOrder = $id_specieOrder;
    }
    
    public function __construct(string $scientificTerms, string $descriptive, string $frenchTerms, int $id_specieOrder) {
        $this->$scientificTerms = $scientificTerms;
        $this->$descriptive = $descriptive;
        $this->$frenchTerms = $frenchTerms;
        $this->$id_specieOrder = $id_specieOrder;
    }

    /**
     * @return int
     */
    public function getId_specieFamily()
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
    public function getDescriptive()
    {
        return $this->descriptive;
    }

    /**
     * @return string
     */
    public function getFrenchTerms()
    {
        return $this->frenchTerms;
    }

    /**
     * @return int
     */
    public function getId_specieOrder()
    {
        return $this->id_specieOrder;
    }

    public function setId_specieFamily(int $id_specieFamily)
    {
        $this->id = $id_specieFamily;
    }

    public function setScientificTerms(string $scientificTerms)
    {
        $this->scientificTerms = $scientificTerms;
    }

    public function setDescriptive(string $descriptive)
    {
        $this->descriptive = $descriptive;
    }

    public function setFrenchTerms(string $frenchTerms)
    {
        $this->frenchTerms = $frenchTerms;
    }

    public function setId_specieOrder(int $id_specieOrder)
    {
        $this->id_specieOrder = $id_specieOrder;
    }    
    
}

