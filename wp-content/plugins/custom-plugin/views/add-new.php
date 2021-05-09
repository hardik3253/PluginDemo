<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <style>
        #frmPost label.error{color: red;}
    </style>
    <?php wp_enqueue_media(); ?>
</head>
<body>

<?php
    global $wpdb;

    // Insert operation

    // simple insert operation on page refresh
    // $wpdb->insert (
    //     "wp_custom_plugin",
    //     array(
    //         "name"=>"WordPress Developer",
    //         "email"=>"abc@gmail.com",
    //         "phone"=>"1234567890"
    //     )
    // );

    // $wpdb->query(
    //     $wpdb->prepare(
    //         "INSERT into wp_custom_plugin (name,email,phone) values('%s','%s','%s')","Hardik","hardik@gmail.com","3522441112"
    //     )
    // );

    // Update operation

    // simple update method which will when we refresh page
    // $wpdb->update(
    //     "wp_custom_plugin", // table name
    //     array( // contains updated value with column name
    //         "email"=>"jay@gmail.com"
    //     ),
    //     array( // where conditions which helps to update row
    //         "id"=>3
    //     )
    // );

    //second method $wpdb->query()
    // $wpdb->query(
    //     $wpdb->prepare(
    //         "Update wp_custom_plugin set email = '%s' where id = %d","hardik@gmail.com","2"
    //     )
    // );

    // Delete operation

    // first method
    // $wpdb->delete(
    //     "wp_custom_plugin",
    //     array(
    //         "id"=>3
    //     )
    // );

    // second method
    $wpdb->query(
        $wpdb->prepare(
            "Delete from wp_custom_plugin where id = %d",2
        )
    );
?>

<div class="container">
  <form action="#" id="frmPost">
    <div class="form-group">
      <label for="email">Name:</label>
      <input type="text" class="form-control" id="txtName" required name="txtName" placeholder="Enter Name">
    </div>
    <div class="form-group">
      <label for="pwd">Email:</label>
      <input type="email" class="form-control" id="txtEmail" required placeholder="Enter Email" name="txtEmail">
    </div>
    <div class="form-group">
      <label for="">Upload Image:</label>
      <input type="button" class="form-control" id="btnImage" name="btnImage" value="Upload Image">
      <img src="" id="getImage" style="height:100px;width:100px" alt=""/>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
