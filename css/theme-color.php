<?php

if (file_exists('../jobs/job-config-info.php')) {
    include('../jobs/job-config-info.php');
}

header("Content-type: text/css; charset: UTF-8");

$color_setting_row = getAllCustomCss();

?>

/*-----------------------------------------
 [MASTER STYLE SHEET]
 * Project: Bizbook Business Directory Template
 * Version: v5.3
 * Copyright 2020-2022 rn53themes
 * Last Changes: 1 jan 2021
 * Author: RN53 Themes
 * Email:      rn53themes@gmail.com
 * Website:    www.rn53themes.net
 * Website:    www.directoryfinder.net
 -----------------------------------------------*/
/*-------------------------------------------------
 =  Table of CSS
	1.All Pages Common CSS Styles
    2.
-------------------------------------------------*/
/*-------------------------------------------------*/
/* =  1.All Pages Common CSS Styles
/*-------------------------------------------------*/
:root {
    --blue: <?php echo $color_setting_row['common_blue_btn']; ?>;
    --bluehover: #0a6cb7;
    --bluelig: <?php echo $color_setting_row['common_light_blue_btn']; ?>;
    --red: <?php echo $color_setting_row['common_red_btn']; ?>;
    --red-hov: <?php echo $color_setting_row['common_dark_red_btn']; ?>;
    --yel1: <?php echo $color_setting_row['common_yellow_bottom_band']; ?>;
    --yel2: <?php echo $color_setting_row['common_yellow_1_bottom_band']; ?>;
    --yel3: <?php echo $color_setting_row['common_yellow_2_btn']; ?>;
    --gray: <?php echo $color_setting_row['common_gray_color']; ?>;
    --green: <?php echo $color_setting_row['common_green_color']; ?>;
    --greenlig: <?php echo $color_setting_row['common_light_green_color']; ?>;
    --hom-sear-btn: <?php echo $color_setting_row['home_search_btn_default']; ?>;
    --hom-sear-btn-hov: <?php echo $color_setting_row['home_search_btn_hover']; ?>;
    --hom-exp-now-btn: <?php echo $color_setting_row['home_banner_btn_default']; ?>;
    --hom-exp-now-btn-hov: <?php echo $color_setting_row['home_banner_btn_hover']; ?>;
    --hom-vi-all-ser: <?php echo $color_setting_row['home_view_all_btn_default']; ?>;
    --hom-vi-all-ser-hov: <?php echo $color_setting_row['home_view_all_btn_hover']; ?>;
    --hom-sub-reg-btn: <?php echo $color_setting_row['home_submit_req_btn_default']; ?>;
    --hom-sub-reg-btn-hov: <?php echo $color_setting_row['home_submit_req_btn_hover']; ?>;
    --job-blue: <?php echo $color_setting_row['job_blue_color']; ?>;
    --job-blue-com: #246df8;
    --org: <?php echo $color_setting_row['job_orange_color']; ?>;
}
*{font-family:'Poppins',sans-serif}
#status,#loadingmessage1{border-top:5px solid var(--bluelig)}
.status_message{background:var(--hom-sub-reg-btn)}
.ser-head{margin-top:var(--topspac)}
.ser2.ser-bl{background:var(--blue)}
.menu i{background:var(--job-blue-com)}
.hom-nav .bl li:last-child a{border:1px solid var(--job-blue);background:var(--job-blue)}
.ban-search ul li input[type="submit"]{background:var(--hom-sear-btn)}
.ban-search ul li input[type="submit"]:hover{background:var(--hom-sear-btn-hov)}
.ban-ql ul li div a{background-color:var(--hom-exp-now-btn)}
.land-pack .more{background:var(--hom-vi-all-ser)}
.land-pack .more:hover{background:var(--hom-vi-all-ser-hov)}
.hot-page2-hom-pre-3 span{background-color:var(--green)}
.hot-page2-hom-pre-head{background:var(--blue)}
.hot-page2-hom-pre-head:after{border-top-color:var(--blue)}
.list-pop .img span{background-color:var(--green)}
.hcity div:nth-child(2) .list-rat-all i{color:var(--org)}
.full-bot-book{background:var(--gray)}
.bot-book{background:var(--yel1)}
.bb-link a{background:var(--gray)}
.hom-mpop .col-md-9 .rat-sh{background:var(--green)}
.testmo span a{color:var(--green)}
.testmo .rat i{color:var(--org)}
.hom-col-req button{background:var(--red);border:1px solid var(--red)}
.hom-col-req button:hover{background:var(--red);border:1px solid var(--red)}
.wed-hom-footer{background:var(--gray)}
.eve-box div:nth-child(1) span{background:var(--bluelig)}
.rbbox input[type="radio"]:checked + label:before{border-color:var(--green)}
.rbbox input[type="radio"]:checked + label:after{background:var(--green)}
#star-value{background:var(--yel3)}
.ads-box span,.ban-ati-com span{background:var(--red)}
.all-list-sh .al-img .open-stat{background:var(--green)}
.all-list-sh .rat i{color:var(--org)}
.all-list-sh .eve-box div:nth-child(2) .links .quo{background:var(--red);border:1px solid var(--red)}
.all-list-sh .eve-box:hover div:nth-child(2) .links a:first-child{background:var(--yel3);border:1px solid var(--yel3)}
.list-foot{background:var(--gray)}
.list-qview .more a{background:var(--bluelig)}
.list-rat-all b{background:var(--org)}
.pg-list-1-left .rat i{color:var(--org)}
.list-foot-abo .list-rat-all .rat i{color:var(--org)}
.pg-list-1-left h1 i{color:var(--green)}
.lp-ur-all-right p label i{color:var(--bluelig)}
.lr-user-wr-con .rat i{color:var(--org)}
.list-pg-write-rev form input[type='submit']{background:var(--bluelig)}
.list-pg-guar ul li .clim-edit{background:var(--red)}
.list-pg-upro a{background:var(--red)}
.list-red-btn{background:var(--red)}
.lis-pro-badg div .by{background:var(--green)}
.lis-comp-badg .s1 .by{background:var(--green)}
.list-enqu-btn ul li:last-child a{background:var(--red);border:1px solid var(--red)}
.list-ban-btn ul li span.pulse{background:var(--red);border:1px solid var(--red)}
t-ban-btn ul li .cta:hover{background:var(--job-blue-com);border:1px solid var(--job-blue-com)}
.all-list-pro-bad .cntat{background:var(--red);border:1px solid var(--red)}
.all-list-pro-bad .by{background:var(--green)}
.list-det-rel-pre ul li .land-pack-grid .rat i{color:var(--org)}
.fqui-menu{background:var(--gray)}
.pri ul li:nth-child(4) .pri-box .c3 a{background:var(--blue)}
.log div button.btn{background:var(--blue)}
.log div button.btn:hover{background:var(--bluehover);box-shadow:var(--btnshadow)}
.log div a.btn{background:var(--bluelig)}
.login-new{box-shadow:var(--btnshadow1)}
.ud-cen .rat i{color:var(--bluelig)}
.add-list .steps,.udb-inst{background:var(--hom-sub-reg-btn)}
.add-list-ste-inn ul li a.act{background:var(--hom-sub-reg-btn)}
.add-prod-oth ul li i{color:var(--hom-sub-reg-btn)}
.add-lis-oth i{color:var(--hom-sub-reg-btn)}
.add-lis-done .succ{background:var(--hom-sub-reg-btn)}
.db-menu ul li a:hover:before{background:var(--bluelig)}
.ud-lhs-s1 h4{color:var(--bluelig)}
.ud-lhs-s1 .ud-lhs-view-pro{background:var(--hom-sub-reg-btn)}
.db-menu-clo{background:var(--org)}
.cre-dup a{background:var(--bluelig)}
.cre-dup span{background:var(--hom-sub-reg-btn)}
.ud-lhs-s2 ul li a.db-lact:before{background:var(--bluelig)}
.ud-lhs-s2 ul li a:hover{color:var(--bluelig)}
.ud-cen-s1 ul li div:hover b{background:var(--hom-sub-reg-btn);}
.ud-cen-s1 ul li div b{background:var(--bluelig);}
.ud-cen-s2 a.db-tit-btn,.ud-cen-s3 a.db-tit-btn{background:var(--bluelig);}
.ud-rhs-promo:hover a{background:var(--org);}
.ud-rhs-promo a{background:var(--yel1);}
.ud-rhs-promo-1 a{background:var(--bluelig);}
.db-pro-bot-btn{background:var(--bluelig);}
.ud-rhs-pay-inn h3{background:var(--bluelig);}
.ud-rhs-pay-inn .btn{background:var(--red);}
.ud-rhs-pay-inn .btn2{background:var(--green)}
.ad-table-inn .db-list-rat:hover{background:var(--bluelig);}
.pay-rhs ul li:nth-child(2){color:var(--bluelig);}
.pay-rhs ul li .ud-stat-pay-btn{background:var(--hom-sub-reg-btn);}
.pay-note button{background:var(--bluelig);}
.ud-rhs-poin2 a.cta{background:var(--red);}
.use-act-err{background:linear-gradient(to bottom,var(#ffea31),var(--yel2) 100%);}
.sub-btn{background:var(--bluelig);}
.com-noti{background:var(--hom-sub-reg-btn);}
.ud-pro-link .pay-rhs ul li.pre a{background:var(--blue);background:-webkit-linear-gradient(to top,var(--blue),var(--bluehover));background:linear-gradient(to top,var(--blue),var(--bluehover))}
.pro-listing-box div:nth-child(1) label.rat i{color:var(--bluelig);}
.blog-sli .rhs span.hig{background:var(--bluelig);    padding: 5px 10px 7px 10px;}
.ad-pri-cal ul li:last-child div{background:var(--hom-sub-reg-btn);}
.ldelik.sav-act{background:var(--job-blue-com);border:1px solid var(--job-blue-com);}
.templ-rhs-form .btn-primary{background:var(--hom-sub-reg-btn);border:1px solid var(--hom-sub-reg-btn);}
.ani-q1 span{background:var(--green);}
.how-wrks-inn ul li div span{background:var(--bluelig);}
.mob-app .rhs ul li:before{color:var(--blue)}
.mob-app .rhs form ul li input[type="submit"]{background:var(--blue)}
.near-ser-list ul li .near-bx .ne-3 span{background:var(--greenlig);}
.all-list-bre{padding:40px 0 35px;position:relative}
.all-pro-bre{margin-top:var(--topspac);}
.biz-pro-bre:before{background:var(--job-blue-com)de}
.biz-pro-btn .btn1{background:var(--blue);}
.biz-pro-btn .btn2{background:var(--org)}
.pro-pbox-2 .rat{background:var(--green);}
.pro-pbox-2 .veri{background:var(--green);}
.pro-pbox-2 .pro-off{color:var(--green);}
.list-fix-btn span{background:var(--red);}
.fed-box .lhs form button{border:0 solid var(--blue);}
.abou-pg{margin-top:var(--topspac);}
.hom-h2-pri .pri-box .c2{background:var(--job-blue);}
.btn-ser-need-ani{background:var(--hom-sub-reg-btn);}
.list-map-filt .map-fi-view .ic-map-3{color:var(--job-blue-com)}
.list-map .list-map-filt:before{background:var(--job-blue-com);}
.mob-map-filt i{background:var(--job-blue-com);}
.map-fi-com .ic3{color:var(--job-blue-com)}
.pop-noti:hover span{background:var(--yel3);}
.pop-noti span{background:var(--red);}
.all-jobs-ban{margin-top:var(--topspac);}
.job-sear ul li.sr-btn button{background:var(--job-blue);}
.job-pop-tag a{background:var(--job-blue);}
.job-counts ul li span{color:var(--job-blue);}
.job-box:hover .job-box-cta{background:var(--org)}
.job-box-con span{color:var(--job-blue);}
.job-box-apl span.job-box-cta{background:var(--job-blue-com);}
.job-det-desc .job-box-con .job-box-cta{background:var(--job-blue-com);}
.job-det-desc .alpply .cta-app{background:var(--job-blue-com);border-bottom:4px solid var(--job-blue);}
.job-det-desc .alpply .cta-app:hover{background:var(--org);}
.job-det-desc .skills ul li:before{background:var(--green);}
.job-det-desc .rhs{background:var(--job-blue-com);}
.job-det-desc .job-summ .cta-app{background:var(--org);}
.job-comp-abo .cta{background:var(--green);}
.sub-tit h2{color:var(--job-blue)}
.job-cate-main ul li div:hover{background:var(--job-blue-com);border:1px solid var(--job-blue-com);}
button.blu-upp{background:var(--blue);}
.salout{background:var(--green);}
.salout:before{background:var(--green);}
.job-alert a{background:var(--job-blue);}
.job-tre ul li:hover .jbtre-apl .job-box-cta{background:var(--org)}
.jbtre-con span{color:var(--job-blue);}
.jbtre-sale .empsal{color:var(--org);}
.jbtre-apl .job-box-cta{background:var(--job-blue-com);}
.jpro-ban-tit .s3 .cta.fol{background:var(--job-blue-com);}
.jpro-bd-com ul li:before{background:var(--job-blue-com);}
.jpro-bd-com span{color:var(--job-blue);}
.jb-skil-set ul li{color:var(--job-blue);}
.all-serexp .job-days span.ver,.job-prof-pg .lhs .profile .job-days span.ver{background:var(--green);}
.ser-avail-yes{background:var(--green);box-shadow:0 0 0 0 var(--green);}
.exper-rev-box .rating-new-cta button{background:var(--job-blue-com);border:1px solid var(--job-blue-com)}
.pro-pg-cts a.cta1{background:var(--red)}
.tser-res li div h4{color:var(--bluelig)}
.ebk-ban .lhs a.btn{background:var(--yel3);}
.ebk-con .lhs form .btn{background:var(--red);}
.pg-install .s2 table tr td button{background:var(--green);}
.cta-call{background:var(--green);}
@media screen and (max-width:992px) {
.all-list-bre{margin-top:var(--topspac);}
}