<!-- BEGIN: main -->
<div class="container">
	<div class="row">
		<div>
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">		
				<img src="{ROW.image}" alt="" >
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 ">
				<h3>{ROW.name}</h3>
				</br>
				<div class="container">
				<p>
					{LANG.price} : {ROW.price} 
					
				</p>
				<p>{LANG.category_id}: {ROW_CATE.name}</p>
				</div>
				<p>
					<a href="#" class="btn btn-danger"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
				</p>
			</div>
		</div>	
	</div>
	
	</br>
		<div class="panel-body text-center">
			<h2>Nội dung chính</h2>
		</div>
		<div class="col-md-18 col-md-offset-3">
			<p>{LANG.content}: {ROW.content}</p>
	</div>
</div>
<!-- END: main -->