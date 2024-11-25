<?php
include "header.php";
?>

<?php if($footer_row['admin_job_show'] != 1 || $admin_row['admin_jobs_options'] != 1){
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
                            <span class="udb-inst">Delete Job Skill Set</span>
                            <div class="log log-1">
                                <div class="login">
                                    <h4>Delete this Job Skill Set</h4>
                                    <?php include "../page_level_message.php"; ?>
                                    <?php
                                    $category_id=$_GET['row'];
                                    $row= getJobSkill($category_id) ;

                                    ?>
                                    <form name="category_form" id="category_form" method="post" action="trash_job_skill_set.php" enctype="multipart/form-data" class="cre-dup-form cre-dup-form-show">
                                        <input type="hidden" class="validate" id="category_id" name="category_id" value="<?php echo $row['category_id']; ?>" required="required">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" readonly="readonly"  id="category_name" name="category_name" value="<?php echo $row['category_name']; ?>"  placeholder="Skill Set name *" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <button type="submit" name="category_submit" class="btn btn-primary">Delete</button>
                                    </form>
                                    <div class="col-md-12">
                                        <a href="admin-all-job-skill-set.php" class="skip">Go to All Skill Set >></a>
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
<script src="js/admin-custom.js"></script> <script src="../js/select-opt.js"></script>
</body>

</html>