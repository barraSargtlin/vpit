<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_root_i18n")
     * @Route("/recipes/{page}", name="app_recipes", defaults={"page" = 1}, requirements={"page" = "\d+"})
     * @Route("/recipes/{id}/{name}", name="app_recipe", requirements={"id" = "\d+"})
     */
    public function indexAction(): Response
    {
        return $this->render('::base.html.twig');
    }

    /**
     * @Route("/products/{page}", name="app_products", defaults={"page" = 1}, requirements={"page" = "\d+"})
     * @Route("/products/{id}/{name}", name="app_product", requirements={"id" = "\d+"})
     * @Route("/products/new", name="app_product_new")
     */
    public function adminAction(): Response
    {
        // authentication is handled in angular
        return $this->render('::base.html.twig');
    }
}
