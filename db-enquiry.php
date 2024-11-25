<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

if (file_exists('config/listing_page_authentication.php')) {
    include('config/listing_page_authentication.php');
}

include "dashboard_left_pane.php";
?>

    <!--CENTER SECTION-->
    <div class="ud-main">
    <div class="ud-main-inn ud-main-full ud-main-leads ud-no-rhs">
    <div class="ud-cen">
        <div class="log-bor">&nbsp;</div>
        <span class="udb-inst"><?php echo $BIZBOOK['LEADS']; ?></span>
        <?php include('config/user_activation_checker.php'); ?>
        <div class="ud-cen-s2">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">All Leads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#listing">Listing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#product">Product </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#blog">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#event">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#adpost">Ad Post</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane active"><br>
                    <h3>All Leads</h3>
                    <?php include "page_level_message.php"; ?>
                    <div class="lead-box">
                        <table class="responsive-table bordered">
                            <thead>
                            <tr>
                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $si = 1;
                            $session_user_id = $_SESSION['user_id'];
                            foreach (getUserEnquiries($session_user_id) as $enquiries_row) {

                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                $enquiry_event_id = $enquiries_row['event_id'];
                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                $enquiry_product_id = $enquiries_row['product_id'];
                                $enquiry_ad_post_id = $enquiries_row['ad_post_id'];

                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                $event_enquiry_row = getEvent($enquiry_event_id);
                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                $product_enquiry_row = getIdProduct($enquiry_product_id);
                                $ad_post_enquiry_row = getIdAdPost($enquiry_ad_post_id);

                                ?>
                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                    </td>
                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                    <td><?php
                                        if ($enquiry_listing_id != 0) {
                                            echo $listing_enquiry_row['listing_name'];
                                        } else if ($enquiry_event_id != 0) {
                                            echo $event_enquiry_row['event_name'];
                                        } elseif ($enquiry_blog_id != 0) {
                                            echo $blog_enquiry_row['blog_name'];
                                        } elseif ($enquiry_product_id != 0) {
                                            echo $product_enquiry_row['product_name'];
                                        } elseif ($enquiry_ad_post_id != 0) {
                                            echo $ad_post_enquiry_row['ad_post_name'];
                                        } else {
                                            echo "N/A";
                                        }
                                        ?></td>
                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                    <td>
                                        <div class="dropdown dd_new">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="material-icons">more_vert</i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=home&imp=1">Move to important</a>
                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=home&fav=1">Move to favourite</a>
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
                    <div class="ud-cen" style="padding-left: 0!important;">
                        <div class="row">
                            <div class="col-md-12 mt-5">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['IMPOR']; ?></span>
                                <div class="ud-cen-s2">
                                    <div class="lead-box">
                                        <table class="responsive-table bordered">
                                            <thead>
                                            <tr>
                                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $si = 1;
                                            $session_user_id = $_SESSION['user_id'];
                                            foreach (getUserImportantEnquiries($session_user_id) as $enquiries_row) {

                                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                                $enquiry_event_id = $enquiries_row['event_id'];
                                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                                $enquiry_product_id = $enquiries_row['product_id'];

                                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                                $event_enquiry_row = getEvent($enquiry_event_id);
                                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                                $product_enquiry_row = getIdProduct($enquiry_product_id);

                                                ?>
                                                <tr>
                                                    <td><?php echo $si; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                                    </td>
                                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                                    <td><?php
                                                        if ($enquiry_listing_id != 0) {
                                                            echo $listing_enquiry_row['listing_name'];
                                                        } else if ($enquiry_event_id != 0) {
                                                            echo $event_enquiry_row['event_name'];
                                                        } elseif ($enquiry_blog_id != 0) {
                                                            echo $blog_enquiry_row['blog_name'];
                                                        } elseif ($enquiry_product_id != 0) {
                                                            echo $product_enquiry_row['product_name'];
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                        ?></td>
                                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                                    <td>
                                                        <div class="dropdown dd_new">
                                                            <button type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                <i class="material-icons">more_vert</i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=home&main=1">Move to All Leads</a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=home&fav=1">Move to favourite</a>
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
                            <div class="col-md-12 mt-5">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['FAVORLEAD']; ?></span>
                                <div class="ud-cen-s2">

                                    <div class="lead-box">
                                        <table class="responsive-table bordered">
                                            <thead>
                                            <tr>
                                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $si = 1;
                                            $session_user_id = $_SESSION['user_id'];
                                            foreach (getUserFavouriteEnquiries($session_user_id) as $enquiries_row) {

                                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                                $enquiry_event_id = $enquiries_row['event_id'];
                                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                                $enquiry_product_id = $enquiries_row['product_id'];

                                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                                $event_enquiry_row = getEvent($enquiry_event_id);
                                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                                $product_enquiry_row = getIdProduct($enquiry_product_id);

                                                ?>
                                                <tr>
                                                    <td><?php echo $si; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                                    </td>
                                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                                    <td><?php
                                                        if ($enquiry_listing_id != 0) {
                                                            echo $listing_enquiry_row['listing_name'];
                                                        } else if ($enquiry_event_id != 0) {
                                                            echo $event_enquiry_row['event_name'];
                                                        } elseif ($enquiry_blog_id != 0) {
                                                            echo $blog_enquiry_row['blog_name'];
                                                        } elseif ($enquiry_product_id != 0) {
                                                            echo $product_enquiry_row['product_name'];
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                        ?></td>
                                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                                    <td>
                                                        <div class="dropdown dd_new">
                                                            <button type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                <i class="material-icons">more_vert</i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=home&imp=1">Move to important</a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=home&main=1">Move to All Leads</a>
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
                    </div>
                </div>
                <div id="listing" class="container tab-pane fade"><br>
                    <h3>Listing Leads</h3>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat.</p>
                    <?php include "page_level_message.php"; ?>
                    <div class="lead-box">
                        <table class="responsive-table bordered">
                            <thead>
                            <tr>
                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $si = 1;
                            $session_user_id = $_SESSION['user_id'];
                            foreach (getUserListingEnquiries($session_user_id) as $enquiries_row) {

                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                $enquiry_event_id = $enquiries_row['event_id'];
                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                $enquiry_product_id = $enquiries_row['product_id'];
                                $enquiry_ad_post_id = $enquiries_row['ad_post_id'];

                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                $event_enquiry_row = getEvent($enquiry_event_id);
                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                $product_enquiry_row = getIdProduct($enquiry_product_id);
                                $ad_post_enquiry_row = getIdAdPost($enquiry_ad_post_id);

                                ?>
                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                    </td>
                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                    <td><?php
                                        if ($enquiry_listing_id != 0) {
                                            echo $listing_enquiry_row['listing_name'];
                                        } else if ($enquiry_event_id != 0) {
                                            echo $event_enquiry_row['event_name'];
                                        } elseif ($enquiry_blog_id != 0) {
                                            echo $blog_enquiry_row['blog_name'];
                                        } elseif ($enquiry_product_id != 0) {
                                            echo $product_enquiry_row['product_name'];
                                        } elseif ($enquiry_ad_post_id != 0) {
                                            echo $ad_post_enquiry_row['ad_post_name'];
                                        } else {
                                            echo "N/A";
                                        }
                                        ?></td>
                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                    <td>
                                        <div class="dropdown dd_new">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="material-icons">more_vert</i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=listing&imp=1">Move to important</a>
                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=listing&fav=1">Move to favourite</a>
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
                    <div class="ud-cen" style="padding-left: 0!important;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['IMPOR']; ?></span>
                                <div class="ud-cen-s2">

                                    <div class="lead-box">
                                        <table class="responsive-table bordered">
                                            <thead>
                                            <tr>
                                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $si = 1;
                                            $session_user_id = $_SESSION['user_id'];
                                            foreach (getUserListingImportantEnquiries($session_user_id) as $enquiries_row) {

                                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                                $enquiry_event_id = $enquiries_row['event_id'];
                                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                                $enquiry_product_id = $enquiries_row['product_id'];

                                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                                $event_enquiry_row = getEvent($enquiry_event_id);
                                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                                $product_enquiry_row = getIdProduct($enquiry_product_id);

                                                ?>
                                                <tr>
                                                    <td><?php echo $si; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                                    </td>
                                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                                    <td><?php
                                                        if ($enquiry_listing_id != 0) {
                                                            echo $listing_enquiry_row['listing_name'];
                                                        } else if ($enquiry_event_id != 0) {
                                                            echo $event_enquiry_row['event_name'];
                                                        } elseif ($enquiry_blog_id != 0) {
                                                            echo $blog_enquiry_row['blog_name'];
                                                        } elseif ($enquiry_product_id != 0) {
                                                            echo $product_enquiry_row['product_name'];
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                        ?></td>
                                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                                    <td>
                                                        <div class="dropdown dd_new">
                                                            <button type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                <i class="material-icons">more_vert</i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=listing&main=1">Move to All Leads</a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=listing&fav=1">Move to favourite</a>
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
                            <div class="col-md-6">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['FAVORLEAD']; ?></span>
                                <div class="ud-cen-s2">

                                    <div class="lead-box">
                                        <table class="responsive-table bordered">
                                            <thead>
                                            <tr>
                                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $si = 1;
                                            $session_user_id = $_SESSION['user_id'];
                                            foreach (getUserListingFavouriteEnquiries($session_user_id) as $enquiries_row) {

                                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                                $enquiry_event_id = $enquiries_row['event_id'];
                                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                                $enquiry_product_id = $enquiries_row['product_id'];

                                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                                $event_enquiry_row = getEvent($enquiry_event_id);
                                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                                $product_enquiry_row = getIdProduct($enquiry_product_id);

                                                ?>
                                                <tr>
                                                    <td><?php echo $si; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                                    </td>
                                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                                    <td><?php
                                                        if ($enquiry_listing_id != 0) {
                                                            echo $listing_enquiry_row['listing_name'];
                                                        } else if ($enquiry_event_id != 0) {
                                                            echo $event_enquiry_row['event_name'];
                                                        } elseif ($enquiry_blog_id != 0) {
                                                            echo $blog_enquiry_row['blog_name'];
                                                        } elseif ($enquiry_product_id != 0) {
                                                            echo $product_enquiry_row['product_name'];
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                        ?></td>
                                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                                    <td>
                                                        <div class="dropdown dd_new">
                                                            <button type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                <i class="material-icons">more_vert</i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=listing&imp=1">Move to important</a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=listing&main=1">Move to All Leads</a>
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
                    </div>
                </div>
                <div id="product" class="container tab-pane fade"><br>
                    <h3>Product Leads</h3>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                        totam rem aperiam.</p>
                    <?php include "page_level_message.php"; ?>
                    <div class="lead-box">
                        <table class="responsive-table bordered">
                            <thead>
                            <tr>
                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $si = 1;
                            $session_user_id = $_SESSION['user_id'];
                            foreach (getUserProductEnquiries($session_user_id) as $enquiries_row) {

                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                $enquiry_event_id = $enquiries_row['event_id'];
                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                $enquiry_product_id = $enquiries_row['product_id'];
                                $enquiry_ad_post_id = $enquiries_row['ad_post_id'];

                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                $event_enquiry_row = getEvent($enquiry_event_id);
                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                $product_enquiry_row = getIdProduct($enquiry_product_id);
                                $ad_post_enquiry_row = getIdAdPost($enquiry_ad_post_id);

                                ?>
                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                    </td>
                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                    <td><?php
                                        if ($enquiry_listing_id != 0) {
                                            echo $listing_enquiry_row['listing_name'];
                                        } else if ($enquiry_event_id != 0) {
                                            echo $event_enquiry_row['event_name'];
                                        } elseif ($enquiry_blog_id != 0) {
                                            echo $blog_enquiry_row['blog_name'];
                                        } elseif ($enquiry_product_id != 0) {
                                            echo $product_enquiry_row['product_name'];
                                        } elseif ($enquiry_ad_post_id != 0) {
                                            echo $ad_post_enquiry_row['ad_post_name'];
                                        } else {
                                            echo "N/A";
                                        }
                                        ?></td>
                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                    <td>
                                        <div class="dropdown dd_new">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="material-icons">more_vert</i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=product&imp=1">Move to important</a>
                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=product&fav=1">Move to favourite</a>
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
                    <div class="ud-cen" style="padding-left: 0!important;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['IMPOR']; ?></span>
                                <div class="ud-cen-s2">

                                    <div class="lead-box">
                                        <table class="responsive-table bordered">
                                            <thead>
                                            <tr>
                                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $si = 1;
                                            $session_user_id = $_SESSION['user_id'];
                                            foreach (getUserProductImportantEnquiries($session_user_id) as $enquiries_row) {

                                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                                $enquiry_event_id = $enquiries_row['event_id'];
                                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                                $enquiry_product_id = $enquiries_row['product_id'];

                                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                                $event_enquiry_row = getEvent($enquiry_event_id);
                                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                                $product_enquiry_row = getIdProduct($enquiry_product_id);

                                                ?>
                                                <tr>
                                                    <td><?php echo $si; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                                    </td>
                                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                                    <td><?php
                                                        if ($enquiry_listing_id != 0) {
                                                            echo $listing_enquiry_row['listing_name'];
                                                        } else if ($enquiry_event_id != 0) {
                                                            echo $event_enquiry_row['event_name'];
                                                        } elseif ($enquiry_blog_id != 0) {
                                                            echo $blog_enquiry_row['blog_name'];
                                                        } elseif ($enquiry_product_id != 0) {
                                                            echo $product_enquiry_row['product_name'];
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                        ?></td>
                                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                                    <td>
                                                        <div class="dropdown dd_new">
                                                            <button type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                <i class="material-icons">more_vert</i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=product&main=1">Move to All Leads</a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=product&fav=1">Move to favourite</a>
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
                            <div class="col-md-6">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['FAVORLEAD']; ?></span>
                                <div class="ud-cen-s2">

                                    <div class="lead-box">
                                        <table class="responsive-table bordered">
                                            <thead>
                                            <tr>
                                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $si = 1;
                                            $session_user_id = $_SESSION['user_id'];
                                            foreach (getUserProductFavouriteEnquiries($session_user_id) as $enquiries_row) {

                                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                                $enquiry_event_id = $enquiries_row['event_id'];
                                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                                $enquiry_product_id = $enquiries_row['product_id'];

                                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                                $event_enquiry_row = getEvent($enquiry_event_id);
                                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                                $product_enquiry_row = getIdProduct($enquiry_product_id);

                                                ?>
                                                <tr>
                                                    <td><?php echo $si; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                                    </td>
                                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                                    <td><?php
                                                        if ($enquiry_listing_id != 0) {
                                                            echo $listing_enquiry_row['listing_name'];
                                                        } else if ($enquiry_event_id != 0) {
                                                            echo $event_enquiry_row['event_name'];
                                                        } elseif ($enquiry_blog_id != 0) {
                                                            echo $blog_enquiry_row['blog_name'];
                                                        } elseif ($enquiry_product_id != 0) {
                                                            echo $product_enquiry_row['product_name'];
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                        ?></td>
                                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                                    <td>
                                                        <div class="dropdown dd_new">
                                                            <button type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                <i class="material-icons">more_vert</i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=product&imp=1">Move to important</a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=product&main=1">Move to All Leads</a>
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
                    </div>
                </div>
                <div id="blog" class="container tab-pane fade"><br>
                    <h3>Blog Leads</h3>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                        totam rem aperiam.</p>
                    <?php include "page_level_message.php"; ?>
                    <div class="lead-box">
                        <table class="responsive-table bordered">
                            <thead>
                            <tr>
                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $si = 1;
                            $session_user_id = $_SESSION['user_id'];
                            foreach (getUserBlogEnquiries($session_user_id) as $enquiries_row) {

                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                $enquiry_event_id = $enquiries_row['event_id'];
                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                $enquiry_product_id = $enquiries_row['product_id'];
                                $enquiry_ad_post_id = $enquiries_row['ad_post_id'];

                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                $event_enquiry_row = getEvent($enquiry_event_id);
                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                $product_enquiry_row = getIdProduct($enquiry_product_id);
                                $ad_post_enquiry_row = getIdAdPost($enquiry_ad_post_id);

                                ?>
                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                    </td>
                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                    <td><?php
                                        if ($enquiry_listing_id != 0) {
                                            echo $listing_enquiry_row['listing_name'];
                                        } else if ($enquiry_event_id != 0) {
                                            echo $event_enquiry_row['event_name'];
                                        } elseif ($enquiry_blog_id != 0) {
                                            echo $blog_enquiry_row['blog_name'];
                                        } elseif ($enquiry_product_id != 0) {
                                            echo $product_enquiry_row['product_name'];
                                        } elseif ($enquiry_ad_post_id != 0) {
                                            echo $ad_post_enquiry_row['ad_post_name'];
                                        } else {
                                            echo "N/A";
                                        }
                                        ?></td>
                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                    <td>
                                        <div class="dropdown dd_new">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="material-icons">more_vert</i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=blog&imp=1">Move to important</a>
                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=blog&fav=1">Move to favourite</a>
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
                    <div class="ud-cen" style="padding-left: 0!important;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['IMPOR']; ?></span>
                                <div class="ud-cen-s2">

                                    <div class="lead-box">
                                        <table class="responsive-table bordered">
                                            <thead>
                                            <tr>
                                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $si = 1;
                                            $session_user_id = $_SESSION['user_id'];
                                            foreach (getUserBlogImportantEnquiries($session_user_id) as $enquiries_row) {

                                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                                $enquiry_event_id = $enquiries_row['event_id'];
                                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                                $enquiry_product_id = $enquiries_row['product_id'];

                                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                                $event_enquiry_row = getEvent($enquiry_event_id);
                                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                                $product_enquiry_row = getIdProduct($enquiry_product_id);

                                                ?>
                                                <tr>
                                                    <td><?php echo $si; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                                    </td>
                                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                                    <td><?php
                                                        if ($enquiry_listing_id != 0) {
                                                            echo $listing_enquiry_row['listing_name'];
                                                        } else if ($enquiry_event_id != 0) {
                                                            echo $event_enquiry_row['event_name'];
                                                        } elseif ($enquiry_blog_id != 0) {
                                                            echo $blog_enquiry_row['blog_name'];
                                                        } elseif ($enquiry_product_id != 0) {
                                                            echo $product_enquiry_row['product_name'];
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                        ?></td>
                                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                                    <td>
                                                        <div class="dropdown dd_new">
                                                            <button type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                <i class="material-icons">more_vert</i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=blog&main=1">Move to All Leads</a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=blog&fav=1">Move to favourite</a>
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
                            <div class="col-md-6">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['FAVORLEAD']; ?></span>
                                <div class="ud-cen-s2">

                                    <div class="lead-box">
                                        <table class="responsive-table bordered">
                                            <thead>
                                            <tr>
                                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $si = 1;
                                            $session_user_id = $_SESSION['user_id'];
                                            foreach (getUserFavouriteEnquiries($session_user_id) as $enquiries_row) {

                                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                                $enquiry_event_id = $enquiries_row['event_id'];
                                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                                $enquiry_product_id = $enquiries_row['product_id'];

                                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                                $event_enquiry_row = getEvent($enquiry_event_id);
                                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                                $product_enquiry_row = getIdProduct($enquiry_product_id);

                                                ?>
                                                <tr>
                                                    <td><?php echo $si; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                                    </td>
                                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                                    <td><?php
                                                        if ($enquiry_listing_id != 0) {
                                                            echo $listing_enquiry_row['listing_name'];
                                                        } else if ($enquiry_event_id != 0) {
                                                            echo $event_enquiry_row['event_name'];
                                                        } elseif ($enquiry_blog_id != 0) {
                                                            echo $blog_enquiry_row['blog_name'];
                                                        } elseif ($enquiry_product_id != 0) {
                                                            echo $product_enquiry_row['product_name'];
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                        ?></td>
                                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                                    <td>
                                                        <div class="dropdown dd_new">
                                                            <button type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                <i class="material-icons">more_vert</i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=blog&imp=1">Move to important</a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=blog&main=1">Move to All Leads</a>
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
                    </div>
                </div>
                <div id="event" class="container tab-pane fade"><br>
                    <h3>Event Leads</h3>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                        totam rem aperiam.</p>
                    <?php include "page_level_message.php"; ?>
                    <div class="lead-box">
                        <table class="responsive-table bordered">
                            <thead>
                            <tr>
                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $si = 1;
                            $session_user_id = $_SESSION['user_id'];
                            foreach (getUserEventEnquiries($session_user_id) as $enquiries_row) {

                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                $enquiry_event_id = $enquiries_row['event_id'];
                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                $enquiry_product_id = $enquiries_row['product_id'];
                                $enquiry_ad_post_id = $enquiries_row['ad_post_id'];

                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                $event_enquiry_row = getEvent($enquiry_event_id);
                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                $product_enquiry_row = getIdProduct($enquiry_product_id);
                                $ad_post_enquiry_row = getIdAdPost($enquiry_ad_post_id);

                                ?>
                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                    </td>
                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                    <td><?php
                                        if ($enquiry_listing_id != 0) {
                                            echo $listing_enquiry_row['listing_name'];
                                        } else if ($enquiry_event_id != 0) {
                                            echo $event_enquiry_row['event_name'];
                                        } elseif ($enquiry_blog_id != 0) {
                                            echo $blog_enquiry_row['blog_name'];
                                        } elseif ($enquiry_product_id != 0) {
                                            echo $product_enquiry_row['product_name'];
                                        } elseif ($enquiry_ad_post_id != 0) {
                                            echo $ad_post_enquiry_row['ad_post_name'];
                                        } else {
                                            echo "N/A";
                                        }
                                        ?></td>
                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                    <td>
                                        <div class="dropdown dd_new">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="material-icons">more_vert</i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=event&imp=1">Move to important</a>
                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=event&fav=1">Move to favourite</a>
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
                    <div class="ud-cen" style="padding-left: 0!important;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['IMPOR']; ?></span>
                                <div class="ud-cen-s2">

                                    <div class="lead-box">
                                        <table class="responsive-table bordered">
                                            <thead>
                                            <tr>
                                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $si = 1;
                                            $session_user_id = $_SESSION['user_id'];
                                            foreach (getUserEventImportantEnquiries($session_user_id) as $enquiries_row) {

                                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                                $enquiry_event_id = $enquiries_row['event_id'];
                                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                                $enquiry_product_id = $enquiries_row['product_id'];

                                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                                $event_enquiry_row = getEvent($enquiry_event_id);
                                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                                $product_enquiry_row = getIdProduct($enquiry_product_id);

                                                ?>
                                                <tr>
                                                    <td><?php echo $si; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                                    </td>
                                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                                    <td><?php
                                                        if ($enquiry_listing_id != 0) {
                                                            echo $listing_enquiry_row['listing_name'];
                                                        } else if ($enquiry_event_id != 0) {
                                                            echo $event_enquiry_row['event_name'];
                                                        } elseif ($enquiry_blog_id != 0) {
                                                            echo $blog_enquiry_row['blog_name'];
                                                        } elseif ($enquiry_product_id != 0) {
                                                            echo $product_enquiry_row['product_name'];
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                        ?></td>
                                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                                    <td>
                                                        <div class="dropdown dd_new">
                                                            <button type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                <i class="material-icons">more_vert</i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=event&main=1">Move to All Leads</a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=event&fav=1">Move to favourite</a>
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
                            <div class="col-md-6">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['FAVORLEAD']; ?></span>
                                <div class="ud-cen-s2">

                                    <div class="lead-box">
                                        <table class="responsive-table bordered">
                                            <thead>
                                            <tr>
                                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $si = 1;
                                            $session_user_id = $_SESSION['user_id'];
                                            foreach (getUserEventFavouriteEnquiries($session_user_id) as $enquiries_row) {

                                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                                $enquiry_event_id = $enquiries_row['event_id'];
                                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                                $enquiry_product_id = $enquiries_row['product_id'];

                                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                                $event_enquiry_row = getEvent($enquiry_event_id);
                                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                                $product_enquiry_row = getIdProduct($enquiry_product_id);

                                                ?>
                                                <tr>
                                                    <td><?php echo $si; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                                    </td>
                                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                                    <td><?php
                                                        if ($enquiry_listing_id != 0) {
                                                            echo $listing_enquiry_row['listing_name'];
                                                        } else if ($enquiry_event_id != 0) {
                                                            echo $event_enquiry_row['event_name'];
                                                        } elseif ($enquiry_blog_id != 0) {
                                                            echo $blog_enquiry_row['blog_name'];
                                                        } elseif ($enquiry_product_id != 0) {
                                                            echo $product_enquiry_row['product_name'];
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                        ?></td>
                                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                                    <td>
                                                        <div class="dropdown dd_new">
                                                            <button type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                <i class="material-icons">more_vert</i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=event&imp=1">Move to important</a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=event&main=1">Move to All Leads</a>
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
                    </div>
                </div>
                <div id="adpost" class="container tab-pane fade"><br>
                    <h3>Ad Post Leads</h3>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                        totam rem aperiam.</p>
                    <?php include "page_level_message.php"; ?>
                    <div class="lead-box">
                        <table class="responsive-table bordered">
                            <thead>
                            <tr>
                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $si = 1;
                            $session_user_id = $_SESSION['user_id'];
                            foreach (getUserAdPostEnquiries($session_user_id) as $enquiries_row) {

                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                $enquiry_event_id = $enquiries_row['event_id'];
                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                $enquiry_product_id = $enquiries_row['product_id'];
                                $enquiry_ad_post_id = $enquiries_row['ad_post_id'];

                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                $event_enquiry_row = getEvent($enquiry_event_id);
                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                $product_enquiry_row = getIdProduct($enquiry_product_id);
                                $ad_post_enquiry_row = getIdAdPost($enquiry_ad_post_id);

                                ?>
                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                    </td>
                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                    <td><?php
                                        if ($enquiry_listing_id != 0) {
                                            echo $listing_enquiry_row['listing_name'];
                                        } else if ($enquiry_event_id != 0) {
                                            echo $event_enquiry_row['event_name'];
                                        } elseif ($enquiry_blog_id != 0) {
                                            echo $blog_enquiry_row['blog_name'];
                                        } elseif ($enquiry_product_id != 0) {
                                            echo $product_enquiry_row['product_name'];
                                        } elseif ($enquiry_ad_post_id != 0) {
                                            echo $ad_post_enquiry_row['ad_post_name'];
                                        } else {
                                            echo "N/A";
                                        }
                                        ?></td>
                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                    <td>
                                        <div class="dropdown dd_new">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="material-icons">more_vert</i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=adpost&imp=1">Move to important</a>
                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=adpost&fav=1">Move to favourite</a>
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
                    <div class="ud-cen" style="padding-left: 0!important;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['IMPOR']; ?></span>
                                <div class="ud-cen-s2">

                                    <div class="lead-box">
                                        <table class="responsive-table bordered">
                                            <thead>
                                            <tr>
                                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $si = 1;
                                            $session_user_id = $_SESSION['user_id'];
                                            foreach (getUserAdPostImportantEnquiries($session_user_id) as $enquiries_row) {

                                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                                $enquiry_event_id = $enquiries_row['event_id'];
                                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                                $enquiry_product_id = $enquiries_row['product_id'];

                                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                                $event_enquiry_row = getEvent($enquiry_event_id);
                                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                                $product_enquiry_row = getIdProduct($enquiry_product_id);

                                                ?>
                                                <tr>
                                                    <td><?php echo $si; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                                    </td>
                                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                                    <td><?php
                                                        if ($enquiry_listing_id != 0) {
                                                            echo $listing_enquiry_row['listing_name'];
                                                        } else if ($enquiry_event_id != 0) {
                                                            echo $event_enquiry_row['event_name'];
                                                        } elseif ($enquiry_blog_id != 0) {
                                                            echo $blog_enquiry_row['blog_name'];
                                                        } elseif ($enquiry_product_id != 0) {
                                                            echo $product_enquiry_row['product_name'];
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                        ?></td>
                                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                                    <td>
                                                        <div class="dropdown dd_new">
                                                            <button type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                <i class="material-icons">more_vert</i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=adpost&main=1">Move to All Leads</a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=adpost&fav=1">Move to favourite</a>
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
                            <div class="col-md-6">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['FAVORLEAD']; ?></span>
                                <div class="ud-cen-s2">

                                    <div class="lead-box">
                                        <table class="responsive-table bordered">
                                            <thead>
                                            <tr>
                                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                                <th><?php echo $BIZBOOK['NAME']; ?></th>
                                                <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                                                <th><?php echo $BIZBOOK['PHONE']; ?></th>
                                                <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                                                <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                                                <!-- <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>-->
                                                <th><?php echo $BIZBOOK['OPTIONS']; ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $si = 1;
                                            $session_user_id = $_SESSION['user_id'];
                                            foreach (getUserAdPostFavouriteEnquiries($session_user_id) as $enquiries_row) {

                                                $enquiry_listing_id = $enquiries_row['listing_id'];
                                                $enquiry_event_id = $enquiries_row['event_id'];
                                                $enquiry_blog_id = $enquiries_row['blog_id'];
                                                $enquiry_product_id = $enquiries_row['product_id'];

                                                $listing_enquiry_row = getAllListingUserListing($session_user_id, $enquiry_listing_id);
                                                $event_enquiry_row = getEvent($enquiry_event_id);
                                                $blog_enquiry_row = getBlog($enquiry_blog_id);
                                                $product_enquiry_row = getIdProduct($enquiry_product_id);

                                                ?>
                                                <tr>
                                                    <td><?php echo $si; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                                    </td>
                                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                                    <td><?php
                                                        if ($enquiry_listing_id != 0) {
                                                            echo $listing_enquiry_row['listing_name'];
                                                        } else if ($enquiry_event_id != 0) {
                                                            echo $event_enquiry_row['event_name'];
                                                        } elseif ($enquiry_blog_id != 0) {
                                                            echo $blog_enquiry_row['blog_name'];
                                                        } elseif ($enquiry_product_id != 0) {
                                                            echo $product_enquiry_row['product_name'];
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                        ?></td>
                                                    <!-- <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $LISTING_URL . urlModifier($listing_enquiry_row['listing_slug']) . "?src=" . $enquiries_row['enquiry_source']; ?></td>-->
                                                    <td>
                                                        <div class="dropdown dd_new">
                                                            <button type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                <i class="material-icons">more_vert</i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>"
                                                                   class="dropdown-item"><?php echo $BIZBOOK['DELETE']; ?></a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=adpost&imp=1">Move to important</a>
                                                                <a class="dropdown-item" href="enquiry_process.php?enq_id=<?php echo $enquiries_row['enquiry_id']; ?>&path=adpost&main=1">Move to All Leads</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
if (isset($_GET['ledname_1'])) {
    trashFolderNew($_GET['ledname_1']);
}
include "dashboard_right_pane.php";
?>