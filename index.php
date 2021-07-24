<?php
include "config.php";
?>
<!doctype html>
<html>
    <head>
        <title>Dynamically load content in Bootstrap Modal with AJAX</title>
        <link href='bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
        <!-- Script -->
        <script src='jquery-3.1.1.min.js' type='text/javascript'></script>
        <script src='bootstrap/js/bootstrap.min.js' type='text/javascript'></script>
    </head>
    <body >
        <div class="container" >
            <!-- Modal -->
            <div class="modal fade" id="empModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">User Info</h4>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

            <br/>
            <table id="myTable" border="1">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Sr. No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <?php
                $query = "select * from employee";
                $result = mysqli_query($con,$query);
                while($row = mysqli_fetch_array($result)){
                    $id = $row['id'];
                    $name = $row['emp_name'];
                    $email = $row['email'];

                ?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $name;?></td>
                    <td><?php echo $email;?></td>
                    <td><button data-id='<?php echo $id;?>' class='userinfo'>view</button></td>
                 </tr>
                <?php
                }
                ?>
            </table>
            <script type='text/javascript'>
            $(document).ready(function(){

                $('.userinfo').click(function(){

                    var userid = $(this).data('id');

                    // AJAX request
                    $.ajax({
                        url: 'ajaxfile.php',
                        type: 'post',
                        data: {userid: userid},
                        success: function(response){
                            // Add response in Modal body
                            $('.modal-body').html(response);

                            // Display Modal
                            $('#empModal').modal('show');
                        }
                    });
                });
            });
            </script>
        </div>
    </body>
</html>
