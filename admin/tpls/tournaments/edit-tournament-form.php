<form method="POST" id="editTournament">
  <input type="hidden" id="tournament-id" value="<?php echo $tournament_id; ?>" />
    <div class="form-group">
        <label>Type <small>(only single elimination is currently available)</small></label>
        <input disabled class="form-control" id="type" placeholder="Single Elimination" value="Single Elimination, <?php echo $public_text; ?>" />
    </div>
    <div class="form-group">
        <label>Tournament</label>
        <input class="form-control" id="tournament" value="<?php echo $tournament['tournament']; ?>" placeholder="Tournament Name" />
    </div>
    <div class="form-group">
        <label>Status</label>
        <select class="form-control" id="status">
            <option <?php echo ( $tournament['status'] == 1 ? 'selected' : '' ); ?> value="1">Running</option>
            <option <?php echo ( $tournament['status'] == 0 ? 'selected' : '' ); ?> value="0">Closed</option>
        </select>
    </div>
    <div class="form-group">
        <label>Required (Max) Teams</label>
        <select class="form-control" id="max-teams">
            <option <?php echo ( $tournament['teams'] == 4 ? 'selected' : '' ); ?> value="4">4</option>
            <option <?php echo ( $tournament['teams'] == 8 ? 'selected' : '' ); ?> value="8">8</option>
            <option <?php echo ( $tournament['teams'] == 16 ? 'selected' : '' ); ?> value="16">16</option>
            <option <?php echo ( $tournament['teams'] == 32 ? 'selected' : '' ); ?> value="32">32</option>
        </select>
    </div>
    <div class="form-group">
        <label>Format</label>
        <select class="form-control" id="format">
         <?php for( $i=1; $i <= 16; $i = $i + 1 ) { ?>
            <option <?php echo ( $tournament['format'] == $i ? 'selected' : '' ); ?> value="<?php echo $i . 'v' . $i; ?>"><?php echo $i . 'v' . $i; ?></option>
         <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label>Game</label>
        <select disabled class="form-control" id="game">
            <option></option>
         <?php $games = $ez_settings->get_settings_game(); ?>
          <?php foreach( $games as $game ) { ?> 
            <option <?php echo ( $tournament['game'] == $game['slug'] ? 'selected' : '' ); ?> value="<?php echo $game['game']; ?>"><?php echo $game['game']; ?></option>
          <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label>Start Date</label>
        <input class="form-control" id="start" value="<?php echo $tournament['start_date']; ?>" placeholder="Start Date" />
    </div>
    <div class="form-group">
        <label>Registration End Date</label>
        <input class="form-control" id="registration" value="<?php echo $tournament['registration']; ?>" placeholder="Registration End Date" />
    </div>
    <div class="form-group">
        <button class="btn btn-success" type="submit">Edit Tournament</button>
        <button class="btn btn-warning" type="reset">Reset</button>
    </div>
    <div class="success">
      <span class="success_text"></span>
    </div>
</form>