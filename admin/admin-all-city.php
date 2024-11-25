<?php
include "header.php";
?>
<?php if($footer_row['admin_listing_show'] != 1 || $admin_row['admin_city_options'] != 1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
				<div class="log-bor">&nbsp;</div>
				<span class="udb-inst">City</span>
                <div class="ud-cen-s2">
                    <h2>All City</h2>
                    <?php include "../page_level_message.php"; ?>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="Search this page..">
                    </div>
                    <a href="admin-add-city.php" class="db-tit-btn">Add new City</a>
                    <table class="responsive-table bordered " id="citytab">
							<thead>
								<tr>
									<th>No</th>
                                    <th>City Name</th>
									<th>Created date</th>
									<th>Listings</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
                            <?php
                            $si = 1;
                            foreach (getAllCities() as $row) {

                            $city_id = $row['city_id'];
                                
                            $city_listing_count = getCountCityListing($city_id);
                                
                            ?>
								<tr>
                                    <td><?php echo $si; ?></td>
                                    <td><b class="db-list-rat"><?php echo $row['city_name']; ?></b></td>
									<td><?php echo dateFormatconverter($row['city_cdt']); ?></td>
                                    <td><span class="db-list-ststus" data-toggle="tooltip" title="Total listings in this category"><?php echo $city_listing_count; ?></span></td>
									<td><a href="admin-city-edit.php?row=<?php echo $row['city_id']; ?>" class="db-list-edit">Edit</a></td>
									<td><a href="admin-city-delete.php?row=<?php echo $row['city_id']; ?>" class="db-list-edit">Delete</a></td>
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
    </section>
    <!-- END -->    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="js/admin-custom.js"></script> <script src="../js/select-opt.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#citytab').DataTable({
//            pagingType: "simple" // "simple" option for 'Previous' and 'Next' buttons only
        });
    });
</script>
</body>

</html>