<?php

namespace CmbSdk\ClassesMetiers;

/**
 * ComplexeGerant
 *
 */
class ComplexeGerant implements ClasseMetierInterface
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
     * @ORM\ManyToOne(targetEntity="Complexe")
     */
    private $complexe;

    /**
     * @var string
     *
     * @ORM\Column(name="gerant_username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="gerant_password", type="string", length=255)
     */
    private $password;


    function __construct()
    {
        $this->complexe = new Complexe();
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
     * Set complexe
     *
     * @param string $complexe
     *
     * @return ComplexeGerant
     */
    public function setComplexe($complexe)
    {
        $this->complexe = $complexe;

        return $this;
    }

    /**
     * Get complexe
     *
     * @return string
     */
    public function getComplexe()
    {
        return $this->complexe;
    }


    /**
     * Set username
     *
     * @param string $username
     *
     * @return ComplexeGerant
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return ComplexeGerant
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}

