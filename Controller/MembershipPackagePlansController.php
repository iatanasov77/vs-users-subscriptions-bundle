<?php namespace IA\UsersSubscriptionsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Spatie\Url\Url as SpatieUrl;

use VS\UsersBundle\Entity\Package;
use VS\UsersBundle\Form\PackageFormType;
use App\Component\Url;

class MembershipPackagePlansController extends ResourceController
{
    
    public function createAction( Request $request ): Response
    {
        $tplVars    = $this->processRequest( $request );
        return $this->render('IAUsersBundle:PackagePlans:create.html.twig', $tplVars);
    }
    
    public function updateAction( Request $request ) : Response
    {
        $tplVars    = $this->processRequest( $request );
        return $this->render( 'IAUsersBundle:PackagePlans:update.html.twig', $tplVars );
    }
    
    protected function processRequest( Request $request )
    {
        //$id = Url::ProjectsUrlGetId();
        $id = $this->getId();
        
        $er = $this->getDoctrine()->getRepository( 'VS\UsersBundle\Entity\PackagePlan' );
        $oPackage = $id ? $er->find($id) : new Package();
        
        $form = $this->createForm(PackageFormType::class, $oPackage, ['data' => $oPackage]);
        
        //if($form->isSubmitted()) {
        if($request->isMethod('POST') || $request->isMethod('PUT')) {
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            
            return $this->redirect($this->generateUrl('ia_paid_membership_packageplans_index'));
        }
        
        $tplVars = array(
            'form'          => $form->createView(),
            'item'          => $oPackage,
        );
        return $tplVars;
    }
    
    protected function getId()
    {
        $url = SpatieUrl::fromString( $_SERVER['REQUEST_URI'] );
        return intval( $url->getSegment( 3 ) );
    }
}

