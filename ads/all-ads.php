<?php
include "ads-config-info.php";
include "../header.php";

if ($footer_row['admin_ad_post_show'] != 1) {
    header("Location: " . $webpage_full_link . "dashboard");
}

?>
<link rel="stylesheet" href="<?php echo $slash; ?>ads/ad-style.css">

<?php

if (isset($_GET['category']) && !empty($_REQUEST['category'])) {

    $category_search_slug1 = str_replace('.php', '', $_GET['category']);

    $category_search_slug = str_replace('-', ' ', $category_search_slug1);

    $cat_search_row = getSlugAdPostCategory($category_search_slug);  //Fetch Category Id using category name

    $category_id = $cat_search_row['category_id'];

    $category_slug = $cat_search_row['category_slug'];

    $category_search_name = $cat_search_row['category_name'];

    $category_search_query = "AND FIND_IN_SET($category_id, T1.category_id)";

}

//Event Location Check starts
if (isset($_REQUEST['city']) && !empty($_REQUEST['city'])) {

    $get_city = $_REQUEST['city'];
    $city1 = str_replace('-', ' ', $get_city);

    $city_search_row = getCityName($city1);  //Fetch City Id using City name

    $get_city1 = $city_search_row['city_id'];

    if (strstr($get_city1, ',')) {
        $data56 = explode(',', $get_city1);
        $sub_cat_array2 = array();
        foreach ($data56 as $c) {
            $sub_cat_array2[] = "FIND_IN_SET($c,T1.city_id)";

        }
        $events_location_search_query = 'AND (' . implode(' OR ', $sub_cat_array2) . ')';
    } else {
        $events_location_search_query = 'AND (FIND_IN_SET(' . $get_city1 . ',T1.city_id))';

    }
}

//Calendar order starts
if (isset($_REQUEST['calendar-date']) && !empty($_REQUEST['calendar-date'])  && $_REQUEST['calendar-date'] !== "[object Object]") {

    $get_calendar_date = $_REQUEST['calendar-date'];

    if ($get_calendar_date != '') {
        $phpdate = strtotime($get_calendar_date);
        $new_date = date("Y-m-d", $phpdate);

        $ad_post_sort_by_query = 'AND DATE(T1.ad_post_cdt) = "'.$new_date.'"';
    }

}else {

//Event order starts
    if (isset($_REQUEST['sort_by']) && !empty($_REQUEST['sort_by'])) {

        $get_sort_by = $_REQUEST['sort_by'];

        if ($get_sort_by != '') {

            if ($get_sort_by == 'recent') {
                $ad_post_sort_by_query = 'AND T1.ad_post_cdt >= NOW() - INTERVAL 30 DAY
                AND T1.ad_post_cdt  < NOW()';

            } elseif ($get_sort_by == 'today') {
                $ad_post_sort_by_query = 'AND T1.ad_post_cdt = CURDATE()';

            } elseif ($get_sort_by == 'newest') {
                $ad_post_sort_by_query = 'ORDER BY T1.ad_post_id DESC';

            } elseif ($get_sort_by == 'oldest') {
                $ad_post_sort_by_query = 'ORDER BY T1.ad_post_id ASC';
            }
        }

    }
//    else {
//        $get_sort_by = 'upcoming';
//        $ad_post_sort_by_query = 'AND T1.ad_post_cdt >= NOW()';
//    }
}

//$event_sort_by_search_query = 'GROUP BY T2.event_id';
//$event_start_search_query = ', T2.event_id, COUNT(T2.event_id) as top';
//$event_end_search_query = "INNER JOIN " . TBL . "page_views AS T2 ON T1.event_id = T2.event_id";

?>


<!-- START -->
<section class="<?php if ($footer_row['admin_language'] == 2) {
    echo "lg-arb";
} ?> event-body ad-modu-com">
    <div class="container">
        <div class="blog-head-inn">
            <h1><?php if (isset($_GET['category']) && !empty($_REQUEST['category'])) {

                echo $category_search_name;
                }if (isset($_REQUEST['city']) && !empty($_REQUEST['city'])) {
                    echo " in ".$city1;
                }
                ?>
            </h1>
