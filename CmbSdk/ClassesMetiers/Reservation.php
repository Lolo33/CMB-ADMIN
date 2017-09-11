<?php

namespace CmbSdk\ClassesMetiers;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservationRepository")
 */
class Reservation implements ClasseMetierInterface
{


    public function serializeProperties()
    {
        return array(
            "date_debut" => $this->plageHoraire->getHeureDebut(),
            "date_fin" => $this->plageHoraire->getHeureFin(),
            "terrain" => $this->plageHoraire->getTerrain()->getId(),
            "nom_client" => $this->nomClient,
            "tel_client" => $this->telephoneClient,
            "descriptif_resa" => $this->descriptif
        );
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
     * @ORM\Column(name="res_reference", type="string", length=15)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="res_nom_client", type="string", length=255)
     */
    private $nomClient;

    /**
     * @var string
     *
     * @ORM\Column(name="res_num_tel_client", type="string", length=20)
     */
    private $telephoneClient;

    /**
     * @var string
     *
     * @ORM\Column(name="res_descriptif", type="text", nullable=true)
     */
    private $descriptif;

    /**
     * @var bool
     *
     * @ORM\Column(name="res_est_confirmee", type="boolean")
     */
    private $estConfirmee;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="PlageHoraire", mappedBy="reservation")
     */
    private $plageHoraire;



    function __construct($is_object_searched = false)
    {
        if ($is_object_searched)
            $this->plageHoraire = new PlageHoraire(true);
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
     * Set reference
     *
     * @param string $reference
     *
     * @return Reservation
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set estConfirmee
     *
     * @param boolean $estConfirmee
     *
     * @return Reservation
     */
    public function setEstConfirmee($estConfirmee)
    {
        $this->estConfirmee = $estConfirmee;

        return $this;
    }

    /**
     * Get estConfirmee
     *
     * @return bool
     */
    public function getEstConfirmee()
    {
        return $this->estConfirmee;
    }

    /**
     * Set plageHoraire
     *
     * @param string $plageHoraire
     *
     * @return Reservation
     */
    public function setPlageHoraire($plageHoraire)
    {
        $this->plageHoraire = $plageHoraire;

        return $this;
    }

    /**
     * Get plageHoraire
     *
     * @return string
     */
    public function getPlageHoraire()
    {
        return $this->plageHoraire;
    }

    /**
     * Set nomClient
     *
     * @param string $nomClient
     *
     * @return Reservation
     */
    public function setNomClient($nomClient)
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    /**
     * Get nomClient
     *
     * @return string
     */
    public function getNomClient()
    {
        return $this->nomClient;
    }

    /**
     * Set telephoneClient
     *
     * @param string $numeroTelephoneClient
     *
     * @return Reservation
     */
    public function setTelephoneClient($numeroTelephoneClient)
    {
        $this->telephoneClient = $numeroTelephoneClient;

        return $this;
    }

    /**
     * Get telephoneClient
     *
     * @return string
     */
    public function getTelephoneClient()
    {
        return $this->telephoneClient;
    }

    /**
     * Set descriptif
     *
     * @param string $descriptif
     *
     * @return Reservation
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }
}
