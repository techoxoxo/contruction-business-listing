<?php
include "ads-config-info.php";
include "../header.php";

if (file_exists('../config/user_authentication.php')) {
    include('../config/user_authentication.php');
}

if (file_exists('../config/general_user_authentication.php')) {
    include('../config/general_user_authentication.php');
}

//if (file_exists('../config/ads_page_authentication.php')) {
//    include('../config/ads_page_authentication.php');
//}

//To check the event count with current plan starts

$plan_type_event_count = $user_plan_type['plan_type_event_count'];
$event_count_user = getCountUserEvent($_SESSION['user_id']);

if ($event_count_user >= $plan_type_event_count) {

    $_SESSION['status_msg'] = $BIZBOOK['EVENTS_LIMIT_EXCEED_MESSAGE'];

    header('Location: db-events');
    exit();
}
//To check the event count with current plan ends

?>
<link rel="stylesheet" href="../ads/ad-style.css">
<!-- START -->
<!--PRICING DETAILS-->
<section class="<?php if ($footer_row['admin_language'] == 2) {
    echo "lg-arb";
} ?> login-reg">
    <div class="container">
        <div class="row">
            <div class="login-main add-list">
                <div class="log-bor">&nbsp;</div>
                <span class="steps"><?php echo $BIZBOOK['ADS-CRE-ADD-NEW']; ?></span>
                <div class="log">
                    <div class="login">
                        <?php include "../page_level_message.php"; ?>
                        <h4><?php echo $BIZBOOK['ADS-CRE-EDIT']; ?></h4>
                        <?php
                        $ad_post_codea = $_GET['code'];
                        $ad_post_a_row = getAdPost($ad_post_codea);

                        ?>
                        <form action="ads_trash.php" class="ad_post_form" id="ad_post_form"
                              name="ad_post_form"
                              method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="ad_post_id" value="<?php echo $ad_post_a_row['ad_post_id']; ?>"
                                   name="ad_post_id" class="validate">
                            <input type="hidden" id="ad_post_code" value="<?php echo $ad_post_a_row['ad_post_code']; ?>"
                                   name="ad_post_code" class="validate">
                            <input type="hidden" id="gallery_image_old"
                                   value="<?php echo $ad_post_a_row['gallery_image']; ?>" name="gallery_image_old"
                                   class="validate">
                            <ul>
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group floating">
                                                <input readonly="readonly" value="<?php echo $ad_post_a_row['ad_post_name']; ?>" type="text" name="ad_post_name" required="required"
                                                       class="form-control floating" id="ad_post_name">
                                                <label for="ad_post_name" class="tfix"><?php echo $BIZBOOK['ADS-CRE-AD-NAME']; ?>*</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select disabled="disabled" onchange="getadpostSubCategories(this.value)" name="category_id"
                                                         id="category_id" class="chosen-select form-control">
                                                    <option value=""><?php echo $BIZBOOK['SELECT_CATEGORY']; ?></option>
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
                                                                    <input readonly="readonly" type="text" value="<?php echo $ad_pos_highlight_row['sub_category_value']; ?>" name="ad_post_sub_cat_<?php echo $sub_categories_row['sub_category_id']; ?>" class="form-control floating"
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
                                                <input readonly="readonly" value="<?php echo $ad_post_a_row['ad_post_locality']; ?>" type="text" name="ad_post_locality"

                                                       class="form-control floating" id="ad_post_locality">
                                                <label for="ad_post_locality" class="tfix">Locality*</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->

                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group floating">
                                                <input readonly="readonly" value="<?php echo $ad_post_a_row['ad_post_address']; ?>" type="text" name="ad_post_address"

                                                       class="form-control floating" id="ad_post_address">
                                                <label for="ad_post_address" class="tfix"><?php echo $BIZBOOK['ADS-CRE-AD-ADDRESS']; ?>*</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select disabled="disabled" onChange="getAdPostCities(this.value);" name="country_id"  id="country_id"
                                                        class="chosen-select form-control">
                                                    <option value=""><?php echo $BIZBOOK['SELECT_YOUR_COUNTRY']; ?></option>
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select disabled="disabled" data-placeholder="<?php echo $BIZBOOK['SELECT_YOUR_CITY']; ?>" name="city_id[]" id="city_id" multiple
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
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group floating">
                                                <input readonly="readonly"  value="<?php echo $ad_post_a_row['ad_post_price']; ?>" type="text" name="ad_post_price"
                                                       class="form-control floating" id="ad_post_price"
                                                       required>
                                                <label for="ad_post_price" class="tfix"><?php echo $BIZBOOK['ADS-CRE-AD-PRICE']; ?>*</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea readonly="readonly"  class="form-control"
                                                          name="ad_post_description" id="ad_post_description"
                                                          placeholder="<?php echo "Ads Description"; ?>"><?php echo $ad_post_a_row['ad_post_description']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input readonly="readonly" type="text" name="ad_post_contact_name"

                                                       class="form-control" value="<?php echo $ad_post_a_row['ad_post_contact_name']; ?>"
                                                       placeholder="<?php echo $BIZBOOK['CONTACT_PERSON']; ?>*">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input readonly="readonly"  type="text" name="ad_post_contact_mobile"
                                                        value="<?php echo $ad_post_a_row['ad_post_contact_mobile']; ?>"
                                                       class="form-control"
                                                       placeholder="<?php echo $BIZBOOK['CONTACT_PHONE_NUMBER']; ?>*">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->

                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input readonly="readonly"  type="email" name="ad_post_contact_email"
                                                        value="<?php echo $ad_post_a_row['ad_post_contact_email']; ?>"
                                                       class="form-control"
                                                       placeholder="<?php echo $BIZBOOK['CONTACT_EMAIL_ID']; ?>*">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                </li>
                            </ul>
                            <!--FILED START-->
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="ad_post_submit"
                                            class="btn btn-primary"><?php echo $BIZBOOK['DELETE']; ?></button>
                                </div>
                                <div class="col-md-12">
                                    <a href="../dashboard" class="skip"><?php echo $BIZBOOK['GO_TO_USER_DASHBOARD']; ?>
                                        >></a>
                                </div>
                            </div>
                            <!--FILED END-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END PRICING DETAILS-->

<?php
include "../footer.php";
?>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo $slash; ?>js/jquery.min.js"></script>
<script src="<?php echo $slash; ?>js/popper.min.js"></script>
<script src="<?php echo $slash; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $slash; ?>js/jquery-ui.js"></script>
<script type="text/javascript">var webpage_full_link = '<?php echo $webpage_full_link;?>';</script>
<script type="text/javascript">var login_url = '<?php echo $LOGIN_URL;?>';</script>
<script type="text/javascript" src="<?php echo $slash; ?>js/imageuploadify.min.js"></script>
<script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script>
<!--<script src="--><?php //echo $slash; ?><!--js/custom_validation.js"></script>-->
<script src="<?php echo $slash; ?>js/select-opt.js"></script>
<script src="<?php echo $slash; ?>admin/ckeditor/ckeditor.js"></script>
<script src="<?php echo $slash; ?>js/custom.js"></script>
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
            url: "ad_post_sub_category_process.php",
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
<script type="text/javascript">
    //    $(document).ready(function() {
    //        $('input[type="file"]').imageuploadify();
    //    })
</script>
<?php if ($footer_row['admin_google_paid_geo_location'] == 1) { ?>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo $footer_row['admin_geo_map_api']; ?>&callback=initAutocomplete&libraries=places&v=weekly"
        defer
    ></script>
    <script src="../admin/js/google-geo-location-event-add.js">
    </script>
<?php } ?>
</body>

</html>