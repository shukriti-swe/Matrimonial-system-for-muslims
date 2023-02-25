<?php
$this->db->select('cover_pic_payment.cover_pic_payment_id, cover_pic_payment.client_date , cover_pic_payment.payment_date , cover_pic_plan.name , cover_pic_plan.image , cover_pic_plan.week , cover_pic_plan.amount , member.email , cover_pics.end_date , cover_pics.image , cover_pics.status , member.member_profile_id , member.member_id , member.first_name, member.last_name , cover_pics.cover_pics_id ');
$this->db->from('cover_pic_payment');
$this->db->join('member', 'member.member_id = cover_pic_payment.member_id');
$this->db->join('cover_pic_plan', 'cover_pic_plan.plan_id = cover_pic_payment.member_plan_id');
$this->db->join('cover_pics', 'cover_pics.member_id = cover_pic_payment.member_id');
$this->db->where('cover_pic_payment.cover_pic_payment_id', $id );
$member = $this->db->get()->result_array();

$index_no = count($member) - 1;

if ( isset( $member[$index_no]['image'] ) || !empty( $member[$index_no]['image'] )) {
	$img = json_decode($member[$index_no]['image'] ,true )[0]['image'];
}

 ?>
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"> <?php echo translate('add_new_cover_pic')?> </h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('add_new_cover_pic')?></a></li>
			<li class="active"><a href="#"><?php echo translate('add_new_cover_pic')?></a></li>
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
				<h3 class="panel-title"><?php echo translate('add_new_cover_pic')?>  </h3>
			</div>
			<!--Horizontal Form-->
			<!--===================================================-->
			<form class="form-horizontal" id="package_form" method="POST" action="<?=base_url()?>admin/CoverPic_approval/do_add" enctype="multipart/form-data">
				<div class="panel-body">
					<?php if (isset($img)) { ?>

						<div class="form-group">
							<label class="col-sm-2 control-label" ><b><?php echo translate('email')?> </b></label>
							<div class="col-sm-9">
								<input type="text" name="email" class="form-control"  value="<?= $member[$index_no]['email'] ?>" readonly>
							</div>
						</div>

						<input type="hidden" name="id" value="<?= $id; ?>">
					    <input type="hidden" name="week" value="<?= $member[$index_no]['week']; ?>">
					    <input type="hidden" name="member_id" value="<?= $member[$index_no]['member_id']; ?>">
					    <input type="hidden" name="first_name" value="<?= $member[$index_no]['first_name']; ?>">
					    <input type="hidden" name="last_name" value="<?= $member[$index_no]['last_name']; ?>">
						<input type="hidden" name="cover_pics_id" value="<?= $member[$index_no]['cover_pics_id'] ?>">
						<input type="hidden" name="cover_pic_payment_id" value="<?= $member[$index_no]['cover_pic_payment_id'] ?>">

						<input type="hidden" name="plan_name" value="<?= $member[$index_no]['name'] ?>">
						<input type="hidden" name="payment_date" value="<?= $member[$index_no]['payment_date'] ?>">

						<div class="form-group">
							<label class="col-sm-2 control-label" ><b><?php echo translate('client_date')?> </b></label>
							<div class="col-sm-9">
								<input type="text" name="client_date" class="form-control" value="<?= $member[$index_no]['client_date'] ?>" readonly >
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label" ><b><?php echo translate('upload_by_member')?> </b></label>
							<div class="col-sm-9">
								<img src="<?= base_url("/uploads/home_slide/".$img ) ?>" width="50%" >
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label" ><b><?php echo translate('approve_member_pic')?> </b></label>
							<div class="col-sm-9">
								
								<div class="form-group">
								    <select class="form-control" name="status" >
								      <option value="1"> Yes </option>
								    </select>
								</div>

							</div>
						</div>
					<?php }else{ ?>

						User did not upload any pic yet to approve 

					<?php } ?>

				</div>
				<div class="panel-footer text-right">
					<a href="<?=base_url()?>admin/CoverPic_approval" class="btn btn-danger btn-sm btn-labeled fa fa-step-backward" type="submit"><?php echo translate('go_back')?></a>
					<?php if (isset($img)) { ?>
	                <button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('approve')?></button>
	                <?php }?>
				</div>
			</form>
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