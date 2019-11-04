<?php
	session_start();
	include('config/variables.php');
	
	//Início das validações de cadastro
	if ($_POST) {	
		//Variáveis referentes à edição de cada produto cadastrado	
    $_SESSION['array']["$_GET[product]"]['name'] = $_POST['productName'];
		$_SESSION['array']["$_GET[product]"]['category'] = $_POST['productCategory'];
		$_SESSION['array']["$_GET[product]"]['description'] = $_POST['productDescription'];
		$_SESSION['array']["$_GET[product]"]['amount'] = $_POST['productAmount'];
		$_SESSION['array']["$_GET[product]"]['cost'] = $_POST['productCost'];

		//Valida se o valor inserido como quantidade e valor foi um número inteiro positivo
		if ($_SESSION['array']["$_GET[product]"]['amount'] < 0 || $_SESSION['array']["$_GET[product]"]['cost'] < 0) {
			echo "O número não pode ser negativo.<br>";
			$uploadOk = 0;
		}

		//Valida se a imagem foi selecionada
		if (isset($fileName)) {
			if (!empty($fileName)) {
				//Renomeia a imagem: data do envio_nome do arquivo
				$newFileName = date("d-M-Y_").$fileName.'.'.$fileExtension;
				$_SESSION['array']["$_GET[product]"]['image'] = $targetDir.$newFileName;

				//Verifica se já existe uma imagem com o mesmo nome
				if (file_exists($_SESSION['array']["$_GET[product]"]['image'])) {
					echo "Já existe um arquivo com esse nome. Por favor, use outro nome.<br>";
					$uploadOk = 0;

				//Verifica o formato do arquivo e compara com uma lista de extensões pré-definidas
				} elseif (array_search($fileType, $allowedTypes) === false) {
					echo "O tipo de arquivo enviado é inválido, somente imagens são aceitas.<br>";
					$uploadOk = 0;

				//Verifica o tamanho do arquivo e compara com o máximo pré-estabelecido
				} elseif ($fileSize > $allowedSize) {
					echo "O tamanho do arquivo enviado é maior que o limite. Por favor, diminua o tamanho da imagem.<br>";
					$uploadOk = 0;

				//Última verificação para checar se algum erro deixou $uploadOk igual a 0
				} elseif ($uploadOk == 0) {
					echo "Não foi possível cadastrar o produto.<br>";
				
				//Se tudo estiver ok, salva a imagem
				} else {
					if (move_uploaded_file($tempDir, $_SESSION['array']["$_GET[product]"]['image'])) {
						echo "Produto atualizado com sucesso!";
					} else  {
						echo "Você deve selecionar uma imagem para salvar.";
					}
				}
			}
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edição do Produto: <?php echo $_SESSION['array']["$_GET[product]"]['name']; ?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
  <main class="d-flex justify-content-center">
  <div class="col-lg-4 bg-color p-4">
		<div class="text-center">
			<button class="btn-color btn mb-3" type="button"><a class="anchor-color" href="index.php">&#11013; Voltar para a lista de produtos</a></button>
		</div>
				<h3 class="border-bottom text-center mb-4">Editar cadastro de produtos</h3>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="productName">Nome</label>
						<input class="form-control" type="text" name="productName" value="<?php echo $_SESSION['array']["$_GET[product]"]['name'];?>" required>
					</div>
					<div class="form-group">
						<label for="productCategory">Categoria</label>
						<select class="form-control" name="productCategory" id="" required>
							<option selected disabled>Selecione uma categoria</option>
							<?php foreach ($categories as $category): ?>
								<?php if($_SESSION['array']["$_GET[product]"]['category'] == $category): ?>
									<option selected value="<?php echo $category; ?>"><?php echo $category; ?></option>;
								<?php else: ?>
									<option value="<?php echo $category; ?>"><?php echo $category; ?></option>;
								<?php endif; ?>
              <?php endforeach;	?>
						</select>
					</div>
					<div class="form-group">
						<label for="productDescription">Descrição</label>
						<textarea class="form-control" name="productDescription" required><?php echo $_SESSION['array']["$_GET[product]"]['description']; ?></textarea>
					</div>
					<div class="form-group">
						<label for="productAmount">Quantidade</label>
						<input class="form-control" type="text" name="productAmount" value="<?php echo $_SESSION['array']["$_GET[product]"]['amount']; ?>" required>
					</div>
					<div class="form-group">
						<label for="productCost">Preço</label>
						<input class="form-control" type="text" name="productCost" value="<?php echo $_SESSION['array']["$_GET[product]"]['cost']; ?>" required>
					</div>
					<div class="form-group">
						<img class="col-lg-12 mt-2" src="<?php echo $_SESSION['array']["$_GET[product]"]['image']; ?>">
						<input type="file" class="form-control" name="productImg">
					</div>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary" name="edit">Salvar alterações</button>
					</div>
				</form>
			</div>
		</section>
	</main>
</body>
</html>