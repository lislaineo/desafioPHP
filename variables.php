<?php

  //Lista de categorias disponíveis
  $categories = ["bermuda","boné","camiseta","chinelo","moletom","saia","shorts","tênis","top"];

	//Lista de tipos de arquivos permitidos como imagem do produto
	$allowedTypes = array('image/svg', 'image/jpeg', 'image/jpg', 'image/png');
  
  //Tamanho máximo permitido da imagem (em bytes)
  $allowedSize = 1024 * 500; //500Kb

  if($_POST) {
    //Variáveis referentes a cada produto cadastrado (usadas na página index)
    $name = $_POST['productName'];
    $category = $_POST['productCategory'];
    $description = $_POST['productDescription'];
    $amount = $_POST['productAmount'];
    $cost = $_POST['productCost'];

    //Variáveis referentes ao upload da imagem (usadas nas páginas index e edit)
    $fieldname = "productImg";
    $targetDir = "img/";
    $fileName = $_FILES[$fieldname]["name"];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileSize = $_FILES[$fieldname]["size"];
    $fileType = $_FILES[$fieldname]['type'];
    $tempDir = $_FILES[$fieldname]["tmp_name"];
    $uploadOk = 1;
  }
  
?>