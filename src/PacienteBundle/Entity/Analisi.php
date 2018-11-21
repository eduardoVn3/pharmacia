<?php

namespace PacienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Analisi
 *
 * @ORM\Table(name="analisi")
 * @ORM\Entity(repositoryClass="PacienteBundle\Repository\AnalisiRepository")
 */
class Analisi
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
    *@ORM\ManyToMany(targetEntity="Paciente",mappedBy="analisi")
    *@ORM\JoinTable(name="paciente_analisis")
    */
    private $paciente = null;

    public function __construct()
    {
        $this->paciente = new ArrayCollection();
    }

    public function getPaciente($value='')
    {
        return $this->paciente;
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
     * @return Analisi
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
    public function __toString()
    {
        return $this->name;
    }
}

