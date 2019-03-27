<?php        
       global $woocommerce;
         
       
        $this->countries    = new WC_Countries();
	    
	    
		
		$additional_settings  = $this->additional_settings;
		$additional_settings  = array_filter($additional_settings);
		$core_fields          = '';
		$country_fields       = '';
		$address2_field       = '';

		$requiredadditional_slugs = '';
		
	    if (isset($additional_settings) && (sizeof($additional_settings) >= 1)) { 
		   $conditional_fields_dropdown = $additional_settings;
		} else {
		   $conditional_fields_dropdown = array();
		}
		
		$noticerowno3 = 1;
		 ?>
		 <center>
		 <div class="panel-group pcfme-sortable-list" id="accordion" >
		<?php if (isset($additional_settings) && (sizeof($additional_settings) >= 1)) { 
		    foreach ($additional_settings as $key =>$field) { 
		      $this->show_fields_form($conditional_fields_dropdown,$key,$field,$noticerowno3,$this->additional_settings_key,$requiredadditional_slugs,$core_fields,$country_fields,$address2_field);
		    $noticerowno3++;
		 } 
		 } 
		  ?>
		<script>
		 var hash= <?php echo $noticerowno3; ?>;
		jQuery(document).ready(function($) {
		  $(".checkout_field_width").select2({width: "250px" ,"disable_search": true}); 
          $(".checkout_field_visibility").select2({width: "250px" ,"disable_search": true});	
          $(".checkout_field_conditional_showhide").select2({width: "70px" ,"disable_search": true});
          $(".checkout_field_conditional_parentfield").select2({width: "170px" });		  
          $(".row-validate-multiselect").select2({width: "250px" });  
          $(".checkout_field_type").select2({width: "250px" });  
		  $(".checkout_field_category").select2({width: "400px" });
		  		  $('.checkout_field_products').select2({
  		   ajax: {
    			url: ajaxurl, // AJAX URL is predefined in WordPress admin
    			dataType: 'json',
    			delay: 250, // delay in ms while typing when to perform a AJAX search
    			data: function (params) {
      				return {
        				q: params.term, // search query
        				action: 'pdfmegetajaxproductslist' // AJAX action for admin-ajax.php
      				};
    			},
    			processResults: function( data ) {
				var options = [];
				if ( data ) {
 
					// data is the array of arrays, and each of them contains ID and the Label of the option
					$.each( data, function( index, text ) { // do not forget that "index" is just auto incremented value
						options.push( { id: text[0], text: text[1]  } );
					});
 
				}
				return {
					results: options
				};
			},
			cache: true
		   },
		     minimumInputLength: 3 ,
			 width: "400px"// the minimum of symbols to input before perform a search
	       });
		 });
		 </script>
		</div>
		<div class="additional-buttondiv">
         <input type="button" id="add-additional-field" class="btn button-primary" style="float:left;" value="<?php _e('Add additional Field','pcn'); ?>">
	    </div>
		</center> <?php
		
	     $this->show_new_form($conditional_fields_dropdown,$this->additional_settings_key,$country_fields);