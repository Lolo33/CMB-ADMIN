<?php

namespace CmbSdk\ClassesMetiers;

/**
 * UtilisateurApiRepository
 *
 * @ORM\Table(name="utilisateur_api")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UtilisateurApiRepository")
 */
class UtilisateurApi implements ClasseMetierInterface
{

    public function serializeProperties(){
        return array(
            "userClientId" => $this->getUserClientId(),
            "userPlainPassword" => $this->getUserPlainPassword(),
            "nomSociete" => $this->getNomSociete(),
            "adresseL1" => $this->getCoordonnee()->getAdresseLigne1(),
            "adresseL2" => $this->getCoordonnee()->getAdresseLigne2(),
            "ville" => $this->getCoordonnee()->getVille(),
            "codePostal" => $this->getCoordonnee()->getCodePostal(),
            "telephone" => $this->getCoordonnee()->getTelephone(),
            "mail" => $this->getCoordonnee()->getMail()
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
     * @ORM\Column(name="user_nom_societe", type="string")
     */
    private $nomSociete;

    /**
     * @var string
     *
     * @ORM\Column(name="user_client_id", type="string", unique=true)
     */
    private $userClientId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=255)
     */
    private $userPassword;

    /**
     * @var Coordonnee
     *
     */
    private $coordonnee;

    /**
     * @var PlanningComission[]
     *
     * @ORM\OneToMany(targetEntity="PlanningComission", mappedBy="apiUser")
     */
    private $listeComissions;

    /**
     * @var Reservation[]
     *
     */
    private $listeReservations;

    private $userPlainPassword;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->coordonnee = new Coordonnee();
        $this->listeReservations = array(new Reservation(true));
    }

    public function truncObjetVide(){
        unset($this->listeReservations[0]);
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
     * Set userClientId
     *
     * @param string $userClientId
     *
     * @return UtilisateurApi
     */
    public function setUserClientId($userClientId)
    {
        $this->userClientId = $userClientId;

        return $this;
    }

    /**
     * Get userClientId
     *
     * @return string
     */
    public function getUserClientId()
    {
        return $this->userClientId;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     *
     * @return UtilisateurApi
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get userPassword
     *
     * @return string
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Get userPlainPassword
     *
     * @return string
     */
    public function getUserPlainPassword()
    {
        return $this->userPlainPassword;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     *
     * @return UtilisateurApi
     */
    public function setUserPlainPassword($userPassword)
    {
        $this->userPlainPassword = $userPassword;

        return $this;
    }

    /**
     * Set coordonnee
     *
     * @param Coordonnee $coordonnee
     *
     * @return UtilisateurApi
     */
    public function setCoordonnee(Coordonnee $coordonnee = null)
    {
        $this->coordonnee = $coordonnee;

        return $this;
    }

    /**
     * Get coordonnee
     *
     * @return Coordonnee
     */
    public function getCoordonnee()
    {
        return $this->coordonnee;
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
     * Set listeComissions
     *
     * @param PlanningComission[] $listeComission
     *
     * @return UtilisateurApi
     */
    public function setListeComissions($listeCom)
    {
        $this->listeComissions = $listeCom;
        return $this;
    }

    /**
     * Set nomSociete
     *
     * @param string $nomSociete
     *
     * @return UtilisateurApi
     */
    public function setNomSociete($nomSociete)
    {
        $this->nomSociete = $nomSociete;

        return $this;
    }

    /**
     * Get nomSociete
     *
     * @return string
     */
    public function getNomSociete()
    {
        return $this->nomSociete;
    }

    /**
     * @return Reservation[]
     */
    public function getListeReservations()
    {
        return $this->listeReservations;
    }

    /**
     * @param Reservation[] $listeReservations
     */
    public function setListeReservations($listeReservations)
    {
        $this->listeReservations = $listeReservations;
    }

}
