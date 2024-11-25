<?php

include "header.php";

if (isset($_SESSION['user_id'])) {
    $session_user_id = $_SESSION['user_id'];
}
$user_details_row = getUser($session_user_id);

$session_user_plan = $user_details_row['user_plan'];
$session_plan_type_row = getPlanType($session_user_plan); //Session User Plan Type Database Fetch


if ($_GET['code'] == NULL && empty($_GET['code'])) {

    header("Location: all-listing");
}

$listing_codea1 = str_replace('-', ' ', $_GET['code']);
$listing_codea = str_replace('.php', '', $listing_codea1);

//$listing_codea = $_GET['code'];

$listrow = getSlugListing($listing_codea); //To Fetch the listing

$listing_id = $listrow['listing_id'];
$list_user_id = $listrow['user_id'];
$list_category_id = $listrow['category_id'];

$cat_search_row = getCategory($list_category_id);  //Fetch Category name using category Id

$category_search_slug = $cat_search_row['category_slug'];

$category_search_name = $cat_search_row['category_name'];

$redirect_url = $webpage_full_link . 'dashboard';  //Redirect Url

if ($listing_id == NULL && empty($listing_id)) {

    header("Location: $redirect_url");  //Redirect When No Listing Found in Table
}

listingpageview($listing_id); //Function To Find Page View

$usersqlrow = getUser($list_user_id); // To Fetch particular User Data

$user_plan = $usersqlrow['user_plan'];

foreach (getListingReview($listing_id) as $star_rating_row) {
    if ($star_rating_row["rate_cnt"] > 0) {
        $star_rate_times = $star_rating_row["rate_cnt"];
        $star_sum_rates = $star_rating_row["total_rate"];
        $star_rate_one = $star_sum_rates / $star_rate_times;
        $star_rate_two = number_format($star_rate_one, 1);
        $star_rate = floatval($star_rate_two);

    } else {
        $rate_times = 0;
        $rate_value = 0;
        $star_rate = 0;
    }
}

// List Rating. for Rating of Star Ends

$check_listing_likes_total1 = getCountUserLikedListing($listing_id, $list_user_id); // To get count of likes

if ($check_listing_likes_total1 >= 1) {
    $check_listing_likes_total = 0;
    $check_listing_likes_active = 'sav-act';
} else {
    $check_listing_likes_total = 1;
    $check_listing_likes_active = '';
}

$plan_type_row = getPlanType($user_plan); //User Plan Type Database Fetch

$review_count = getCountListingReview($listing_id); //Listing Reviews Count

?>

<!-- START -->
<section>
    <div class="v3-list-ql">
        <div class="container">
            <div class="row">
                <div class="v3-list-ql-inn">
                    <ul>
                        <li class="active"><a href="#ld-abo"><i
                                        class="material-icons">person</i> <?php echo $BIZBOOK['LISTING_DETAILS_ABOUT']; ?>
                            </a>
                        </li>
                        <li><a href="#ld-ser"><i
                                        class="material-icons">business_center</i> <?php echo $BIZBOOK['LISTING_DETAILS_SERVICES']; ?>
                            </a>
                        </li>
                        <li><a href="#ld-off"><i
                                        class="material-icons">style</i> <?php echo $BIZBOOK['LISTING_DETAILS_OFFERS']; ?>
                            </a>
                        </li>
                        <li><a href="#location"><i
                                        class="material-icons">map</i> <?php echo $BIZBOOK['LOCATION']; ?>
                            </a>
                        </li>
                        <!--                        <li><a href="#ld-360"><i-->
                        <!--                                        class="material-icons">camera</i> --><?php //echo $BIZBOOK['LISTING_DETAILS_360_VIEW']; ?>
                        <!--                            </a>-->
                        <!--                        </li>-->
                        <li><a href="#ld-rev"><i
                                        class="material-icons">star_half</i> <?php echo $BIZBOOK['LISTING_DETAILS_WRITE_REVIEW']; ?>
                            </a>
                        </li>
                        <?php

                        //To Check whether listing owner made listing guarantee is visible

                        $setting_guarantee_show = $usersqlrow['setting_guarantee_show'];
                        if ($user_details_row['user_type'] == 'Service provider' && $setting_guarantee_show == 0) {
                            ?>
                            <li><a href="#" data-toggle="modal" data-target="#claim"><i
                                            class="material-icons">store</i><?php echo $BIZBOOK['LISTING_DETAILS_CLAIM_BUSINESS']; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<!-- START -->
<section>
    <div class="list-det-fix">
        <div class="container">
            <div class="row">
                <div class="list-det-fix-inn">
                    <div class="list-fix-pro">
                        <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                             class="b-lazy"
                             data-src="<?php if ($listrow['profile_image'] != NULL || !empty($listrow['profile_image'])) {
                                 echo $slash . "images/listings/" . $listrow['profile_image'];
                             } else {
                                 echo $slash . "images/listings/" . $footer_row['listing_default_image'];
                             } ?>" alt="" loading="lazy">
                    </div>
                    <div class="list-fix-tit">
                        <h3><?php echo $listrow['listing_name']; ?></h3>
                        <p><b><?php echo $BIZBOOK['ADDRESS']; ?>:</b> <?php echo $listrow['listing_address']; ?></p>
                    </div>
                    <div class="list-fix-btn">
                        <span data-toggle="modal" data-target="#quote"
                              class="pulse"><?php echo $BIZBOOK['SEND_AN_ENQIRY']; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->


