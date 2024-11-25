<?php
include "header.php";
?>

<?php if($footer_row['admin_news_show'] !=1 || $admin_row['admin_news_options'] != 1){
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
                        <div class="login-main add-list add-ncate">
                            <div class="log-bor">&nbsp;</div>
                            <span class="udb-inst">Edit this Category</span>
                            <div class="log log-1">
                                <div class="login">
                                    <h4>Edit Category</h4>
                                    <?php include "../page_level_message.php"; ?>
                                    <?php
                                    $category_id=$_GET['row'];
                                    $row= getNewsCategory($category_id);
                                    ?>

                                    <form  name="category_form" id="category_form" method="post" action="update_news_category.php" enctype="multipart/form-data" class="cre-dup-form cre-dup-form-show">
                                        <input type="hidden" class="validate" id="category_id" name="category_id" value="<?php echo $row['category_id']; ?>" required="required">
                                        <input type="hidden" class="validate" id="category_image_old" name="category_image_old" value="<?php echo $row['category_image']; ?>" required="required">

                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" name="category_name" value="<?php echo $row['category_name']; ?>" class="form-control" placeholder="Category name *" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group jb-fm-box-hig">
                                                            <h5 data-toggle="expand" data-target="#jb-expe">SEO details</h5>
                                                            <div id="jb-expe" class="expand coll-box">
                                                                <input type="text" name="category_seo_title" value="<?php echo $row['category_seo_title']; ?>" class="form-control" placeholder="SEO Title">
                                                                <hr>
                                                                <input type="text" name="category_seo_description" value="<?php echo $row['category_seo_description']; ?>" class="form-control" placeholder="Meta descriptions">
                                                                <hr>
                                                                <input type="text" name="category_seo_keywords" value="<?php echo $row['category_seo_keywords']; ?>" class="form-control" placeholder="Meta keywords">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <button type="submit" name="news_category_submit" class="btn btn-primary">Submit</button>
                                    </form>
                                    <div class="col-md-12">
                                        <a href="news-all-category.php" class="skip">Go to All Category >></a>
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
<script src="../js/jquery-ui.js"></script>
<script src="js/admin-custom.js"></script> <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>