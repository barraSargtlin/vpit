<?php

namespace Barra\BackBundle\Entity\Traits;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class NameTrait
 * @author Paul Kujawa <p.kujawa@gmx.net>
 * @package Barra\BackBundle\Entity\Traits
 */
trait NameTrait
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(
     *      name   = "name",
     *      type   = "string",
     *      length = 40,
     *      unique = true
     * )
     */
    private $name;

    /**
     * @param string $name
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setName($name)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException(sprintf(
                '"%s" needs to be of type "%s',
                'name',
                'string'
            ));
        }
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
