<?php

namespace Barra\BackBundle\Controller;

use Barra\BackBundle\Form\Type\MeasurementType;
use Barra\FrontBundle\Entity\Measurement;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MeasurementController
 * @author Paul Kujawa <p.kujawa@gmx.net>
 * @package Barra\BackBundle\Controller
 */
class MeasurementController extends BasicController
{
    /**
     * @param int $pageIndex
     * @return Response
     */
    public function indexAction($pageIndex)
    {
        $pages = $this->getPaginationPages('Reference', 10);
        $form  = $this->createForm(new MeasurementType(), new Measurement());

        return $this->render('BarraBackBundle:Reference:references.html.twig', [
            'pageIndex' => $pageIndex,
            'pages'     => $pages,
            'form'      => $form->createView(),
        ]);
    }
}
