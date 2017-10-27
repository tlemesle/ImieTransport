<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 24/10/17
 * Time: 21:17
 */

namespace ImieTransportBundle\Controller;


use ImieTransportBundle\Entity\Produit;
use ImieTransportBundle\Entity\Rayon;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// N'oubliez pas ce use pour l'annotation
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use ImieTransportBundle\Form\ProduitType;
use ImieTransportBundle\Form\RayonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{

    public function homeAction(){

        $app_locale = $this->container->getParameter('app_locale');
        $locale = "fr";
        $_locale= "en";

        if(in_array($locale, $app_locale)){
            $_locale = $locale;
        }

        return $this->redirect($this->generateUrl('imie_transport_homepage', array(
            '_locale' => $_locale
        )));
    }

    public function indexAction(Request $request){


        $em = $this->getDoctrine()->getManager();

        $dql   = "SELECT s FROM ImieTransportBundle:SortieProduit s";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('ImieTransportBundle:Home:index.html.twig', array(
            'pagination' => $pagination
        ));
    }


    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addProductAction(Request $request){

        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class,$produit);
        if($request->isMethod("POST")){
            $form->handleRequest($request);
            if($form->isValid()){
                $em->persist($produit);
                $em->flush();
                $session ->getFlashBag()->add('success','Produit ajouté à la base de données');
                return $this->redirectToRoute('imie_transport_list_produit');
            }
        }
        return $this->render('ImieTransportBundle:Home:action.html.twig',[
            'form' => $form->createView(),
            'titre' => "Ajout d'un produit"
        ]);
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addRayonAction(Request $request){

        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $rayon = new Rayon();
        $form = $this->createForm(RayonType::class,$rayon);
        if($request->isMethod("POST")){
            $form->handleRequest($request);
            if($form->isValid()){
                $em->persist($rayon);
                $em->flush();
                $session ->getFlashBag()->add('success','Rayon ajouté à la base de données');
                return $this->redirectToRoute('imie_transport_list_rayon');
            }
        }
        return $this->render('ImieTransportBundle:Home:action.html.twig',[
            'form' => $form->createView(),
            'titre' => "Ajout d'un rayon"
        ]);
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editProduitAction($id, Request $request){
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('ImieTransportBundle:Produit')->find($id);

        $form = $this->createForm(ProduitType::class,$produit);

        if($request->isMethod("POST")){
            $form->handleRequest($request);
            if($form->isValid()){
                $em->flush();
                $session ->getFlashBag()->add('success','Produit modifié !');
                return $this->redirectToRoute('imie_transport_list_produit');
            }
        }

        return $this->render('ImieTransportBundle:Home:action.html.twig',[
            'form' => $form->createView(),
            'titre' => "Modification d'un produit"
        ]);
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editRayonAction($id, Request $request){
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $rayon = $em->getRepository('ImieTransportBundle:Rayon')->find($id);
        $form = $this->createForm(RayonType::class,$rayon);

        if($request->isMethod("POST")){
            $form->handleRequest($request);
            if($form->isValid()){
                $em->flush();
                $session ->getFlashBag()->add('success','Rayon modifié !');
                return $this->redirectToRoute('imie_transport_list_rayon');
            }
        }
        return $this->render('ImieTransportBundle:Home:action.html.twig',[
            'form' => $form->createView(),
            'titre' => "Modification d'un rayon"
        ]);
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function removeProduitAction($id, Request $request){
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('ImieTransportBundle:Produit')->find($id);
        if($request->isMethod("POST")){
            //$form->handleRequest($request);
            //if($form->isValid()){
                $em->remove($produit);
                $em->flush();
                $session ->getFlashBag()->add('success','Produit supprimé !');
            //}
        }
        return $this->redirectToRoute('imie_transport_list_produit');
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function removeRayonAction($id, Request $request){
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $rayon = $em->getRepository('ImieTransportBundle:Rayon')->find($id);
        if($request->isMethod("POST")){
            //$form->handleRequest($request);
            //if($form->isValid()){
            $em->remove($rayon);
            $em->flush();
            $session ->getFlashBag()->add('success','Rayon supprimé !');
            //}
        }
        return $this->redirectToRoute('imie_transport_list_rayon');
    }

    public function listProduitAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        /*$produits = $em->getRepository("ImieTransportBundle:Produit")->findAll();*/

        $dql1   = "SELECT p FROM ImieTransportBundle:Produit p";
        $query = $em->createQuery($dql1);

        $paginator  = $this->get('knp_paginator');
        $paginationProduit = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('ImieTransportBundle:Home:list.html.twig',[
            "paginationProduit" => $paginationProduit
        ]);
    }

    public function listRayonAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $dql   = "SELECT r FROM ImieTransportBundle:Rayon r";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/

        );

        return $this->render('ImieTransportBundle:Home:listRayon.html.twig',[
            "pagination" => $pagination
        ]);
    }

    public function charteAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder([], array(
           'attr' => array(
               'id' => 'charte_form',
               'request' => $request->getUri(),
           )
        ))
            ->add('check', CheckboxType::class, array(
                'label' => "J'accepte la charte de confidentialité",
                'required' => false,
            ))

            ->add('save',SubmitType::class)
            ->getForm();

        $user = $this->getUser();

        $form->handleRequest($request);

        if($request->isMethod("POST")){
            if($form->get('check')->getData() != 1){
                $form->addError(new FormError("Erreur : Vous devez accepter la charte"));
            }else{
               if($form->isValid()){
                   $user->setAcceptCharte(1);
                   $em->persist($user);
                   $em->flush();
                   return $this->redirectToRoute('imie_transport_homepage1');
               }
            }

        }

        return $this->render('ImieTransportBundle:Default:charte.html.twig',[
            "form" => $form->createView()
        ]);
    }




}