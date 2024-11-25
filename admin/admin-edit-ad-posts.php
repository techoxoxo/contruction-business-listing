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
            <section class="login-reg">
                <div class="container">
                    <div class="row">
                        <div class="login-main add-list">
                            <div class="log-bor">&nbsp;</div>
                            <span class="steps">Edit this Ad</span>
                            <div class="log">
                                <div class="login">
                                    <?php include "../page_level_message.php"; ?>
                                    <?php
                                    $ad_post_codea = $_GET['code'];
                                    $ad_post_a_row = getAdPost($ad_post_codea);

                                    ?>
                                    <form action="update_ad_post.php" class="ad_post_edit_form" id="ad_post_edit_form"
                                          name="ad_post_edit_form"
                                          method="POST" enctype="multipart/form-data">
                                        <input type="hidden" id="ad_post_id" value="<?php echo $ad_post_a_row['ad_post_id']; ?>"
                                               name="ad_post_id" class="validate">
                                        <input type="hidden" id="ad_post_code" value="<?php echo $ad_post_a_row['ad_post_code']; ?>"
                                               name="ad_post_code" class="validate">
                                        <input type="hidden" id="sub_category_id_old" value="<?php echo $ad_post_a_row['sub_category_id']; ?>"
                                               name="sub_category_id_old" class="validate">
                                        <input type="hidden" id="gallery_image_old"
                                               value="<?php echo $ad_post_a_row['gallery_image']; ?>" name="gallery_image_old"
                                               class="validate">
                                        <ul>
                                            <li>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <select name="user_id" required="required" class="form-control" id="user_id">
                                                                <option value="">Choose a user</option>
                                                                <?php
                                                                foreach (getAllUser() as $row) {
                                                                    ?>
                                                                    <option <?php if($ad_post_a_row['user_id'] == $row['user_id']){ echo "selected"; } ?>
                                                                        value="<?php echo $row['user_id']; ?>"><?php echo $row['first_name']; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group floating">
                                                            <input value="<?php echo $ad_post_a_row['ad_post_name']; ?>" type="text" name="ad_post_name" required="required"
                                                                   class="form-control floating" id="ad_post_name">
                                                            <label for="ad_post_name" class="tfix">Ad Post name
                                                                *</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <select onchange="getadpostSubCategories(this.value)" name="category_id"
                                                                    id="category_id" class="chosen-select form-control">
                                                                <option value="">Select Category</option>
                                                                <?php
                                                                    foreach (getAllAdPostCategories() as $categories_row) {
                                                                    ?>
                                                                    <option <?php if ($ad_post_a_row['category_id'] == $categories_row['category_id']) {
                                                                        echo "selected";
                                                                    } ?>
                                                                        value="<?php echo $categories_row['category_id']; ?>"><?php echo $categories_row['category_name']; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row ads-form-oth" id="ads-form-oth">
                                                    <div class="col-md-12">
                                                        <div class="ads-form-hig">
                                                            <h6>Higlights</h6>
                                                            <ul class="row" id="ad_post_sub_category_ul">
                                                                <?php
                                                                if(getCountAdPostSubCategoryCategory($ad_post_a_row['category_id']) != 0){
                                                                $sub_category_idArray = explode(',', $ad_post_a_row['sub_category_id']);
                                                                foreach ($sub_category_idArray as $cit_Array) {

                                                                    $ad_pos_highlight_row = getAdPostHighlightsHighlightId($cit_Array,$ad_post_a_row['ad_post_id']);

                                                                    $sub_category_id = $ad_pos_highlight_row['sub_category_id'];

                                                                    $sub_categories_row = getAdPostSubCategory($sub_category_id);

                                                                    ?>
                                                                    <li class="col-md-6">
                                                                        <div class="form-group floating">
                                                                            <input type="text" value="<?php echo $ad_pos_highlight_row['sub_category_value']; ?>" name="ad_post_sub_cat_<?php echo $sub_categories_row['sub_category_id']; ?>" class="form-control floating"
                                                                                   id="ad_post_sub_cat_<?php echo $sub_categories_row['sub_category_id']; ?>" >
                                                                            <label for="ad_post_sub_cat_<?php echo $sub_categories_row['sub_category_id']; ?>" class="tfix"><?php echo $sub_categories_row['sub_category_name']; ?></label>
                                                                        </div>
                                                                    </li>

                                                                    <?php
                                                                }

                                                                }else {
                                                                    ?>
                                                                    <li>No Highlights to Show!!</li>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group floating">
                                                            <input value="<?php echo $ad_post_a_row['ad_post_locality']; ?>" type="text" name="ad_post_locality"
                                                                   required="required"
                                                                   class="form-control floating" id="ad_post_locality">
                                                            <label for="ad_post_locality" class="tfix">Locality
                                                                *</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->

                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group floating">
                                                            <input value="<?php echo $ad_post_a_row['ad_post_address']; ?>" type="text" name="ad_post_address"
                                                                   required="required"
                                                                   class="form-control floating" id="ad_post_address">
                                                            <label for="ad_post_address" class="tfix">Address *</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <select onChange="getAdPostCities(this.value);" name="country_id" required="required"
                                                                    class="chosen-select form-control">
                                                                <option value=""><?php echo "Select your Country"; ?></option>
                                                                <?php
                                                                //Countries Query
                                                                $admin_countries = $footer_row['admin_countries'];
                                                                $catArray = explode(',', $admin_countries);
                                                                foreach ($catArray as $cat_Array) {

                                                                    foreach (getMultipleCountry($cat_Array) as $countries_row) {
                                                                        ?>
                                                                        <option <?php if ($ad_post_a_row['country_id'] == $countries_row['country_id']) {
                                                                            echo "selected";
                                                                        } ?>
                                                                            value="<?php echo $countries_row['country_id']; ?>"><?php echo $countries_row['country_name']; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <select data-placeholder="<?php echo "Select Your City"; ?>"
                                                                    name="city_id[]" id="city_id"
                                                                    multiple required="required"
                                                                    class="chosen-select form-control">
                                                                <?php
                                                                $cityArray = explode(',', $ad_post_a_row['city_id']);
                                                                foreach ($cityArray as $cit_Array) {
                                                                    ?>
                                                                    <option <?php
                                                                    echo "selected";

                                                                    $city_row = getCity($cit_Array);

                                                                    ?>
                                                                        value="<?php echo $city_row['city_id']; ?>"><?php echo $city_row['city_name']; ?></option>
                                                                    <?php
                                                                }
                                                                ?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group floating">
                                                            <input value="<?php echo $ad_post_a_row['ad_post_price']; ?>" type="text" name="ad_post_price"
                                                                   class="form-control floating" id="ad_post_price"
                                                                   required>
                                                            <label for="ad_post_price" class="tfix">Price*</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                <textarea class="form-control" required="required"
                                                          name="ad_post_description" id="ad_post_description"
                                                          placeholder="<?php echo "Ads Description"; ?>"><?php echo $ad_post_a_row['ad_post_description']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12 ads-gall">
                                                        <!--FILED END-->
                                                        <h4>Photo gallery</h4>
                                                        <div>
                                                            <input type="file" name="gallery_image[]"
                                                                   accept="image/*,.jpg,.jpeg,.png" multiple>
                                                        </div>
                                                        <!--FILED START-->
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="ad_post_contact_name"
                                                                   required="required" value="<?php echo $ad_post_a_row['ad_post_contact_name']; ?>"
                                                                   class="form-control"
                                                                   placeholder="Contact person*">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="ad_post_contact_mobile"
                                                                   required="required" value="<?php echo $ad_post_a_row['ad_post_contact_mobile']; ?>"
                                                                   class="form-control"
                                                                   placeholder="Phone number*">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->

                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="email" name="ad_post_contact_email"
                                                                   required="required" value="<?php echo $ad_post_a_row['ad_post_contact_email']; ?>"
                                                                   class="form-control"
                                                                   placeholder="Email id*">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                            </li>
                                        </ul>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" name="ad_post_submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                    </form>
                                    <div class="col-md-12">
                                        <a href="profile.php" class="skip">Go to user dashboard
                                            >></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</section>
<!-- END -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/imageuploadify.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="js/admin-custom.js"></script>
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script src="../js/select-opt.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('ad_post_description');
</script>

<script>
    //    $(document).ready(function () {
    //        $('input[type="file"]').imageuploadify();
    //    });

    function getadpostSubCategories(val) {
        $.ajax({
            type: "POST",
            url: "../ads/ad_post_sub_category_process.php",
            data: 'category_id=' + val,
            success: function (data) {
//                if(data = 0){
//                    $("#ads-form-oth").hide();
//                }else{
                $("#ad_post_sub_category_ul").html(data);
//                }

            }
        });
    }

    function getAdPostCities(val) {
        $.ajax({
            type: "POST",
            url: "../city_process.php",
            data: 'country_id=' + val,
            success: function (data) {
                $("#city_id").html(data);
                $('#city_id').trigger("chosen:updated");
            }
        });
    }
</script>
</body>

</html>