<?php

namespace CmbSdk\ClassesMetiers;

/**
 * PlanningTarif
 *
 * @ORM\Table(name="planning_tarif")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlanningTarifRepository")
 */
class PlanningTarif implements ClasseMetierInterface
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
     * @var Terrain
     *
     * @ORM\ManyToOne(targetEntity="Terrain", inversedBy="listeTarifs")
     */
    private $terrain;

    /**
     * @var string
     *
     * @ORM\Column(name="tarif_montant", type="float", length=255)
     */
    private $montant;

    /**
     * @var int
     *
     * @ORM\Column(name="tarif_jour", type="integer")
     */
    private $jourDeLaSemaine;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tarif_heure_debut", type="time")
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tarif_heure_fin", type="time")
     */
    private $heureFin;



    function __construct($is_direct_object = false)
    {
        if ($is_direct_object)
            $this->terrain = new Terrain();
    }

    function truncObjetVide(){
        $this->terrain->truncObjetVide();
    }

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
     * Set terrain
     *
     * @param Terrain $terrain
     *
     * @return PlanningTarif
     */
    public function setTerrain(Terrain $terrain)
    {
        $this->terrain = $terrain;

        return $this;
    }

    /**
     * Get terrain
     *
     * @return Terrain
     */
    public function getTerrain()
    {
        return $this->terrain;
    }

    /**
     * Set montant
     *
     * @param string $montant
     *
     * @return PlanningTarif
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set heureDebut
     *
     * @param string $heureDebut
     *
     * @return PlanningTarif
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return string
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param \DateTime $heureFin
     *
     * @return PlanningTarif
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return \DateTime
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set jourDeLaSemaine
     *
     * @param integer $jourDeLaSemaine
     *
     * @return PlanningTarif
     */
    public function setJourDeLaSemaine($jourDeLaSemaine)
    {
        $this->jourDeLaSemaine = $jourDeLaSemaine;

        return $this;
    }

    /**
     * Get jourDeLaSemaine
     *
     * @return integer
     */
    public function getJourDeLaSemaine()
    {
        return $this->jourDeLaSemaine;
    }
}
