<?php

namespace CmbSdk\ClassesMetiers;

/**
 * Terrain
 *
 * @ORM\Table(name="terrain")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TerrainRepository")
 */
class Terrain implements ClasseMetierInterface
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
     * @ORM\Column(name="terrain_nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var TerrainType
     *
     * @ORM\ManyToOne(targetEntity="TerrainType")
     */
    private $type;

    /**
     * @var Complexe
     *
     * @ORM\ManyToOne(targetEntity="Complexe", inversedBy="listeTerrains")
     */
    private $complexe;

    /**
     * @var PlageHoraire[]
     *
     * @ORM\OneToMany(targetEntity="PlageHoraire", mappedBy="terrain")
     */
    private $listeHoraires;

    /**
     * @var PlanningTarif[]
     *
     * @ORM\OneToMany(targetEntity="PlanningTarif", mappedBy="terrain")
     */
    private $listeTarifs;

    /**
     * @var PlanningComission[]
     *
     * @ORM\OneToMany(targetEntity="PlanningComission", mappedBy="terrain")
     */
    private $listeComissions;

    /**
     * Constructor
     */
    public function __construct($is_object_searched = false)
    {
        $this->type = new TerrainType();
        if ($is_object_searched)
            $this->complexe = new Complexe(false);
        $this->listeHoraires = array(new PlageHoraire());
        $this->listeTarifs = array(new PlanningTarif());
        $this->listeComissions = array(new PlanningComission());
    }



    public function truncObjetVide(){
        unset($this->listeHoraires[0]);
        unset($this->listeTarifs[0]);
        unset($this->listeComissions[0]);
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Terrain
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set type
     *
     * @param TerrainType $type
     *
     * @return Terrain
     */
    public function setType(TerrainType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return TerrainType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set complexe
     *
     * @param Complexe $complexe
     *
     * @return Terrain
     */
    public function setComplexe(Complexe $complexe = null)
    {
        $this->complexe = $complexe;

        return $this;
    }

    /**
     * Get complexe
     *
     * @return Complexe
     */
    public function getComplexe()
    {
        return $this->complexe;
    }


    /**
     * Get listeHoraires
     *
     * @return PlageHoraire[]
     */
    public function getListeHoraires()
    {
        return $this->listeHoraires;
    }

    /**
     * Add horaires
     *
     * @param PlageHoraire $horaire
     *
     * @return Terrain
     */
    public function addListeHoraires(PlageHoraire $horaire) {
        $this->listeHoraires[] = $horaire;

        return $this;
    }

    /**
     * Set listeHoraires
     *
     * @param PlageHoraire[] $listeHor
     *
     * @return Terrain
     */
    public function setListeHoraires($listeHor)
    {
        $this->listeHoraires = $listeHor;
        return $this;
    }



    /**
     * Get listeTarifs
     *
     * @return PlanningTarif[]
     */
    public function getListeTarifs()
    {
        return $this->listeTarifs;
    }


    /**
     * Add listeTarifs
     *
     * @param PlanningTarif $tarif
     *
     * @return Terrain
     */
    public function addListeTarifs(PlanningTarif $tarif) {
        $this->listeTarifs[] = $tarif;

        return $this;
    }

    /**
     * Set listeTarifs
     *
     * @param PlanningTarif[] $listeTarif
     *
     * @return Terrain
     */
    public function setListeTarifs($listeTarif)
    {
        $this->listeTarifs = $listeTarif;
        return $this;
    }

    /**
     * Get listeComissions
     *
     * @return PlanningComission[]
     */
    public function getListeComissions()
    {
        return $this->listeComissions;
    }

    /**
     * Add listeTarifs
     *
     * @param PlanningComission $com
     *
     * @return Terrain
     */
    public function addListeComissions(PlanningComission $com) {
        $this->listeComissions[] = $com;

        return $this;
    }

    /**
     * Set listeComissions
     *
     * @param PlanningComission[] $listeComission
     *
     * @return Terrain
     */
    public function setListeComissions($listeCom)
    {
        $this->listeComissions = $listeCom;
        return $this;
    }

}
