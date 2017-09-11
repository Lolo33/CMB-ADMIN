<?php

namespace CmbSdk\ClassesMetiers;

/**
 * PlageHoraireStatut
 *
 * @ORM\Table(name="plage_horaire_statut")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlageHoraireStatutRepository")
 */
class PlageHoraireStatut implements ClasseMetierInterface
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
     * @ORM\Column(name="statutNom", type="string", length=255)
     */
    private $statutNom;


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
     * Set statutNom
     *
     * @param string $statutNom
     *
     * @return PlageHoraireStatut
     */
    public function setStatutNom($statutNom)
    {
        $this->statutNom = $statutNom;

        return $this;
    }

    /**
     * Get statutNom
     *
     * @return string
     */
    public function getStatutNom()
    {
        return $this->statutNom;
    }
}

