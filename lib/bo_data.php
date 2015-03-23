<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe de Data
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class BO_DATA{
	
	/**
	 * Obter a data actual
	 * 
	 * @param $lingua A língua na qual será obtida a data
	 * @return unknown_type
	 */
	function obter_data($lingua='pt'){

		return BO_DATA::obterdia(date('D')).', '.date('d').' de '.BO_DATA::obtermes(date('m')).' de '.date('Y');
		
	}
	
	/**
	 * Obter um dia da semana por extenso
	 * 
	 * @param $dia O dia da semana (Mon, Tue, Wed, Thu, Fri, Sat, Sun)
	 * @return O dia da semana por extenso em português
	 */
	function obterdia($dia){
		
		switch($dia){
			case 'Mon': return "Segunda-feira";break;
			case 'Tue': return "Terça-feira";break;
			case 'Wed': return "Quarta-feira";break;
			case 'Thu': return "Quinta-feira";break;
			case 'Fri': return "Sexta-feira";break;
			case 'Sat': return "Sábado";break;
			case 'Sun': return "Domingo";break;
		}
		
	}
	
	/**
	 * Obter o mês por extenso
	 * 
	 * @param $mes O mês a obter (numérico)
	 * @return O mês por extenso em português
	 */
	function obtermes($mes){
		switch($mes){
			case 1: return "Janeiro";break;
			case 2: return "Feveiro";break;
			case 3: return "Março";break;
			case 4: return "Abril";break;
			case 5: return "Maio";break;
			case 6: return "Junho";break;
			case 7: return "Julho";break;
			case 8: return "Agosto";break;
			case 9: return "Setembro";break;
			case 10: return "Outubro";break;
			case 11: return "Novembro";break;
			case 12: return "Dezembro";break;
		}
	}
	
}