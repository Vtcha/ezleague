<div class="col-md-12">
<?php $tournaments = $ez_tournament->get_open_public_tournaments(); ?>
<h1>Tournaments</h1>
<h2>Public Tournaments Without Matches</h2>
<?php include( 'tpls/tournaments/tournaments-sub-navigation.php' ); ?>
<div class="row">
	<div class="col-md-12">
		<div class="news-blocks">
			<h4 class="title">Public Tournaments that have not started</h4>
	<?php if( $tournaments ) { ?>
			<table class="table league-information">
				<tr>
					<th>Game</th>
					<th>Tournament</th>
					<th>Format</th>
					<th># Teams Registered</th>
					<th>Max Teams</th>
					<th>End Registration</th>
					<th></th>
				</tr>
		<?php foreach( $tournaments as $tournament ) { ?>
			<?php $total_registered = $ez_tournament->get_total_teams( $tournament['tid'] ); ?>
				<tr>
					<td><?php echo $tournament['gameshort']; ?></td>
					<td><em><?php echo $tournament['tournament']; ?></em></td>
					<td><?php echo $tournament['format']; ?></td>
					<td><?php echo $total_registered; ?></td>
					<td><?php echo $tournament['max_teams']; ?></td>
					<td><?php echo date( 'F d, Y', strtotime( $tournament['registration_date'] ) ); ?></td>
					<td>
						<?php if( $tournament['max_teams'] > $total_registered ) { ?>
								<?php if( isset( $profile ) ) { ?>
									<?php if( $profile['team_admin'] == true ) { ?>
										<?php $exist = $ez_tournament->check_for_team( $profile['guild_id'], $tournament_id ); ?>
										<?php if( $exist == false ) { ?>
												<button type="button" class="btn green btn-sm" onclick="registerTeam('<?php echo $profile['guild_id']; ?>', '<?php echo $tournament['tid']; ?>')"><i class="fa fa-pencil"></i> REGISTER TEAM</button>
										<?php } else { ?>
												<button disabled class="btn danger btn-sm">Already Registered</button>
										<?php } ?>
									<?php } ?>
								<?php } ?>
						<?php } ?>
						<a href="view-tournaments.php?p=view&id=<?php echo $tournament['tid']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> View Bracket</a>
						<a href="view-tournaments.php?p=rules&id=<?php echo $tournament['tid']; ?>" class="btn btn-info btn-sm"><i class="fa fa-gavel"></i> Rules</a>
					</td>
				</tr>
		<?php } ?>
			</table>
	<?php } else { ?>
		Sorry, currently there are no open tournaments
	<?php } ?>
		</div>
		<div class="success"><span class="success_text"></span></div>
	</div>
</div>