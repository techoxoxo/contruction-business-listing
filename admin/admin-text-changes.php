<?php
include "header.php";
?>

<?php if($admin_row['admin_text_options'] != 1){
    header("Location: profile.php");
}
?>
<style>
    .log h4{padding:40px 0 20px;text-align:left}
</style>
    <!-- START -->
    <section>
    <div class="ad-com all-text-updt">
        <div class="ad-dash leftpadd">
            <div class="login-reg">
                <div class="container">
                    <div class="row">
                        <div class="login-main add-list">
                            <div class="log-bor">&nbsp;</div>
                            <span class="steps">Edit all website texts here</span>
                            <div class="log">
                                <div class="login">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tab1">Registration</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab2">Listing</a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <!-- Tab 1 -->
                                        <div id="tab1" class="container tab-pane active">
                                                <h4>Register & Login pages</h4>
                                                <form action="" class="event_form" id="" name="" method="post" enctype="">
                                                    <ul>
                                                        <li>

                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group floating">
                                                                        <input type="text" class="form-control floating" value="Name" id="f1">
                                                                        <label for="f1" class="tfix">Name</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group floating">
                                                                        <input type="text" class="form-control floating" value="Email">
                                                                        <label for="" class="tfix">Email</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group floating">
                                                                        <input type="text" class="form-control floating" value="Email Id">
                                                                        <label for="" class="tfix">Email Id</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group floating">
                                                                        <input type="text" class="form-control floating" value="Phone">
                                                                        <label for="" class="tfix">Phone</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group floating">
                                                                        <input type="text" class="form-control floating" value="Phone number">
                                                                        <label for="" class="tfix">Phone number</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group floating">
                                                                        <input type="text" class="form-control floating" value="Mobile Number">
                                                                        <label for="" class="tfix">Mobile Number</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                        </li>
                                                    </ul>
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" name="event_submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                </form>

                                        </div>
                                        <!-- END Tab 1 -->
                                        <!-- Tab 1 -->
                                        <div id="tab2" class="container tab-pane">
                                        <h4>Listing pages</h4>
                                                <form action="" class="event_form" id="" name="" method="post" enctype="">
                                                    <ul>
                                                        <li>

                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group floating">
                                                                        <input type="text" class="form-control floating" value="Name" id="f1">
                                                                        <label for="f1" class="tfix">Name</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group floating">
                                                                        <input type="text" class="form-control floating" value="Email">
                                                                        <label for="" class="tfix">Email</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group floating">
                                                                        <input type="text" class="form-control floating" value="Email Id">
                                                                        <label for="" class="tfix">Email Id</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group floating">
                                                                        <input type="text" class="form-control floating" value="Phone">
                                                                        <label for="" class="tfix">Phone</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group floating">
                                                                        <input type="text" class="form-control floating" value="Phone number">
                                                                        <label for="" class="tfix">Phone number</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group floating">
                                                                        <input type="text" class="form-control floating" value="Mobile Number">
                                                                        <label for="" class="tfix">Mobile Number</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                        </li>
                                                    </ul>
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" name="event_submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                </form>
                                        </div>
                                        <!-- END Tab 1 -->
                                    </div>
                                    <!-- END Tab panes -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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