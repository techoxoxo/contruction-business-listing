<?php
include "header.php";
?>

<?php if ($footer_row['admin_ad_post_show'] != 1 || $admin_row['admin_ad_post_options'] != 1) {
    header("Location: profile.php");
}
?>

<style>
.login-main.add-list{width:100%}
.add-list.add-ncate ul li{border:0;padding:0;position:relative}
.hig-itm-remo{position:absolute;right:6px;top:0;height:100%;cursor:pointer}
.hig-itm-remo i{padding-top:9px}
</style>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst">AD Category</span>
                <div class="ud-cen-s2 hcat-cho">
                    <h2>All Category</h2>
                    <?php include "../page_level_message.php"; ?>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="Search this page..">
                    </div>
                    <a href="#" data-toggle="modal" data-target="#category-add" class="db-tit-btn">Add New Ad
                        Category</a>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Views</th>
                            <th>Total <br> Ad posts</th>
                            <th>Higlights</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $si = 1;
                        foreach (getAllAdPostCategories() as $row) {

                            $category_id = $row['category_id'];

                            $category_listing_count = getCountCategoryAdPost($category_id);

                            $sub_category_qry = getCategoryAdPostSubCategories($category_id);

                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><?php echo $row['category_name']; ?>
                                    <span>Created on: <?php echo dateFormatconverter($row['category_cdt']); ?></span>
                                </td>
                                <td><span class="db-list-rat">298</span></td>
                                <td><span class="db-list-ststus"><?php echo $category_listing_count; ?></span></td>
                                <td>
                                    <div class="ad-hig">
                                        <?php
                                        foreach ($sub_category_qry as $sub_category_row) {
                                            ?>
                                            <span><?php echo $sub_category_row['sub_category_name']; ?></span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown dd_new">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                            <i class="material-icons">more_vert</i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                               data-target="#category-edit<?php echo $category_id; ?>">Edit</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                               data-target="#category-delete<?php echo $category_id; ?>">Delete</a>
                                            <a class="dropdown-item" href="<?php echo $webpage_full_link.'all-ads/'.urlModifier($row['category_slug']); ?>" target="_blank">Preview</a>
                                        </div>
                                    </div>
                                </td>
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

<!-- START -->
<section>
    <div class="pop-table">
        <!-- The Modal -->
        <div class="modal fade" id="category-add">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="login-main add-list add-ncate">
                        <div class="log-bor">&nbsp;</div>
                        <span class="udb-inst">Add new Category details</span>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="inn">
                            <div class="log log-1">
                                <div class="login">
                                    <h4>Add Category</h4>
                                    <?php include "../page_level_message.php"; ?>
                                    <span class="add-list-add-btn adhig-add-btn" data-toggle="tooltip"
                                          title="Click to create additional Sub Category field">+</span>
                                    <span class="add-list-rem-btn scat-rem-btn" data-toggle="tooltip"
                                          title="Click to remove Sub Category field">-</span>
                                    <div id="ad_post_category_form_success" class="log" style="display: none;"><p>
                                            Category(s) has been Added Successfully!!!</p>
                                    </div>
                                    <div id="ad_post_category_form_fail" class="log" style="display: none;"><p>Oops!!
                                            Something Went Wrong Try Later!!!</p>
                                    </div>
                                    <div id="ad_post_category_form_same" class="log" style="display: none;"><p>The Given
                                            Category name is Already Exist Try Other!!!</p>
                                    </div>
                                    <form name="ad_post_category_form" id="ad_post_category_form" method="post"
                                          enctype="multipart/form-data"
                                          class="ad_post_category_form cre-dup-form cre-dup-form-show">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="category_name" class="form-control"
                                                           placeholder="Category name *" required="required">
                                                </div>
                                            </div>
                                            <div class="ads-form-hig">
                                                <h6>Category Higlights</h6>
                                                <ul class="col-md-12">
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <input type="text" name="sub_category_name[]"
                                                                           class="form-control"
                                                                           placeholder="Higlights *">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <button type="submit" id="category_submit" name="category_submit"
                                                    class="btn btn-primary">
                                                Submit
                                            </button>
                                    </form>
                                    <div class="col-md-12">
                                        <a href="admin-ad-post-all-category.php" class="skip">Go to All Category >></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--- END --->
    </div>
    <!--    //Edit Pop up box starts-->
    <?php
    $si = 1;
    foreach (getAllAdPostCategories() as $row) {

        $category_id = $row['category_id'];

        $sub_category_qry = getCategoryAdPostSubCategories($category_id);

        ?>
        <div class="pop-table">
            <!-- The Modal -->
            <div class="modal fade" id="category-edit<?php echo $category_id; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="login-main add-list add-ncate">
                            <div class="log-bor">&nbsp;</div>
                            <span class="udb-inst">Edit This Category details</span>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="inn">
                                <div class="log log-1">
                                    <div class="login">
                                        <h4>Edit Category</h4>
                                        <?php include "../page_level_message.php"; ?>
                                        <span class="add-list-add-btn adhig-add-btn" data-toggle="tooltip"
                                              title="Click to create additional Sub Category field">+</span>
                                        <span class="add-list-rem-btn scat-rem-btn" data-toggle="tooltip"
                                              title="Click to remove Sub Category field">-</span>
                                        <div id="edit_category_form_success<?php echo $category_id; ?>" class="log"
                                             style="display: none;"><p>Category(s) has been Updated Successfully!!!</p>
                                        </div>
                                        <div id="edit_category_form_fail<?php echo $category_id; ?>" class="log"
                                             style="display: none;"><p>Oops!! Something Went Wrong Try Later!!!</p>
                                        </div>
                                        <div id="edit_category_form_same<?php echo $category_id; ?>" class="log"
                                             style="display: none;"><p>The Given Category name is Already Exist Try
                                                Other!!!</p>
                                        </div>
                                        <form name="edit_category_form"
                                              id="edit_category_form<?php echo $category_id; ?>" method="post"
                                              enctype="multipart/form-data"
                                              class="cre-dup-form cre-dup-form-show">
                                            <input type="hidden" name="category_id"
                                                   value="<?php echo $category_id; ?>"/>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" value="<?php echo $row['category_name']; ?>"
                                                               name="category_name" class="form-control"
                                                               placeholder="Category name *" required>
                                                    </div>
                                                </div>
                                                <div class="ads-form-hig">
                                                    <h6>Category Higlights</h6>
                                                    <ul class="col-md-12">
                                                        <?php
                                                        $category_listing_count = getCountAdPostSubCategoryCategory($category_id);
                                                        if ($category_listing_count > 0) {
                                                            foreach ($sub_category_qry as $sub_category_row) {
                                                                ?>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       value="<?php echo $sub_category_row['sub_category_name']; ?>"
                                                                                       name="sub_category_id<?php echo $sub_category_row['sub_category_id']; ?>"
                                                                                       class="form-control"
                                                                                       placeholder="Higlights *">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <input type="text"
                                                                                   name="sub_category_name[]"
                                                                                   class="form-control"
                                                                                   placeholder="Highlights *">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>

                                                <button type="submit"
                                                        id="edit_category_submit<?php echo $category_id; ?>"
                                                        name="edit_category_submit"
                                                        class="btn btn-primary">
                                                    Save Changes
                                                </button>
                                        </form>
                                        <div class="col-md-12">
                                            <a href="admin-ad-post-all-category.php" class="skip">Go to All Category
                                                >></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--- END --->
        </div>
        <?php
    }
    ?>
    <!--    //Edit Pop up box ends-->

    <!--    //Delete Pop up box starts-->
    <?php
    $si = 1;
    foreach (getAllAdPostCategories() as $row) {

        $category_id = $row['category_id'];

        $sub_category_qry = getCategoryAdPostSubCategories($category_id);

        ?>
        <div class="pop-table">
            <!-- The Modal -->
            <div class="modal fade" id="category-delete<?php echo $category_id; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="login-main add-list add-ncate">
                            <div class="log-bor">&nbsp;</div>
                            <span class="udb-inst">Delete This Category details</span>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="inn">
                                <div class="log log-1">
                                    <div class="login">
                                        <h4>Delete Category</h4>
                                        <?php include "../page_level_message.php"; ?>

                                        <div id="delete_category_form_success<?php echo $category_id; ?>" class="log"
                                             style="display: none;"><p>Category(s) has been Permanently Deleted!!!</p>
                                        </div>
                                        <div id="delete_category_form_fail<?php echo $category_id; ?>" class="log"
                                             style="display: none;"><p>Oops!! Something Went Wrong Try Later!!!</p>
                                        </div>
                                        <div id="delete_category_form_same<?php echo $category_id; ?>" class="log"
                                             style="display: none;"><p>The Given Category name is Already Exist Try
                                                Other!!!</p>
                                        </div>
                                        <form name="delete_category_form"
                                              id="delete_category_form<?php echo $category_id; ?>" method="post"
                                              enctype="multipart/form-data"
                                              class="cre-dup-form cre-dup-form-show">
                                            <input type="hidden" name="category_id"
                                                   value="<?php echo $category_id; ?>"/>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" value="<?php echo $row['category_name']; ?>"
                                                               name="category_name" class="form-control"
                                                               placeholder="Category name *">
                                                    </div>
                                                </div>
                                                <div class="ads-form-hig">
                                                    <h6>Category Higlights</h6>
                                                    <ul class="col-md-12">
                                                        <?php
                                                        $category_listing_count = getCountAdPostSubCategoryCategory($category_id);
                                                        if ($category_listing_count > 0) {
                                                            foreach ($sub_category_qry as $sub_category_row) {
                                                                ?>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <input type="text" readonly="readonly"
                                                                                       value="<?php echo $sub_category_row['sub_category_name']; ?>"
                                                                                       name="sub_category_name[]"
                                                                                       class="form-control"
                                                                                       placeholder="Higlights *">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <input type="text" readonly="readonly"
                                                                                   name="sub_category_name[]"
                                                                                   class="form-control"
                                                                                   placeholder="Higlights *">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>

                                                <button type="submit"
                                                        id="delete_category_submit<?php echo $category_id; ?>"
                                                        name="delete_category_submit"
                                                        class="btn btn-primary">
                                                    Delete
                                                </button>
                                        </form>
                                        <div class="col-md-12">
                                            <a href="admin-ad-post-all-category.php" class="skip">Go to All Category
                                                >></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--- END --->
        </div>
        <?php
    }
    ?>
    <!--    //Delete Pop up box ends-->

</section>
<!-- END -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/select-opt.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<script src="js/admin-custom.js"></script>
<script src="../js/select-opt.js"></script>
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#pg-resu').DataTable({
            "columnDefs": [
                {"bSortable": false, "aTargets": [8]}
            ]
        });
    });
    $(document).on("click", '.hig-itm-remo', function(event) { 
        $(this).parent("li").remove();
    });
</script>
<script>
    $(function () {

        $('#category_submit').on('click', function (e) {

            $("#ad_post_category_form").validate({
                rules: {
                    category_name: {required: true}


                },
                messages: {
                    category_name: {required: "Category Name is Required"}
                },

                submitHandler: function (form) { // for demo
                    //form.submit();
//                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "insert_ad_post_category.php",
                        data: $('form.ad_post_category_form').serialize(),
                        success: function (html) {
                            // alert(html);
                            if (html == 4) {
                                $("#ad_post_category_form_fail").show().delay(2000).fadeOut();
                                $("#ad_post_category_form")[0].reset();
                            } else {
                                if (html == 1) {
                                    $("#ad_post_category_form_same").show().delay(2000).fadeOut();
                                    $("#ad_post_category_form")[0].reset();
                                } else {
                                    $("#ad_post_category_form_success").show().delay(2000).fadeOut();
                                    $("#ad_post_category_form")[0].reset();
                                    setTimeout(function () {// wait for 5 secs(2)
                                        location.reload(); // then reload the page.(3)
                                    }, 3000);
                                }
                            }
                        },
                        error: function () {
                            alert('Error');
                        }
                    });
                    return false;
                }
            });
        });
    });
