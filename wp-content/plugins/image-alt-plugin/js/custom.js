jQuery( document ).ready(function() {

  $("#myTable").on("click", ".bt_save", function(){

    jQuery(this).attr("disabled", true);

    var post_id = jQuery(this).attr('data-id');
    jQuery('.save_item_'+post_id).show();
    var alt  = jQuery('#edit-'+post_id+' input[name="alt"]').val();

    var data = { 
    'action': 'save_post_custom_alt_media',
    'post_id' :post_id,
    'alt' : alt 
    }; 
    jQuery.post(custom_alt.ajax_url, data, function(response) {
    jQuery('.bt_save').removeAttr("disabled");
    jQuery('.save_item_'+post_id).hide();
    });
  });
  
});