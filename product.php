<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Página do produto: <?php echo $_SESSION['array']["$_GET[product]"]['name']; ?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <main class="container mt-4 mb-4 bg-color">
    <section class="pt-4 pb-4 d-flex row">
    <div class="col-lg-4">
      <button class="btn-color btn align-self-center ml-3 mb-4" type="button"><a class="anchor-color" href="index.php">&#11013; Voltar para a lista de produtos</a></button>
      <img class="col-lg-12 mt-2" src="<?php echo $_SESSION['array']["$_GET[product]"]['image']; ?>">
      </div> 
      <div class="col-lg-8">
        <table>
        <thead>
          <h1 class="mt-5 pt-4 pb-2"><?php echo $_SESSION['array']["$_GET[product]"]['name']; ?></h1>
        </thead>
        <tbody>
          <tr>
            <td class="pb-2">Categoria</td>
          </tr>
          <tr>
            <td class="pb-3"><h5><?php echo $_SESSION['array']["$_GET[product]"]['category']; ?></h5></td>
          </tr>
          <tr>
            <td class="pb-2">Descrição</td>
          </tr>
          <tr>
            <td class="pb-5"><h5><?php echo $_SESSION['array']["$_GET[product]"]['description']; ?></h5></td>
          </tr>
        <tr>
          <td class="pr-5">Quantidade em estoque</td>
          <td class="pl-5">Preço</td>
        </tr>
          <tr>
            <td><h5><?php echo $_SESSION['array']["$_GET[product]"]['amount']; ?></h5></td>
            <td><h5 class="pl-5 font-weight-bold"><?php echo "R$".$_SESSION['array']["$_GET[product]"]['cost']; ?></h5></td>
        </tr>
        </tbody>
      </table>
      </div>
    </section>
  </main>
</body>
</html>