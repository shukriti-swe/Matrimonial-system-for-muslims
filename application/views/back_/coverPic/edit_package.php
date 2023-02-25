<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('cover_pic_plans')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('cover_pic_plans')?></a></li>
			<li class="active"><a href="#"><?php echo translate('edit_package')?></a></li>
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<!--Block Styled Form -->
		<!--===================================================-->
        <div class="row">
            <div class="col-md-8 col-lg-offset-2">
		        <div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo translate('edit_package')?></h3>
			</div>
			<!--Horizontal Form-->
			<!--===================================================-->
			<?php
				foreach ($get_plan as $value) 
				{
			?>
			<form class="form-horizontal" id="package_form" method="POST" action="<?=base_url()?>admin/coverPic/update" enctype="multipart/form-data">
				<div class="panel-body">
					<input type="hidden" class="form-control" name="plan_id" value="<?=$value->plan_id?>">

					<div class="form-group">
						<label class="col-sm-2 control-label" for="demo-hor-name"><b><?php echo translate('package_name')?></b></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="name" value="<?=$value->name?>" required="">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" ><b><?php echo translate('week')?></b></label>
						<div class="col-sm-9">
							<input type="number" class="form-control" name="week" value="<?=$value->week?>" required="">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" ><b><?php echo translate('prize_id')?> </b></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="price_id" value="<?=$value->price_id?>"  required="" placeholder="Stripe Price ID" >
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label"><b><?php echo "Amount"; ?></b></label>
						<div class="col-sm-9">
							<input type="number" class="form-control" name="amount" value="<?=$value->amount?>" required="">
						</div>
					</div>

				</div>
				<div class="panel-footer text-right">
					<a href="<?=base_url()?>admin/packages" class="btn btn-danger btn-sm btn-labeled fa fa-step-backward" type="submit"><?php echo translate('go_back')?></a>
					<!-- <a href="#" class="btn btn-primary" type="submit">Submit</a> -->
	                <button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
				</div>
			</form>
			<?php
			}
			?>
			<!--===================================================-->
			<!--End Horizontal Form-->
		</div>
            </div>
        </div>
		<!--===================================================-->
		<!--End Block Styled Form -->
	</div>
	<!--===================================================-->
	<!--End page content-->
</div>
<script>
	$(function () {
	    //bootstrap WYSIHTML5 - text editor
	    $('.textarea').wysihtml5();
	})
</script>
<script>
	// SCRIT FOR IMAGE UPLOAD
    function readURL_all(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var parent = $(input).closest('.form-group');
            reader.onload = function (e) {
                parent.find('.wrap').hide('fast');
                parent.find('.blah').attr('src', e.target.result);
                parent.find('.wrap').show('fast');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".panel-body").on('change', '.imgInp', function () {
        readURL_all(this);
    });
</script>