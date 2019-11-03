<?php

//Função para salvar o produto (chamada na página index)
function saveProduct ($name,$category,$cost,$description,$amount,$targetFile) {	
	$_SESSION['array'][] = ["name"=>$name, "category"=>$category,"cost"=>$cost,"description"=>$description,"amount"=>$amount,"image"=>$targetFile];

	//Se a session não foi setada, declarar como um array vazio
	if (!isset($_SESSION['array'])) {
		$_SESSION['array'] = [];
	}
	
	//Se após todas as validações, ainda assim der algum erro
	if (!$_SESSION['array']) {
		return "Não foi possível cadastrar o produto corretamente.";
	} 
}

?>