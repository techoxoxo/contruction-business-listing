<?php
include "ads-config-info.php";
include "../header.php";

if($footer_row['admin_ad_post_show'] != 1) {
    header("Location: ".$webpage_full_link."dashboard");
}

?>
<link rel="stylesheet" href="<?php echo $slash; ?>ads/ad-style.css">
<style>
    .hom-head .container {
        display: none
    }

    .hom-top {
        transition: all .5s ease;
        background: #000;
        box-shadow: none
    }

    .hom-head {
        background: none !important;
        padding: 0;
        margin: 0
    }

    .hom-head .hom-top .container {
        display: block
    }

    .hom-top {
        background: #292c2e;
    }
</style>

<!-- START -->
<section class="modu-hom-ban ads-hom-ban">
    <div class="modu-hom-ban-inn">
    <div class="container">
                <div class="row">
        <h1><?php echo $BIZBOOK['ADS-HOM-BAN-TIT']; ?></h1>
        <p><?php echo $BIZBOOK['ADS-HOM-BAN-SUBTIT']; ?></p>
        </div>
        </div>
    </div>
</section>
<!--END-->

<section>
        <div class="ad-modu-com ad-sec-pad asd-all-hom">
            <div class="container">
                <div class="row">
                    <div class="plac-det-tit-inn">
                        <h2><?php echo $BIZBOOK['ADS_POST_HOME_PAGE_THIRD_DIV_TITLE']; ?></h2>
                    </div>
                    <div class="plac-hom-all-pla">
                        <ul>
                            <?php
                            foreach (getAllAdPostCategories() as $ads_row) {

                                $category_id = $ads_row['category_id'];

                                $fresh_ad_postrow = getAllAdPostCategoryLimitOne($category_id); //To Fetch the ads
                                $gallery_image = $fresh_ad_postrow['gallery_image'];

                                    ?>
                                    <li>
                                        <div class="plac-hom-box ad-box">
                                            <div class="plac-hom-box-im">
                                                <img src="<?php if ($gallery_image != NULL || !empty($gallery_image)) {
                                                    echo $slash . "ads/images/" . array_shift(explode(',', $gallery_image));
                                                } else {
                                                    echo $slash . "images/listings/" . $footer_row['listing_default_image'];
                                                } ?>" class="b-lazy b-loaded"
                                                     alt="">
                                            </div>
                                            <div class="ad-box-txt">
                                                <h3><?php echo $ads_row['category_name']; ?></h3>
                                            </div>
                                            <a href="<?php echo $ALL_AD_POST_URL .'?category='. urlModifier($ads_row['category_slug']); ?>"
                                               class="fclick" tabindex="0"></a>
                                        </div>
                                    </li>
                                    <?php
                            }
                            ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


