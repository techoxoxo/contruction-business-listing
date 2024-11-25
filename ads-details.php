<?php
include "header.php";


?>
<link rel="stylesheet" href="ads/ad-style.css">
<!-- START -->
<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> ad-post-detai-pg">
    <div class="container">
        <div class="eve-deta-pg-main">
        
            <div class="lhs">
                <div class="plac-hom-all-pla ad-post-detai-ban">
                    <ul class="postbansli">
                        <li>
                        <img loading="lazy" src="<?php echo $slash; ?>images/ad-posts/1.jpg" alt="">
                        </li>
                        <li>
                        <img loading="lazy" src="<?php echo $slash; ?>images/ad-posts/2.jpg" alt="">
                        </li>
                        <li>
                        <img loading="lazy" src="<?php echo $slash; ?>images/ad-posts/3.jpg" alt="">
                        </li>
                        <li>
                        <img loading="lazy" src="<?php echo $slash; ?>images/ad-posts/4.jpg" alt="">
                        </li>
                    </ul>
                </div>
                <!-- START -->
<div class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> eve-deta-body blog-deta-body">
        <div class="eve-deta-body-main">
            <div class="lhs">
               <div class="head">
                   <div class="eve-bred-crum">
                        <ul>
                        <li><a href="<?php echo $slash; ?>"><?php echo $BIZBOOK['HOME']; ?></a></li>
                        <li><a href="#">Bikes</a></li>
                        <li><a href="#">Harley Davidson S440 - 2023 model</a></li>
                        </ul>
                    </div>
                    
                    <h1 class="a_name">Harley Davidson S440 - 2023 model</h1>
                    <div class="blog-bred-post-date">
                        <span class="ic-time"><?php echo dateFormatconverter($blogs_a_row['blog_cdt']); ?></span>
                        <span class="ic-view"><?php  echo blog_pageview_count($blogs_a_row['blog_id']); ?></span>
                    </div>
                </div> 
                <div class="as-details">
                    <div class="desc">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book
                    </div>
                    <div class="list">
                        <ul>
                            <li>Kilometers run: 25,000</li>
                            <li>Owners count: 2nd owner</li>
                            <li>Year of manufacture: 2012</li>
                            <li>Engine type: Petrol</li>
                        </ul>
                    </div>
                    <div class="tags"><span class="tag1"></span><span class="tag2"></span></div>
                </div>
                <div class="list-sh">
                    <span class="share-new" data-toggle="modal" data-target="#sharepop"><i class="material-icons">share</i> Share now</span>
                </div>
            </div>
            <div class="rhs">
            
                <div class="sec-3">
                    <div class="pro-bad-sml">
                        <img loading="lazy" src="<?php echo $slash; ?>images/user/<?php if (($blog_user_row['profile_image'] == NULL) || empty($blog_user_row['profile_image'])) {
                            echo $footer_row['user_default_image'];
                        } else {
                            echo $blog_user_row['profile_image'];
                        } ?>" alt="">
                        <h4><?php echo $blog_user_row['first_name']; ?></h4>
                        <b><?php echo $BIZBOOK['BLOG-DETAILS-JOIN-ON']; ?> <?php echo dateFormatconverter($blog_user_row['user_cdt']); ?></b>
                        <a target="_blank" href="<?php echo $PROFILE_URL.urlModifier($blog_user_row['user_slug']); ?>" class="fclick">&nbsp;</a>
                    </div>
                </div>
                
            </div>
        </div>
        
        
                        </div>
