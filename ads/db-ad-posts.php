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

include "../dashboard_left_pane.php";
?>
			<!--CENTER SECTION-->
			<div class="ud-main">
   <div class="ud-main-inn ud-no-rhs">
			<div class="ud-cen">
				<div class="log-bor">&nbsp;</div>
				<span class="udb-inst"><?php echo $BIZBOOK['ADS-ALL-ADS']; ?></span>
				<?php include('../config/user_activation_checker.php'); ?>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['ADS-DASH-DETAIL']; ?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <a href="ads-create" target="_blank" class="db-tit-btn"><?php echo $BIZBOOK['ADS-POST']; ?></a>
                    <div class="table-responsive">
                        <table class="table bordered">
							<thead>
								<tr>
									<th><?php echo $BIZBOOK['S_NO']; ?></th>
                                    <th><?php echo $BIZBOOK['ADS-CRE-AD-NAME']; ?></th>
									<th><?php echo $BIZBOOK['VIEWS']; ?></th>
									<th><?php echo $BIZBOOK['STATUS']; ?></th>
									<th><?php echo $BIZBOOK['EDIT']; ?></th>
									<th><?php echo $BIZBOOK['DELETE']; ?></th>
									<th><?php echo $BIZBOOK['PREVIEW']; ?></th>
								</tr>
							</thead>
							<tbody>
							<?php

							$si = 1;
							foreach (getAllAdPostUser($_SESSION['user_id']) as $ad_postrow) {

							$reviewlisting_id = $listrow['listing_id'];

							?>
								<tr>
                                    <td><?php echo $si; ?></td>
                                    <td><img src="<?php if ($ad_postrow['gallery_image'] != NULL || !empty($ad_postrow['gallery_image'])) {
                                            echo $slash."ads/images/" . array_shift(explode(',', $ad_postrow['gallery_image']));
                                        } else {
                                            echo $slash."images/listings/" . $footer_row['listing_default_image'];
                                        } ?>"><?php echo $ad_postrow['ad_post_name']; ?>
                                        <span><?php echo dateFormatconverter($ad_postrow['ad_post_cdt']); ?></span></td>
                                    <td><span class="db-list-rat"><?php echo ad_post_pageview_count($ad_postrow['ad_post_id']); ?></span></td>
									<td><span class="db-list-ststus"><?php echo $ad_postrow['ad_post_status']; ?></span></td>
                                    <td><a href="edit-ad-posts.php?code=<?php echo $ad_postrow['ad_post_code']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT']; ?></a></td>
									<td><a href="delete-ad-posts.php?code=<?php echo $ad_postrow['ad_post_code']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE']; ?></a></td>
                                    <td><a href="<?php echo $AD_POST_URL.urlModifier($ad_postrow['ad_post_slug']); ?>" class="db-list-edit" target="_blank"><?php echo $BIZBOOK['PREVIEW']; ?></a></td>
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
			<!--RIGHT SECTION-->
<?php
include "../dashboard_right_pane.php";
?>