<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

if (file_exists('config/general_user_authentication.php')) {
    include('config/general_user_authentication.php');
}

if (file_exists('config/event_page_authentication.php')) {
    include('config/event_page_authentication.php');
}
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
<link rel="stylesheet" href="ads/ad-style.css">
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
                        <?php include "page_level_message.php"; ?>
                        <h4><?php echo $BIZBOOK['ADS-CRE-ADD']; ?></h4>
                        <form action="event_insert.php" class="event_form" id="event_form" name="event_form"
                              method="post" enctype="multipart/form-data">
                            <ul>
                                <li>
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group floating">
                                                <input type="text" name="event_name" required="required"
                                                       class="form-control floating" id="event_name">
                                                <label for="event_name" class="tfix"><?php echo $BIZBOOK['ADS-CRE-AD-NAME']; ?>*</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="category_id"
                                                        id="category_id" class="chosen-select form-control">
                                                    <option value=""><?php echo $BIZBOOK['SELECT_CATEGORY']; ?></option>
                                                    <?php
                                                    foreach (getAllEventCategories() as $categories_row) {
                                                        ?>
                                                        <option <?php if ($_SESSION['category_id'] == $categories_row['category_id']) {
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
                                    <div class="row ads-form-oth">
                                        <div class="col-md-12">
                                            <div class="ads-form-hig">
                                                <h6>Higlights</h6>
                                                <ul class="row">
                                                    <li class="col-md-6">
                                                        <div class="form-group floating">
                                                            <input type="text" class="form-control floating" id="hig_1" required>
                                                            <label for="hig_1" class="tfix">KMS run</label>
                                                        </div>
                                                    </li>
                                                    <li class="col-md-6">
                                                        <div class="form-group floating">
                                                            <input type="text" class="form-control floating" id="hig_2" required>
                                                            <label for="hig_2" class="tfix">Owners count</label>
                                                        </div>
                                                    </li>
                                                    <li class="col-md-6">
                                                        <div class="form-group floating">
                                                            <input type="text" class="form-control floating" id="hig_3" required>
                                                            <label for="hig_3" class="tfix">Year of manufacture</label>
                                                        </div>
                                                    </li>
                                                    <li class="col-md-6">
                                                        <div class="form-group floating">
                                                            <input type="text" class="form-control floating" id="hig_4" required>
                                                            <label for="hig_4" class="tfix">Engine type</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->

                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group floating">
                                                <input type="text" name="event_address" required="required"
                                                       class="form-control floating" id="event_address">
                                                <label for="event_address" class="tfix"><?php echo $BIZBOOK['ADS-CRE-AD-ADDRESS']; ?>*</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->

                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group floating">
                                                <input type="text" name="event_locali" required="required"
                                                       class="form-control floating" id="event_locali">
                                                <label for="event_locali" class="tfix">Locality *</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select data-placeholder="<?php echo $BIZBOOK['SELECT_YOUR_CITY']; ?>"
                                                        name="city_id[]" id="city_id" multiple required="required"
                                                        class="chosen-select form-control">
                                                    <option value=""><?php echo $BIZBOOK['SELECT_YOUR_CITY']; ?></option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group floating">
                                                <input type="text" class="form-control floating" id="ads_pri" required>
                                                <label for="ads_pri" class="tfix"><?php echo $BIZBOOK['ADS-CRE-AD-PRICE']; ?>*</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" required="required"
                                                          name="event_description" id="event_description"
                                                          placeholder="<?php echo $BIZBOOK['EVENT_DETAILS']; ?>"></textarea>
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
                                                <input type="file" name="gallery_image[]" accept="image/*,.jpg,.jpeg,.png" multiple>
                                            </div>
                                            <!--FILED START-->
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="event_contact_name" required="required"
                                                       class="form-control"
                                                       placeholder="<?php echo $BIZBOOK['CONTACT_PERSON']; ?>*">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="event_mobile" required="required"
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
                                                <input type="email" name="event_email" required="required"
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
                                    <button type="submit" name="event_submit"
                                            class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT']; ?></button>
                                </div>
                                <div class="col-md-12">
                                    <a href="dashboard" class="skip"><?php echo $BIZBOOK['GO_TO_USER_DASHBOARD']; ?>
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
include "footer.php";
?>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript">var webpage_full_link = '<?php echo $webpage_full_link;?>';</script>
<script type="text/javascript">var login_url = '<?php echo $LOGIN_URL;?>';</script>
<script type="text/javascript" src="js/imageuploadify.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom_validation.js"></script>
<script src="js/select-opt.js"></script>
<script src="admin/ckeditor/ckeditor.js"></script>
<script src="js/custom.js"></script>
<script>
    CKEDITOR.replace('event_description');
</script>
<script>
    function geteventCities(val) {
        $.ajax({
            type: "POST",
            url: "city_process.php",
            data: 'country_id=' + val,
            success: function (data) {
                $("#city_id").html(data);
                $('#city_id').trigger("chosen:updated");
            }
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('input[type="file"]').imageuploadify();
    })
</script>
<?php if ($footer_row['admin_google_paid_geo_location'] == 1) { ?>
    <script
            src="https://maps.googleapis.com/maps/api/js?key=<?php echo $footer_row['admin_geo_map_api']; ?>&callback=initAutocomplete&libraries=places&v=weekly"
            defer
    ></script>
    <script src="js/google-geo-location-event-add.js">
    </script>
<?php } ?>
</body>

</html>