<section>
        <div class="ad-modu-com ad-sec-pad plac-deta-sec">
            <div class="container">
                <div class="row">
                    <div class="plac-det-tit-inn">
                        <h2><?php echo $BIZBOOK['ADS_POST_HOME_PAGE_FIRST_DIV_TITLE']; ?></h2>
                    </div>
                    <div class="plac-hom-all-pla">
                        <ul class="multiple-items1">
                            <?php
                            foreach (getAllTopViewsPremiumActiveAdPost() as $latest_ad_postrow) {

                                $latest_ad_post_id = $latest_ad_postrow['ad_post_id'];

                                $latest_ad_post_category_id = $latest_ad_postrow['category_id'];

                                ?>
                                <li>
                                    <div class="plac-hom-box ad-box">
                                        <div class="plac-hom-box-im">
                                            <img src="<?php if ($latest_ad_postrow['gallery_image'] != NULL || !empty($latest_ad_postrow['gallery_image'])) {
                                                echo $slash."ads/images/" . array_shift(explode(',', $latest_ad_postrow['gallery_image']));
                                            } else {
                                                echo $slash."images/listings/" . $footer_row['listing_default_image'];
                                            } ?>" class="b-lazy b-loaded"
                                                 alt="">
                                            <h4><?php if($footer_row['currency_symbol_pos']== 1){ echo $footer_row['currency_symbol']; } ?><?php echo $latest_ad_postrow['ad_post_price']; ?><?php if($footer_row['currency_symbol_pos']== 2){ echo $footer_row['currency_symbol']; } ?></h4>
                                        </div>
                                        <div class="ad-box-txt">
                                            <h3><?php echo $latest_ad_postrow['ad_post_name']; ?></h3>
                                            <span class="loc"><?php echo $latest_ad_postrow['ad_post_address']; ?></span>
                                            <span class="dat"><?php
                                                $now = time(); // or your date as well
                                                $your_date = strtotime($latest_ad_postrow['ad_post_cdt']);
                                                $datediff = $now - $your_date;

                                                echo round($datediff / (60 * 60 * 24));
                                                ?> Days old</span>
                                        </div>
                                        <a href="<?php echo $AD_POST_URL.urlModifier($latest_ad_postrow['ad_post_slug']); ?>" class="fclick" tabindex="0"></a>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="ad-modu-com ad-sec-pad plac-deta-sec">
            <div class="container">
                <div class="row">
                    <div class="plac-det-tit-inn">
                        <h2><?php echo $BIZBOOK['ADS_POST_HOME_PAGE_SECOND_DIV_TITLE']; ?></h2>
                    </div>
                    <div class="plac-hom-all-pla">
                        <ul class="multiple-items1">
                            <?php
                            foreach (getAllTopViewsTodayDatedAdPost() as $today_ad_postrow) {

                                $today_ad_post_id = $today_ad_postrow['ad_post_id'];

                                ?>
                                <li>
                                    <div class="plac-hom-box ad-box">
                                        <div class="plac-hom-box-im">
                                            <img src="<?php if ($today_ad_postrow['gallery_image'] != NULL || !empty($today_ad_postrow['gallery_image'])) {
                                                echo $slash."ads/images/" . array_shift(explode(',', $today_ad_postrow['gallery_image']));
                                            } else {
                                                echo $slash."images/listings/" . $footer_row['listing_default_image'];
                                            } ?>" class="b-lazy b-loaded"
                                                 alt="">
                                            <h4><?php if($footer_row['currency_symbol_pos']== 1){ echo $footer_row['currency_symbol']; } ?><?php echo $today_ad_postrow['ad_post_price']; ?><?php if($footer_row['currency_symbol_pos']== 2){ echo $footer_row['currency_symbol']; } ?></h4>
                                        </div>
                                        <div class="ad-box-txt">
                                            <h3><?php echo $today_ad_postrow['ad_post_name']; ?></h3>
                                            <span class="loc"><?php echo $today_ad_postrow['ad_post_address']; ?></span>
                                            <span class="dat"><?php
                                                $now = time(); // or your date as well
                                                $your_date = strtotime($today_ad_postrow['ad_post_cdt']);
                                                $datediff = $now - $your_date;

                                                echo round($datediff / (60 * 60 * 24));
                                                ?> Days old</span>
                                        </div>
                                        <a href="<?php echo $AD_POST_URL.urlModifier($today_ad_postrow['ad_post_slug']); ?>" class="fclick" tabindex="0"></a>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="container">
            <div class="row">
                <div class="plac-hom-tit plac-hom-tit-ic-sugg">
                        <h2><?php echo $BIZBOOK['ADS_POST_HOME_PAGE_SUGGESTION_H2']; ?></h2>
                        <p><?php echo $BIZBOOK['ADS_POST_HOME_PAGE_SUGGESTION_P']; ?></p>
                        <a href="ads-create"><?php echo $BIZBOOK['ADS_POST_HOME_PAGE_SUGGESTION_A']; ?></a>
                    </div>
            </div>
        </div>
    </section>

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
<script src="<?php echo $slash; ?>js/blazy.min.js"></script>
<script type="text/javascript">var webpage_full_link = '<?php echo $webpage_full_link;?>';</script>
<script type="text/javascript">var login_url = '<?php echo $LOGIN_URL;?>';</script>
<script src="<?php echo $slash; ?>js/slick.js"></script>
<script src="<?php echo $slash; ?>js/custom.js"></script>
<script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo $slash; ?>js/custom_validation.js"></script>
<script>
    $('.multiple-items1').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
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
</script>

</body>

</html>