<?php 

$jahr  = date('Y');
$monat = 1;

setlocale(LC_TIME,'de_DE@euro', 'de_DE', 'de', 'ge', 'deu_deu');

$ts = easter_date($jahr);
$feiertag_arr = array(
	'01.01.' => 'Neujahr',
	date('d.m.',$ts-(2*60*60*24))  => 'Karfreitag',
	date('d.m.',$ts+(60*60*24))	   => 'Ostermontag',
	'01.05.' 					   => '1. Mai',
	date('d.m.',$ts+(39*60*60*24)) => 'Christi Himmelfahrt',
	date('d.m.',$ts+(50*60*60*24)) => 'Pfingstmontag',
	'03.10.' 					   => 'Tag der dt. Einheit',
	'25.12.' 					   => '1. Weihnachtstag',
	'26.12.' 					   => '2. Weihnachtstag',
);
echo '<table border="1">';
echo '<tr>';
for($i=1; $i<=12; $i++) {
	$monatsname = utf8_encode(strftime('%B',mktime(0,0,0,$i,1,$jahr)));
	echo '<th style="width:100px">'.$monatsname.'</th>';
}
echo '</tr>';

for($tag=1; $tag<=31; $tag++) {
	echo '<tr>';
	for($monat=1; $monat<=12; $monat++) {
		if(checkdate($monat,$tag,$jahr)) {
			$timestamp = mktime(0,0,0,$monat,$tag,$jahr);
			$wtag = strftime('%a',$timestamp);
			if($wtag == 'So') {
				echo '<td style="background-color: grey">';
			} else {
				echo '<td>';
			}
			$feiertag = '';
			if(isset($feiertag_arr[date('d.m.',$timestamp)])) {
				$feiertag = ' '.$feiertag_arr[date('d.m.',$timestamp)];
			}
			echo $tag.' '.$wtag.$feiertag.'</td>';
		} else {
			echo '<td>&nbsp;</td>';
		}	
	}
	echo '</tr>';
}
echo '</table>';
?>