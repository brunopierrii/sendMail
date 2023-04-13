<?php

?>

<html>

<head>
	<meta charset="utf-8" />
	<title>Send Mail</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="icon" type="image/png" href="./public/logo.png" />
</head>

<body>

	<div class="container">

		<div class="py-3 text-center">
			<img class="d-block mx-auto mb-2" src="./public/icon.png" alt="" width="72" height="72">
			<h2>Send Mail</h2>
			<p class="lead">Seu app de envio de e-mails particular!</p>
		</div>

		<div class="row">
			<div class="col-md-12">
				<?php if (isset($_GET['status']) && $_GET['status'] == 1) { ?>

					<div class="container">
						<h1 class="display-4 text-success">Sucesso!!!</h1>
						<p><?= $_GET['msg'] ?></p>
						<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
					</div>

				<?php } ?>

				<?php if (isset($_GET['status']) && $_GET['status'] == 2) { ?>

					<div class="container">
						<h1 class="display-4 text-danger">Ops!!!</h1>
						<p><?= $_GET['msg'] ?></p>
						<a href="index.php" class="btn btn-danger btn-lg mt-5 text-white">Voltar</a>
					</div>

				<?php } ?>

				<?php if (isset($_GET['status']) && $_GET['status'] == 3) { ?>

					<div class="container">
						<h1 class="display-4 text-info">Ops!!!</h1>
						<p><?= $_GET['msg'] ?></p>
						<a href="index.php" class="btn btn-info btn-lg mt-5 text-white">Voltar</a>
					</div>

				<?php } ?>


				<?php if (isset($_GET['status']) && $_GET['status'] == 4) { ?>

					<div class="container">
						<h1 class="display-4 text-danger">Ops!!!</h1>
						<p><?= $_GET['msg'] ?></p>
						<a href="index.php" class="btn btn-danger btn-lg mt-5 text-white">Voltar</a>
					</div>

				<?php } ?>

			</div>


			<?php if (!isset($_GET) || empty($_GET)) { ?>

				<div class="col-md-6">
					<div class="card-body font-weight-bold">
						<form action="./src/processa_envio.php" method="post">
							<div class="form-group">
								<label for="para">Para</label>
								<input name="para" type="text" class="form-control" id="para" placeholder="exemplo@dominio.com">
							</div>

							<div class="form-group">
								<label for="assunto">Assunto</label>
								<input name="assunto" type="text" class="form-control" id="assunto" placeholder="Assundo do e-mail">
							</div>

							<div class="form-group">
								<label for="mensagem">Mensagem</label>
								<textarea name="mensagem" class="form-control" id="mensagem" placeholder="Mensagem"></textarea>
							</div>

							<button type="submit" class="btn btn-primary btn-small">Enviar Mensagem</button>
						</form>
					</div>
				<?php } ?>
				</div>
		</div>
	</div>

</body>

</html>