<section class="<?php if ($footer_row['admin_language'] == 2) {
    echo "lg-arb";
} ?> list-pg-bg">
    <div class="container">
        <div class="row">
            <div class="com-padd">
                <div>
                    <div class="eve-bred-crum">
                        <ul>
                            <li><a href="<?php echo $webpage_full_link; ?>"><?php echo $BIZBOOK['HOME']; ?></a></li>
                            <li>
                                <a href="<?php echo $ALL_LISTING_URL . urlModifier($category_search_slug); ?>"><?php echo $category_search_name; ?></a>
                            </li>
                            <li>
                                <a href="#!"><?php echo $listrow['listing_name']; ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="list-pg-rt">
                    <div class="pglist-bg pglist-p-com">
                        <div class="pg-list-ban-info-23">
                            <div class="pg-list-1-pro">
                                <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                     class="b-lazy"
                                     data-src="<?php if ($listrow['profile_image'] != NULL || !empty($listrow['profile_image'])) {
                                         echo $slash . "images/listings/" . $listrow['profile_image'];
                                     } else {
                                         echo $slash . "images/listings/" . $footer_row['listing_default_image'];
                                     } ?>" alt="" loading="lazy">
                                <?php
                                if ($plan_type_row['plan_type_verified'] == '1') {
                                    ?>
                                    <span class="stat"><i class="material-icons">verified_user</i></span>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="pg-list-1-left">
                                <h1><?php echo $listrow['listing_name']; ?></h1>

                                <?php
                                if ($star_rate_two != 0) {
                                    ?>
                                    <div class="pg-list-revi-23">
                                        <div class="pg-list-revi-lhs">
                                            <div class="list-rat-all">
                                                <?php
                                                if ($star_rate_two != 0) {
                                                    ?>
                                                    <b><?php echo $star_rate_two; ?></b>
                                                    <?php
                                                } ?>
                                                <?php
                                                if ($star_rate != 0) {
                                                    ?>
                                                    <label class="rat">
                                                        <?php
                                                        for ($i = 1; $i <= ceil($star_rate); $i++) {
                                                            ?>
                                                            <i class="material-icons">star</i>
                                                            <?php
                                                        }
                                                        $bal_star_rate = abs(ceil($star_rate) - 5);

                                                        for ($i = 1; $i <= $bal_star_rate; $i++) {
                                                            ?>
                                                            <i class="material-icons ratstar">star</i>
                                                            <?php
                                                        }
                                                        ?>
                                                    </label>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="pglist-revi-lines">
                                            <!-- RATING PROGERESSBAR -->
                                            <div class="progress">
                                                <div class="progress-bar bg-success" style="width:80%"><span>5*</span>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" style="width:40%"><span>4*</span></div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" style="width:20%"><span>3*</span>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" style="width:20%"><span>2*</span>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-secondary" style="width:10%"><span>1*</span>
                                                </div>
                                            </div>
                                            <!-- END RATING PROGERESSBAR -->
                                        </div>
                                        <p class="txt">
                                            <?php
                                            if ($star_rate_two != 0) {
                                                ?>
                                                <span><?php
                                                    if ($star_rate_two != 0) {
                                                        ?>
                                                        <b><?php echo $star_rate_two; ?></b>
                                                        <?php
                                                    } ?>
                                                    average based on <?php echo $review_count; ?> <?php echo $BIZBOOK['REVIEWS']; ?></span>
                                                <?php
                                            } else {
                                                ?>
                                                <span><?php echo $BIZBOOK['NO_REVIEWS_YET']; ?></span>
                                                <?php
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="list-number pag-p1-phone">
                                    <ul>
                                        <li class="ic-addr"><?php echo $listrow['listing_address']; ?></li>
                                        <a href="tel:<?php
                                        if ($listrow['listing_mobile'] != NULL || $usersqlrow['mobile_number'] != NULL) {

                                                echo $listrow['listing_mobile'];
                                        }
                                        ?>">
                                            <li class="ic-php"><?php
                                                if ($listrow['listing_mobile'] != NULL || $usersqlrow['mobile_number'] != NULL) {

                                                        echo $listrow['listing_mobile'];
                                                }
                                                ?>
                                            </li>
                                        </a>
                                        <a href="mailto:<?php if ($listrow['listing_email'] != NULL) {
                                            echo $listrow['listing_email'];
                                        } ?>">
                                            <li class="ic-mai"><?php if ($listrow['listing_email'] != NULL) {
                                                    echo $listrow['listing_email'];
                                                } ?>
                                            </li>
                                        </a>
                                        <?php if ($listrow['listing_website'] != NULL) { ?>
                                            <a target="_blank" href="http://<?php echo $listrow['listing_website']; ?>">
                                                <li class="ic-web"><?php echo $listrow['listing_website']; ?></li>
                                            </a>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="list-ban-btn">
                                <ul>
                                    <li>
                                        <a href="tel:<?php echo $usersqlrow['mobile_number']; ?>"
                                           class="cta cta-call"><?php echo $BIZBOOK['CALL_NOW']; ?></a>
                                    </li>
                                    <li>
                            <span data-toggle="modal" data-target="#quote"
                                  class="pulse cta cta-get"><?php echo $BIZBOOK['LEAD-GET-QUOTE']; ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="pg-list-oths">
                                <ul>
                                    <li><span
                                                class="cta cta-like ldelik Animatedheartfunc<?php echo $listing_id ?> <?php echo $check_listing_likes_active; ?>"
                                                data-for="<?php echo listing_total_like_count($listrow['listing_id']); ?>"
                                                data-section="<?php echo $check_listing_likes_total; ?>"
                                                data-num="<?php echo $list_user_id; ?>"
                                                data-item="<?php echo $session_user_id; ?>"
                                                data-id='<?php echo $listrow['listing_id'] ?>'> <i
                                                    class="material-icons">thumb_up</i>
                                <b class="like-content<?php echo $listrow['listing_id'] ?>"><?php echo listing_total_like_count($listrow['listing_id']); ?></b>
                                            <?php echo $BIZBOOK['LIKES']; ?></span>
                                    </li>
                                    <?php if ($listrow['listing_whatsapp'] != NULL) { ?>
                                        <li>
                                            <a href="https://wa.me/<?php echo $listrow['listing_whatsapp']; ?>"
                                               class="cta cta-rev" target="_blank"><i
                                                        class="material-icons">chat</i><?php echo $BIZBOOK['WHATSAPP']; ?>
                                            </a>
                                        </li>
                                    <?php } ?> 

                                    <?php
                                    if ($plan_type_row['plan_type_social'] == '1') {
                                        ?>

                                        <?php

                                        //To Check whether listing owner made listing Share is enable

                                        $setting_share = $usersqlrow['setting_share'];
                                        if ($setting_share == 0) {
                                            ?>
                                            <li><span data-toggle="modal" data-target="#sharepop"><i
                                                            class="material-icons">share</i><?php echo $BIZBOOK['JOB_SHARE']; ?></span>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!--LISTING DETAILS: LEFT PART 8-->
                    <?php
                    if ((!empty($listrow['listing_info_question']))) {
                        ?>
                        <!--LISTING DETAILS: LEFT PART 9-->
                        <div class="pglist-p3 pglist-bg pglist-p-com">
                            <div class="pglist-p-com-ti">
                                <h3><span><?php echo $BIZBOOK['COMPANY']; ?></span> <?php echo $BIZBOOK['INFO']; ?></h3>
                            </div>
                            <div class="list-pg-inn-sp">
                                <div class="list-work-hrs">
                                    <?php
                                    $today_is_open = strtolower(date('D')) . '_is_open';
                                    $today_open_time = strtolower(date('D')) . '_open_time';
                                    $today_close_time = strtolower(date('D')) . '_close_time';
                                    ?>
                                    <div class="today"><b>Working hours</b><span
                                                class="status"><?php if ($listrow[$today_is_open] == 1) {
                                                echo "Open";
                                            } else {
                                                echo "Closed";
                                            } ?></span><?php if ($listrow[$today_is_open] == 1) { ?><span
                                                class="time"><?php if ($listrow[$today_open_time] != NULL) {
                                            echo $listrow[$today_open_time];
                                        } ?> - <?php if ($listrow[$today_close_time] != NULL) {
                                            echo $listrow[$today_close_time];
                                        } ?></span><?php } ?></div>
                                    <div class="timing">
                                        <ul>
                                            <li>Sunday: <span class="time"><?php if ($listrow['sun_is_open'] == 1) {
                                                        if ($listrow['sun_open_time'] != NULL) {
                                                            echo $listrow['sun_open_time'];
                                                        } else {
                                                            echo "-";
                                                        } ?> - <?php if ($listrow['sun_close_time'] != NULL) {
                                                            echo $listrow['sun_close_time'];
                                                        } else {
                                                            echo "-";
                                                        }
                                                    } else {
                                                        echo "Closed";
                                                    } ?></span></li>
                                            <li>Monday: <span class="time"><?php if ($listrow['mon_is_open'] == 1) {
                                                        if ($listrow['mon_open_time'] != NULL) {
                                                            echo $listrow['mon_open_time'];
                                                        } else {
                                                            echo "-";
                                                        } ?> - <?php if ($listrow['mon_close_time'] != NULL) {
                                                            echo $listrow['mon_close_time'];
                                                        } else {
                                                            echo "-";
                                                        }
                                                    } else {
                                                        echo "Closed";
                                                    } ?></span></li>
                                            <li>Tuesday: <span class="time"><?php if ($listrow['tue_is_open'] == 1) {
                                                        if ($listrow['tue_open_time'] != NULL) {
                                                            echo $listrow['tue_open_time'];
                                                        } else {
                                                            echo "-";
                                                        } ?> - <?php if ($listrow['tue_close_time'] != NULL) {
                                                            echo $listrow['tue_close_time'];
                                                        } else {
                                                            echo "-";
                                                        }
                                                    } else {
                                                        echo "Closed";
                                                    } ?></span></li>
                                            <li>Wednesday: <span class="time"><?php if ($listrow['wed_is_open'] == 1) {
                                                        if ($listrow['wed_open_time'] != NULL) {
                                                            echo $listrow['wed_open_time'];
                                                        } else {
                                                            echo "-";
                                                        } ?> - <?php if ($listrow['wed_close_time'] != NULL) {
                                                            echo $listrow['wed_close_time'];
                                                        } else {
                                                            echo "-";
                                                        }
                                                    } else {
                                                        echo "Closed";
                                                    } ?></span></li>
                                            <li>Thursday: <span class="time"><?php if ($listrow['thu_is_open'] == 1) {
                                                        if ($listrow['thu_open_time'] != NULL) {
                                                            echo $listrow['thu_open_time'];
                                                        } else {
                                                            echo "-";
                                                        } ?> - <?php if ($listrow['thu_close_time'] != NULL) {
                                                            echo $listrow['thu_close_time'];
                                                        } else {
                                                            echo "-";
                                                        }
                                                    } else {
                                                        echo "Closed";
                                                    } ?></span></li>
                                            <li>Friday: <span class="time"><?php if ($listrow['fri_is_open'] == 1) {
                                                        if ($listrow['fri_open_time'] != NULL) {
                                                            echo $listrow['fri_open_time'];
                                                        } else {
                                                            echo "-";
                                                        } ?> - <?php if ($listrow['fri_close_time'] != NULL) {
                                                            echo $listrow['fri_close_time'];
                                                        } else {
                                                            echo "-";
                                                        }
                                                    } else {
                                                        echo "Closed";
                                                    } ?></span></li>
                                            <li>Saturday: <span class="time"><?php if ($listrow['sat_is_open'] == 1) {
                                                        if ($listrow['sat_open_time'] != NULL) {
                                                            echo $listrow['sat_open_time'];
                                                        } else {
                                                            echo "-";
                                                        } ?> - <?php if ($listrow['sat_close_time'] != NULL) {
                                                            echo $listrow['sat_close_time'];
                                                        } else {
                                                            echo "-";
                                                        }
                                                    } else {
                                                        echo "Closed";
                                                    } ?></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="list-pg-oth-info">
                                    <ul>
                                        <?php
                                        $listings_a_row_listing_info_question_Array = explode(',', $listrow['listing_info_question']);
                                        $listings_a_row_listing_info_answer_Array = explode(',', $listrow['listing_info_answer']);

                                        $zipped = array_map(null, $listings_a_row_listing_info_question_Array, $listings_a_row_listing_info_answer_Array);

                                        foreach ($zipped as $tuple) {
                                            $tuple[0]; // Info question
                                            $tuple[1]; // Info Answer
                                            if ($tuple[0] != NULL) {
                                                ?>
                                                <li><?php echo $tuple[0]; ?> <span><?php echo $tuple[1]; ?></span></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <?php

                                //To Check whether listing owner made listing guarantee is visible

                                $setting_guarantee_show = $usersqlrow['setting_guarantee_show'];
                                if ($user_details_row['user_type'] == 'Service provider' && $setting_guarantee_show == 0) {
                                    ?>

                                    <div class="list-pg-guar">
                                        <ul>
                                            <li>
                                                <div class="list-pg-guar-img"><img
                                                            src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                            class="b-lazy"
                                                            data-src="<?php echo $slash; ?>images/icon/g2.png" alt=""
                                                            loading="lazy"/></div>
                                                <h4><?php echo $BIZBOOK['LISTING_DETAILS_CLAIM_THIS_BUSINESS']; ?></h4>
                                                <span data-toggle="modal" data-target="#claim"
                                                      class="clim-edit"><?php echo $BIZBOOK['LISTING_DETAILS_SUGGEST_AN_EDIT']; ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!--END LISTING DETAILS: LEFT PART 9-->
                        <?php
                    }
                    ?>

                    <?php

                    //To Check whether listing owner made profile is visible

                    $setting_profile_show = $usersqlrow['setting_profile_show'];
                    if ($setting_profile_show == 0) {

                        ?>
                        <!--LISTING DETAILS: LEFT PART 7-->
                        <div class="ld-rhs-pro pglist-bg pglist-p-com">
                            <div class="pglist-p-com-ti">
                                <h3>
                                    <span><?php echo $BIZBOOK['LISTING']; ?></span> <?php echo $BIZBOOK['CREATED_BY']; ?>
                                </h3>
                            </div>
                            <div class="lis-pro-badg-23">
                                <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                     class="b-lazy"
                                     data-src="<?php echo $slash; ?>images/user/<?php if (($usersqlrow['profile_image'] == NULL) || empty($usersqlrow['profile_image'])) {
                                         echo $footer_row['user_default_image'];
                                     } else {
                                         echo $usersqlrow['profile_image'];
                                     } ?>" alt="" loading="lazy">
                                <div>
                                    <!--<span class="rat" alt="User rating">4.2</span>-->
                                    <h4><?php echo $usersqlrow['first_name']; ?></h4>
                                    <p>Member since <?php $user_date = $usersqlrow['user_cdt'];;
                                        $user_date1 = strtotime($user_date);
                                        echo date("M Y", $user_date1); ?></p>
                                </div>
                                <a href="<?php echo $PROFILE_URL . urlModifier($usersqlrow['user_slug']); ?>"
                                   class="fclick"
                                   target="_blank">&nbsp;</a>
                            </div>
                        </div>
                        <!--END LISTING DETAILS: LEFT PART 7-->
                        <?php
                    }
                    ?>

                    <?php
                    if (getCountUserCompanyUser($list_user_id) > 0) {
                        $company_row = getUserCompanyUser($list_user_id);
                        ?>

                        <div class="ld-rhs-pro pglist-bg pglist-p-com">
                            <div class="pglist-p-com-ti">
                                <h3><?php echo $BIZBOOK['LISTING_DETAILS_BUSINESS_PROFILE']; ?> </h3>
                            </div>
                            <div class="lis-pro-badg-23">
                                <img
                                     src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                     class="proi b-lazy"
                                     data-src="<?php echo $slash; ?>images/user/<?php if (($company_row['company_profile_photo'] == NULL) || empty($company_row['company_profile_photo'])) {
                                         echo $footer_row['user_default_image'];
                                     } else {
                                         echo $company_row['company_profile_photo'];
                                     } ?>"
                                     alt="" loading="lazy">
                                <div>
                                    <!--<span class="rat" alt="User rating">4.2</span>-->
                                    <h4><?php if ($company_row['company_name'] != NULL) {
                                            echo $company_row['company_name'];
                                        } else {
                                            echo $usersqlrow['first_name'];
                                        } ?></h4>
                                    <p><?php echo $company_row['company_address']; ?></p>
                                </div>
                                <div class="lis-comp-badg">
                                    <div class="s1">
                                        <div>
                                            <ul>
                                                <?php
                                                if ($company_row['company_facebook'] != NULL) {
                                                    ?>
                                                    <li><a href="<?php echo $company_row['company_facebook']; ?>"
                                                           target="_blank"><img
                                                                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                                    class="b-lazy"
                                                                    data-src="<?php echo $slash; ?>images/social/3.png"
                                                                    loading="lazy"></a></li>
                                                    <?php
                                                }
                                                if ($company_row['company_twitter'] != NULL) {
                                                    ?>
                                                    <li><a href="<?php echo $company_row['company_twitter']; ?>"
                                                           target="_blank"><img
                                                                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                                    class="b-lazy"
                                                                    data-src="<?php echo $slash; ?>images/social/2.png"
                                                                    loading="lazy"></a></li>
                                                    <?php
                                                }
                                                if ($company_row['company_linkedin'] != NULL) {
                                                    ?>
                                                    <li><a href="<?php echo $company_row['company_linkedin']; ?>"
                                                           target="_blank"><img
                                                                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                                    class="b-lazy"
                                                                    data-src="<?php echo $slash; ?>images/social/1.png"
                                                                    loading="lazy"></a></li>
                                                    <?php
                                                }
                                                if ($company_row['company_instagram'] != NULL) {
                                                    ?>
                                                    <li><a href="<?php echo $company_row['company_instagram']; ?>"
                                                           target="_blank"><img
                                                                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                                    class="b-lazy"
                                                                    data-src="<?php echo $slash; ?>images/social/7.png"
                                                                    loading="lazy"></a></li>
                                                    <?php
                                                }
                                                if ($company_row['company_youtube'] != NULL) {
                                                    ?>
                                                    <li><a href="<?php echo $company_row['company_youtube']; ?>"
                                                           target="_blank"><img
                                                                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                                    class="b-lazy"
                                                                    data-src="<?php echo $slash; ?>images/social/5.png"
                                                                    loading="lazy"></a></li>
                                                    <?php
                                                }
                                                if ($company_row['company_whatsapp'] != NULL) {
                                                    ?>
                                                    <li><a href="<?php echo $company_row['company_whatsapp']; ?>"
                                                           target="_blank"><img
                                                                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                                    class="b-lazy"
                                                                    data-src="<?php echo $slash; ?>images/social/6.png"
                                                                    loading="lazy"></a></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <a target="_blank" href="<?php if ($company_row['company_name'] != NULL) {
                                    echo $COMPANY_URL . urlModifier($company_row['company_slug']);
                                } else {
                                    echo "#!";
                                } ?>" class="fclick"
                                   target="_blank"></a>
                            </div>
                        </div>
                        <?php
                    } ?>

                    <?php
                    $likes_count = listing_total_like_count($listing_id);
                    if ($likes_count >= 1) {
                        ?>
                        <!--LISTING DETAILS: LEFT PART 10-->
                        <div class="list-mig-like">
                            <div class="list-ri-peo-like">
                                <h3><?php echo $BIZBOOK['LISTING_DETAILS_WHO_ARE_LIKE_THIS']; ?></h3>
                                <ul>
                                    <?php
                                    foreach (getAllLikedListingListing($listing_id) as $likesuser_row) {

                                        $user_id_liked = $likesuser_row['user_id'];
                                        $user_id_liked_row = getUser($user_id_liked);
                                        ?>
                                        <li>
                                            <a href="<?php echo $webpage_full_link; ?>profile/<?php echo preg_replace('/\s+/', '-', strtolower($user_id_liked_row['user_slug'])); ?>"
                                               target="_blank">
                                                <img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                        class="b-lazy"
                                                        data-src="<?php echo $slash; ?>images/user/<?php if (($user_id_liked_row['profile_image'] == NULL) || empty($user_id_liked_row['profile_image'])) {
                                                            echo $footer_row['user_default_image'];
                                                        } else {
                                                            echo $user_id_liked_row['profile_image'];
                                                        } ?>" alt="" loading="lazy">
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!--END LISTING DETAILS: LEFT PART 10-->
                        <?php
                    }
                    ?>
                    <!--ADS-->
                    <div class="ban-ati-com ads-det-page">
                        <?php
                        $ad_position_id = 5;   //Ad position on Listing Detail Right
                        $get_ad_row = getAds($ad_position_id);
                        $ad_enquiry_photo = $get_ad_row['ad_enquiry_photo'];
                        ?>
                        <a href="<?php echo stripslashes($get_ad_row['ad_link']); ?>"><span><?php echo $BIZBOOK['AD']; ?></span><img
                                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                    class="b-lazy"
                                    data-src="<?php echo $slash; ?>images/ads/<?php if ($ad_enquiry_photo != NULL || !empty($ad_enquiry_photo)) {
                                        echo $ad_enquiry_photo;
                                    } else {
                                        echo "59040boat-728x90.png";
                                    } ?>" loading="lazy"></a>
                    </div>
                    <!--ADS-->
                </div>
                <!-- LHS END  -->
                <div class="list-pg-lt list-page-com-p">
                    <!--LISTING DETAILS: LEFT PART 3-->
                    <?php
                    if ($plan_type_row['plan_type_photos'] == '1') {
                        if ((!empty($listrow['gallery_image'])) || (!empty($listrow['listing_video']) && $listrow['listing_video'] != NULL)) {
                            ?>
                            <div id="ld-gal" class="pglist-bg pglist-p-com">
                                <div class="list-pg-inn-sp">
                                    <div id="demo" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ul class="carousel-indicators">
                                            <?php
                                            $gallery_image_array = $listrow['gallery_image'];
                                            $gallery_image = explode(',', $gallery_image_array);
                                            $listing_video_array = $listrow['listing_video'];

                                            $gallery_image1 = explode('|', $listing_video_array);


                                            if (count($gallery_image + $gallery_image1) >= 1) {
                                                $p1 = 0;
                                                foreach ($gallery_image as $item) {

                                                    ?>
                                                    <li data-target="#demo" data-slide-to="<?php echo $p1 ?>"
                                                        class="<?php if ($p1 == 0) {
                                                            echo "active";
                                                        } ?>"></li>
                                                    <?php
                                                    $p1++;
                                                }
                                                if ($listing_video_array != "") {
                                                    foreach ($gallery_image1 as $item1) {

                                                        ?>
                                                        <li data-target="#demo" data-slide-to="<?php echo $p1 ?>"
                                                            class="<?php if ($p1 == 0) {
                                                                echo "active";
                                                            } ?>"></li>
                                                        <?php
                                                        $p1++;
                                                    }
                                                }
                                            }
                                            ?>
                                        </ul>

                                        <!-- The slideshow -->
                                        <div class="carousel-inner">
                                            <?php

                                            $p = 1;
                                            foreach ($gallery_image as $item) {

                                                ?>
                                                <div class="carousel-item <?php if ($p == 1) {
                                                    echo "active";
                                                } ?>">
                                                    <img src="<?php echo $slash; ?>images/listings/<?php echo $item; ?>"
                                                         alt="<?php echo $item; ?>" loading="lazy" data-toggle="modal"
                                                         data-target="#galPop" class="galPop">
                                                </div>
                                                <?php
                                                $p++;
                                            }
                                            if ($listing_video_array != "") {
                                                foreach ($gallery_image1 as $item1) {

                                                    ?>
                                                    <div class="carousel-item viki">
                                                        <?php echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "<iframe width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>", $item1); ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (count($gallery_image + $gallery_image1) >= 1) {
                                            ?>
                                            <!-- Left and right controls -->
                                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                                <span class="carousel-control-prev-icon"></span>
                                            </a>
                                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                                <span class="carousel-control-next-icon"></span>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <!--END LISTING DETAILS: LEFT PART 3-->
                    <?php
                    if ($plan_type_row['plan_type_description'] == '1' || $plan_type_row['plan_type_social'] == '1') {
                        ?>

                        <!--LISTING DETAILS: LEFT PART 1-->
                        <div id="ld-abo" class="pglist-bg pglist-p-com">
                            <div class="pglist-p-com-ti">
                                <h3>
                                    <span><?php echo $BIZBOOK['LISTING_DETAILS_ABOUT']; ?></span> <?php echo $listrow['listing_name']; ?>
                                </h3></div>
                            <div class="list-pg-inn-sp list-pg-inn-abo">
                                <?php
                                if ($plan_type_row['plan_type_description'] == '1') {
                                    ?>
                                    <p><?php echo stripslashes($listrow['listing_description']); ?></p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <!--END LISTING DETAILS: LEFT PART 1-->
                        <!--LISTING DETAILS: LEFT PART 2-->
                        <?php if (!empty($listrow['service_id'])) { ?>
                            <div id="ld-ser" class="pglist-bg pglist-p-com">
                                <div class="pglist-p-com-ti">
                                    <h3>
                                        <span><?php echo $BIZBOOK['LISTING_DETAILS_SERVICES']; ?></span> <?php echo $BIZBOOK['LISTING_DETAILS_OFFERED']; ?>
                                    </h3></div>
                                <div class="list-pg-inn-sp">
                                    <div class="row pg-list-ser">
                                        <ul>
                                            <?php

                                            $service_name_array = explode(',', $listrow['service_id']);
                                            $service_image_array = explode(',', $listrow['service_image']);

                                            $zipped = array_map(null, $service_name_array, $service_image_array);

                                            foreach ($zipped as $tuple) {
                                                $tuple[0]; // service name
                                                $tuple[1]; // service Image

                                                ?>
                                                <li class="col-md-3">
                                                    <div class="pg-list-ser-p1"><img
                                                                src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                                class="b-lazy"
                                                                data-src="<?php echo $slash; ?>images/services/<?php if ($tuple[1] != NULL) {
                                                                    echo $tuple[1];
                                                                } else {
                                                                    echo "1.jpg";
                                                                } ?>"
                                                                alt="" loading="lazy"/>
                                                    </div>
                                                    <div class="pg-list-ser-p2">
                                                        <h4><?php echo $tuple[0]; ?></h4></div>
                                                </li>
                                                <?php
                                            }
                                            ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <!--END LISTING DETAILS: LEFT PART 2-->
                    <?php
                    if (!empty($listrow['service_locations'])) {
                        ?>
                        <!--START SERVICE AREAS-->
                        <div id="ld-ser" class="pglist-bg pglist-p-com">
                            <div class="pglist-p-com-ti">
                                <h3>
                                    <span><?php echo $BIZBOOK['LISTING_DETAILS_SERVICE']; ?></span> <?php echo $BIZBOOK['LISTING_DETAILS_AREAS']; ?>
                                </h3></div>
                            <div class="list-pg-inn-sp">
                                <div class="row pg-list-ser-area">
                                    <ul>
                                        <?php
                                        $service_locations = explode(',', $listrow['service_locations']);
                                        foreach ($service_locations as $places) {
                                            ?>
                                            <li><span><?php echo $places; ?></span></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--END SERVICE AREAS-->
                        <?php
                    }
                    ?>

                    <?php
                    if ((!empty($listrow['listing_products']))) {
                        ?>
                        <!--START PRODUCTS-->
                        <div id="ld-products" class="pglist-bg pglist-p-com pg-list-prod-sec">
                            <div class="pglist-p-com-ti">
                                <h3><?php echo $BIZBOOK['PRODUCTS']; ?>
                                </h3></div>
                            <div class="list-pg-inn-sp">
                                <div class="row plac-hom-all-pla pg-list-prod">
                                    <ul class="prod-sli">
                                        <?php
                                        $listing_products_array = $listrow['listing_products'];
                                        $listing_products1 = explode(',', $listing_products_array);
                                        foreach ($listing_products1 as $item) {

                                        $listing_products = getIdProduct($item);
                                        ?>
                                        <li>
                                            <div class="all-pro-box">
                                                <div class="all-pro-img">
                                                    <img loading="lazy"
                                                         src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                         class="b-lazy"
                                                         data-src="<?php echo $slash; ?><?php if ($listing_products['gallery_image'] != NULL || !empty($listing_products['gallery_image'])) {
                                                             echo "images/products/" . array_shift(explode(',', $listing_products['gallery_image']));
                                                         } else {
                                                             echo "images/listings/" . $footer_row['listing_default_image'];
                                                         } ?>"
                                                         class="b-lazy">
                                                </div>
                                                <div class="all-pro-txt">
                                                    <h4><?php echo $listing_products['product_name']; ?></h4>
                                                    <span class="pri"><b class="pro-off"><?php if($footer_row['currency_symbol_pos']== 1){ echo $footer_row['currency_symbol']; }  echo $listing_products['product_price'];  if($footer_row['currency_symbol_pos']== 2){ echo $footer_row['currency_symbol']; } ?></b> <?php if ($listing_products['product_price_offer'] != NULL) {  echo $listing_products['product_price_offer']; ?>% off <?php } ?> </span>
                                                </div>
                                                <div class="pg-pro-buy-cta">
                                                    <a <?php if($listing_products['product_payment_link'] != NULL ){ ?> target="_blank" href="<?php echo $listing_products['product_payment_link']; } else{ echo "#!";} ?>" class="cta-buy-now">Buy now</a>
                                                </div>
                                                <a href="<?php echo $PRODUCT_URL . urlModifier($listing_products['product_slug']); ?>"
                                                   class="pro-view-full"></a>
                                            </div>
                                        </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--END PRODUCTS-->
                        <?php
                    }
                    if ((!empty($listrow['listing_events']))) {
                        ?>

                        <!--START EVENTS-->
                        <div id="ld-events" class="pglist-bg pglist-p-com pg-list-prod-sec">
                            <div class="pglist-p-com-ti">
                                <h3><?php echo $BIZBOOK['EVENTS']; ?>
                                </h3></div>
                            <div class="list-pg-inn-sp">
                                <div class="row plac-hom-all-pla pg-list-prod">
                                    <ul class="prod-sli">
                                        <?php
                                        $listing_events_array = $listrow['listing_events'];
                                        $listing_events1 = explode(',', $listing_events_array);
                                        foreach ($listing_events1 as $item) {

                                            $listing_events = getEvent($item);
                                            ?>
                                        <li>
                                            <div class="plac-hom-box">
                                                <div class="plac-hom-box-im">
                                                    <img loading="lazy"
                                                         src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                         class="b-lazy"
                                                         data-src="<?php echo $slash; ?>images/events/<?php echo $listing_events['event_image']; ?>"
                                                         class="b-lazy">
                                                    <h4><?php echo $listing_events['event_name']; ?></h4>
                                                </div>
                                                <div class="rel-list-txt-box">
                                                    <span class="rat-small-num"><?php echo dateMonthFormatconverter($listing_events['event_start_date']); ?>&nbsp;<b><?php echo dateDayFormatconverter($listing_events['event_start_date']); ?></b></span>
                                                    <span class="rat-more-cta-ic">More details</span>
                                                </div>
                                                <a href="<?php echo $EVENT_URL . urlModifier($listing_events['event_slug']); ?>"
                                                   class="fclick"></a>
                                            </div>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--END EVENTS-->
                    <?php } ?>
                    <?php
                    if ($plan_type_row['plan_type_offers'] == '1') {

                        if (!empty($listrow['service_1_name'])) { ?>
                            <!--LISTING DETAILS: LEFT PART 4-->
                            <div id="ld-off" class="pglist-bg pglist-off-last pglist-p-com">
                                <div class="pglist-p-com-ti">
                                    <h3>
                                        <span><?php echo $BIZBOOK['LISTING_DETAILS_SPECIAL']; ?></span> <?php echo $BIZBOOK['LISTING_DETAILS_OFFERS']; ?>
                                    </h3></div>
                                <?php

                                $ser_1_name_Array = explode('|', $listrow['service_1_name']);
                                $ser_1_price_Array = explode(',', $listrow['service_1_price']);
                                $ser_1_detail_Array = explode('|', $listrow['service_1_detail']);
                                $ser_1_image_Array = explode(',', $listrow['service_1_image']);
                                $ser_1_view_more_Array = explode(',', $listrow['service_1_view_more']);

                                $zipped = array_map(null, $ser_1_name_Array, $ser_1_price_Array, $ser_1_detail_Array, $ser_1_image_Array, $ser_1_view_more_Array);

                                foreach ($zipped as $tuple) {
                                    $tuple[0]; // offer name
                                    $tuple[1]; // offer Price
                                    stripslashes($tuple[2]); // offer Detail
                                    $tuple[3]; // offer Image
                                    $tuple[4]; // offer View More

                                    ?>
                                    <div class="list-pg-inn-sp">
                                        <div class="home-list-pop">
                                            <!--LISTINGS IMAGE-->
                                            <div class="col-md-3"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                        class="b-lazy"
                                                        data-src="<?php echo $slash; ?>images/services/<?php if ($tuple[3] != NULL) {
                                                            echo $tuple[3];
                                                        } else {
                                                            echo "5.jpg";
                                                        } ?>" alt="" loading="lazy"></div>
                                            <!--LISTINGS: CONTENT-->
                                            <div class="col-md-9 home-list-pop-desc inn-list-pop-desc list-room-deta"><a
                                                        href="#!"><h3><?php echo $tuple[0]; ?></h3></a>
                                                <p><?php echo $tuple[2]; ?></p>
                                                <?php
                                                if (!empty($tuple[1])) {
                                                    ?>
                                                    <span
                                                            class="home-list-pop-rat list-rom-pric"><?php if ($footer_row['currency_symbol_pos'] == 1) {
                                                            echo $footer_row['currency_symbol'];
                                                        } ?><?php echo $tuple[1]; ?><?php if ($footer_row['currency_symbol_pos'] == 2) {
                                                            echo $footer_row['currency_symbol'];
                                                        } ?></span>
                                                    <?php
                                                }
                                                ?>
                                                <div class="list-enqu-btn">
                                                    <ul>
                                                        <li>
                                                            <a <?php if ($tuple[4] != NULL){ ?>target="_blank" <?php } ?>
                                                               href="<?php if ($tuple[4] != NULL) {
                                                                   echo $tuple[4];
                                                               } else { ?>#! <?php } ?>"><?php echo $BIZBOOK['VIEW_MORE']; ?></a>
                                                        </li>
                                                        <li><a href="#!" data-toggle="modal"
                                                               data-target="#quote"><?php echo $BIZBOOK['LEAD-SEND-ENQUIRY']; ?></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                            <?php
                        }
                    }
                    ?>

                    <?php
                    if ($plan_type_row['plan_type_maps'] == '1') {
                        ?>
                        <!--LISTING DETAILS: LEFT PART 8-->
                        <?php if (!empty($listrow['google_map'])) { ?>
                            <div id="location" class="pglist-p3 pglist-bg pglist-p-com">
                                <div class="pglist-p-com-ti">
                                    <h3><span><?php echo $BIZBOOK['OUR']; ?></span> <?php echo $BIZBOOK['LOCATION']; ?>
                                    </h3></div>

                                <div class="list-pg-inn-sp">
                                    <div class="list-pg-map">
                                        <?php echo $listrow['google_map']; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    <?php } ?>

                    <div class="list-sh">
                        <span class="share-new" data-toggle="modal" data-target="#sharepop"><i class="material-icons">share</i> Share now</span>
                    </div>

                    <!--END 360 DEGREE MAP: LEFT PART 8-->
                    <?php
                    if ($plan_type_row['plan_type_ratings'] == '1') {
                        ?>

                        <?php

                        //To Check whether listing owner made listing review option enabled

                        $setting_review = $usersqlrow['setting_review'];
                        if ($setting_review == 0) {
                            ?>

                            <!--LISTING DETAILS: LEFT PART 6-->
                            <?php
                            if ($list_user_id != $session_user_id) {
                                ?>
                                <?php if (empty($session_user_id) || $session_user_id == Null) {
                                    ?>
                                    <span
                                            id="Review_Disable"><?php echo $BIZBOOK['LISTING_DETAILS_LOGIN_AND_WRITE_REVIEW']; ?></span>
                                    <?php
                                }
                                ?>

                                <!--LISTING DETAILS: LEFT PART 6-->
                                <div class="pglist-bg pglist-p-com"
                                     style="<?php if (empty($session_user_id) || $session_user_id == Null) {
                                         ?>
                                             pointer-events:none; opacity: .5
                                         <?php
                                     }
                                     ?>" id="ld-rev">
                                    <div class="pglist-p-com-ti">
                                        <h3>
                                            <span><?php echo $BIZBOOK['LISTING_DETAILS_WRITE_YOUR']; ?></span> <?php echo $BIZBOOK['REVIEWS']; ?>
                                        </h3></div>
                                    <div class="list-pg-inn-sp">
                                        <div class="list-pg-write-rev">
                                            <form class="col" <?php if ($session_plan_type_row['plan_type_ratings'] == 0 && $user_details_row['user_type'] != "General") {
                                                echo '';
                                            } else { ?> name="review_form" id="review_form" method="post" <?php } ?>>
                                                <input type="hidden" class="form-control" name="listing_id"
                                                       value="<?php echo $listrow['listing_id']; ?>">
                                                <input type="hidden" class="form-control" name="listing_user_id"
                                                       value="<?php echo $list_user_id; ?>">
                                                <input name="review_user_id" value="<?php echo $session_user_id; ?>"
                                                       type="hidden"
                                                >
                                                <p><?php echo $BIZBOOK['LISTING_DETAILS_REVIEW_P_TAG']; ?>:</p>
                                                <div id="review_success"
                                                     style="text-align:center;display: none;color: green;"><?php echo $BIZBOOK['LISTING_DETAILS_REVIEW_SUCCESS_MESSAGE']; ?>
                                                </div>
                                                <div id="review_fail"
                                                     style="text-align:center;display: none;color: red;"><?php echo $BIZBOOK['OOPS_SOMETHING_WENT_WRONG']; ?></div>
                                                <div class="row">
                                                    <div>
                                                        <fieldset class="rating">
                                                            <input type="radio" id="star5" name="price_rating"
                                                                   class="price_rating" value="5"/>
                                                            <label class="full" for="star5" title="Awesome"></label>
                                                            <input type="radio" id="star4" name="price_rating"
                                                                   class="price_rating" value="4"/>
                                                            <label class="full" for="star4" title="Excellent"></label>
                                                            <input type="radio" checked="checked" id="star3"
                                                                   class="price_rating" name="price_rating" value="3"/>
                                                            <label class="full" for="star3" title="Good"></label>
                                                            <input type="radio" id="star2" name="price_rating"
                                                                   class="price_rating" value="2"/>
                                                            <label class="full" for="star2" title="Average"></label>
                                                            <input type="radio" id="star1" name="price_rating"
                                                                   class="price_rating" value="1"/>
                                                            <label class="full" for="star1" title="Poor"></label>
                                                            <!--                                                            <input type="radio" id="star0" name="price_rating"-->
                                                            <!--                                                                   class="price_rating" value="0"/>-->
                                                            <!--                                                            <label class="" for="star0" title="Very Poor"></label>-->
                                                        </fieldset>
                                                        <div id="star-value">3 Star</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s6">
                                                        <input
                                                                id="review_name" <?php if (!empty($_SESSION['user_name'])) {
                                                            echo "readonly";
                                                        } ?> <?php if ($session_plan_type_row['plan_type_ratings'] == 0 && $user_details_row['user_type'] != "General") {
                                                            echo "disabled";
                                                        } ?> name="review_name" type="text"
                                                                value="<?php if (!empty($_SESSION['user_name'])) {
                                                                    echo $user_details_row['first_name'];
                                                                } ?>">
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <input
                                                                id="review_mobile" <?php if (!empty($_SESSION['user_name'])) {
                                                            echo "readonly";
                                                        } ?> <?php if ($session_plan_type_row['plan_type_ratings'] == 0 && $user_details_row['user_type'] != "General") {
                                                            echo "disabled";
                                                        } ?> name="review_mobile" type="text"
                                                                onkeypress="return isNumber(event)"
                                                                placeholder="Mobile number"
                                                                value="<?php if (!empty($_SESSION['user_name'])) {
                                                                    echo $user_details_row['mobile_number'];
                                                                } ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s6">
                                                        <input
                                                                id="review_email" <?php if (!empty($_SESSION['user_name'])) {
                                                            echo "readonly";
                                                        } ?> <?php if ($session_plan_type_row['plan_type_ratings'] == 0 && $user_details_row['user_type'] != "General") {
                                                            echo "disabled";
                                                        } ?> name="review_email" type="email" placeholder="Email Id"
                                                                value="<?php if (!empty($_SESSION['user_name'])) {
                                                                    echo $user_details_row['email_id'];
                                                                } ?>">
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <input id="review_city" <?php if ($session_plan_type_row['plan_type_ratings'] == 0 && $user_details_row['user_type'] != "General") {
                                                            echo "disabled";
                                                        } ?> name="review_city" placeholder="City"
                                                               type="text">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                    <textarea
                                                            id="review_message" <?php if ($session_plan_type_row['plan_type_ratings'] == 0 && $user_details_row['user_type'] != "General") {
                                                        echo "disabled";
                                                    } ?> placeholder="Write review"
                                                            name="review_message"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <?php if ($session_plan_type_row['plan_type_ratings'] == 0 && $user_details_row['user_type'] != "General") { ?>
                                                            <input type="submit" id="" name="" disabled="disabled"
                                                                   readonly="readonly"
                                                                   value="<?php echo $BIZBOOK['LISTING_DETAILS_UNABLE_SUBMIT_REVIEW']; ?>">
                                                        <?php } else { ?>
                                                            <input type="submit" id="review_submit" name="review_submit"
                                                                   value="<?php echo $BIZBOOK['LISTING_DETAILS_SUBMIT_REVIEW']; ?>">
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <!--END LISTING DETAILS: LEFT PART 6-->
                            <?php
                        }
                    }
                    ?>
                    <!--END LISTING DETAILS: LEFT PART 6-->

                    <?php
                    if ($plan_type_row['plan_type_ratings'] == '1') {
                        ?>

                        <!--LISTING DETAILS: LEFT PART 5-->
                        <?php

                        if ($review_count > 0) {

                            ?>
                            <!--LISTING DETAILS: LEFT PART 5-->
                            <div class="pglist-p3 pglist-bg pglist-p-com" id="ld-rev">
                                <div class="pglist-p-com-ti">
                                    <h3><span><?php echo $BIZBOOK['USER']; ?></span> <?php echo $BIZBOOK['REVIEWS']; ?>
                                    </h3></div>
                                <div class="list-pg-inn-sp">
                                    <div class="lp-ur-all">
                                        <div class="lp-ur-all-left">
                                            <div class="lp-ur-all-left-1">
                                                <div
                                                        class="lp-ur-all-left-11"><?php echo $BIZBOOK['EXCELLENT']; ?></div>
                                                <div class="lp-ur-all-left-12">
                                                    <div class="lp-ur-all-left-13"></div>
                                                </div>
                                            </div>
                                            <div class="lp-ur-all-left-1">
                                                <div class="lp-ur-all-left-11"><?php echo $BIZBOOK['GOOD']; ?></div>
                                                <div class="lp-ur-all-left-12">
                                                    <div class="lp-ur-all-left-13 lp-ur-all-left-Good"></div>
                                                </div>
                                            </div>
                                            <div class="lp-ur-all-left-1">
                                                <div
                                                        class="lp-ur-all-left-11"><?php echo $BIZBOOK['SATISFACTORY']; ?></div>
                                                <div class="lp-ur-all-left-12">
                                                    <div class="lp-ur-all-left-13 lp-ur-all-left-satis"></div>
                                                </div>
                                            </div>
                                            <div class="lp-ur-all-left-1">
                                                <div
                                                        class="lp-ur-all-left-11"><?php echo $BIZBOOK['BELOW_AVERAGE']; ?></div>
                                                <div class="lp-ur-all-left-12">
                                                    <div class="lp-ur-all-left-13 lp-ur-all-left-below"></div>
                                                </div>
                                            </div>
                                            <div class="lp-ur-all-left-1">
                                                <div
                                                        class="lp-ur-all-left-11"><?php echo $BIZBOOK['BELOW_AVERAGE']; ?></div>
                                                <div class="lp-ur-all-left-12">
                                                    <div class="lp-ur-all-left-13 lp-ur-all-left-poor"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lp-ur-all-right">
                                            <h5><?php echo $BIZBOOK['OVERALL_RATINGS']; ?></h5>
                                            <p>
                                                <?php
                                                if ($star_rate != 0) {
                                                    ?>
                                                    <label class="rat">
                                                        <?php
                                                        for ($i = 1; $i <= ceil($star_rate); $i++) {
                                                            ?>
                                                            <i class="material-icons">star</i>
                                                            <?php
                                                        }
                                                        $bal_star_rate = abs(ceil($star_rate) - 5);

                                                        for ($i = 1; $i <= $bal_star_rate; $i++) {
                                                            ?>
                                                            <i class="material-icons ratstar">star</i>
                                                            <?php
                                                        }
                                                        ?>
                                                    </label>
                                                    <?php
                                                }
                                                ?>
                                                <span><?php echo $BIZBOOK['BASED_ON']; ?><?php echo $review_count; ?><?php echo $BIZBOOK['REVIEWS']; ?></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="lp-ur-all-rat">
                                        <h5><?php echo $BIZBOOK['REVIEWS']; ?></h5>
                                        <ul>
                                            <?php
                                            foreach (getAllListingReviews($listing_id) as $reviewsqlrow) {

                                                $review_user_id = $reviewsqlrow['review_user_id'];

                                                $total_per_user_rating = round((($reviewsqlrow['price_rating'] + $reviewsqlrow['customer_service_rating'] + $reviewsqlrow['staff_rating'] + $reviewsqlrow['overall_rating']) / 4), 1);

                                                $revuser_details_row = getUser($review_user_id); // To Fetch particular User Data

                                                ?>
                                                <li>
                                                    <div class="lr-user-wr-img"><img
                                                                src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                                class="b-lazy"
                                                                data-src="<?php echo $slash; ?>images/user/<?php if (($revuser_details_row['profile_image'] == NULL) || empty($revuser_details_row['profile_image'])) {
                                                                    echo $footer_row['user_default_image'];
                                                                } else {
                                                                    echo $revuser_details_row['profile_image'];
                                                                } ?>" alt="" loading="lazy">
                                                    </div>
                                                    <div class="lr-user-wr-con">
                                                        <h6><?php echo $reviewsqlrow['review_name']; ?></h6>
                                                        <label class="rat">
                                                            <?php if ($reviewsqlrow['price_rating'] == 1) { ?>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star_border</i>
                                                                <i class="material-icons">star_border</i>
                                                                <i class="material-icons">star_border</i>
                                                                <i class="material-icons">star_border</i>
                                                            <?php } ?>
                                                            <?php if ($reviewsqlrow['price_rating'] == 2) { ?>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star_border</i>
                                                                <i class="material-icons">star_border</i>
                                                                <i class="material-icons">star_border</i>
                                                            <?php } ?>
                                                            <?php if ($reviewsqlrow['price_rating'] == 3) { ?>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star_border</i>
                                                                <i class="material-icons">star_border</i>
                                                            <?php } ?>
                                                            <?php if ($reviewsqlrow['price_rating'] == 4) { ?>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star_border</i>
                                                            <?php } ?>
                                                            <?php if ($reviewsqlrow['price_rating'] == 5) { ?>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star</i>
                                                            <?php } ?>
                                                        </label>
                                                        <span
                                                                class="lr-revi-date"><?php echo dateFormatconverter($reviewsqlrow['review_cdt']); ?></span>
                                                        <p><?php echo stripslashes($reviewsqlrow['review_message']); ?></p>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div
                                    class="spa-first-review"><?php echo $BIZBOOK['LISTING_DETAILS_BE_FIRST_REVIEW']; ?></div>
                            <?php
                        }
                        ?>

                        <?php
                    }
                    ?>
                    <!--END LISTING DETAILS: LEFT PART 5-->

                    <!--ADS-->
                    <div class="ban-ati-com ads-det-page">
                        <?php
                        $ad_position_id = 6;   //Ad position on Listing Detail Bottom
                        $get_ad_row = getAds($ad_position_id);
                        $ad_enquiry_photo = $get_ad_row['ad_enquiry_photo'];
                        ?>
                        <a href="<?php echo stripslashes($get_ad_row['ad_link']); ?>"><span><?php echo $BIZBOOK['AD']; ?></span><img
                                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                    class="b-lazy"
                                    data-src="<?php echo $slash; ?>images/ads/<?php if ($ad_enquiry_photo != NULL || !empty($ad_enquiry_photo)) {
                                        echo $ad_enquiry_photo;
                                    } else {
                                        echo "59040boat-728x90.png";
                                    } ?>" loading="lazy"></a>
                    </div>
                    <!--ADS-->
                </div>

                <!--RELATED PREMIUM LISTINGS-->
                <div class="list-det-rel-pre">
                    <h2><?php echo $BIZBOOK['LISTING_DETAILS_RELATED_LISTINGS']; ?>:</h2>
                    <ul class="multiple-items1">
                        <?php
                        foreach (getExceptListingCategoryListing($list_category_id, $listing_id) as $except_list_row) {
                            $except_listing_id = $except_list_row['listing_id'];

                            // List Rating. for Rating of Star
                            foreach (getListingReview($except_listing_id) as $star_rating_row_except) {
                                if ($star_rating_row_except["rate_cnt"] > 0) {
                                    $star_rate_times_except = $star_rating_row_except["rate_cnt"];
                                    $star_sum_rates_except = $star_rating_row_except["total_rate"];
                                    $star_rate_one_except = $star_sum_rates_except / $star_rate_times_except;
                                    $star_rate_two_except = number_format($star_rate_one_except, 1);
                                    $star_rate_except = $star_rate_one_except;

                                } else {
                                    $rate_times_except = 0;
                                    $rate_value_except = 0;
                                    $star_rate_except = 0;
                                }
                            }

                            ?>
                            <li>
                                <div class="plac-hom-box">
                                    <div class="plac-hom-box-im">
                                        <img
                                                src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                class="b-lazy"
                                                data-src="<?php if ($except_list_row['profile_image'] != NULL || !empty($except_list_row['profile_image'])) {
                                                    echo $slash . "images/listings/" . $except_list_row['profile_image'];
                                                } else {
                                                    echo $slash . "images/listings/" . $footer_row['listing_default_image'];
                                                } ?>" alt="" loading="lazy">
                                        <h4><?php echo $except_list_row['listing_name']; ?></h4>
                                    </div>
                                    <div class="rel-list-txt-box">
                                        <span class="rat-small-num"><?php if ($star_rate_two_except == '' || $star_rate_two_except == 0) {
                                                echo "0.0";
                                            } else {
                                                echo $star_rate_two_except;
                                            } ?></span>
                                        <span class="rat-more-cta-ic"><?php echo $BIZBOOK['PLACE-MORE-DETAILS']; ?></span>
                                    </div>
                                    <a href="<?php echo $LISTING_URL . urlModifier($except_list_row['listing_slug']); ?>"
                                       class="fclick"></a>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <!--RELATED PREMIUM LISTINGS-->
            </div>
        </div>
    </div>
</section>

<?php
include "footer.php";
?>

<section>
    <div class="pop-ups pop-quo">
        <!-- The Modal -->
        <div class="modal fade" id="quote">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="log-bor">&nbsp;</div>
                    <span class="udb-inst"><?php echo $BIZBOOK['LEAD-SEND-ENQUIRY']; ?></span>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
                    <div class="quote-pop">
                        <h4><?php echo $BIZBOOK['LEAD-GET-QUOTE']; ?></h4>
                        <div id="pop_enq_success" class="log" style="display: none;">
                            <p><?php echo $BIZBOOK['ENQUIRY_SUCCESSFUL_MESSAGE']; ?></p>
                        </div>
                        <div id="pop_enq_same" class="log" style="display: none;">
                            <p><?php echo $BIZBOOK['ENQUIRY_OWN_LISTING_MESSAGE']; ?></p>
                        </div>
                        <div id="pop_enq_fail" class="log" style="display: none;">
                            <p><?php echo $BIZBOOK['OOPS_SOMETHING_WENT_WRONG']; ?></p>
                        </div>
                        <form method="post" name="popup_enquiry_form" id="popup_enquiry_form">
                            <input type="hidden" class="form-control" name="listing_id"
                                   value="<?php echo $listing_id ?>"
                                   placeholder=""
                                   required>
                            <input type="hidden" class="form-control"
                                   name="listing_user_id"
                                   value="<?php echo $list_user_id; ?>" placeholder=""
                                   required>
                            <input type="hidden" class="form-control"
                                   name="enquiry_sender_id"
                                   value="<?php echo $session_user_id; ?>"
                                   placeholder=""
                                   required>
                            <input type="hidden" class="form-control"
                                   name="enquiry_source"
                                   value="<?php if (isset($_GET["src"])) {
                                       echo $_GET["src"];
                                   } else {
                                       echo "Website";
                                   }; ?>"
                                   placeholder=""
                                   required>
                            <div class="form-group">
                                <input type="text" name="enquiry_name"
                                       value="<?php echo $user_details_row['first_name'] ?>"
                                       required="required" class="form-control"
                                       placeholder="<?php echo $BIZBOOK['LEAD-NAME-PLACEHOLDER']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control"
                                       placeholder="<?php echo $BIZBOOK['ENTER_EMAIL_STAR']; ?>" required="required"
                                       value="<?php echo $user_details_row['email_id'] ?>"
                                       name="enquiry_email"
                                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                       title="<?php echo $BIZBOOK['LEAD-INVALID-EMAIL-TITLE']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control"
                                       value="<?php echo $user_details_row['mobile_number'] ?>"
                                       name="enquiry_mobile"
                                       placeholder="<?php echo $BIZBOOK['LEAD-MOBILE-PLACEHOLDER']; ?>"
                                       pattern="[7-9]{1}[0-9]{9}"
                                       title="<?php echo $BIZBOOK['LEAD-INVALID-MOBILE-TITLE']; ?>"
                                       required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="enquiry_message"
                                          placeholder="<?php echo $BIZBOOK['LEAD-MESSAGE-PLACEHOLDER']; ?>"></textarea>
                            </div>
                            <input type="hidden" id="source">
                            <?php if ($session_plan_type_row['plan_type_ratings'] == 0 && $user_details_row['user_type'] != "General") { ?>
                                <button disabled="disabled" type="submit" id="popup_enquiry_submit"
                                        name="popup_enquiry_submit"
                                        class="btn btn-primary"><?php echo $BIZBOOK['LISTING_DETAILS_UNABLE_SUBMIT_ENQUIRY']; ?>
                                </button>
                            <?php } else { ?>
                                <button <?php if ($session_user_id == NULL || empty($session_user_id)) {
                                    ?> disabled="disabled" <?php } ?> type="submit" id="popup_enquiry_submit"
                                                                      name="popup_enquiry_submit"
                                                                      class="btn btn-primary"><?php if ($session_user_id == NULL || empty($session_user_id)) {
                                        ?><?php echo $BIZBOOK['LOG_IN_TO_SUBMIT']; ?><?php } else { ?><?php echo $BIZBOOK['SUBMIT']; ?><?php } ?>
                                </button>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="claim">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="log-bor">&nbsp;</div>
                    <span class="udb-inst"><?php echo $BIZBOOK['LISTING_DETAILS_CLAIM_NOW']; ?></span>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
                    <div class="quote-pop">
                        <h4><?php echo $BIZBOOK['LISTING_DETAILS_CLAIM_THIS_BUSINESS']; ?></h4>
                        <div id="pop_claim_success" class="log" style="display: none;">
                            <p><?php echo $BIZBOOK['LISTING_DETAILS_CLAIM_SUCCESS_MESSAGE']; ?></p>
                        </div>
                        <div id="pop_claim_same" class="log" style="display: none;">
                            <p><?php echo $BIZBOOK['ENQUIRY_OWN_LISTING_MESSAGE']; ?></p>
                        </div>
                        <div id="pop_claim_fail" class="log" style="display: none;">
                            <p><?php echo $BIZBOOK['OOPS_SOMETHING_WENT_WRONG']; ?></p>
                        </div>
                        <form method="post" name="popup_claim_form" id="popup_claim_form">
                            <fieldset <?php if ($list_user_id == $session_user_id || empty($session_user_id) || $session_user_id == Null) {
                                ?> disabled="disabled" <?php } ?>>
                                <input type="hidden" class="form-control" name="listing_id"
                                       value="<?php echo $listing_id ?>"
                                       placeholder=""
                                       required>
                                <input type="hidden" class="form-control"
                                       name="listing_user_id"
                                       value="<?php echo $list_user_id; ?>" placeholder=""
                                       required>
                                <input type="hidden" class="form-control"
                                       name="enquiry_sender_id"
                                       value="<?php echo $session_user_id; ?>"
                                       placeholder=""
                                       required>
                                <input type="hidden" class="form-control"
                                       name="enquiry_source"
                                       value="<?php if (isset($_GET["src"])) {
                                           echo $_GET["src"];
                                       } else {
                                           echo "Website";
                                       }; ?>"
                                       placeholder=""
                                       required>
                                <div class="form-group">
                                    <input type="text" name="enquiry_name"
                                           value=""
                                           required="required" class="form-control"
                                           placeholder="<?php echo $BIZBOOK['LEAD-NAME-PLACEHOLDER']; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control"
                                           placeholder="<?php echo $BIZBOOK['LEAD-EMAIL-PLACEHOLDER']; ?>"
                                           required="required"
                                           value=""
                                           name="enquiry_email"
                                           pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                           title="<?php echo $BIZBOOK['LEAD-INVALID-EMAIL-TITLE']; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           value=""
                                           name="enquiry_mobile"
                                           placeholder="<?php echo $BIZBOOK['LEAD-MOBILE-PLACEHOLDER']; ?>"
                                           pattern="[7-9]{1}[0-9]{9}"
                                           title="<?php echo $BIZBOOK['LEAD-INVALID-MOBILE-TITLE']; ?>"
                                           required>
                                </div>
                                <div class="form-group">
                                    <div class="fil-img-uplo">
                                        <span class="dumfil"><?php echo $BIZBOOK['LEAD-IDENTIFICATION-PROOF-TITLE']; ?></span>
                                        <input type="file" name="enquiry_image" accept="image/*,.jpg,.jpeg,.png"
                                               class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                <textarea class="form-control" rows="3" name="enquiry_message"
                                          placeholder="<?php echo $BIZBOOK['LEAD-WHY-CLAIM-BUSINESS-TITLE']; ?>"></textarea>
                                </div>
                                <input type="hidden" id="source">
                                <button type="submit"
                                    <?php if ($list_user_id == $session_user_id || empty($session_user_id) || $session_user_id == Null) {
                                        ?> disabled="disabled" <?php } ?> id="popup_claim_submit"
                                        name="popup_claim_submit"
                                        class="btn btn-primary"><?php if (empty($session_user_id) || $session_user_id == Null) {
                                        ?><?php echo $BIZBOOK['LOG_IN_TO_SUBMIT']; ?>
                                    <?php } elseif ($list_user_id == $session_user_id) { ?><?php echo $BIZBOOK['LISTING_DETAILS_ITS_YOURS']; ?>
                                    <?php } else { ?><?php echo $BIZBOOK['LISTING_DETAILS_CLAIM_NOW']; ?><?php } ?>
                                </button>
                            </fieldset>
                        </form>
                        <div class="form-notes"><p><?php echo $BIZBOOK['LISTING_DETAILS_CLAIM_P_TAG']; ?></p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SHARE POPUP -->
<div class="modal fade sharepop" id="sharepop">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Share now</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <input type="text" value="" id="shareurl">
                <div class="shareurltip">
                    <button onclick="shareurl()" onmouseout="shareurlout()">
                        <span class="shareurltxt" id="myTooltip">Copy to clipboard</span>
                        Copy text
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- GALLERY POPUP -->
<div class="modal" id="galPop">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <!-- Modal body -->
            <div class="modal-body">
                <img src="http://localhost/bizbook/images/listings/34803pexels-photo-1779487.jpeg" alt="">
            </div>


        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo $slash; ?>js/jquery.min.js"></script>
<script src="<?php echo $slash; ?>js/popper.min.js"></script>
<script src="<?php echo $slash; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $slash; ?>js/jquery-ui.js"></script>
<script src="<?php echo $slash; ?>js/slick.js"></script>
<script src="<?php echo $slash; ?>js/select-opt.js"></script>
<script src="<?php echo $slash; ?>js/blazy.min.js"></script>
<script type="text/javascript">var webpage_full_link = '<?php echo $webpage_full_link;?>';</script>
<script type="text/javascript">var login_url = '<?php echo $LOGIN_URL;?>';</script>
<script src="<?php echo $slash; ?>js/custom.js"></script>
<script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo $slash; ?>js/custom_validation.js"></script>
<script>
    $('.multiple-items1').slick({
        dots: true,
        arrows: false,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
            breakpoint: 992,
            settings: {
                dots: false,
                arrows: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false
            }
        }]

    });
    $('.prod-sli').slick({
        arrows: true,
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 3000,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false
            }
        }]

    });

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        var x = $(".list-pg-bg").offset().top;
        if (scroll >= x) {
            $(".list-det-fix").addClass("list-det-fix-act");
        }
        else {
            $(".list-det-fix").removeClass("list-det-fix-act");
        }
    });
    function scrollNav() {
        $('.v3-list-ql-inn a').click(function () {
            //Toggle Class
            $(".active-list").removeClass("active-list");
            $(this).closest('li').addClass("active-list");
            var theClass = $(this).attr("class");
            $('.' + theClass).parent('li').addClass('active-list');
            //Animate
            $('html, body').stop().animate({
                scrollTop: $($(this).attr('href')).offset().top - 130
            }, 400);
            return false;
        });
        $('.scrollTop a').scrollTop();
    }
    scrollNav();
</script>

<script>
    $(document).ready(function () {
        $(".today").click(function () {
            $(".timing").slideToggle();
        })
        $(".galPop").click(function () {
            var _imgPath = $(this).attr("src");
            $("#galPop img").attr("src", _imgPath);
        })
        $('input[name="price_rating"]').change(function () {
            if ($('#star0').prop('checked')) {
                $("#star-value").html('0 Star');
            }
            else if ($('#star1').prop('checked')) {
                $("#star-value").html('1 Star');
            }
            else if ($('#star2').prop('checked')) {
                $("#star-value").html('2 Star');
            }
            else if ($('#star3').prop('checked')) {
                $("#star-value").html('3 Star');
            }
            else if ($('#star4').prop('checked')) {
                $("#star-value").html('4 Star');
            }
            else if ($('#star5').prop('checked')) {
                $("#star-value").html('5 Star');
            }
        });
    });
</script>

</body>

</html>