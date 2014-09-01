<div class="portlet box blue">
<div class="portlet-title">
	<div class="caption">
		<i class="fa fa-clog"></i>Update User Avatar
	</div>
	<div class="tools">
		<a href="javascript:;" class="collapse">
		</a>
	</div>
</div>
<div class="portlet-body form">
	<form action="./lib/submit/avatar-upload.php" id="uploadform" method="POST" enctype="multipart/form-data">
	 <input type="hidden" name="from" value="<?php echo $_SERVER['PHP_SELF']; ?>">
	 	<div class="form-body">
			<div class="form-group">
				<label class="control-label">Avatar image is <em>limited to 1MB</em></label>
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<input type="file" name="file"/>
				</div>
				<div class="clearfix margin-top-10">
				<?php if( $profile['avatar'] != '' ) { ?>
				Current Avatar:
					<a href="./avatars/<?php echo $profile['avatar']; ?>" target="_blank">
						<img src="./avatars/<?php echo $profile['avatar']; ?>" width="100px" />
					</a>
					<button type="button" class="btn btn-danger btn-sm" onclick="removeAvatar('<?php echo $profile['id']; ?>')">Remove Avatar</button>
				<?php } else { ?>
					No avatar found, you should upload one! 
				<?php } ?>
				</div>
			</div>
			<div class="margin-top-10">
				<button type="submit" class="btn green">
				Submit </button>
				<button type="reset" class="btn default">
				Cancel </button>
			</div>
		</div>
		<div class="success"><span class="success_text"></span></div>
	</form>
</div>
</div>
<!-- /.Team Settings -->