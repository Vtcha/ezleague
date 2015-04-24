<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-file-o"></i> Map Rotation</em>
    </div>
    <div class="panel-body">
        <div class="col-lg-4">
            <form id="addTournamentMap" method="POST">
            <input type="hidden" id="tournament_id" value="<?php echo $tournament_id; ?>" />
                <div class="form-group">
                    <label>Map Name <small>(ex: de_dust2)</small></label>
                    <input type="text" class="form-control" id="map" />
                </div>
                <button type="submit" class="btn btn-success">Add Map</button>
            </form>
        <?php
            $map_list = $ez_tournament->get_tournament_maps( $tournament_id );
                if( ! empty( $map_list ) ) {
        ?>
            <div class="table-responsive">
               <table class="table table-hover">
                <thead>
                    <tr>
                      <th>Map</th>
                      <th></th>
                    </tr>
                </thead>
                <tbody>
            <?php 
                $maps = explode( ',', $map_list );
                    foreach( $maps as $map ) { ?>
                        <tr>
                            <td><?php echo $map; ?></td>
                            <td></td>
                        </tr>
              <?php } ?>
                </tbody>
               </table>
            </div>
            <?php } ?>
        </div>
        <div class="col-lg-8">
            <form id="addMap" method="POST">
            <input type="hidden" id="tournament_id" value="<?php echo $tournament_id; ?>" />
            <?php 
                $map_list = $ez_tournament->get_tournament_maps( $tournament_id );
                if( ! empty( $map_list ) ) {
            ?>
                <div class="table-responsive">
                   <table class="table table-hover">
                    <thead>
                        <tr>
                          <th>Map</th>
                          <th></th>
                        </tr>
                    </thead>
                    <tbody>
              <?php
                    $maps = explode( ',', $map_list );
                    $total_rounds = 1;
                    switch( $max_teams ) {
                        case 4:
                            $total_rounds = 2;
                            break;
                        case 8:
                            $total_rounds = 3;
                            break;
                        case 16:
                            $total_rounds = 4;
                            break;
                        case 32:
                            $total_rounds = 5;
                            break;
                        default:
                            $total_rounds = 2;
                            break;
                    }
                    for ( $i = 1; $i <= $total_rounds; $i++ ) {
                        $round_map = $ez_tournament->get_round_map($tournament_id, $i);
                ?>
                        <tr>
                         <td>Round <?php echo $i; ?></td>
                         <td>
                           <select name="round_map" id="round_map" onchange="setMap('<?php echo $tournament_id; ?>', '<?php echo $i; ?>', this.value)" class="form-control">
                                <option></option>
                           <?php foreach( $maps as $map ) { ?>
                                <option <?php echo ( $round_map == $map ? 'selected' : '' ); ?> value="<?php echo $map; ?>"><?php echo $map; ?></option>
                           <?php } ?>
                           </select>
                         </td>
                        </tr>
              <?php } ?>
                     </tbody>
                   </table>
                </div>
                <div class="success maps_success">
                  <span class="success_text maps_text"></span>
                </div>
            <?php } else { ?>
                    No maps have been added.
            <?php } ?>
            </form>
        </div>
    </div>
</div>