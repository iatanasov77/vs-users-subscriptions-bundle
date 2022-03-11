<?php namespace Vankosoft\UsersSubscriptionsBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Vankosoft\ApplicationBundle\Model\Interfaces\TaxonInterface;

use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceCategoryInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceInterface;

class PayedServiceCategory implements PayedServiceCategoryInterface
{
    /** @var mixed */
    protected $id;
    
    /** @var TaxonInterface */
    protected $taxon;
    
    /** @var Collection|Page[] */
    protected $services;
    
    public function __construct()
    {
        $this->services = new ArrayCollection();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getTaxon(): ?TaxonInterface
    {
        return $this->taxon;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setTaxon(?TaxonInterface $taxon): void
    {
        $this->taxon = $taxon;
    }
    
    /**
     * @return Collection|PayedServiceInterface[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }
    
    public function addService( PayedServiceInterface $service ): PayedServiceCategoryInterface
    {
        if ( ! $this->services->contains( $service ) ) {
            $this->services[] = $service;
            $service->addCategory( $this );
        }
        
        return $this;
    }
    
    public function removeService( PayedServiceInterface $service ): PayedServiceCategoryInterface
    {
        if ( $this->services->contains( $service ) ) {
            $this->services->removeElement( $service );
            $service->removeCategory( $this );
        }
        
        return $this;
    }
    
    public function getName()
    {
        return $this->taxon ? $this->taxon->getName() : '';
    }
    
    public function setName( string $name ) : self
    {
        if ( ! $this->taxon ) {
            // Create new taxon into the controller and set the properties passed from form
            return $this;
        }
        $this->taxon->setName( $name );
        
        return $this;
    }
    
    public function __toString()
    {
        return $this->taxon ? $this->taxon->getName() : '';
    }
}
