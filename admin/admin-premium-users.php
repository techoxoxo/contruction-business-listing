<?php
include "header.php";
?>

<?php if($admin_row['admin_user_options'] != 1){
    header("Location: profile.php");
}
?>

    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
				<div class="log-bor">&nbsp;</div>
				<span class="udb-inst"><?php echo $name[2]['name']; ?> User Details</span>
                <div class="ud-cen-s2">
                    <h2><?php echo $name[2]['name']; ?> Users - <?php echo AddingZero_BeforeNumber(getCountServiceUser(3)); ?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <div style="display: none" class="static-success-message log-suc"><p>User(s) has been Permanently Deleted!!! Please wait for automatic page refresh!! </p></div>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="Search this page..">
                    </div>
                    <a href="admin-add-new-user.php" class="db-tit-btn">Add new user</a>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>User Name</th>
                            <th>User ID</th>
                            <th>Plan type</th>
                            <th>Expiry on</th>
                            <th>Amount</th>
                            <th>User Type</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Preview</th>
                            <th>More</th>
                            <th><input type="checkbox" class="checkall" id="checkall"><input type="button" style="display: none" class='multi-del-btn' id='delete_record' value='Delete' ></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $si = 1;
                        $service_provider = "Service provider";
                        $user_plan = 3;

                        foreach (getAllServiceUser($service_provider, $user_plan) as $row) {

                            $session_user_id = $row['user_id'];
                            $user_plan = $row['user_plan'];

                            $plan_type_row = getPlanType($user_plan);


                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><img src="../images/user/<?php if(($row['profile_image'] == NULL) || empty($row['profile_image'])){  echo "1.jpg";}else{ echo $row['profile_image']; } ?>" alt=""><?php echo $row['first_name']; ?><span><?php echo $row['email_id']; ?></span> <span>Join: <?php  echo dateFormatconverter($row['user_cdt']); ?></span>
                                </td>
                                <td><?php echo $row['user_code']; ?> </td>
                                <td><span class="db-list-rat"><?php if($user_plan == 0){ echo "Free"; }else{echo $plan_type_row['plan_type_name'];} ?></span></td>

                                <?php
                                //To calculate the expiry date from user created date starts

                                $start_date_timestamp = strtotime($row['user_cdt']);
                                $plan_type_duration = $plan_type_row['plan_type_duration'];

                                $expiry_date_timestamp = strtotime("+$plan_type_duration months", $start_date_timestamp);

                                $expiry_date = date("Y-m-d h:i:s", $expiry_date_timestamp);

                                //To calculate the expiry date from user created date ends
                                ?>
                                
                                <td><span class="db-list-ststus"><?php if($user_plan == 0){ echo "N/A"; }else{echo dateFormatconverter($expiry_date);} ?></span></td>
                                <td><span class="db-list-rat"><?php if($footer_row['currency_symbol_pos']== 1){ echo $footer_row['currency_symbol']; } ?> <?php if($user_plan == 0){ echo "0"; }else{echo $plan_type_row['plan_type_price'];} ?><?php if($footer_row['currency_symbol_pos']== 2){ echo $footer_row['currency_symbol']; } ?></span></td>
                                <td><?php echo $row['user_type']; ?> </td>
                                <td><a href="admin-my-profile-edit.php?row=<?php echo $session_user_id; ?>&path=7" class="db-list-edit">Edit</a></td>
                                <td><a href="admin-my-profile-delete.php?row=<?php echo $session_user_id; ?>&path=7" class="db-list-edit">Delete</a></td>
                                <td><a href="<?php echo $PROFILE_URL.urlModifier($row['user_slug']); ?>" class="db-list-edit" target="_blank">Preview</a></td>
                                <td><a href="admin-user-full-details.php?row=<?php echo $session_user_id; ?>" class="db-list-edit">More</a></td>
                                <td><input type='checkbox' class='delete_check' id='delcheck_<?php echo $session_user_id; ?>' onclick='checkcheckbox();' value='<?php echo $session_user_id; ?>'></td>
                            </tr>
                            <?php
                            $si++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            </div>
        </div>
    </section>
    <!-- END -->    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="js/admin-custom.js"></script>
<script>
    $(document).ready(function () {
        $('#pg-resu').DataTable({
            "columnDefs": [
                { "bSortable": false, "aTargets": [ 11 ] }
            ]
        });
    });
</script>

<script>
    $('#delete_record').click(function(){

        var deleteids_arr = [];
        // Read all checked checkboxes
        $("input:checkbox[class=delete_check]:checked").each(function () {
            deleteids_arr.push($(this).val());
        });

        // Check checkbox checked or not
        if(deleteids_arr.length > 0){

            // Confirm alert
            var confirmdelete = confirm("Do you really want to Delete records?");
            if (confirmdelete == true) {
                $.ajax({
                    url: 'multiple_delete_users.php',
                    type: 'post',
                    data: {request: 2,deleteids_arr: deleteids_arr},
                    success: function(response){
                        $('.static-success-message').css("display", "block");
                        window.setTimeout(function(){location.reload()},3000)
                    }
                });
            }
        }
    });
</script>
</body>

</html>