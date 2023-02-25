<div class="col-lg-3 col-md-4" id="successAlert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
	<div class="alert alert-success fade show" role="alert">
	</div>
</div>
<div class="card-title card-bg-c">
	<div class="d-flex">
		<div class="flex-fill">
			<button type="button" class="btn btn-light btn-sm btn-icon-only btn-shadow mt-2" onclick="return location.reload();">
				<span><i class="ion-arrow-left-c"></i></span> Back
			</button></div>
		<div class="flex-fill">
			<h4 class="heading heading-6 text-left">
				BILLING
			</h4>
		</div>
	</div>
</div>
<div class="card-body">
	<div class="container">
		<div class="row clearfix">
			<div class="col-md-12 col-xs-12 mt-2">
				<table id="billing_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead class="thead-light">
						<tr>
							<th>
								<?php echo translate('due_date') ?>
							</th>
							<th>
								<?php echo translate('invoice_no') ?>
							</th>
							<th>
								<?php echo translate('billing_period') ?>
							</th>
							<th>
								<?php echo translate('amount_paid') ?>
							</th>
							<th>
								<?php echo translate('invoice') ?>
							</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>

<script>
    function dateFunc(dateStr, index){
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
        let dateObj = new Date(dateStr);
        let month = monthNames[dateObj.getMonth()];
        let day = String(dateObj.getDate()).padStart(2, '0');
        let year = dateObj.getFullYear();
        let timezoneDate = month  + '\n'+ day  + ', ' + year;
        timezoneTime = new Date(dateStr).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        $('.timezone'+index).html(timezoneDate);
    }
</script>
<script>
	$(document).ready(function() {
		$('#billing_table').DataTable({
			pagingType: "numbers",
			"searching": false,
	      	"bInfo" : false,
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?php echo base_url('home/profile/billing/billingData') ?>",
				"dataType": "json",
				"type": "POST",
				error: function(jqXHR, ajaxOptions, thrownError) {
					console.log(jqXHR);
				}
			},
			"columns": [{
					"data": "due_date"
				},
				{
					"data": "invoice_no"
				},
				{
					"data": "billing_period"
				},
				{
					"data": "amount_paid"
				},
				{
					"data": "action"
				},
			],
			"drawCallback": function(settings) {

				// Pagination - Add BS4-Class for Horizontal Alignment (in second of 2 columns) & Top Margin
			    // $('#billing_table_wrapper .col-md-7:eq(0)').addClass("d-flex justify-content-center justify-content-md-end");
			    // $('#billing_table_paginate').addClass("mt-3 mt-md-2");
			    // $('#billing_table_paginate ul.pagination').addClass("pagination-sm");
			}
		});
	});
</script>