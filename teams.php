<?php include('header.php'); ?>
<?php 
	if( isset( $_GET['league'] ) && is_numeric( $_GET['league'] ) ) { 
		$league_id = trim( $_GET['league'] );
		$league = $ez_frontend->get_league( $league_id );
?>
			<div class="container">
				<div class="row">
					<div class="title_wrapper">
						<div class="span6">
							<h1><?php echo $league['league'] . " Teams"; ?></h1>
						</div>
						<div class="breadcrumbs">
							<strong><a href="index.php">Home</a> / Games / Leagues / <?php echo $league['league']; ?> / Teams</strong>
						</div>
					</div>
				</div>
			</div>
			<div class="page normal-page container">
			<div class="row">
				<div class="span12">
					<div class="block block-text_block span10 cf">
						<?php $teams = $ez_frontend->get_league_teams( $league_id ); ?>
						<?php $total_teams = count( $teams ); ?>
						<div class="title-wrapper">
							<h3 class="widget-title">Team List (<?php echo $total_teams; ?>)</h3>
							<div class="clear"></div>
						</div>
						<div class="wcontainer">
							<table class="table table-striped team-list">
						      <thead>
						        <tr>
						          <th></th>
						          <th>Team</th>
						          <th>Abbreviation</th>
						          <th>Leader</th>
						          <th></th>
						        </tr>
						      </thead>
						      <tbody>
						      <?php foreach( $teams as $team ) { ?>
						        <tr>
						          <td></td>
						          <td><?php echo $team['guild']; ?></td>
						          <td><?php echo $team['abbreviation']; ?></td>
						          <td><a href="search.php?search=<?php echo $team['gm']; ?>"><?php echo $team['gm']; ?></a></td>
						          <td><a href="team.php?id=<?php echo $team['id']; ?>" class="view-team">View Team</a></td>
						        </tr>
						      <?php } ?>
						      </tbody>
						    </table>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
<?php } else { echo "Not a valid league."; } ?>
<?php include('footer.php'); ?>