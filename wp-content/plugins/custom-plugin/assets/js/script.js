/* This is JS file */

jQuery(function(){

    // Other ajax request
    // jQuery("#frmPostOtherPage").on("click",function(e){
    //     e.preventDefault();
    //     jQuery.post(ajaxurl,{action:"custom_plugin",name:"Website",Tut:"WordPress Plugin Develop"},function(response){
    //         console.log(response);
    //     });
    // });

    jQuery("#frmPostOtherPage").validate({
        submitHandler:function(){
            var post_data = jQuery("#frmPostOtherPage").serialize()+"&action=custom_ajax_req";
            jQuery.post(ajaxurl,post_data,function(response){
                var data = jQuery.parseJSON(response);
                // console.log("Name : "+data.txtName+" and Email: "+data,txtEmail);
            });
        }
    });

    jQuery(document).on("click",".btnClick",function(){
        
        var post_data = "action=custom_plugin_library&param=get_message";
        $.post(ajaxurl,post_data,function(response){
            // console.log(response);
        });

    });

    $("#frmPost").validate({
        submitHandler:function(){
            console.log($("#frmPost").serialize());
            var post_data = $("#frmPost").serialize()+"&action=custom_plugin_library&param=post_form_data";

            $.post(ajaxurl,post_data,function(response){
                var data = $.parseJSON(response);
                // console.log(data);
                // console.log("Name: "+data.txtName+" Email: "+data.txtEmail);
            });
        }
    });

    // Image Upload
    jQuery("#btnImage").on("click", function(){
        var images = wp.media({
            title:"Upload Image",
            multiple: false
        }).open().on("select", function(e) {
            var uploadedImages = images.state().get("selection").first();
            var selectedImages = uploadedImages.toJSON();
            // console.log(selectedImages.title + " " + selectedImages.url + " " + selectedImages.filename);
    
            // jQuery.each(selectedImages,function(index,image){
            //     console.log("Image URL: "+image.url+" and Title: "+image.title);
            // });

            // selectedImages.map(function(image){
            //     var itemDetails = image.toJSON();
            //     console.log(itemDetails.url);
            // });

            jQuery("#getImage").attr("src", selectedImages.url);
        });
    });

});