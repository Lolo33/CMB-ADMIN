<?php

namespace CmbSdk\ClassesMetiers;

/**
 * PlanningComission
 *
 * @ORM\Table(name="planning_commission")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlanningCommissionRepository")
 */
class PlanningComission implements ClasseMetierInterface
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
     * @ORM\ManyToOne(targetEntity="Terrain", inversedBy="listeComissions")
     */
    private $terrain;

    /**
     * @var float
     *
     * @ORM\Column(name="com_montant", type="float")
     */
    private $montant;

    /**
     * @var int
     *
     * @ORM\Column(name="com_jour", type="integer")
     */
    private $jourDeLaSemaine;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="com_heure_debut", type="time")
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="com_heure_fin", type="time")
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
     * @return PlanningComission
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
     * @param float $montant
     *
     * @return PlanningComission
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
     * @param \DateTime $heureDebut
     *
     * @return PlanningComission
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return \DateTime
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
     * @return PlanningComission
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
     * @return PlanningComission
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
