<?php

namespace Barra\DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reference
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Reference
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="company", type="string", length=30, nullable=false)
     */
    private $company;

    /**
     * @var string
     * @ORM\Column(name="website", type="string", length=30, nullable=false)
     */
    private $website;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", length=30, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     * @ORM\Column(name="started", type="date", nullable=false)
     */
    private $started;

    /**
     * @var \DateTime
     * @ORM\Column(name="finished", type="date", nullable=false)
     */
    private $finished;





    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return Reference
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Reference
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set started
     *
     * @param \DateTime $started
     * @return Reference
     */
    public function setStarted($started)
    {
        $this->started = $started;

        return $this;
    }

    /**
     * Get started
     *
     * @return \DateTime 
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * Set finished
     *
     * @param \DateTime $finished
     * @return Reference
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * Get finished
     *
     * @return \DateTime 
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Reference
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
