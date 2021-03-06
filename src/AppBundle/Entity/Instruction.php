<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\IdAutoTrait;
use AppBundle\Entity\Traits\TimestampTrait;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueEntity({
 *      "recipe",
 *      "position"
 * })
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass = "AppBundle\Entity\Repository\InstructionRepository")
 */
class Instruction
{
    use IdAutoTrait;
    use TimestampTrait;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min = 5)
     *
     * @ORM\Column(type = "text")
     */
    public $description;

    /**
     * @var int
     *
     * @Assert\NotNull()
     * @Assert\GreaterThan(value = 0)
     *
     * @ORM\Column(type = "smallint")
     */
    public $position;

    /**
     * @var Recipe
     *
     * @Assert\NotNull()
     *
     * @Serializer\Exclude()
     *
     * @ORM\ManyToOne(
     *      targetEntity = "Recipe",
     *      inversedBy = "instructions"
     * )
     * @ORM\JoinColumn(
     *      name = "recipe",
     *      referencedColumnName = "id",
     *      nullable = false,
     *      onDelete = "CASCADE"
     * )
     * @ORM\OrderBy({"name" = "ASC"})
     */
    public $recipe;

    public function __construct(int $recipeId, int $position)
    {
        $this->recipe = $recipeId;
        $this->position = $position;
    }
}
