<?php

namespace Cekurte\Library;

use Cekurte\Library\Html\Element;

/**
 * Custom
 *
 * Classe básica para registrar e exibir de forma apropriada os dados, utiliza as funções nativas var_dump() e print_r()
 *
 * @author     João Paulo Cercal
 * @version    1.0
 */
abstract class Debug {
	
	/**
	 * Método executado antes da saída de caracteres
	 */
	private static function beforeOutput() {
		echo '<pre>';
	}
	
	/**
	 * Método executado após da saída de caracteres
	 */
	private static function afterOutput() {
		echo '</pre>';
	}
	
	/**
	 * Faz um dump dos dados utilizando a função nativa var_dump()
	 *
	 * @param mixed $data
	 * @param bool $type
	 *
	 * @return \Cekurte\Library\Debug
	 */
	public static function dump($data, $type = true) {
		
		self::beforeOutput();
    	
    	if ($type === true) {
    		var_dump($data);
    	} else {
    		print_r($data);
    	}
    	
    	self::afterOutput();
    	
    	return $this;
    }
} 