<?php 

add_action( 'wp_ajax_getpostsfordatatables', 'my_ajax_getpostsfordatatables' );
add_action( 'wp_ajax_nopriv_getpostsfordatatables', 'my_ajax_getpostsfordatatables' );

function my_ajax_getpostsfordatatables() {
   global $wpdb;
   $page = 100;
   $attachments = new WP_Query(
         array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'posts_per_page' => $page,
        'post_status' => 'inherit',
        'ignore_custom_sort' => TRUE
            )
    );
   $return_json = array();


   while($attachments->have_posts()) {
    $attachments->the_post();
    $row = array(
        'post_id' => get_the_ID(),
        'thumbnail' => wp_get_attachment_image(get_the_ID()),
        'file' => get_attached_file(get_the_ID()),
        'namefile' => basename(get_attached_file(get_the_ID())),
        'title' => get_the_title(),
        'alt' => get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true)
    );
    $return_json[] = $row;

  }
  echo json_encode(array('data' => $return_json));
  wp_die();
}


add_action('wp_ajax_save_post_custom_alt_media', 'save_post_custom_alt_media_func');
add_action('wp_ajax_nopriv_save_post_custom_alt_media', 'save_post_custom_alt_media_func');

function save_post_custom_alt_media_func() {

    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $alt = $_POST['alt'];
    $post = array(
        'ID' => $post_id,
        'post_title' => $title
    );
    $res = false;
    if (wp_update_post($post)) {
        update_post_meta($post_id, '_wp_attachment_image_alt', $alt);
        $res = true;
    }
    echo $res;
    die();
}


function media_custom_alt_func() {
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"/>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script><script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    </head>
    <body>
        <div class="table-responsive">
            <table id="myTable" width="100%">
                <thead>
                <tr role="row">
                    <th>File name</th>
                    <th>ALT tag</th>
                    <th>Compression</th>
                    <th></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </body>
    <script type="text/javascript">
        
    var jobtable = $('#myTable').DataTable({
        // responsive:true,
        "processing":true,
        "serverside":true,
        "ordering": false,
        ajax: {
            url: custom_alt.ajax_url + '?action=getpostsfordatatables',
        },
        columns: [{ 
            "render": function (data, type, row) {
                return '<a href="<?php echo get_site_url(); ?>/wp-admin/post.php?post='+row.post_id+'&action=edit" target="_blank"> <span class="media-icon image-icon">'+row.thumbnail+'</span></a>'+
                    '<span class="text-truncate filename-table-cells ml-2">'+row.namefile+'</span>';
            } 
        },
        {   "render": function (data, type, row) {
                return '<span class="badge badge-table-status badge-muted">N/A</span>';
            } 
        },
        {   "render": function (data, type, row) {
                return '<span class="badge badge-success badge-table-status">Crushed</span>'+
                            '<span class="badge badge-primary badge-table-saved">4% saved</span>';
            } 
        },
        {    
            "render": function (data, type, row) {
                return '<div class="btn-group btn-group-sm">'+
                    '<a class="btn btn-secondary dashboard-image-details-link"  data-open="Details" data-close="Close" >Details</a>'+
                    '<div class="btn-group btn-group-sm">'+
                    '<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"></button>'+
                    '<div class="dropdown-menu dropdown-menu-right">'+
                    '<h6 class="dropdown-header text-uppercase">Quick actions</h6>'+
                    '<div class="dropdown-divider"></div>'+
                    '<a class="dropdown-item imagechange" data-toggle="modal" data-target="#edit-'+row.post_id+'" style="cursor:pointer;"><span class="glyphicon glyphicon-money glyphicon-white"></span>Rename ALT Tag</a>'+
                    '</div>'+'</div>'+'</div>'+'</div>'+
                    '<div class="modal fade modal-'+row.post_id+'" id="edit-'+row.post_id+'" role="dialog"  data-id="'+row.post_id+'" >'+
                    '<div class="modal-dialog">'+
                        '<div class="modal-content">'+
                            '<div class="modal-header">'+
                            '<h2 class="modal-title">Rename ALT tag</h2>'+
                            '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
                            '</div>'+
                            '<div class="modal-body">'+
                            '<b>New ALT Tag</b>'+
                            '<input type="text" name="alt"  value="'+row.alt+'" style="width: 100%;">'+
                            '</div>'+
                            '<div class="modal-footer">'+
                                '<button type="button" class="btn btn-success bt_save" data-id='+row.post_id+'>'+
                                '<img src="<?php echo SPIP_URL .'assets/arrows32.gif'; ?>" class="save_item_'+row.post_id+'" style="display:none;">Save</button>'+
                            '</div>'+
                       '</div>'+
                    '</div>'+
                '</div>';
            }    
        }],
    });
    </script>
</html>
<?php
}
