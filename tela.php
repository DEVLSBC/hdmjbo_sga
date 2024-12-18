<!-- Função utilizada para atualizar a tela a cada 2 segundos. -->
<meta http-equiv = "refresh" content = "2" />


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

$top       = "SELECT nome,sala from painel order by id desc limit 4";
$resulttop = mysqli_query($conexao, $top);
$arraytop  = mysqli_fetch_assoc($resulttop);


$sqlid    = "SELECT MAX(id) FROM painel";
$resultid = mysqli_query($conexao, $sqlid);
$arrayid  = mysqli_fetch_assoc($resultid);
$stringid = implode($arrayid);

$sqlprio    = "SELECT prio FROM painel WHERE id = '$stringid'";
$resultprio = mysqli_query($conexao, $sqlprio);
$arrayprio  = mysqli_fetch_assoc($resultprio);
$stringprio = implode($arrayprio);

$sqlnome    = "SELECT nome,sala FROM painel WHERE id = '$stringid'";
$resultnome = mysqli_query($conexao, $sqlnome);
$arraynome  = mysqli_fetch_assoc($resultnome);
?>

<!DOCTYPE html>
<html lang = "br">

<head>
	<title>HDMJBO :: TELA</title>
	<link rel  = "icon" type             = "image/png" href = "imagens/LOGO.png">
	<link href = "css/bootstrap.css" rel = "stylesheet">
	<link href = "css/style.css" rel     = "stylesheet">
</head>

<body>
	<br><br>
	<div class = "barraTop">&nbsp;</div>
	<div class = "container page">
	<div class = "row barraSuperior">
	<div class = "col-xs-1">
	<img src   = "imagens/LOGO.png" class = "uespiLogo">
			</div>
			<div class = "col-xs-11" style = "text-align: center;">
				<p></p>
				<span class = "uespiTexto">Hospital Distrital Maria José Barroso de Oliveira</span><br>
				<span class = "subtitulo"><strong>HDMJBO</strong></span>
			</div>
			<div  class = "col-xs-11" style = "text-align: right;">
			<span class = "datahora"><strong><?php echo ($Time) ?><?php echo ('<br>') ?><?php echo ($Date) ?></strong></span>
			</div>
		</div>
		<div  class = "row">
		<span id    = "senhaTexto">PACIENTE CHAMADO -</span>
		<span id    = "prioridade"><?php echo ($stringprio) ?></span>
		<div  class = "senhaAtual">
				<div id="nomeChamado">
					<table class = "table" style = "text-align: left;"><?php echo "<td>" . $arraynome['nome'] . "</td>";
																	echo "<td>" . $arraynome['sala'] . "</td>"; ?></table>
				</div>
			</div>
		</div>
		<div   class = "row">
		<span  id    = "senhaTexto">ÚLTIMOS CHAMADOS</span><br>
		<div   class = "col-xs-4 col-xs-offset-4 ultimaSenha">
		<table class = "table2" style = "text-align: left;">
					<tbody>
						<?php
						while ($arraytop = mysqli_fetch_assoc($resulttop)) {
							echo "<tr>";
							echo "<td>" . $arraytop['nome'] . "</td>";
							echo "<td>" . $arraytop['sala'] . "</td>";
							echo "<tr>";
							echo "<td>" . "<br>" . "</td>";
							echo "</tr>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<audio id = "audioChamada" src = "audio/chamada.wav"></audio>
</body>
<!-- <script src="./js/app.js"></script> -->
</html>