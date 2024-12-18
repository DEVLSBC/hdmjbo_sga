<?php
include_once('config.php');
//Libera somente os IPs necessários para acessar a página.
// $validos = array('10.0.0.20', '10.0.0.51');
// if (! in_array($_SERVER['REMOTE_ADDR'], $validos))
//     die('Você não tem acesso a este site, entre em contato com o suporte para mais informações.');

//Criação do objeto do tipo "Conexão" e chamada da função de "conexão" presente dentro da classe.
$connect = new Conexao();
$conexao = $connect->conectar();

//Inserção dos valores, nome e local, no banco de dados.
if (isset($_POST['submit'])) {
	$nome   = $_POST['nome'];
	$local  = $_POST['select'];
	$prio   = $_POST['selectprio'];
	$sql    = "INSERT INTO hdmjbo_sga (nome_sga, sala_sga, prio_sga) VALUES ('$nome','$local', '$prio')";
	$result = mysqli_query($conexao, $sql);
}
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/stylepac.css" rel="stylesheet">
	<link rel="icon" href="imagens/favicon.png">
	<title>HDMJBO :: Cadastro</title>
</head>

<body>
	<header>
		<!-- Cabeçalho da página, contendo imagem e título -->
		<section>
			<div id="head_top">
				<div>
					<img class="logo_head" src="./imagens/LOGO.png" alt="Logo da Prefeitura de Fortaleza">
				</div>
				<div class="mes">
					<!-- Imagem precisa ter 200px de largura por 150px altura -->
					<!-- <img src = "./imagens/outubrorosa.png" alt = "Logo mês de apoio"> -->
				</div>
				<div>
					<h1><br>Cadastro Paciente Acolhimento</h1>
				</div>
			</div>
		</section>

		<hr>

		<!-- Select para cadastrar paciente -->
		<nav>
			<form id="formulario" action="index.php" method="POST">

				<p>-- Cadastro de Paciente --</p>
				<section class="cadastroPac">
					<div class="inputBox">
						<input type="text" name="nome" id="nome" maxlength="48" class="inputUser" required placeholder="Nome do Paciente">
					</div>
					<div>
						<span>Sala</span>
						<select name="select" id="select">
							<option id="acolhimento">Acolhimento</option>
							<option id="consultorioum">Consultorio 1</option>
							<option id="consultoriodois">Consultorio 2</option>
							<option id="consultoriotres">Consultorio 3</option>
							<option id="consultorioquatro">Consultorio 4</option>
						</select>
						<span">Prioridade</span>
							<select name="selectprio" id="selectprio">
								<option id="prio1">Normal</option>
								<option id="prio2">Alta</option>
							</select>
					</div>
				</section>
				<input type="submit" name="submit" id="submit" value="CADASTRAR">

			</form>
		</nav>
		<hr>
	</header>

	<main>
		<?php
		// Consulta SQL para buscar os 4 últimos registros
		$sql    = "SELECT * FROM hdmjbo_sga ORDER BY id_sga DESC LIMIT 4";
		$result = mysqli_query($conexao, $sql);

		// Verificar se há resultados
		if ($result->num_rows > 0) {
			echo '
			<table id = "tabela" class = "tabelaCadastro" border = "0">
				<tr>
					<th>Nome</th>
					<th>Sala</th>
					<th>Prioridade</th>
					</tr>';
			// Exibir os dados de cada linha
			while ($row = $result->fetch_assoc()) {
				echo "<tr>
					<td id=\"nomePaciente\">" . $row["nome_sga"] . "</td>
					<td id=\"salaPaciente\">" . $row["sala_sga"] . "</td>
					<td id=\"prioPaciente\">" . $row["prio_sga"] . "</td>
					<td><button onclick=\"mostrarPaciente()\">Chamar</button></td>
				</tr>";
			}

			// Fechar a tabela e HTML
			echo '
			</table>';
		} else {
			echo "Nenhum registro encontrado.";
		}

		// Fechar a conexão
		$conexao->close();
		?>
	</main>

	<!-- Rodape da página -->
	<footer>
		<div class="sga_footer">
			<hr>
			<p>&copy; 2024 HDMJBO. Todos os direitos reservados.</p>
		</div>
	</footer>

</body>
<script src="./js/app.js"></script>

</html>