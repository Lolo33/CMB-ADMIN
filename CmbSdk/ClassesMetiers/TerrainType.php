<?php

namespace CmbSdk\ClassesMetiers;

/**
 * TerrainType
 *
 * @ORM\Table(name="terrain_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TerrainTypeRepository")
 */
class TerrainType implements ClasseMetierInterface
{


    public function serializeProperties()
    {
        // TODO: Implement serializeProperties() method.
    }

    public function iterateProperties()
    {
        $array_prop_valeurs = array();
        foreach($this as $key => $value) {
            $array_prop_valeurs[$key] = $value;
        }
        return $array_prop_valeurs;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type_nom", type="string", length=255)
     */
    private $typeNom;


    /**
     * Set id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set typeNom
     *
     * @param string $typeNom
     *
     * @return TerrainType
     */
    public function setTypeNom($typeNom)
    {
        $this->typeNom = $typeNom;

        return $this;
    }

    /**
     * Get typeNom
     *
     * @return string
     */
    public function getTypeNom()
    {
        return $this->typeNom;
    }
}

