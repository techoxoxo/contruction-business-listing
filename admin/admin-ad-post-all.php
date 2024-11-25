<?php
include "header.php";
?>

<?php if($footer_row['admin_ad_post_show'] != 1 || $admin_row['admin_ad_post_options'] != 1){
    header("Location: profile.php");
}
?>

<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst">All Ad Post Details</span>
                <div class="ud-cen-s2">
                    <h2>Ad Post details</h2>
                    <?php include "../page_level_message.php"; ?>
                    <div style="display: none" class="static-success-message log-suc"><p>Ad Post(s) has been Permanently Deleted!!! Please wait for automatic page refresh!! </p></div>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="Search this page..">
                    </div>
                    <a href="admin-ad-post-new-ads.php" class="db-tit-btn">Add new Ad Post</a>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Ad Post Name</th>
<!--                            <th>Rating</th>-->
                            <th>Views</th>
                            <th>Created by</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Preview</th>
                            <th><input type="checkbox" class="checkall" id="checkall"><input type="button" style="display: none" class='multi-del-btn' id='delete_record' value='Delete' ></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $si = 1;
                        foreach (getAllAdPost() as $ad_postrow) {

                            $ad_post_id = $ad_postrow['ad_post_id'];
                            $user_id = $ad_postrow['user_id'];

                            $user_details_row = getUser($user_id);

                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><img src="<?php if ($ad_postrow['gallery_image'] != NULL || !empty($ad_postrow['gallery_image'])) {
                                                echo "../ads/images/" . array_shift(explode(',', $ad_postrow['gallery_image']));
                                            } else {
                                                echo "../images/listings/" . $footer_row['listing_default_image'];
                                            } ?>"><?php echo $ad_postrow['ad_post_name']; ?>
                                    <span><?php echo dateFormatconverter($ad_postrow['ad_post_cdt']); ?></span></td>
<!--                                <td><span class="db-list-rat">--><?php //echo $star_rate; ?><!--</span></td>-->
                                <td><span
                                        class="db-list-rat"><?php echo ad_post_pageview_count($ad_postrow['ad_post_id']); ?></span>
                                </td>
                                <td><a href="<?php echo $PROFILE_URL.urlModifier($user_details_row['user_slug']); ?>"
                                       class="db-list-ststus"
                                       target="_blank"><?php echo $user_details_row['first_name'] ?></a></td>
                                <td><a href="admin-edit-ad-posts.php?code=<?php echo $ad_postrow['ad_post_code']; ?>"
                                       class="db-list-edit">Edit</a></td>
                                <td><a href="admin-delete-ad-posts.php?code=<?php echo $ad_postrow['ad_post_code']; ?>"
                                       class="db-list-edit">Delete</a></td>
                                <td><a href="<?php echo $AD_POST_URL.urlModifier($ad_postrow['ad_post_slug']); ?>" class="db-list-edit" target="_blank">Preview</a>
                                </td>
                                <td><input type='checkbox' class='delete_check' id='delcheck_<?php echo $ad_post_id; ?>' onclick='checkcheckbox();' value='<?php echo $ad_post_id; ?>'></td>
                            </tr>
                            <?php
                            $si++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="ad-pgnat">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
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
                { "bSortable": false, "aTargets": [ 8 ] }
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
                    data: {request: 10,deleteids_arr: deleteids_arr},
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