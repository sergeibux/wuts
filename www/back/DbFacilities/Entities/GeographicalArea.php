<?php
class GeographicalArea
{
    private $id;
    private $name;
    private $polygon;

    public function __construct(int $id, string $name, array $polygon){
        $this->id = $id;
        $this->name = $name;
        $this->polygon = $polygon;
    }
    
    /*
     * use this functiononly if you do not know ID
     */
    public function __construct(string $name, array $polygon){
        $this->name = $name;
        $this->polygon = $polygon;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array of strings containing points
     */
    public function getPolygon()
    {
        return $this->polygon;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setPolygon(array $polygon)
    {
        $this->polygon = $polygon;
    }
    
}

