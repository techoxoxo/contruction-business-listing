<?php

if(file_exists('ads-config-info.php'))
{
    include "ads-config-info.php";
}

$category_id = $_POST['category_id'];

//get matched data from State table
$sub_categories_sql = "SELECT * FROM  " . TBL . "ad_post_sub_categories where category_id='" . $category_id . "'";
$sub_categories_rs = mysqli_query($conn, $sub_categories_sql);

$sub_categories_row_count = mysqli_num_rows($sub_categories_rs);

if ($sub_categories_row_count <= 0) {
    ?>
    <p><?php echo "No Highlights to Show!!"; ?></p>
    <?php
} else {
    while ($sub_categories_row = mysqli_fetch_array($sub_categories_rs)) {

            ?>
        <li class="col-md-6">
            <div class="form-group floating">
                <input type="text" name="ad_post_sub_cat_<?php echo $sub_categories_row['sub_category_id']; ?>" class="form-control floating"
                       id="ad_post_sub_cat_<?php echo $sub_categories_row['sub_category_id']; ?>" >
                <label for="ad_post_sub_cat_<?php echo $sub_categories_row['sub_category_id']; ?>" class="tfix"><?php echo $sub_categories_row['sub_category_name']; ?></label>
            </div>
        </li>

            <?php
        }
}

?>