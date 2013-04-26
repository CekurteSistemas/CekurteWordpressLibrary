<?php

namespace Cekurte\Library\Html\Element;

use \Cekurte\Library\Html\Element;
use \Cekurte\Library\Html\Message;

/**
 * Cria uma tabela
 * 
 * @package Cekurte
 * @author Cekurte Sistemas
 * @version 1.0
 * @link http://sistemas.cekurte.com/portfolio/wp/cekurte-library
 */

class Table extends Element {

	/**
	 * @var array coluna das tabelas
	 */
	private $columns;
	
	/**
	 * @var array dados da tabela
	 */
	private $data;
	
	/**
	 * @var array template
	 */
	private $template;

	/**
	 * Cria uma tabela
	 * 
	 * @param array $columns
	 * @param array $data
	 */
	public function __construct($columns = array(), $data = array()) {
		$this
			->setColumns($columns)
			->setData($data)
		;
		
		$this->setTemplate(array(
			'thead_open'		=> '<thead>',
			'thead_close'		=> '</thead>',
		
			'heading_row_start'	=> '<tr>',
			'heading_row_end'	=> '</tr>',
			'heading_cell_start'=> '<th>',
			'heading_cell_end'	=> '</th>',
		
			'tbody_open'		=> '<tbody>',
			'tbody_close'		=> '</tbody>',
		
			'row_start'			=> '<tr>',
			'row_end'			=> '</tr>',
			'cell_start'		=> '<td>',
			'cell_end'			=> '</td>',
		));
		
		parent::__construct('table');
	}
	
	/**
	 * Configura o template
	 * 
	 * @param array|string $template a chave (índice) que será configurado ou um array com todo o template.
	 * 
	 * @param null|string $value Default NULL, se informado irá configurar apenas a $key informada em $template
	 * 
	 * @return \Cekurte\Library\Html\Element\Table
	 */
	public function setTemplate($templateOrKey, $value = null) {
		if( !empty($value) and is_string($templateOrKey)) {
			$this->template[$templateOrKey] = $value;
		} elseif( is_array($templateOrKey) ) {
			$this->template = $templateOrKey;
		}
		return $this;
	}
	
	/**
	 * Recupera o template
	 * 
	 * @param boolean|string $key Se true, recupera o template inteiro, do contrário recupera apenas o índice $key do template
	 * 
	 * @return array|string
	 */
	public function getTemplate($key = null) {
		return empty($key) ? $this->template : $this->template[$key];
	}
	
	/**
	 * Configura as colunas da tabela
	 *
	 * @param array $columns
	 *
	 * @return \Cekurte\Library\Html\Element\Table
	 */
	public function setColumns(array $columns) {
		$this->columns = $columns;
		return $this;
	}
	
	/**
	 * Recupera as colunas da tabela
	 *
	 * @return array as colunas da tabela
	 */
	public function getColumns() {
		return $this->columns;
	}

	/**
	 * Configura os dados da tabela
	 * 
	 * @param array $data
	 * 
	 * @return \Cekurte\Library\Html\Element\Table
	 */
	public function setData(array $data) {
		$this->data = $data;
		return $this;
	}

	/**
	 * Recupera os dados da tabela
	 * 
	 * @return array os dados da tabela
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * Recupera o elemento base da tabela
	 * 
	 * @return \Cekurte\Library\Html\Element
	 */
	public function getElement() {
		return $this->element;
	}

	/**
	 * Verifica se as colunas foram configuradas
	 * 
	 * @return boolean
	 */
	public function columnsIsEmpty() {
		return $this->getColumns() == null;
	}
	
	/**
	 * Verifica se existem dados
	 *
	 * @return boolean
	 */
	public function dataIsEmpty() {
		return $this->getData() == null;
	}
	
	/**
	 * Gera o cabeçalho da tabela
	 *
	 * @return \Cekurte\Library\Html\Element
	 */
	private function generateTableHead() {
		
		$template = $this->getTemplate();
		
		$html = $template['thead_open'];
		
		$html .= $template['heading_row_start'];
		
		foreach( $this->getColumns() as $name => $value ) {
			
			$html .= $template['heading_cell_start'] . $value . $template['heading_cell_end'];
		}
		
		$html .= $template['heading_row_end'];
		
		$html .= $template['thead_close'];
		
		return $html;
	}
	
	/**
	 * Gera o corpo da tabela
	 *
	 * @return \Cekurte\Library\Html\Element
	 */
	private function generateTableBody() {
		
		$template 	= $this->getTemplate();
		
		$html 		= $template['tbody_open'];
		$total 		= count($this->getData());
		$data 		= $this->getData();
		$columns 	= array();
	
		foreach( $data as $name => $value ) {
			$columns[] = $name;
		}
		
		for( $i = 0; $i <= $total; $i++ ) {
			
			$html .= $template['row_start'];
			
			foreach( $columns as $column ) {
				$html .= $template['cell_start'] . $data[$column][$i] . $template['cell_end'];
			}
			
			$html .= $template['row_end'];
		}
		
		$html .= $template['tbody_close'];
		
		return $html;
	}

	/**
	 * Mostra a tabela
	 * 
	 * @return \Cekurte\Library\Html\Element\Table|string
	 */
	protected function output() {
		
		if( $this->columnsIsEmpty() or $this->dataIsEmpty() ) {
			return Message::generate('Não há dados para exibir', Message::ERROR);
		}
		
		$this->clearContent();
		
		$this
			->append($this->generateTableHead())
			->append($this->generateTableBody())
		;
		
		return parent::output();
	}
}