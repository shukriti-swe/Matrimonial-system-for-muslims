<footer id="footer" class="footer">
   <div class="footer-top" style="padding-top: 1rem; padding-bottom: 1rem;">
      <div style="padding-left: 10%; padding-right: 10%;">
         <div class="row cols-xs-space cols-sm-space cols-md-space">
            <?php                                            $footer_logo_info = $this->db->get_where('frontend_settings', array('type' => 'footer_logo'))->row()->value;                                            $footer_logo = json_decode($footer_logo_info, true);                                            $footer_logo_position = $this->db->get_where('frontend_settings', array('type' => 'footer_logo_position'))->row()->value;                                            $footer_text = $this->db->get_where('frontend_settings', array('type' => 'footer_text'))->row()->value;                                            if ($footer_logo_position == 'left') {                                            ?>                                                
            <div class="col-md-3 col-lg-3" style="text-align: left;line-height: 1;padding-left: 5px !important;padding-right: 5px !important;"> 
               <div class="col" style="padding-left: 2px !important;padding-right: 2px !important;">
                  <h4 class="heading heading-xs strong-600 text-uppercase mb-1">													 Contact Us                                                </h4>
                  <small style="line-height: 0.5rem;padding: 0.25rem 0;font-size: 0.8rem;font-weight: 400;">Match Made In Jannah<br/>P.O Box 214752, Auburn Hills, MI 48321<br/>(248) 934-0075<br/>customers@matchmadeinjannah.com<br/>techelp@matchmadeinjannah.com</small>                                                    
               </div>
            </div>
            <?php                                            }                                        ?>                                        
            <div class="col-md-3 col-lg-3" style="text-align: left;line-height: 1;padding-left: 5px !important;padding-right: 5px !important;">
               <div class="col" style="padding-left: 2px !important;padding-right: 2px !important;">
                  <h4 class="heading heading-xs strong-600 text-uppercase mb-1">                                                <?php echo translate('main_menu')?></h4>
                  <ul class="footer-links" style="line-height: 0.5rem;">
                     <li>                                                    <a href="<?=base_url()?>home" title="Home">                                                    <?php echo translate('home')?></a>                                                    </li>
                     <li>                                                    <a href="<?=base_url()?>home/contact_us" title="Contact Us">                                                    <?php echo translate('contact_us')?></a>                                                    </li>
                     <li>                                                    <a href="<?=base_url()?>home/listing" title="Search">                                                    Search Members</a>                                                    </li>
                  </ul>
               </div>
            </div>
            <div class="col-md-3 col-lg-3" style="text-align: left;line-height: 1;padding-left: 5px !important;padding-right: 5px !important;">
               <div class="col" style="padding-left: 2px !important;padding-right: 2px !important;">
                  <h4 class="heading heading-xs strong-600 text-uppercase mb-1">                                                Services</h4>
                  <ul class="footer-links" style="line-height: 0.5rem;">
                     <li>                                                    <a href="<?=base_url()?>home/about_us" title="FAQ">                                                    About Us </a>                                                    </li>
                     <li>                                                    <a href="<?=base_url()?>home/terms_and_conditions" title="Terms & Conditions">                                                    Terms and Conditions</a>                                                    </li>
                     <li>                                                    <a href="<?=base_url()?>home/warning" title="FAQ">                                                    Warning and Suspension </a>                                                    </li>
                    <li>
                                                    <a href="<?=base_url()?>home/privacy_policy" title="FAQ">
                                                    Privacy Policy </a>
                                                    </li>
                  </ul>
               </div>
            </div>
            <div class="col-md-3 col-lg-3" style="text-align: left;line-height: 1;padding-left: 5px !important;padding-right: 5px !important;">
               <div class="col" style="padding-left: 2px !important;padding-right: 2px !important;">
                  <h4 class="heading heading-xs strong-600 text-uppercase mb-1">                                                Useful Links</h4>
                  <ul class="footer-links" style="line-height: 0.5rem;">
                     <li>                                                    <a href="<?=base_url()?>home/honesty" title="FAQ">                                                    Honesty Is The Best Policy </a>                                                    </li>
                     <li>                                                    <a href="<?=base_url()?>home/faq" title="FAQ">                                                    Helpful Questions </a>                                                    </li>
                     <li>                                                    <a href="<?=base_url()?>home/safety_tips" title="FAQ">                                                    Safety Tips </a>                                                    </li>
                     <li>                                                    <a href="<?=base_url()?>home/effective_communication" title="Privacy Policy">                                                    Effective Communication</a>                                                    </li>
                  </ul>
               </div>
            </div>
            <?php                                            if ($footer_logo_position == 'right') {                                            ?>                                                
            <div class="col-md-3 col-lg-3">
               <div class="col">
                  <a class="navbar-brand" href="#">                                                            <?php                                                                if (file_exists('uploads/footer_logo/'.$footer_logo[0]['image'])) {                                                                ?>                                                                    <img src="<?=base_url()?>uploads/footer_logo/<?=$footer_logo[0]['image']?>" class="img-responsive" width="100%">                                                                <?php                                                                }                                                                else {                                                                ?>                                                                    <img src="<?=base_url()?>uploads/footer_logo/default_image.png" class="img-responsive" width="100%">                                                                <?php                                                                }                                                            ?>                                                        </a>                                                        
                  <div class="text-center"><small><?=$footer_text?></small></div>
               </div>
            </div>
            <?php                                            }                                        ?>                                    
         </div>
      </div>
   </div>
   <div class="footer-bottom py-1">
      <div class="container">
         <div class="row row-cols-xs-spaced flex flex-items-xs-middle">
            <div class="col col-sm-7 col-xs-12">
               <div class="copyright text-xs-center text-sm-left mt-2">                                                 <?=translate('copyright')?> &copy; <?=date("Y")?> <a href="<?=base_url()?>" class="c-base-1" target="_blank" title="Webpixels - Official Website">                                                <strong class="strong-400"><?=$this->system_name?></strong>                                                </a>                                             </div>
            </div>
         </div>
      </div>
   </div>
</footer>
</div>                </div>            </div>            <!-- END: st-pusher -->        </div>        <!-- END: st-pusher -->    </div>    <!-- END: st-container --></div><!-- END: body-wrap -->