<!--            <h1>--><?php //echo $BIZBOOK['ADS-ALL-BAN-TIT']; ?><!--</h1>-->
<!--            <p>--><?php //echo $BIZBOOK['ADS-ALL-BAN-SUBTIT']; ?><!--</p>-->
            <div class="ban-search">
                <form>
                    <ul>
                        <li class="sr-sea">
                            <input type="text" id="ad-post-search" class="autocomplete"
                                   placeholder="<?php echo $BIZBOOK['ADS_POST_SEARCH_ADS_POST_PLACEHOLDER']; ?>">
                        </li>
                        <li class="sr-cit">
                            <select id="city" name="city" class="city chosen-select">
                                <option value=""><?php echo 'All City'; ?></option>
                                <?php
                                foreach (getAllAdPostCities() as $city_listrow) {

                                    if (strpos($city_listrow['city_id'], ',') !== false) {
                                        $city_id_array = array_unique(explode(',', $city_listrow['city_id']));
                                        foreach ($city_id_array as $places) {
                                            $cityrow = getCity($places);

                                            $hyphend_city_name = urlModifier($cityrow['city_name']);

                                            ?>
                                            <option <?php if ($get_city === $hyphend_city_name) {
                                                echo 'selected';
                                            } ?>
                                                    value="<?php echo $hyphend_city_name; ?>"><?php echo $cityrow['city_name']; ?></option>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </li>
                        <li class="sr-cate">
                            <select name="cat_check" id="cat_check" class="cat_check chosen-select form-control">
                                <option value=""><?php echo 'All Category'; ?></option>
                                <?php
                                foreach (getAllAdPostCategories() as $categories_row) {
                                    ?>
                                    <option <?php if ($category_slug == $categories_row['category_slug']) {
                                        echo 'selected';
                                    } ?>
                                            value="<?php echo urlModifier($categories_row['category_slug']); ?>"><?php echo $categories_row['category_name']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </li>
<!--                        <li class="sr-time">-->
<!--                            <select name="highlights" id="highlights" class="chosen-select form-control">-->
<!--                                --><?php
//                                if (isset($_GET['category']) && !empty($_REQUEST['category'])) {
//                                    if (getCountAdPostSubCategoryCategory($category_id) <= 0) {
//                                        ?>
<!--                                        <option value="">No Highlights to show</option>-->
<!--                                        --><?php
//                                    } else {
//
//                                        foreach (getCategoryAdPostSubCategories($category_id) as $sub_category_row) {
//
//                                            ?>
<!--                                            <option-->
<!--                                                    value="--><?php //echo $sub_category_row['sub_category_id']; ?><!--">--><?php //echo $sub_category_row['sub_category_name']; ?><!--</option>-->
<!---->
<!--                                            --><?php
//                                        }
//                                    }
//                                }else{
//                                    ?>
<!--                                    <option value="">All Highlights</option>-->
<!--                                    --><?php
//                                    foreach (getAllAdPostSubCategories() as $sub_category_row) {
//
//                                        ?>
<!--                                        <option-->
<!--                                                value="--><?php //echo $sub_category_row['sub_category_id']; ?><!--">--><?php //echo $sub_category_row['sub_category_name']; ?><!--</option>-->
<!---->
<!--                                        --><?php
//                                    }
//                                }
//                                ?>
<!--                            </select>-->
<!--                        </li>-->
                        <li class="sr-time">
                            <select name="sort_by" id="sort_by" class="sort_by chosen-select form-control">
                                <option <?php if ($get_sort_by == '') {
                                    echo 'selected';
                                } ?> value="">All Ads</option>
                                <option  <?php if ($get_sort_by == 'today') {
                                    echo 'selected';
                                } ?> value="today">Todays post</option>
                                <option  <?php if ($get_sort_by == 'recent') {
                                    echo 'selected';
                                } ?> value="recent">Recent posts</option>
                                <option  <?php if ($get_sort_by == 'newest') {
                                    echo 'selected';
                                } ?> value="newest">Newest posts first</option>
                                <option  <?php if ($get_sort_by == 'oldest') {
                                    echo 'selected';
                                } ?> value="oldest">Oldest posts first</option>
                            </select>
                        </li>
                        <li class="sr-date">
                            <div id="newdate"></div>
                        </li>
                    </ul>
                </form>
            </div>
        </br>
            <!--START-->
            <div class="filt-com lhs-ads">
                <ul>
                    <li>
                        <div class="ads-box">
                            <?php
                            $ad_position_id = 13;   //Ad position on All Events page left
                            $get_ad_row = getAds($ad_position_id);
                            $ad_enquiry_photo = $get_ad_row['ad_enquiry_photo'];
                            ?>
                            <a href="<?php echo stripslashes($get_ad_row['ad_link']); ?>">
                                <span><?php echo $BIZBOOK['AD']; ?></span>

                                <img
                                        src="<?php echo $slash; ?>images/ads/<?php if ($ad_enquiry_photo != NULL || !empty($ad_enquiry_photo)) {
                                            echo $ad_enquiry_photo;
                                        } else {
                                            echo "ads1.jpg";
                                        } ?>" alt="">
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <!--END-->
        </div>

        <div class="us-ppg-com">
            <ul id="intseres" class="events-wrapper">
                <?php
                $si = 1;

                $ad_postsql = "SELECT * FROM " . TBL . "ad_post as T1 $event_end_search_query WHERE T1.ad_post_status= 'Active' $category_search_query $events_location_search_query $ad_post_sort_by_query ";

                $ad_postrs = mysqli_query($conn, $ad_postsql);
                $total_ad_posts = mysqli_num_rows($ad_postrs);

                ?>
                <div class="listng-res">
                    <div class="count_no">Total of <span><?php echo AddingZero_BeforeNumber($total_ad_posts); ?></span>
                        Ad Post(s) found.
                    </div>
                    <div class="list-res-selt">
                        <!-- //Filter Category name   -->
                        <?php
                        if (isset($_GET['category']) && !empty($_GET['category'])) { ?>
                            <span class="ad-post-filters-span" id="<?php echo strtolower($category_search_slug); ?>"
                                  data-type="category"><?php echo $category_search_name; ?></span>
                        <?php } ?>

                        <!-- //Filter City name   -->
                        <?php
                        if (isset($_REQUEST['city']) && !empty($_REQUEST['city'])) {

                            $city1 = str_replace('-', ' ', $get_city);
                            $expert_city_row = getCityName($city1);

                            $hyphend_city_name = urlModifier($expert_city_row['city_name']);
                            ?>
                            <span class="ad-post-filters-span" id="<?php echo $hyphend_city_name; ?>"
                                  data-type="city"><?php echo $expert_city_row['city_name']; ?></span>
                        <?php } ?>

                        <!-- //Filter Sort By   -->
                        <?php
                        //Calendar order starts
                        if (isset($_REQUEST['calendar-date']) && !empty($_REQUEST['calendar-date']) && $_REQUEST['calendar-date'] !== "[object Object]") {

                            $get_calendar_date = $_REQUEST['calendar-date'];

                            if ($get_calendar_date != '') {
                                $phpdate = strtotime($get_calendar_date);
                                $new_date = date("Y-m-d", $phpdate);
                                ?>

                                <span class="ad-post-filters-span" id="<?php echo $get_calendar_date; ?>" data-type="calendar-date"><?php echo $new_date; ?></span>
                                <?php
                            }

                        }else {

                        if (isset($_REQUEST['sort_by']) && $_REQUEST['sort_by'] != NULL) {

                            $get_sort_by = $_REQUEST['sort_by'];

                            ?>
                            <span class="ad-post-filters-span" id="<?php echo $get_sort_by; ?>" data-type="sort_by"><?php

                                if ($get_sort_by == "recent") {
                                    echo "Recent Posts";
                                } elseif ($get_sort_by == "today") {
                                    echo "Todays Post";
                                } elseif ($get_sort_by == "newest") {
                                    echo "Newest posts first";
                                } elseif ($get_sort_by == "oldest") {
                                    echo "Oldest posts first";
                                } ?></span>
                        <?php }
//                        else{
                            ?>
<!--                            <span class="ad-post-filters-span" id="--><?php //echo $get_sort_by; ?><!--" data-type="sort_by">--><?php //echo "Upcoming Events"; ?><!--</span>-->
                            <?php
                        } //}?>

                        <!-- //Filter most views   -->
<!--                        <span class="ad-post-filters-span" id="" data-type="most_views">--><?php //echo "Most Views"; ?><!--</span>-->
                    </div>
                </div>
                <?php

                if ($total_ad_posts > 0) {

                    while ($ad_postrow = mysqli_fetch_array($ad_postrs)) {

                        $user_id = $ad_postrow['user_id'];

                        $user_details_row = getUser($user_id);

                        ?>
                        <li>
                        <div class="plac-hom-box ad-box">
                                    <div class="plac-hom-box-im">
                                        <img src="<?php if ($ad_postrow['gallery_image'] != NULL || !empty($ad_postrow['gallery_image'])) {
                                            echo $slash."ads/images/" . array_shift(explode(',', $ad_postrow['gallery_image']));
                                        } else {
                                            echo $slash."images/listings/" . $footer_row['listing_default_image'];
                                        } ?>" class="b-lazy b-loaded" alt="">
                                        <h4><?php if($footer_row['currency_symbol_pos']== 1){ echo $footer_row['currency_symbol']; } ?><?php echo $ad_postrow['ad_post_price']; ?><?php if($footer_row['currency_symbol_pos']== 2){ echo $footer_row['currency_symbol']; } ?></h4>
                                    </div>
                                    <div class="ad-box-txt">
                                        <h3><?php echo $ad_postrow['ad_post_name']; ?></h3>
                                        <span class="loc"><?php echo $ad_postrow['ad_post_address']; ?></span>
                                        <span class="dat"><?php
                                            $now = time(); // or your date as well
                                            $your_date = strtotime($ad_postrow['ad_post_cdt']);
                                            $datediff = $now - $your_date;

                                            echo round($datediff / (60 * 60 * 24));
                                            ?> Days old</span>
                                    </div>
                                    <a href="<?php echo $AD_POST_URL.urlModifier($ad_postrow['ad_post_slug']); ?>" class="fclick" tabindex="0"></a>
                                </div>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="filt-no-res-msg"><?php echo $BIZBOOK['EVENTS_NO_EVENTS_MESSAGE']; ?></span>
                    <?php
                }
                ?>
            </ul>
        </div>

    </div>
</section>
<!--END-->

<section>
    <div class="pop-ups pop-quo">
        <!-- The Modal -->
        <div class="modal fade" id="quote">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
                    <div class="quote-pop">
                        <h4><?php echo $BIZBOOK['LEAD-GET-QUOTE']; ?></h4>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control"
                                       placeholder="<?php echo $BIZBOOK['LEAD-NAME-PLACEHOLDER']; ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control"
                                       placeholder="<?php echo $BIZBOOK['ENTER_EMAIL_STAR']; ?>"
                                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                       title="<?php echo $BIZBOOK['LEAD-INVALID-EMAIL-TITLE']; ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control"
                                       placeholder="<?php echo $BIZBOOK['LEAD-MOBILE-PLACEHOLDER']; ?>"
                                       pattern="[7-9]{1}[0-9]{9}"
                                       title="<?php echo $BIZBOOK['LEAD-INVALID-MOBILE-TITLE']; ?>" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3"
                                          placeholder="<?php echo $BIZBOOK['LEAD-MESSAGE-PLACEHOLDER']; ?>"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT']; ?></button>
                        </form>
                    </div>
                    <div class="log-bor">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="event-pagination-container"></div>
<?php
include "../footer.php";
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo $slash; ?>js/jquery.min.js"></script>
<script src="<?php echo $slash; ?>js/popper.min.js"></script>
<script src="<?php echo $slash; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $slash; ?>js/jquery-ui.js"></script>
<script src="<?php echo $slash; ?>js/select-opt.js"></script>
<script type="text/javascript">var webpage_full_link = '<?php echo $webpage_full_link;?>';</script>
<script type="text/javascript">var login_url = '<?php echo $LOGIN_URL;?>';</script>
<script src="<?php echo $slash; ?>js/blazy.min.js"></script>
<script src="<?php echo $slash; ?>js/custom.js"></script>
<script src="<?php echo $slash; ?>ads/js/ad_post_filter.js"></script>
<!--<script src="js/jquery.simplePagination.min.js"></script>-->

<script>
    $(document).ready(function () {
        var bLazy = new Blazy({});
    });
    
</script>
<?php
//if (isset($_REQUEST['calendar-date']) && !empty($_REQUEST['calendar-date'])) {?>
    <script>
    $("#newdate").datepicker(
        "setDate", "<?php echo date('2023-05-05'); ?>"
    );
    <?php
//} ?>
//</body>
//</html>