<?php include_once 'meta.php'; ?>
<!-- Page loader -->
<script src="<?=base_url()?>template/front/vendor/pace/js/pace.min.js?<?=date('ymdhis')?>"></script>
 
<link rel="stylesheet" href="<?=base_url()?>template/front/css/main.css?<?=date('ymdhis')?>">

<!-- Icons -->
<!-- Linea Icons -->
 
<!-- Global style (main) -->
<?php
	$theme_color = $this->db->get_where('frontend_settings', array('type' => 'theme_color'))->row()->value; 
	if ($theme_color == 'default-color') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style.css?<?=date('ymdhis')?>" rel="stylesheet" media="screen">
	<?php
	} elseif ($theme_color == 'pink') { ?>
		<!--<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-pink.css?<?=date('ymdhis')?>" rel="stylesheet" media="screen">-->
	<?php	
	} elseif ($theme_color == 'purple') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-purple.css?<?=date('ymdhis')?>" rel="stylesheet" media="screen">
	<?php	
	} elseif ($theme_color == 'light-blue') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-light-blue.css?<?=date('ymdhis')?>" rel="stylesheet" media="screen">
	<?php	
	} elseif ($theme_color == 'green') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-green.css?<?=date('ymdhis')?>" rel="stylesheet" media="screen">
	<?php	
	} elseif ($theme_color == 'dark') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-dark.css?<?=date('ymdhis')?>" rel="stylesheet" media="screen">
	<?php	
	} elseif ($theme_color == 'super-dark') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-super-dark.css?<?=date('ymdhis')?>" rel="stylesheet" media="screen">
	<?php	
	}
?>
 


