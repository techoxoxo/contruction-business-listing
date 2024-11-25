<?php
include "header.php";
?>

<?php if($footer_row['admin_place_show'] !=1){
    header("Location: profile.php");
}
?>

<style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
    #sortable li {     margin: 0 0px 3px 3px;
        padding: 11px 10px 5px 50px;
        font-size: 13px;
        /* height: 18px; */
        width: 100%;
        text-align: left;
        line-height: 18px;
        font-weight: 500;}
    #sortable li:hover{cursor: move;}
    #sortable li i { position: absolute;margin: -3px 0px 0px -30px;}
</style>

<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst">Place order on home page</span>
                <div class="ud-cen-s2">
                    <h2>Change Place Category order</h2>
                    <?php include "../page_level_message.php"; ?>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="Search this page..">
                    </div>
                    <ul id="sortable">
                        <?php
                        $si = 1;
                        foreach (getAllPlaceCategoriesPos() as $row) {
                            ?>
                            <li id="sort_<?php echo $row['category_id'] ?>" class="ui-state-default"><i class="material-icons">view_comfy</i> <?php echo $row['category_name']; ?></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="ud-notes">
                    <p><b>Notes:</b> You can <b>Re-Order Categories list</b> which will be reflected on website <b>Home page </b>and <b>All categories Page</b>.</p>
                </div>
            </div>
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
<script src="js/admin-custom.js"></script>
<script>
    $( function() {
        var ul_sortable = $('#sortable');

        ul_sortable.sortable({
            opacity: 0.325,
            tolerance: 'pointer',
            cursor: 'move',
            update: function(event, ui) {
                var post = ul_sortable.sortable('serialize');

                $.ajax({
                    type: 'POST',
                    url: 'save_place_category_position.php',
                    data: post,
                    dataType: 'json',
                    cache: false,
                    success: function(output) {
                        // alert(output);
                    },
                    error: function(output) {
                        // alert(output);
                    }
                });

            }
        });
        ul_sortable.disableSelection();
    } );
</script>
</body>

</html>