</script>
<!--//Edit ajax call starts-->
<?php
$si = 1;
foreach (getAllAdPostCategories() as $row) {

    $category_id = $row['category_id'];

    ?>
    <script>
        $(function () {

            $('#edit_category_submit<?php echo $category_id; ?>').on('click', function (e) {

                $("#edit_category_form<?php echo $category_id; ?>").validate({
                    rules: {
                        category_name: {required: true}
                    },
                    messages: {
                        category_name: {required: "Category Name is Required"}
                    },

                    submitHandler: function (form) { // for demo
                        //form.submit();
//                    e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "update_ad_post_category.php",
                            data: $('#edit_category_form<?php echo $category_id; ?>').serialize(),
                            success: function (html) {
                                 //alert(html);
                                if (html == 4) {
                                    $("#edit_category_form_fail<?php echo $category_id; ?>").show().delay(2000).fadeOut();
                                    $("#edit_category_form<?php echo $category_id; ?>")[0].reset();
                                } else {
                                    if (html == 1) {
                                        $("#edit_category_form_same<?php echo $category_id; ?>").show().delay(2000).fadeOut();
                                        $("#edit_category_form<?php echo $category_id; ?>")[0].reset();
                                    } else {
                                        $("#edit_category_form_success<?php echo $category_id; ?>").show().delay(2000).fadeOut();
                                        $("#edit_category_form<?php echo $category_id; ?>")[0].reset();
                                        setTimeout(function () {// wait for 5 secs(2)
                                            location.reload(); // then reload the page.(3)
                                        }, 3000);
                                    }
                                }
                            },
                            error: function () {
                                alert('Error');
                            }
                        });
                        return false;
                    }
                });
            });
        });
    </script>
    <?php
}
?>
<!--//Edt ajax call ends-->
<!--//Delete ajax call starts-->
<?php
$si = 1;
foreach (getAllAdPostCategories() as $row) {

    $category_id = $row['category_id'];

    ?>
    <script>
        $(function () {

            $('#delete_category_submit<?php echo $category_id; ?>').on('click', function (e) {

                $("#delete_category_form<?php echo $category_id; ?>").validate({
                    rules: {
                        category_name: {required: false}
                    },
                    messages: {
                        category_name: {required: "Category Name is Required"}
                    },

                    submitHandler: function (form) { // for demo
                        //form.submit();
//                    e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "trash_ad_post_category.php",
                            data: $('#delete_category_form<?php echo $category_id; ?>').serialize(),
                            success: function (html) {
                                // alert(html);
                                if (html == 4) {
                                    $("#delete_category_form_fail<?php echo $category_id; ?>").show().delay(2000).fadeOut();
                                    $("#delete_category_form<?php echo $category_id; ?>")[0].reset();
                                } else {
                                    if (html == 1) {
                                        $("#delete_category_form_same<?php echo $category_id; ?>").show().delay(2000).fadeOut();
                                        $("#delete_category_form<?php echo $category_id; ?>")[0].reset();
                                    } else {
                                        $("#delete_category_form_success<?php echo $category_id; ?>").show().delay(2000).fadeOut();
                                        $("#delete_category_form<?php echo $category_id; ?>")[0].reset();
                                        setTimeout(function () {// wait for 5 secs(2)
                                            location.reload(); // then reload the page.(3)
                                        }, 3000);
                                    }
                                }
                            },
                            error: function () {
                                alert('Error');
                            }
                        });
                        return false;
                    }
                });
            });
        });
    </script>
    <?php
}
?>
<!--//Delete ajax call ends-->
</body>

</html>