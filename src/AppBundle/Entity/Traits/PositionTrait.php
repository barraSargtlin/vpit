<?php

namespace AppBundle\Entity\Traits;

use Symfony\Component\Validator\Constraints as Assert;

trait PositionTrait
{
    /**
     * @var int
     *
     * @Assert\NotNull()
     * @Assert\GreaterThan(value = 0)
     *
     * @ORM\Column(type = "smallint")
     */
    private $position;

    /**
     * @param int $position
     */
    public function setPosition(int $position)
    {
        $this->position = $position;
    }

    /**
     * @return integer
     */
    public function getPosition(): int
    {
        return $this->position;
    }
}
