<!DOCTYPE html>{*http://webapplayers.com/inspinia_admin-v2.7.1/*}
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Samocvetik | Dashboard</title>

    <link href="{{@BASE}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{@BASE}}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{@BASE}}/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{@BASE}}/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="{{@BASE}}/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <!-- iCheck -->
    <link href="{{@BASE}}/css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="{{@BASE}}/css/animate.css" rel="stylesheet">
    <link href="{{@BASE}}/css/style.css" rel="stylesheet">

</head>

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{@BASE}}/img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <repeat group="{{@NAV_MENU}}" key="{{@key}}" value="{{@item}}">
                    <li{{ @PARAMS.action==@item.name ? ' class="active"':'' }}>
                        <set href="{{ isset(@item.href) ? @item.href : @BASE.'/admin/'.@item.name }}" sub_items="{{ isset(@item.items ) }}" />
                        <a href="{{@href}}"><i class="fa fa-{{@item.icon}}"></i> <span class="nav-label">{{@item.label}}</span> {{ @sub_items ? '<span class="fa arrow"></span>' : '' }}</a>
                        <include href="Admin/sum_menu_items.tpl" if="{{@sub_items}}" with="items={{@item.items}}"/>
                    </li>
                </repeat>
            </ul>
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" action="search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="{{@BASE}}/img/a7.jpg">
                                    </a>
                                    <div class="media-body">
                                        <small class="pull-right">46h ago</small>
                                        <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="{{@BASE}}/img/a4.jpg">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right text-navy">5h ago</small>
                                        <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                        <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="{{@BASE}}/img/profile.jpg">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right">23h ago</small>
                                        <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                        <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="mailbox.html">
                                        <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="mailbox.html">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="profile.html">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="grid_options.html">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="notifications.html">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>


                    <li>
                        <a href="login.html">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                    <li>
                        <a class="right-sidebar-toggle">
                            <i class="fa fa-tasks"></i>
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <include href="{{ @content_tpl }}"/>
    </div>

</div>

<!-- Mainly scripts -->
<script src="{{@BASE}}/js/jquery-3.1.1.min.js"></script>
<script src="{{@BASE}}/js/bootstrap.min.js"></script>
<script src="{{@BASE}}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{@BASE}}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{@BASE}}/js/common.js"></script>

<!-- Flot -->
<script src="{{@BASE}}/js/plugins/flot/jquery.flot.js"></script>
<script src="{{@BASE}}/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="{{@BASE}}/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="{{@BASE}}/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="{{@BASE}}/js/plugins/flot/jquery.flot.pie.js"></script>

<!-- Peity -->
<script src="{{@BASE}}/js/plugins/peity/jquery.peity.min.js"></script>
<script src="{{@BASE}}/js/demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{@BASE}}/js/inspinia.js"></script>

<script src="{{@BASE}}/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="{{@BASE}}/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- GITTER -->
<script src="{{@BASE}}/js/plugins/gritter/jquery.gritter.min.js"></script>

<!-- Sparkline -->
<script src="{{@BASE}}/js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="{{@BASE}}/js/demo/sparkline-demo.js"></script>

<!-- ChartJS-->
<script src="{{@BASE}}/js/plugins/chartJs/Chart.min.js"></script>

<!-- Toastr -->
<script src="{{@BASE}}/js/plugins/toastr/toastr.min.js"></script>

<!-- Sweet alert -->
<script src="{{@BASE}}/js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- iCheck -->
<script src="{{@BASE}}/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function () {

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });

    });
</script>

</body>
</html>