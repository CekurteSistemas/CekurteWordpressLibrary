<?php

namespace Cekurte\Library;

/**
 * TwitterBootstrap
 *
 * Classe básica para utilização do Twitter_Bootstrap
 *
 * @author     João Paulo Cercal
 * @version    1.0
 */
abstract class Form extends \Cekurte\Library\Form\TwitterBootstrap
{
    const DISPOSITION_HORIZONTAL    = 'horizontal';
    const DISPOSITION_SEARCH        = 'search navbar-form';
    
    public function init()
    {
        $this->beforeSetup();
        
        $this->setup();
        
        $this->afterSetup();
    }
    
    public function beforeSetup()
    {
        $this->setDisposition( self::DISPOSITION_HORIZONTAL );
        
    	// Configura a ação do formulário
    	$this->setAction('');
        
    	// Configura o id do formulário
        $this->setName( $this->getName() );
        
        // Configura o método de envio do formulário
        $this->setMethod( self::METHOD_POST );
    }
    
    public function afterSetup()
    {
        
    }
    
    public function setDisposition( $disposition )
    {
    	if ($disposition === self::DISPOSITION_SEARCH) {
    		
    		$this->removeDisplayGroup('zfBootstrapFormActions');
    		 
    		$this->setElementDecorators(array(
    			'ViewHelper',
    		));
    	}
    	
    	if (($disposition === self::DISPOSITION_SEARCH) or ($disposition === self::DISPOSITION_HORIZONTAL)) {
    		$this->setAttrib( 'class', 'form-' . $disposition );
    	}
    }
    
    public function getName()
    {
        $name = parent::getName();
        
        return empty($name) ? strtolower(get_class($this)) : parent::getName();
    }
   
    public function addFieldSubmit()
    {
        $this->addElement('submit', 'submit', array(
            'label'		=> __('Salvar', 'cekurte'),
			'id'        => $this->getName() . '_submit'
        ));
        
        return $this;
    }
    
    public function getFieldSubmit()
    {
        $element = $this->getElement('submit');
        
        if( empty($element) )
        {
            $this->addFieldSubmit();
            
            $element = $this->getElement('submit');
        }
        
        return $element;
    }
    
    public function removeFieldSubmit()
    {
        $this->removeElement('submit');
        
        return $this;
    }
    
    public function addFieldReset($label = 'Submit')
    {
        $this->addElement('reset', 'reset', array(
            'label'		=> __('Limpar', 'cekurte'),
			'id'        => $this->getName() . '_reset'
        ));
        
        return $this;
    }
    
    public function getFieldReset()
    {
        $element = $this->getElement('reset');
        
        if( empty($element) )
        {
            $this->addFieldReset();
            
            $element = $this->getElement('reset');
        }
        
        return $element;
    }
    
    public function removeFieldReset()
    {
        $this->removeElement('reset');
        
        return $this;
    }
} 