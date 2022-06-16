<html dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url(); ?>assets/images/favicon.png">
        <title>Zadin Mitra Abadi</title>
        <link href="<?=base_url(); ?>assets/dist/css/style.min.css" rel="stylesheet">




        <script src="<?=base_url(); ?>assets/libs/jquery/dist/jquery.min.js"></script>

        <script src="<?=base_url(); ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="<?=base_url(); ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>


        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    </head>

    <body>
        <div class="main-wrapper">
            <div class="preloader" style="display: none;">
                <div class="lds-ripple">
                    <div class="lds-pos"></div>
                    <div class="lds-pos"></div>
                </div>
            </div>
            <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="">
                <div class="auth-box p-4 bg-white rounded">
                    <div id="loginform">
                        <div class="logo text-center">
                            <h3 class="box-title mb-3">Zadin Mitra Abadi</h3>
                        </div>
                        <!-- Form -->
                        <div class="row">
                            <div class="col-12">
                                <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.8/jquery.jgrowl.min.css" />
                                <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.8/jquery.jgrowl.min.js"></script>
                                <?php if ($this->session->flashdata('error') != ''): ?>
                                <script type="text/javascript">
                                $(document).ready(function() {
                                    $.jGrowl("<?php echo $this->session->flashdata('error'); ?>", {
                                        "position": "center"
                                    });
                                });
                                </script>
                                <?php endif; ?>

                                <form method="post" action="<?php echo site_url('login/process'); ?>">
                                    <div class="form-group mb-3">
                                        <div class="">
                                            <input class="form-control" type="text" required="" placeholder="Username" name="username" autofocus value="Admin">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="">
                                            <input class="form-control" type="password" required="" placeholder="Password" name="password" value="12345">
                                        </div>
                                    </div>
                                    <div class="form-group text-center mt-4">
                                        <div class="col-xs-12">
                                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Masuk</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>















        </div>




        <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        </script>


    </body>

</html>