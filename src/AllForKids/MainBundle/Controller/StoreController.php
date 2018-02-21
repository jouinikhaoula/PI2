<?php

namespace AllForKids\MainBundle\Controller;

use AllForKids\MainBundle\Entity\LigneCommandes;
use AllForKids\MainBundle\Entity\Produits;
use AllForKids\MainBundle\Entity\User;
use AllForKids\MainBundle\Form\ProduitsType;
use AllForKids\MainBundle\Form\RechercherType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StoreController extends Controller
{
    public function AjoutAction(Request $request)
    {
        $p = new Produits();
        $form = $this->createForm(ProduitsType::class, $p);
        $form->handleRequest($request);/*creation d'une session pr stocker les valeurs de l'input*/
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $p->getImage();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $this->getParameter('Produitsdirectory'),
                $filename
            );
            $p->setImage($filename);
            $em = $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush();
            return $this->redirectToRoute('Listes',array());
        }
        return $this->render('@AllForKidsMain/Admin/AjoutProd.html.twig', array(
            'form' => $form->createView()
        ));
    }

   public function ListeAction()
    {
      $em = $this->getDoctrine()->getManager();
       $prod = $em->getRepository("AllForKidsMainBundle:Produits")->findAll();
        return $this->render('@AllForKidsMain/Store/Liste.hmtl.twig', array(
           'p'=>$prod
      ));

   }
    public function ListeAAction()
    {
        $em = $this->getDoctrine()->getManager();
        $prod = $em->getRepository("AllForKidsMainBundle:Produits")->findAll();
        return $this->render('@AllForKidsMain/Admin/ListeProduits.html.twig',array(
            'p'=>$prod
        ));

    }
    public function AfficheDetailsAction($id)

    {
        $em = $this->getDoctrine()->getManager();
        $prod = $em->getRepository("AllForKidsMainBundle:Produits")->find($id);
        return $this->render('@AllForKidsMain/Store/details.html.twig',array(
            'p'=>$prod
        ));

    }
    function updateAction(Request $request,$id){
        $em=$this->getDoctrine()->getManager();
        $p=$em->getRepository("AllForKidsMainBundle:Produits")->find($id);
        $form=$this->createForm(ProduitsType::class,$p);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $file = $p->getImage();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $this->getParameter('Produitsdirectory'),
                $filename
            );
            $p->setImage($filename);
            $em->persist($p);
            $em->flush();
        }
        return $this->render('@AllForKidsMain/Admin/Update.html.twig',array(
                'form'=>$form->createView())
        );
    }
    function RechercheAction(Request $request)
    {
        $p= new Produits();
        $form = $this->createForm(RechercherType::class,$p);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if( $form->isSubmitted()) {
            $cat=$p->getCategorie();
            $prod = $em->getRepository("AllForKidsMainBundle:Produits")->DQL($cat);
        }else{
            $prod=$em->getRepository("AllForKidsMainBundle:Produits")->findAll();
        }
        return $this->render('@AllForKidsMain/Admin/Recherche.html.twig',array(
            'form' => $form->createView(), 'p'=>$prod ,
        ));
    }

 /*   public function AjoutPanierAction($id)
    {
    $l=new LigneCommandes();
    $em = $this->getDoctrine()->getManager();
    $prod = $em->getRepository("AllForKidsMainBundle:Produits")->findBy(array($id));
    $l->setFkProduits($prod);
        $user = $this->get('security.token_storage')
            ->getToken()
            ->getUser();
        $l->setFkParent($user);
        $l->setNbrArticles(2);
        $l->setPrixTotal(12);

    $em->persist($l);
    $em->flush();




    }*/
    public function AjoutAuPanierAction ($id)
    {
        $session= $this->get('session');

        if (!$session->has('panier')) $session->set('panier',array());
        $panier=$session->get('panier');
        if(array_key_exists($id,$panier)){

            $panier[$id]=$panier[$id]+1;
        }else $panier[$id]=1;

        $session->set('panier',$panier);

        $em=$this->getDoctrine()->getManager();
        $prod=$em->getRepository("AllForKidsMainBundle:Produits")->findAll();
        if (!$session->has('panier')) $session->set('panier',array());


        return $this->render('@AllForKidsMain/Store/Liste.hmtl.twig',array('p'=>$prod));
    }
    public function PanierAction()
    {

        $session= $this->get('session');
        if (!$session->has('panier')) $session->set('panier',array());

        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository('AllForKidsMainBundle:Produits')->findArray(array_keys($session->get('panier')));

        return $this->render('@AllForKidsMain/Store/details.html.twig',array('produits'=>$produits,
            'panier'=>$session->get('panier')));
    }
    public function SupprimerDuPanierAction($id){
        $session= $this->get('session');
        $panier=$session->get('panier');
        if(array_key_exists($id,$panier)) {
            unset($panier[$id]);
            $session->set('panier',$panier);

        }
        return $this->redirectToRoute('Details',array());
        }
    public function ajouterLigneAction()
    {
        $session= $this->get('session');
        $panier=$session->get('panier');
        if($panier!=NULL) {
            $em = $this->getDoctrine()->getManager();
            $produits = $em->getRepository("AllForKidsMainBundle:Produits")->findArray(array_keys($session->get('panier')));
            $user = $this->getUser();
            $uid=$user->getId();
            foreach ($produits as $p) {
                $l = new LigneCommandes();
                
                $em->persist($l);
                $em->flush();
            }
        }
        }





}
