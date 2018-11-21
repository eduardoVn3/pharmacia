<?php

namespace PacienteBundle\Controller;

use PacienteBundle\Entity\Analisi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Analisi controller.
 *
 * @Route("analisi")
 */
class AnalisiController extends Controller
{
    /**
     * Lists all analisi entities.
     *
     * @Route("/", name="analisi_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $analisis = $em->getRepository('PacienteBundle:Analisi')->findAll();

        return $this->render('analisi/index.html.twig', array(
            'analisis' => $analisis,
        ));
    }

    /**
     * Creates a new analisi entity.
     *
     * @Route("/new", name="analisi_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $analisi = new Analisi();
        $form = $this->createForm('PacienteBundle\Form\AnalisiType', $analisi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($analisi);
            $em->flush();

            return $this->redirectToRoute('analisi_show', array('id' => $analisi->getId()));
        }

        return $this->render('analisi/new.html.twig', array(
            'analisi' => $analisi,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a analisi entity.
     *
     * @Route("/{id}", name="analisi_show")
     * @Method("GET")
     */
    public function showAction(Analisi $analisi)
    {
        $deleteForm = $this->createDeleteForm($analisi);

        return $this->render('analisi/show.html.twig', array(
            'analisi' => $analisi,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing analisi entity.
     *
     * @Route("/{id}/edit", name="analisi_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Analisi $analisi)
    {
        $deleteForm = $this->createDeleteForm($analisi);
        $editForm = $this->createForm('PacienteBundle\Form\AnalisiType', $analisi);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('analisi_edit', array('id' => $analisi->getId()));
        }

        return $this->render('analisi/edit.html.twig', array(
            'analisi' => $analisi,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a analisi entity.
     *
     * @Route("/{id}", name="analisi_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Analisi $analisi)
    {
        $form = $this->createDeleteForm($analisi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($analisi);
            $em->flush();
        }

        return $this->redirectToRoute('analisi_index');
    }

    /**
     * Creates a form to delete a analisi entity.
     *
     * @param Analisi $analisi The analisi entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Analisi $analisi)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('analisi_delete', array('id' => $analisi->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
