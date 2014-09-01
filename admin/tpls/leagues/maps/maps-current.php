<div class="panel panel-default">
<div class="panel-heading">
    <i class="fa fa-file-o"></i> Current <em><?php echo $league['league']; ?></em> Map Rotation
</div>
<div class="panel-body">
    <div class="table-responsive">
       <table class="table table-hover">
        <thead>
            <tr>
              <th>Map</th>
              <th></th>
            </tr>
        </thead>
        <tbody>
  <?php $maps = $ez_league->get_maps( $league_id ); ?>
  <?php for ($i=1; $i<=$league['games']; $i++) { ?>
  <?php $week_map = $ez_league->get_week_map($league_id, $i); ?>
            <tr>
             <td>Week <?php echo $i; ?></td>
             <td>
               <select name="week_map" id="week_map" onchange="setMap('<?php echo $league_id; ?>', '<?php echo $i; ?>', this.value)" class="form-control">
               		<option></option>
               <?php foreach( $maps as $map ) { ?>
               		<option <?php echo ( $week_map == $map['map'] ? 'selected' : '' ); ?> value="<?php echo $map['map']; ?>"><?php echo $map['map']; ?></option>
               <?php } ?>
               </select>
             </td>
            </tr>
  <?php } ?>
        </tbody>
       </table>
    </div>
</div>
</div>