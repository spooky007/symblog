<?php

namespace FutureTech\SymblogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RegisterController extends Controller
{
    /**
     * @Route("/register")
     */
    public function registerAction()
    {
        return $this->render('FutureTechSymblogBundle:Register:register.html.twig', array(
            // ...
        ));
    }

}