<!--END-->
            </div>
            <div class="rhs"> 
                    <div class="apost-detals-box">
                        <div class="apost-bio">
                            <h2 class="a_price">$500</h2>
                            <div class="share">
                                <span class="share-ic" data-toggle="modal" data-target="#sharepop"><i class="material-icons">share</i></span>
                                <span class="share-ic"><i class="material-icons">thumb_up</i></span>
                            </div>
                            <p>Harley Davidson S440 - 2023 model</p>
                        </div>
                        <div class="adost-bio-2">
                            <p class="addr a_addr">28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A.</p>
                            <p class="addr a_loca">Albany</p>
                        </div>
                        <!-- <div class="adost-cta">
                            <span class="cta-line-red">Send and enquiry</span>
                        </div> -->
                        <div class="list-rhs-form pglist-bg pglist-p-com">
                        <div class="quote-pop">
                            <h3><?php echo $BIZBOOK['LEAD-SEND-ENQUIRY']; ?></h3>
                            <div id="blog_detail_enq_success" class="log new-tnk-msg" style="display: none;"><p><?php echo $BIZBOOK['ENQUIRY_SUCCESSFUL_MESSAGE']; ?></p>
                            </div>
                            <div id="blog_detail_enq_same" class="log" style="display: none;"><p><?php echo $BIZBOOK['ENQUIRY_OWN_BLOG_MESSAGE']; ?></p>
                            </div>
                            <div id="blog_detail_enq_fail" class="log" style="display: none;"><p><?php echo $BIZBOOK['OOPS_SOMETHING_WENT_WRONG']; ?></p>
                            </div>
                            <form method="post" name="blog_detail_enquiry_form" id="blog_detail_enquiry_form">

                                <?php if(!isset($_SESSION['user_code']) && empty($_SESSION['user_code'])){ ?>
                                <fieldset disabled="disabled">
                                    <?php } ?>

                                    <input type="hidden" class="form-control" name="blog_id"
                                           value="<?php echo $blog_id ?>"
                                           placeholder=""
                                           required>
                                    <input type="hidden" class="form-control"
                                           name="listing_user_id"
                                           value="<?php echo $user_id; ?>" placeholder=""
                                           required>
                                    <input type="hidden" class="form-control"
                                           name="enquiry_sender_id"
                                           value="<?php echo $_SESSION['user_id']; ?>"
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

                                    <div class="form-group ic-user">
                                        <input type="text" name="enquiry_name"
                                               value="<?php echo $user_details_row['first_name'] ?>"
                                               required="required" class="form-control"
                                               placeholder="<?php echo $BIZBOOK['LEAD-NAME-PLACEHOLDER']; ?>">
                                    </div>
                                    <div class="form-group ic-eml">
                                        <input type="email" class="form-control"
                                               placeholder="<?php echo $BIZBOOK['ENTER_EMAIL_STAR']; ?>"  required="required"
                                               value="<?php echo $user_details_row['email_id'] ?>"
                                               name="enquiry_email"
                                               pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                               title="<?php echo $BIZBOOK['LEAD-INVALID-EMAIL-TITLE']; ?>" >
                                    </div>
                                    <div class="form-group ic-pho">
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
                                    <?php if(!isset($_SESSION['user_code']) && empty($_SESSION['user_code'])){ ?>
                                </fieldset>
                            <?php } ?>
                                <?php if(!isset($_SESSION['user_code']) && empty($_SESSION['user_code'])){ ?>
                                    <a href="<?php echo $slash; ?>login"> <button type="button" name="" class="btn btn-primary"><?php echo $BIZBOOK['LEAD-LOGIN-ENJOY-MESSAGE']; ?></button></a>
                                <?php }else{ ?>
                                    <button type="submit" name="enquiry_submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT']; ?></button>
                                <?php }?>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
        </div>
        <div class="pro-rel-posts">
            <h4><?php echo $BIZBOOK['BLOG-DETAILS-RELATED-POST']; ?></h4>
            <div class="plac-hom-all-pla plac-det-eve">
            <ul class="multiple-items1">
                                                    <li>
                                                    <div class="all-pro-box">
                                                <div class="all-pro-img">
                                                    <img loading="lazy" src="images/ad-posts/5.jpg" class="b-lazy b-loaded">
                                                </div>
                                                <div class="all-pro-txt">
                                                    <h4>Harley Davidson S440 - 2023 model</h4>
                                                    <span class="pri"><b class="pro-off">$500</b> </span>
                                                </div>
                                                <div class="pg-pro-buy-cta">
                                                    <a target="_blank" href="ads-details" class="cta-buy-now" tabindex="0">More details</a>
                                                </div>
                                                <a href="ads-details" class="pro-view-full" tabindex="0"></a>
                                            </div>
                            </li>
                                                </ul>
                    </div>
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
                                <input type="text" class="form-control" placeholder="<?php echo $BIZBOOK['LEAD-NAME-PLACEHOLDER']; ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_EMAIL_STAR']; ?>" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" title="<?php echo $BIZBOOK['LEAD-INVALID-EMAIL-TITLE']; ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="<?php echo $BIZBOOK['LEAD-MOBILE-PLACEHOLDER']; ?>" pattern="[7-9]{1}[0-9]{9}"
                                       title="<?php echo $BIZBOOK['LEAD-INVALID-MOBILE-TITLE']; ?>" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" placeholder="<?php echo $BIZBOOK['LEAD-MESSAGE-PLACEHOLDER']; ?>"></textarea>
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
                        Copy text                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
include "footer.php";
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo $slash; ?>js/jquery.min.js"></script>
<script src="<?php echo $slash; ?>js/popper.min.js"></script>
<script src="<?php echo $slash; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $slash; ?>js/jquery-ui.js"></script>
<script src="<?php echo $slash; ?>js/blazy.min.js"></script>
<script type="text/javascript">var webpage_full_link ='<?php echo $webpage_full_link;?>';</script>
<script type="text/javascript">var login_url ='<?php echo $LOGIN_URL;?>';</script>
<script src="<?php echo $slash; ?>js/slick.js"></script>
<script src="<?php echo $slash; ?>js/custom.js"></script>
<script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo $slash; ?>js/custom_validation.js"></script>
<script>

//    <!-- Blog Enquiry Form Blog Detail Page Ajax Call And Validation starts-->
    $(document).ready(function () {
        var a_name = $('.a_name').text();
        var a_loca = $('.a_loca').text();
        var a_addr = $('.a_addr').text();
        var a_pric = $('.a_pric').text();
    $('.tag1').text(a_name + "sale in" + a_loca);
    $('.tag2').text(a_name + "sale in" + a_addr);
    $('.postbansli').slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
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

        $("#blog_detail_enquiry_form").validate({
            rules: {
                enquiry_name: {required: true},
                enquiry_email: {required: true, email: true},
                enquiry_mobile: {required: true}

            },
            messages: {

                enquiry_name: {required: "Name is Required"},
                enquiry_email: {required: "Email ID is Required"},
                enquiry_mobile: {required: "Mobile Number is Required"}
            },

            submitHandler: function (form) { // for demo
                //form.submit();
                $.ajax({
                    type: "POST",
                    data: $("#blog_detail_enquiry_form").serialize(),
                    url: "<?php echo $slash; ?>enquiry_submit.php",
                    cache: true,
                    success: function (html) {
                        // alert(html);
                        if (html == 1) {
                            $("#blog_detail_enq_success").show();
                            $("#blog_detail_enquiry_form")[0].reset();
                        }
                        else {
                            if (html == 3) {
                                $("#blog_detail_enq_same").show();
                                $("#blog_detail_enquiry_form")[0].reset();
                            }else{
                                $("#blog_detail_enq_fail").show();
                                $("#blog_detail_enquiry_form")[0].reset();
                            }

                        }

                    }

                })
            }
        });
    });
    <!-- Event Enquiry Form Event Detail Page Ajax Call And Validation ends-->

</script>
</body>

</html>