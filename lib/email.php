<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe para criação, envio e gestão de emails
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class Email{
	
	var $emailTo = "";
	var $emailFrom = "";
	var $nomeFrom = "";
	var $subject = "";
	var $body = "";
	var $headers = "";
	var $contentType = 'text/html';
	var $replyTo = "";
	
	/**
	 * Construção e envio(caso todos os campos estejam correctamente preenchidos) de um objecto de email
	 * 
	 * @param $emailTo O remetido
	 * @param $emailFrom O remetente 
	 * @param $nomeFrom O nome do remetente 
	 * @param $subject O assunto
	 * @param $body O campo de texto
	 * @param $replyTo Enviar respostas a email para
	 * @param $contentType Tipo de conteúdo (por defeito "text/html")
	 */
	function __construct($emailTo='', $emailFrom='', $nomeFrom='', $subject='', $body='', $replyTo='', $contentType='text/html'){
		$this->emailTo = $emailTo;
		$this->emailFrom = $emailFrom;
		$this->nomeFrom = $nomeFrom;
		$this->subject = $subject;
		$this->body = $body;
		$this->contentType = $contentType;
		$this->replyTo = $replyTo;

		if($this->emailTo!="" && $this->emailFrom!="" && $this->subject!="" && $this->body!=""){
			$this->definirHeaders();
			$this->enviarMail();			
		}
	}
	
	/**
	 * Definir os cabeçalhos de envio do email
	 * 
	 */
	function definirHeaders(){
		$this->headers .= "From: $this->nomeFrom <$this->emailFrom>\r\n";
		if($this->replyTo!="")
			$this->headers .= "Reply-To: $this->replyTo\n";
		$this->headers .= "Content-Type: $this->contentType;";	
	}
	
	/**
	 * Enviar o email
	 * 
	 * @return mensagem de JSON indicando p suceso ou falha do envio 
	 */
	function enviarMail(){
		$this->definirHeaders();
		if($this->emailTo!="" && $this->emailFrom!="" && $this->subject!="" && $this->body!="" && $this->headers!=""){
			$mail = mail($this->emailTo, $this->subject, $this->body, $this->headers);
			if(isset($mail)){
				$json = '{"message" : "success", "value" : "0"}';
			}else{
				$json = '{"message" : "Falha no envio do email.", "value" : "-2"}';
			}
		}else{
			$json = '{"message" : "Headers de email não estão definidos", "value" : "-1"}';
		}
		return $json;
	}
	
	function mail_attachment ($from , $to, $subject, $message, $attachment){
		$fileatt = $attachment; // Path to the file                  
		$fileatt_type = "application/octet-stream"; // File Type 
		$start=	strrpos($attachment, '/') == -1 ? strrpos($attachment, '//') : strrpos($attachment, '/')+1;
		$fileatt_name = substr($attachment, $start, strlen($attachment)); // Filename that will be used for the file as the attachment 

		$email_from = $from; // Who the email is from
		$subject = "New Attachment Message";
		$email_subject =  $subject; // The Subject of the email 
		$email_txt = $message; // Message that the email has in it 
		
		$email_to = $to; // Who the email is to

		$headers = "From: ".$email_from;

		$file = fopen($fileatt,'rb'); 
		$data = fread($file,filesize($fileatt)); 
		fclose($file); 
		$msg_txt="\n\n You have recieved a new attachment message from $from";
		$semi_rand = md5(time()); 
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
		$headers .= "\nMIME-Version: 1.0\n" . 
				"Content-Type: multipart/mixed;\n" . 
				" boundary=\"{$mime_boundary}\""; 
		$email_txt .= $msg_txt;
		$email_message .= "This is a multi-part message in MIME format.\n\n" . 
					"--{$mime_boundary}\n" . 
					"Content-Type:text/html; charset=\"iso-8859-1\"\n" . 
				   "Content-Transfer-Encoding: 7bit\n\n" . 
		$email_txt . "\n\n"; 
		$data = chunk_split(base64_encode($data)); 
		$email_message .= "--{$mime_boundary}\n" . 
					  "Content-Type: {$fileatt_type};\n" . 
					  " name=\"{$fileatt_name}\"\n" . 
					  //"Content-Disposition: attachment;\n" . 
					  //" filename=\"{$fileatt_name}\"\n" . 
					  "Content-Transfer-Encoding: base64\n\n" .
					 $data . "\n\n" . 
					  "--{$mime_boundary}--\n";

		$ok = mail($email_to, $email_subject, $email_message, $headers);

		if($ok)
		{
		echo "File Sent Successfully.";
		unlink($attachment); // delete a file after attachment sent.
		}
		else
		{
			die("Sorry but the email could not be sent. Please go back and try again!"); 
		}
	}
}