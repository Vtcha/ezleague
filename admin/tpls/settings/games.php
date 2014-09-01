<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Game Settings</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Add Additional Games
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                     <form method="POST" id="addGame" name="addGame">
                    	<div class="form-group">
						    <label>Game (ex: Counter-Strike: Global Offensive)</label>
						    <input type="text" class="form-control" id="game" placeholder="Game Name" />
						</div>
						<div class="form-group">
						    <label>Short Name (ex: CS: GO)</label>
						    <input type="text" class="form-control" id="short-name" placeholder="Game Short Name" />
						</div>
						<div class="form-group">
						    <label>Slug (ex: wow)</label>
						    <input type="text" class="form-control" id="slug" placeholder="Game Slug" />
						</div>
						<div class="form-group">
							<button class="btn btn-success" type="submit">Add Game</button>
						</div>
						<div class="success">
	                      <span class="success_text"></span>
	                    </div>
					  </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
    	<div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Current Games
            </div>
            <div class="panel-body">
            	<div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Game</th>
                                <th>Short Name</th>
                                <th>Options</th>
                            </tr>
                        </thead>
            <?php $games = $ez_settings->get_settings_game(); ?>
                        <tbody>
              <?php foreach( $games as $game ) { ?>
                            <tr>
                                <td><?php echo $game['game']; ?></td>
                                <td><?php echo $game['short_name']; ?></td>
                                <td>
				            		<button type="button" onclick="getGame('<?php echo $game['id']; ?>')" data-toggle="modal" data-target="#editGameModal" class="btn btn-primary btn-xs">Edit</button>
				            		<button type="button" onclick="deleteGame('<?php echo $game['id']; ?>')" class="btn btn-danger btn-xs">Delete</button>
				            	</td>
                            </tr>
               <?php } ?>
                        </tbody>
                     </table>
                    </div>
            </div>
        </div>
     </div>
  </div>
<div id="editGameModal" class="modal"></div>    