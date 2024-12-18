<!-- Função utilizada para atualizar a tela a cada 2 segundos. -->
<meta http-equiv="refresh" content="2" />


<?php
//V1.5
include_once('config.php');

//Data e hora.
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$Time = date('H:i', time());

$data    = new DateTime();
$formato = new IntlDateFormatter(
	'pt_BR',
	IntlDateFormatter::MEDIUM,
	IntlDateFormatter::NONE,
	'America/Sao_Paulo',
	IntlDateFormatter::GREGORIAN,
	"dd 'de' MMMM"
);
$Date = $formato->format($data);


//Criação do objeto do tipo "Conexão" e chamada da função de "conexão" presente dentro da classe.
$connect = new Conexao();
$conexao = $connect->conectar();

//Consulta no banco de dados para retornar maior id, último paciente chamado e array com os 3 ultimos pacientes chamados exceto o ultimo;
include_once('config.php');

$top       = "SELECT nome_sga,sala_sga from hdmjbo_sga order by id_sga desc limit 4";
$resulttop = mysqli_query($conexao, $top);
$arraytop  = mysqli_fetch_assoc($resulttop);


$sqlid    = "SELECT MAX(id_sga) FROM hdmjbo_sga";
$resultid = mysqli_query($conexao, $sqlid);
$arrayid  = mysqli_fetch_assoc($resultid);
$stringid = implode($arrayid);

$sqlprio    = "SELECT prio_sga FROM hdmjbo_sga WHERE id_sga = '$stringid'";
$resultprio = mysqli_query($conexao, $sqlprio);
$arrayprio  = mysqli_fetch_assoc($resultprio);
$stringprio = implode($arrayprio);

$sqlnome    = "SELECT nome_sga,sala_sga FROM hdmjbo_sga WHERE id_sga = '$stringid'";
$resultnome = mysqli_query($conexao, $sqlnome);
$arraynome  = mysqli_fetch_assoc($resultnome);
?>

<!DOCTYPE html>
<html lang="br">

<head>
	<link href="css/sga_style.css" rel="stylesheet">
	<link rel="icon" href="imagens/favicon.png">
	<title>HDMJBO :: Tela</title>
</head>

<body>
	<header class="tela_Header">
			<div class="tela_Logopref">
				<img src="imagens/LOGO.png" class="tela_Logo">
			</div>
			<div class="tela_Titulo">
				<span class="tela_Hospital">Hospital Distrital Maria José Barroso de Oliveira</span><br>
				<span class="tela_subHDMJBO"><strong>HDMJBO</strong></span>
			</div>
			<div class="tela_Datahora">
				<span class="datahora"><strong><?php echo ($Time) ?><?php echo ('<br>') ?><?php echo ($Date) ?></strong></span>
			</div>
	</header>
		<main class="tela_Main">
			<div class="tela_headerMain">
				<div class="tela_headerPacienteAtual">
					<span class="tela_h1">PACIENTE CHAMADO</span>
					<span class="tela_prio">Prioridade: <?php echo ($stringprio) ?></span>
				</div>
				<div class="tela_atualPac">
					<span class="tela_nomeAtual"><?php echo $arraynome['nome_sga']?></span>
					<span class="tela_salaAtual"><?php echo $arraynome['sala_sga']?></span>
				</div>
			</div>
			<div class="tela_ultimoPac">
				<span class="tela_h1_x2">ÚLTIMOS CHAMADOS</span><br>
				<div class="tela_listaUltimoPac">
					<table class="tela_tabelaUltimoPac">
						<tbody class="tela_tabelaBody">
							<?php
							while ($arraytop = mysqli_fetch_assoc($resulttop)) {
								echo "<tr>";
								echo "<td>" . $arraytop['nome_sga'] . "</td>";
								echo "<td>" . $arraytop['sala_sga'] . "</td>";
								echo "</tr>";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</main>
	<audio id="audioChamada" src="audio/chamada.wav"></audio>
</body>
<!-- <script src="./js/app.js"></script> -->

</html>