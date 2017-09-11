<?php

namespace CmbSdk\ClassesMetiers;

/**
 * Coordonnee
 *
 * @ORM\Table(name="coordonnee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CoordonneeRepository")
 */
class Coordonnee implements ClasseMetierInterface
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
     * @ORM\Column(name="adresse_ligne1", type="string", length=255)
     */
    private $adresseLigne1;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_ligne2", type="string", length=255, nullable=true)
     */
    private $adresseLigne2;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=255)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=20)
     */
    private $telephone;


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
     * Set adresseLigne1
     *
     * @param string $adresseLigne1
     *
     * @return Coordonnee
     */
    public function setAdresseLigne1($adresseLigne1)
    {
        $this->adresseLigne1 = $adresseLigne1;

        return $this;
    }

    /**
     * Get adresseLigne1
     *
     * @return string
     */
    public function getAdresseLigne1()
    {
        return $this->adresseLigne1;
    }

    /**
     * Set adresseLigne2
     *
     * @param string $adresseLigne2
     *
     * @return Coordonnee
     */
    public function setAdresseLigne2($adresseLigne2)
    {
        $this->adresseLigne2 = $adresseLigne2;

        return $this;
    }

    /**
     * Get adresseLigne2
     *
     * @return string
     */
    public function getAdresseLigne2()
    {
        return $this->adresseLigne2;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Coordonnee
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Coordonnee
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Coordonnee
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Coordonnee
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
}
