<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
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
     * @Route("/dashboard", name="app_dashboard")
     */
    public function adminAction(): Response
    {
        // authentication is handled in angular
        return $this->render('::base.html.twig');
    }
}
