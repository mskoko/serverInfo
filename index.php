<?php
// Ovde defiinisi koji ip;
$serverIP = '193.104.68.108:27055';

// GameQ
require_once($_SERVER['DOCUMENT_ROOT'].'/GameQ/Autoloader.php');
$GameQ = new \GameQ\GameQ();
$GameQ->addServer([
    'type' => 'cs16', 					// game
    'host' => $serverIP, 				// ip
]);
$results = $GameQ->process(); 			// Process

// print_r($results); // Pogledaj Array;

$serverName 		= @$results[$serverIP]['gq_hostname'];
$maxBrojIgraca 		= @$results[$serverIP]['gq_maxplayers'];
$trenutniBrojIgraca = @$results[$serverIP]['gq_numplayers'];
$trenutnaMapa 		= @$results[$serverIP]['gq_mapname'];
$slMapa 			= @$results[$serverIP]['amx_nextmap'];
$Igraci 			= @$results[$serverIP]['players'];

?>

<!-- Server informacije -->
<h3>Ime servera: <?php echo $serverName; ?></h3>
<h3>Igraci: <?php echo $trenutniBrojIgraca.'/'.$maxBrojIgraca; ?></h3>
<h3>Trenutna mapa: <?php echo $trenutnaMapa; ?></h3>
<h3>Sledeca mapa: <?php echo $slMapa; ?></h3>
<!-- Tabela igraca -->
<table>
	<thead>
		<tr>
			<th>Igrac</th>
			<th>Skor</th>
			<th>Time</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($Igraci as $playerKey => $playerVal) {
		$palyerTime = explode('.', $playerVal['time']);
		$hours 		= floor($palyerTime[0] / 3600);
		$mins 		= floor($palyerTime[0] / 60 % 60);
		$secs 		= floor($palyerTime[0] % 60);
	?>
		<tr>
			<td><?php echo @$playerVal['name']; ?></td>
			<td><?php echo @$playerVal['score']; ?></td>
			<td><?php echo $hours.':'.$mins.':'.$secs; ?></td>
		</tr>
	<?php } ?>
</tbody>
</table>