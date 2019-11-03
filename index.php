<?php
	session_start();	
	include('variables.php');
	include('functions.php');
	
	//Início das validações de cadastro
	if ($_POST) {
		//Valida se o valor inserido como quantidade e valor foi um número inteiro positivo
		if ($amount < 0 || $cost < 0) {
			echo "O número não pode ser negativo.<br>";
			$uploadOk = 0;
		}

		//Valida se a imagem foi selecionada
		if (isset($fileName)) {
			//Renomeia a imagem: data do envio_nome do arquivo
			$newFileName = date("d-M-Y_").$fileName.'.'.$fileExtension;
			$targetFile = $targetDir.$newFileName;

			//Verifica se já existe uma imagem com o mesmo nome
			if (file_exists($targetFile)) {
				echo "Já existe um arquivo com esse nome. Por favor, use outro nome.<br>";
				$uploadOk = 0;
			
			//Verifica o formato do arquivo e compara com uma lista de extensões pré-definidas
			} elseif (array_search($fileType, $allowedTypes) === false) {
				echo "O tipo de arquivo enviado é inválido. Somente imagens são aceitas.<br>";
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
				if (move_uploaded_file($tempDir, $targetFile)) {
					echo saveProduct ($name,$category,$cost,$description,$amount,$targetFile);
				} else  {
					echo "Você deve selecionar uma imagem para salvar.";
				}
			}
		}
	//Início da validação do botão deletar	
	} else {
		if(!empty($_GET["action"])) {
			switch($_GET["action"]) {
				case "remove":
					//Se a session não foi setada, ele para de rodar
					if(!isset($_SESSION['array'])) {
						break;

					//Se a session foi setada e não estiver vazia, ele busca o array referente ao produto selecionado e deleta da session
					} else {
						$products = $_SESSION['array'];
						if(!empty($products)) {
							foreach($products as $k => $v) {
								if($_GET["code"] == $k) {
									$position = array_search($products[$k],$products);
									unset($products[$position]);
									$_SESSION['array'] = $products;
									if(count($_SESSION['array'])==0) {
										unset($_SESSION['array']);
									}
								}
							}
						}
					}
				break;
			}
		}
	}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Cadastro Produtos</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<main class="container mt-5 mb-5">
		<section class="row">
			<div class="col-lg-7">
				<h1 class="pb-3">Todos os produtos</h1>
				
				<!-- Se algum produto foi cadastrado, mostra a tabela de produtos -->
				<?php if(isset($_SESSION['array']) && $_SESSION['array'] != []): ?>
				<table class="table text-center">
					<thead>
						<tr>
							<th scope="col">Nome</th>
							<th scope="col">Categoria</th>
							<th scope="col">Preço</th>
							<th scope="col">Editar</th>
						</tr>
					</thead>
					<tbody>		
					<?php	foreach ($_SESSION['array'] as $key=>$product): ?>
						<tr>
							<td>
								<a href="product.php?product=<?php echo $key; ?>"><?php echo $product['name']; ?></a>
							</td>
							<td>
								<?php echo $product['category']; ?>
							</td>
							<td>
								<?php echo "R$".$product['cost']; ?>
							</td>
							<td>
								<a href="edit.php?product=<?php echo $key; ?>"><img src="img/edit.svg" class="img-size"></a>
								<a href="index.php?action=remove&code=<?php echo $key; ?>"><img src="img/delete.svg" class="img-size"></a>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				
				<!-- Se nenhum produto foi cadastrado, mostra mensagem -->
				<?php else: ?>
					<h2>Ainda não há produtos cadastrados</h2>
				<?php endif; ?>
			</div>
			
			<!-- Formulário de cadastro -->
			<div class="col-lg-5 bg-color p-4 main-form-size">
				<h3 class="border-bottom mb-4">Cadastrar produtos</h3>
				<form action="index.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="productName">Nome</label>
						<input class="form-control" type="text" name="productName" required>
					</div>
					<div class="form-group">
						<label for="productCategory">Categoria</label>
						<select class="form-control" name="productCategory" id="" required>
							<option selected disabled>Selecione uma categoria</option>
							<?php foreach ($categories as $category): ?>
								<option value="<?php echo $category; ?>"><?php echo $category; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="productDescription">Descrição</label>
						<textarea class="form-control" name="productDescription" required></textarea>
					</div>
					<div class="form-group">
						<label for="productAmount">Quantidade</label>
						<input class="form-control" type="text" name="productAmount" required>
					</div>
					<div class="form-group">
						<label for="productCost">Preço</label>
						<input class="form-control" type="text" name="productCost" required>
					</div>
					<div class="form-group">
						<label for="productImg">Foto do produto</label>
						<input type="file" class="form-control" name="productImg" required>
					</div>
					<div class="form-group text-right">
						<button type="submit" class="btn btn-primary" name="add">Enviar</button>
					</div>
				</form>
			</div>
		</section>
	</main>
</body>
</html>