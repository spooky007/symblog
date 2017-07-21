<?php

namespace FutureTech\SymblogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FutureTech\SymblogBundle\Entity\Enquiry;
use FutureTech\SymblogBundle\Form\EnquiryType;

class PageController extends Controller
{
	/**
	 *	Handles request to index page
	 */
    public function indexAction()
    {
        return $this->render('FutureTechSymblogBundle:Page:index.html.twig');
    }

	/**
	 *	Handles request to about page$loader->registerNamespaceFallbacks
	 */
    public function aboutAction()
    {
        return $this->render('FutureTechSymblogBundle:Page:about.html.twig');
    }

	/**
	 *	Handles request to contact page
	 */
    public function contactAction()
	{
	    $enquiry = new Enquiry();
	    $form = $this->createForm(new EnquiryType(), $enquiry);

	    $request = $this->getRequest();
	    if ($request->getMethod() == 'POST') {
	        $form->handleRequest($request);

	        if ($form->isValid()) {
	            // Perform some action, such as sending an email
                $message = \Swift_Message::newInstance()
                          ->setSubject('Contact enquiry from symblog')
                          ->setFrom('enquiries@symblog.co.uk')
                          ->setTo($this->container->getParameter('futuretech_symblog.emails.contact_email'))
                          ->setBody($this->renderView('FutureTechSymblogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->add('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');

                 // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('FutureTechSymblogBundle_contact'));
	        }
	    }

	    return $this->render('FutureTechSymblogBundle:Page:contact.html.twig', array(
	        'form' => $form->createView()
	    ));
	}
}