<?php

namespace CmbSdk\ClassesMetiers;
/**
 * PlageHoraire
 *
 * @ORM\Table(name="plage_horaire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlageHoraireRepository")
 */
class PlageHoraire implements ClasseMetierInterface
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
     * @ORM\ManyToOne(targetEntity="Terrain", inversedBy="listeHoraires")
     */
    private $terrain;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hor_heure_debut", type="datetime")
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hor_heure_fin", type="datetime")
     */
    private $heureFin;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="PlageHoraireStatut")
     */
    private $statut;


    function __construct($is_direct_object = false)
    {
        if ($is_direct_object)
            $this->terrain = new Terrain();
        $this->statut = new PlageHoraireStatut();
        $this->reservation = new Reservation();
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
     * @param string $terrain
     *
     * @return PlageHoraire
     */
    public function setTerrain($terrain)
    {
        $this->terrain = $terrain;

        return $this;
    }

    /**
     * Get terrain
     *
     * @return string
     */
    public function getTerrain()
    {
        return $this->terrain;
    }

    /**
     * Set heureDebut
     *
     * @param \DateTime $heureDebut
     *
     * @return PlageHoraire
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
     * @return PlageHoraire
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
     * Set statut
     *
     * @param string $statut
     *
     * @return PlageHoraire
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

}

