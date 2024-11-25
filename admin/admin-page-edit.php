<?php
include "header.php";
?>

<?php if($admin_row['admin_text_options'] != 1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
    <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
				<div class="log-bor">&nbsp;</div>
				<span class="udb-inst">Edit all static pages</span>
                <div class="ud-cen-s2 ad-all-text-chan">
                    <!-- TAB START -->

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- TODAY LEADS -->
                        <div id="home" class="tab-pane active"><br>
                            <h2>Edit page</h2>
                                <table class="responsive-table bordered">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Page name</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>    
                                    <tr>
                                        <td>1</td>
                                        <td>About us</td>
                                        <td><a href="#"  data-toggle="modal" data-target="#pageeditpop" class="db-list-edit">Edit</a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>FAQ</td>
                                        <td><a href="#"  data-toggle="modal" data-target="#pageeditpop" class="db-list-edit">Edit</a></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Feedback</td>
                                        <td><a href="#"  data-toggle="modal" data-target="#pageeditpop" class="db-list-edit">Edit</a></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Contact us</td>
                                        <td><a href="#"  data-toggle="modal" data-target="#pageeditpop" class="db-list-edit">Edit</a></td>
                                    </tr> 
                                    <tr>
                                        <td>5</td>
                                        <td>Privacy policy</td>
                                        <td><a href="#"  data-toggle="modal" data-target="#pageeditpop" class="db-list-edit">Edit</a></td>
                                    </tr> 
                                    <tr>
                                        <td>6</td>
                                        <td>Terms of use</td>
                                        <td><a href="#"  data-toggle="modal" data-target="#pageeditpop" class="db-list-edit">Edit</a></td>
                                    </tr>   
                                 </tbody>
                            </table>
                        </div>
                        <!-- END TODAY LEADS -->

                        <!-- TAB END -->
                    </div>

                </div>
            </div>

            </div>
        </div>
    </section>
    <!-- END -->    

    <section>
        <div class="pop-table pop-page-edit">
            <!-- The Modal -->
            <div class="modal fade" id="pageeditpop">
                <div class="modal-dialog">
                    <div class="modal-content login">
                        <div class="log-bor">&nbsp;</div>
                        <span class="udb-inst">Edit page</span>
                        <div class="log">
                            <h4>About us</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="inn">
                            <textarea name="page_text" id="page_text"      required="required" class="form-control"      placeholder="News details">
                                <div class="rhs">
                                    <h2>Your feedback</h2>
                                    <p>Your feedback is most important for us. There are many variations of passages of Lorem Ipsum available,but the majority have suffered alteration in some form, by injected humour</p>
                                    <h2>Your feedback</h2>
                                    <p>Your feedback is most important for us. There are many variations of passages of Lorem Ipsum available,but the majority have suffered alteration in some form, by injected humour</p>
                                    <h2>Your feedback</h2>
                                    <p>Your feedback is most important for us. There are many variations of passages of Lorem Ipsum available,but the majority have suffered alteration in some form, by injected humour</p>
                                    <h2>Your feedback</h2>
                                    <p>Your feedback is most important for us. There are many variations of passages of Lorem Ipsum available,but the majority have suffered alteration in some form, by injected humour</p>
                                    <h2>Your feedback</h2>
                                    <p>Your feedback is most important for us. There are many variations of passages of Lorem Ipsum available,but the majority have suffered alteration in some form, by injected humour</p>
                                    <h2>Your feedback</h2>
                                    <p>Your feedback is most important for us. There are many variations of passages of Lorem Ipsum available,but the majority have suffered alteration in some form, by injected humour</p>
                                </div>
                            </textarea>
                        </div>
                        </div>
                        <button type="submit" name="news_submit" class="btn btn-primary cta-new">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
            <!--- END --->
        </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="js/admin-custom.js"></script> <script src="../js/select-opt.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('page_text');
    </script>
</body>

</html>