<?php

class Observation
{
    private $id_observationPrimaire;
    private $observationDate;
    private $geographicalArea;
    private $polygon;
    private $distinctiveSign;
    private $population;
    private $id_userWutsIndex;
    private $id_status;
    private $id_specimen;
    
    public function __construct(int $id_observationPrimaire, string $observationDate, string $geographicalArea, array $polygon, string $distinctiveSign, int $population, int $id_userWutsIndex, int $status){
        $this->id_observationPrimaire = $id_observationPrimaire;
        $this->observationDate = $observationDate;
        $this->geographicalArea = $geographicalArea;
        $this->polygon = $polygon;
        $this->distinctiveSign = $distinctiveSign;
        $this->population = $population;
        $this->id_userWutsIndex = $id_userWutsIndex;
        $this->id_status = $status;
    }
    
    /**
     * use this functiononly if you do not know ID
     */
    public function __construct(string $observationDate, string $geographicalArea, array $polygon, string $distinctiveSign, int $population, int $id_userWutsIndex, int $status){
        $this->observationDate = $observationDate;
        $this->geographicalArea = $geographicalArea;
        $this->polygon = $polygon;
        $this->distinctiveSign = $distinctiveSign;
        $this->population = $population;
        $this->id_userWutsIndex = $id_userWutsIndex;
        $this->id_status = $status;
    }
    
    /**
     * @return int
     */
    public function getId_observationPrimaire()
    {
        return $this->id_observationPrimaire;
    }

    /**
     * @return string
     */
    public function getObservationDate()
    {
        return $this->observationDate;
    }

    /**
     * @return string
     */
    public function getGeographicalArea()
    {
        return $this->geographicalArea;
    }

    /**
     * @return array
     */
    public function getPolygon()
    {
        return $this->polygon;
    }

    /**
     * @return string
     */
    public function getDistinctiveSign()
    {
        return $this->distinctiveSign;
    }

    /**
     * @return int
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * @return int
     */
    public function getId_userWutsIndex()
    {
        return $this->id_userWutsIndex;
    }

    /**
     * @return int
     */
    public function getId_status()
    {
        return $this->id_status;
    }
    
    /**
     * @return int
     */
    public function getId_specimen()
    {
        return $this->id_specimen;
    }
    
    /**
     * @param int $id_specimen
     */
    public function setId_specimen(int $id_specimen)
    {
        $this->id_specimen = $id_specimen;
    }
    
    public function setId_observationPrimaire(int $id_observationPrimaire)
    {
        $this->id_observationPrimaire = $id_observationPrimaire;
    }

    public function setObservationDate(string $observationDate)
    {
        $this->observationDate = $observationDate;
    }

    public function setGeographicalArea(string $geographicalArea)
    {
        $this->geographicalArea = $geographicalArea;
    }

    /**
     * @return array of strings containing points
     */
    public function setPolygon(array $polygon)
    {
        $this->polygon = $polygon;
    }

    public function setDistinctiveSign(string $distinctiveSign)
    {
        $this->distinctiveSign = $distinctiveSign;
    }

    public function setPopulation(int $population)
    {
        $this->population = $population;
    }

    public function setId_userWutsIndex(int $id_userWutsIndex)
    {
        $this->id_userWutsIndex = $id_userWutsIndex;
    }

    public function setId_status(int $id_status)
    {
        $this->id_status = $id_status;
    }

}

