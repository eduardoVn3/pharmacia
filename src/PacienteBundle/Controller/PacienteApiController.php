<?php

namespace PacienteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use PacienteBundle\Entity\Paciente;

class PacienteApiController extends Controller
{
	/**
     * @Route("/paciente/api/add")
     *@Method("POST")
     */
    public function indexAction(Request $req)
    {
    	$paciente = new Paciente ();
        $form = $this->createForm(
            'PacienteBundle\Form\PacienteApiType',
            $paciente
        );

        $form->bind($req);
        $valid = $form->isValid();
        $response = new Response();
        if(false === $valid){
            $response->setStatusCode(400);
            $response->setContent(json_encode($this->getFormErrors($form)));
            return $response;
        }
        if (true === $valid) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paciente);
            $em->flush();
            $response->setContent(json_encode($paciente));
        }
        return $response;
    }

    public function getFormErrors($form){
        $errors = [];
        if (0 === $form->count()){
            return $errors;
        }
        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = (string) $form[$child->getName()]->getErrors();
            }
        }
        return $errors;
    }

    public function jsonRender($data)
    {
        $response = new Response();
            $response->headers->add([
                    'Content-Type'=>'application/json'
            ]);
            $response->setContent(json_encode(['response'=>$data]));
            return $response;
    }
}
