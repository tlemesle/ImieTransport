<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 25/10/17
 * Time: 11:24
 */

namespace ImieTransportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ImieTransportBundle\Form\SortieProduitType;
use Symfony\Component\HttpFoundation\Request;
use ImieTransportBundle\Entity\SortieProduit;

class SortieController extends Controller
{
    public function newSortieAction(Request $request){
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $sortie = new SortieProduit();
        $form = $this->createForm(SortieProduitType::class,$sortie);
        if($request->isMethod("POST")) {
            $form->handleRequest($request);
            if($form->isValid()){
                $produit = $sortie->getProduit();
                $stock = $produit->getStock();
                if($sortie->getQuantite() < $stock){
                    $em->persist($sortie);
                    $em->flush();
                    $update = $this->updateStock($sortie->getQuantite(),$produit,$stock);
                    $session ->getFlashBag()->add('success', "Form validé");
                    return $this->redirectToRoute('imie_transport_new_sortie');
                }else{
                    $session ->getFlashBag()->add('error', "Erreur, La quantité est supérieure au stock disponible");
                    return $this->redirectToRoute('imie_transport_new_sortie');
                }
            }
        }
            return $this->render('ImieTransportBundle:Home:action.html.twig',[
            'form' => $form->createView(),
            'titre' => "Sortie d'un produit"
            ]);
    }


    public function updateStock($qte,$produit,$stock){
        $em = $this->getDoctrine()->getManager();
        $newStock = $stock-$qte;
        $produit->setStock($newStock);
        $em->flush();
        if($produit->getAlertMail() && $newStock < $produit->getLimiteStock()){
            $message = \Swift_Message::newInstance()
                ->setSubject('Alerte Stock')
                ->setFrom('imietransport@imie.com')
                ->setTo('tlemesle@gmail.com')
                ->setContentType("text/html")
                ->setBody(
                    $this->renderView(
                        'ImieTransportBundle:Email:email.html.twig',
                        array('produit' => $produit)
                    )
                )
            ;
            $this->get('mailer')->send($message);
        }

    }
}