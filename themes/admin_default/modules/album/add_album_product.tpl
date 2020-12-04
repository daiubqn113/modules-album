<!-- BEGIN: main -->
<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post" enctype="multipart/form-data">
    	   	<!-- BEGIN: error -->
	   	<div class="alert alert-warning">
			<strong>{ERROR} </strong> 
		</div>
		<!-- END: error -->
	   	
	   	<legend>Thêm ảnh</legend>
	   	
	   	<input type="hidden" class="form-inline" name="id" value="{POST.id}">
	
		<div class="form-group">
			<label for="">{LANG.name_user}:</label>
			<input type="text" class="form-inline" name="name_user" value="{POST.name_user}">
		</div>
		
		<div class="form-group">
			<label for="">{LANG.img}:</label>
			<input type="file" class="form-inline" name="img" value="{POST.img}">
		</div>
		
		<div class="form-group">
			<label for="">{LANG.content}:</label>
			<input type="text" class="form-inline" name="content" value="{POST.content}">
		</div>
		
		<div class="form-group">
			<label for="">{LANG.album_id}:</label>
			<select name="album_id" id="input" class="form-inline">
				<option value="" >-- Chọn album -- </option>
				<!-- BEGIN: data -->
				<option value="{DATA.id}" {DATA.selected}>{DATA.title_album}</option>
				<!-- END: data -->
			</select>
		</div>
		
		<div class="radio">
		{LANG.status} :
		<label>
			<input type="radio" name="active" id="input" value="0" checked="checked">
			Ẩn
		</label>
		<label>
			<input type="radio" name="active" id="input" value="1" checked="checked">
			Hiện
		</label>
	</div>
    <div class="text-center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
</form>

<!-- END: main -->