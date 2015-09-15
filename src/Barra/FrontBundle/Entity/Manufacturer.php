<?php

namespace Barra\FrontBundle\Entity;

use Barra\FrontBundle\Entity\Traits\IdAutoTrait;
use Barra\FrontBundle\Entity\Traits\NameTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * Class Manufacturer
 * @author Paul Kujawa <p.kujawa@gmx.net>
 * @package Barra\FrontBundle\Entity

 * @ExclusionPolicy("none")
 * @ORM\Table()
 * @ORM\Entity(repositoryClass = "Barra\FrontBundle\Entity\Repository\ManufacturerRepository")
 */
class Manufacturer
{
    use IdAutoTrait,
        NameTrait
    ;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *      targetEntity = "Product",
     *      mappedBy     = "manufacturer"
     * )
     * @ORM\OrderBy({"name" = "ASC"})
     */
    private $products;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * Add products
     *
     * @param Product $products
     * @return $this
     */
    public function addProduct(Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param Product $product
     * @return $this
     */
    public function removeProduct(Product $product)
    {
        $this->products->removeElement($product);

        return $this;
    }

    /**
     * Get products
     *
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }
}
