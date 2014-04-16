<?php
if ( $title ) {
	echo $before_title . $title . $after_title;
}
?>
	<div class="divisions">
		<span data-division="alw" class="division <?php echo ( 'alw' === $default_division ) ? 'selected' : ''; ?>">ALW</span>&nbsp;
		<span data-division="alc" class="division <?php echo ( 'alc' === $default_division ) ? 'selected' : ''; ?>">ALC</span>&nbsp; 
		<span data-division="ale" class="division <?php echo ( 'ale' === $default_division ) ? 'selected' : ''; ?>">ALE</span>&nbsp;
	</div>
	<div class="divisions">
		<span data-division="nlw" class="division <?php echo ( 'nlw' === $default_division ) ? 'selected' : ''; ?>">NLW</span>&nbsp;
		<span data-division="nlc" class="division <?php echo ( 'nlc' === $default_division ) ? 'selected' : ''; ?>">NLC</span>&nbsp;
		<span data-division="nle" class="division <?php echo ( 'nle' === $default_division ) ? 'selected' : ''; ?>">NLE</span>
	</div>
<?php
foreach ( $standings_data as $division_name=>$divisions ) {
	$display = 'display:none;';
	if ( $division_name === $default_division ) {
		$display = '';
	}
	?>
	<table style="<?php echo $display; ?>" class="<?php echo $division_name; ?>">
		<tr>
			<th class="name header">Team</th>
			<th class="won header">W</th>
			<th class="name header">L</th>
			<th class="win-pct header">%</th>
			<!-- <th class="name streak">Streak</th> -->
			<th class="games-back header">GB</th>			
		</tr>									


	<?php
	foreach ( $divisions as $place=>$team ) {
	?>
		<tr class="team <?php echo $team['team-id']; ?>">
			<td class="name"><?php echo $team['short-name']; ?></td>
			<td class="won"><?php echo $team['won']; ?></td>
			<td class="lost"><?php echo $team['lost']; ?></td>
			<td class="win-pct"><?php echo $team['win-pct']; ?></td>
			<!-- <td class="streak"><?php echo strtoupper( substr( $team['streak-type'], 0, 1 ) ) . $team['streak-total']; ?></td> -->
			<td class="games-back"><?php echo $team['games-back'] ?></td>
		</tr>
	<?php
	}
	?></table><?php
}
?>
