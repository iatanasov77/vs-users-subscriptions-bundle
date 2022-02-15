<?php namespace Vankosoft\UsersSubscriptionsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckoutController extends AbstractController
{
    public function selectMethodAction($planId, Request $request)
    {
        $paymentMethods = $this->container->getParameter('ia_payment.methods');
        
        $tplVars = array('paymentMethods' => $paymentMethods, 'planId' => $planId);
        return $this->render('IAUsersBundle:Payment:select-method.html.twig', $tplVars);
    }

}


