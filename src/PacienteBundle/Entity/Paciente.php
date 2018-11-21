<?php

namespace PacienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Paciente
 *
 * @ORM\Table(name="paciente")
 * @ORM\Entity(repositoryClass="PacienteBundle\Repository\PacienteRepository")
 */
class Paciente implements \jsonSerializable
{
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
     * @ORM\Column(name="name", type="string", length=255)
     *@Assert\NotBlank
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     *@Assert\NotBlank
     */
    private $lastName;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     *@Assert\NotBlank
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="idNumber", type="string", length=255)
     *@Assert\NotBlank
     */
    private $idNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="idType", type="string", length=255)
     *@Assert\NotBlank
     */
    private $idType;

    /**
     * @var string
     *
     * @ORM\Column(name="observation", type="string", length=255)
     *@Assert\NotBlank
     */
    private $observation;

    /**
    *@ORM\ManyToMany(targetEntity="Analisi",inversedBy="paciente")
    *@ORM\JoinTable(name="paciente_analisis")
    */
    private $analisi = null;

    public function __construct()
    {
        $this->analisi = new ArrayCollection();
    }

    public function getAnalisi($value='')
    {
        return $this->analisi;
    }

    public function jsonSerialize()
    {
        return [
            'id'=>$this->getId(),
            'name'=>$this->getName(),
            'lastBame'=>$this->getLastName(),
            'age'=>$this->getAge(),
            'idNumber'=>$this->getIdNumber(),
            'idType'=>$this->getIdType(),
            'observation'=>$this->getObservation()
        ];
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
     * Set name
     *
     * @param string $name
     *
     * @return Paciente
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Paciente
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Paciente
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set idNumber
     *
     * @param string $idNumber
     *
     * @return Paciente
     */
    public function setIdNumber($idNumber)
    {
        $this->idNumber = $idNumber;

        return $this;
    }

    /**
     * Get idNumber
     *
     * @return string
     */
    public function getIdNumber()
    {
        return $this->idNumber;
    }

    /**
     * Set idType
     *
     * @param string $idType
     *
     * @return Paciente
     */
    public function setIdType($idType)
    {
        $this->idType = $idType;

        return $this;
    }

    /**
     * Get idType
     *
     * @return string
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Set observation
     *
     * @param string $observation
     *
     * @return Paciente
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return string
     */
    public function getObservation()
    {
        return $this->observation;
    }

    public function __toString()
    {
        $name = sprintf('%s %s',$this->name,$this->lastName);
        return $name;
    }
}

