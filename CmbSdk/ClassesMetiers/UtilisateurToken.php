<?php

namespace CmbSdk\ClassesMetiers;

/**
 * UtilisateurToken
 *
 * @ORM\Table(name="utilisateur_token")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UtilisateurTokenRepository")
 */
class UtilisateurToken implements ClasseMetierInterface
{

    public function serializeProperties()
    {
        $prop_a_envoyer = array(
            "login" => $this->apiUser->getUserClientId(),
            "password" => $this->apiUser->getUserPlainPassword(),
        );
        //var_dump($prop_a_envoyer);
        return $prop_a_envoyer;
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
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="UtilisateurApi")
     * @var UtilisateurApi
     */
    private $apiUser;


    function __construct()
    {
        $this->apiUser = new UtilisateurApi();
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
     * Set value
     *
     * @param string $value
     *
     * @return UtilisateurToken
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return UtilisateurToken
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set UtilisateurApiRepository
     *
     * @param UtilisateurApi $apiUser
     *
     * @return UtilisateurToken
     */
    public function setApiUser($apiUser)
    {
        $this->apiUser = $apiUser;

        return $this;
    }

    /**
     * Get UtilisateurApiRepository
     *
     * @return UtilisateurApi
     */
    public function getApiUser()
    {
        return $this->apiUser;
    }

}

