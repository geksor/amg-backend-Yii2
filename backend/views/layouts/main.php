<?php

/**
 * @var $content string
 */

use yii\helpers\Html;

yiister\adminlte\assets\Asset::register($this);

$this->title = 'Админ панель AMG'
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .textWrap{overflow: auto}
        .markTr .table-striped > tbody > tr.newRow{background-color:rgba(255, 26, 0, 0.10)}
        .markTr .table-striped > tbody > tr.newRow:hover{background-color:rgba(255, 26, 0, 0.20)}
        .markTr .table-striped > tbody > tr.noReadRow{background-color:rgba(255, 193, 7, 0.10)}
        .markTr .table-striped > tbody > tr.noReadRow:hover{background-color:rgba(255, 193, 7, 0.20)}
        .workarea-cropbox{width: 100%!important;}
        .bg-cropbox{width: 100%!important;}
        .imagePages-form .workarea-cropbox{height: 600px!important;}
        .imagePages-form .bg-cropbox{height: 600px!important;}
        .grid-view{overflow: auto}
    </style>
    <?php $this->head() ?>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="/" class="logo" target="_blank">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">AMG</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">AMG админ панель</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <?= Html::a('Выход', ['site/logout'], ['data'=>['method'=>'post'] ,'class'=>'btn btn-primary btn-flat']) ?>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="/admin/params"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar Menu -->
            <?try {?>
            <?=
            \yiister\adminlte\widgets\Menu::widget(
                [
                    "items" => [
                        ["label" => "Главная", "url" => "/admin", "icon" => "home", "active" => Yii::$app->controller->id === 'site',],
                        ["label" => "Тренеры", "url" => ["/trainer/index"], "icon" => "users", "active" => Yii::$app->controller->id === 'trainer',],
                        ["label" => "Пользователи", "url" => ["/user/index"], "icon" => "users", "active" => Yii::$app->controller->id === 'user',],
                        [
                            "label" => "Организация",
                            "icon" => "info",
                            "url" => "#",
                            "items" => [
                                ["label" => "Контакты", "url" => ["/contact/index"], "active" => Yii::$app->controller->id === 'contact',],
                                ["label" => "Правила и карта", "url" => ["/rules-training/index"], "active" => Yii::$app->controller->id === 'rules-training',],
                                ["label" => "Дилерские центры", "url" => ["/dealer-center/index"], "active" => Yii::$app->controller->id === 'dealer-center',],
                                ["label" => "Тренинги", "url" => ["/training/index"], "active" => Yii::$app->controller->id === 'training',],
                                [
                                    "label" => "Расписание",
                                    "url" => ["#"],
                                    "icon" => "table",
                                    "active" => Yii::$app->controller->id === 'timetable',
                                    "items" => [
                                        [
                                            "label" => "Тренинг 1",
                                            "url" => ["#"],
                                            "items" => [
                                                [
                                                    "label" => "Понедельник",
                                                    "url" => ["/timetable/index", 'trainingDay' => 1, 'weekday' => 1],
                                                    "items" => [
                                                        [
                                                            "label" => "группа 1",
                                                            "url" => [
                                                                "/timetable/table",
                                                                'TimetableSearch' => [
                                                                    'trainingDay' => 1,
                                                                    'weekday' => 1,
                                                                    'group' => 1
                                                                ],
                                                            ],
                                                        ],
                                                        [
                                                            "label" => "группа 2",
                                                            "url" => [
                                                                "/timetable/table",
                                                                'TimetableSearch' => [
                                                                    'trainingDay' => 1,
                                                                    'weekday' => 1,
                                                                    'group' => 2
                                                                ]
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    "label" => "Вторник",
                                                    "url" => ["/timetable/index", 'trainingDay' => 1, 'weekday' => 2],
                                                    "items" => [
                                                        [
                                                            "label" => "группа 1",
                                                            "url" => [
                                                                "/timetable/table",
                                                                'TimetableSearch' => [
                                                                    'trainingDay' => 1,
                                                                    'weekday' => 2,
                                                                    'group' => 1
                                                                ],
                                                            ],
                                                        ],
                                                        [
                                                            "label" => "группа 2",
                                                            "url" => [
                                                                "/timetable/table",
                                                                'TimetableSearch' => [
                                                                    'trainingDay' => 1,
                                                                    'weekday' => 2,
                                                                    'group' => 2
                                                                ]
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    "label" => "Среда",
                                                    "url" => ["/timetable/index", 'trainingDay' => 1, 'weekday' => 3],
                                                    "items" => [
                                                        [
                                                            "label" => "группа 1",
                                                            "url" => [
                                                                "/timetable/table",
                                                                'TimetableSearch' => [
                                                                    'trainingDay' => 1,
                                                                    'weekday' => 3,
                                                                    'group' => 1
                                                                ],
                                                            ],
                                                        ],
                                                        [
                                                            "label" => "группа 2",
                                                            "url" => [
                                                                "/timetable/table",
                                                                'TimetableSearch' => [
                                                                    'trainingDay' => 1,
                                                                    'weekday' => 3,
                                                                    'group' => 2
                                                                ]
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                        [
                                            "label" => "Тренинг 2",
                                            "url" => ["#"],
                                            "items" => [
                                                [
                                                    "label" => "Среда",
                                                    "url" => ["/timetable/index", 'trainingDay' => 3, 'weekday' => 3],
                                                    "items" => [
                                                        [
                                                            "label" => "группа 1",
                                                            "url" => [
                                                                "/timetable/table",
                                                                'TimetableSearch' => [
                                                                    'trainingDay' => 3,
                                                                    'weekday' => 3,
                                                                    'group' => 1
                                                                ],
                                                            ],
                                                        ],
                                                        [
                                                            "label" => "группа 2",
                                                            "url" => [
                                                                "/timetable/table",
                                                                'TimetableSearch' => [
                                                                    'trainingDay' => 3,
                                                                    'weekday' => 3,
                                                                    'group' => 2
                                                                ]
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    "label" => "Четверг",
                                                    "url" => ["/timetable/index", 'trainingDay' => 3, 'weekday' => 4],
                                                    "items" => [
                                                        [
                                                            "label" => "группа 1",
                                                            "url" => [
                                                                "/timetable/table",
                                                                'TimetableSearch' => [
                                                                    'trainingDay' => 3,
                                                                    'weekday' => 4,
                                                                    'group' => 1
                                                                ],
                                                            ],
                                                        ],
                                                        [
                                                            "label" => "группа 2",
                                                            "url" => [
                                                                "/timetable/table",
                                                                'TimetableSearch' => [
                                                                    'trainingDay' => 3,
                                                                    'weekday' => 4,
                                                                    'group' => 2
                                                                ]
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    "label" => "Пятница",
                                                    "url" => ["/timetable/index", 'trainingDay' => 3, 'weekday' => 5],
                                                    "items" => [
                                                        [
                                                            "label" => "группа 1",
                                                            "url" => [
                                                                "/timetable/table",
                                                                'TimetableSearch' => [
                                                                    'trainingDay' => 3,
                                                                    'weekday' => 5,
                                                                    'group' => 1
                                                                ],
                                                            ],
                                                        ],
                                                        [
                                                            "label" => "группа 2",
                                                            "url" => [
                                                                "/timetable/table",
                                                                'TimetableSearch' => [
                                                                    'trainingDay' => 3,
                                                                    'weekday' => 5,
                                                                    'group' => 2
                                                                ]
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            "label" => "Тесты",
                            "icon" => "gamepad",
                            "url" => "#",
                            "items" => [
                                ["label" => "Очки за тесты", "url" => ["/point-test/index"], "active" => Yii::$app->controller->id === 'point-test',],
                                ["label" => "X-Class Тест драйв", "url" => ["/xclass-drive/index"], "active" => Yii::$app->controller->id === 'xclass-drive',],
                                ["label" => "MIX Статика", "url" => ["/mix-static/index"], "active" => Yii::$app->controller->id === 'mix-static',],
                                ["label" => "AMG Статика", "url" => ["/amg-static-test/index"], "active" => Yii::$app->controller->id === 'amg-static-test',],
                                ["label" => "MBUX Тест", "url" => ["/mbux-test/index"], "active" => Yii::$app->controller->id === 'mbux-test',],
                                ["label" => "X-Class линии исполнения", "url" => ["/xclass-line/index"], "active" => Yii::$app->controller->id === 'xclass-line',],
                                ["label" => "Викторина", "url" => ["/quiz/index"], "active" => Yii::$app->controller->id === 'quiz',],
                            ],
                        ],
//                        [
//                            "label" => "Widgets",
//                            "icon" => "th",
//                            "url" => "#",
//                            "items" => [
//                                ["label" => "Menu", "url" => ["site/menu"]],
//                                ["label" => "Boxes", "url" => ["site/boxes"]],
//                                ["label" => "FlashAlert", "url" => ["site/flash-alert"]],
//                                ["label" => "Callouts", "url" => ["site/callouts"]],
//                            ],
//                        ],
//                        [
//                            "label" => "Badges",
//                            "url" => "#",
//                            "icon" => "table",
//                            "items" => [
//                                [
//                                    "label" => "Default",
//                                    "url" => "#",
//                                    "icon" => "table",
//                                    "badge" => "123",
//                                ],
//                                [
//                                    "label" => "Blue",
//                                    "url" => "#",
//                                    "icon" => "table",
//                                    "badge" => "123",
//                                    "badgeOptions" => [
//                                        "class" => \yiister\adminlte\components\AdminLTE::BG_BLUE,
//                                    ],
//                                ],
//                            ],
//                        ],
//                        [
//                            "label" => "Multilevel",
//                            "url" => "#",
//                            "icon" => "table",
//                            "items" => [
//                                [
//                                    "label" => "Second level",
//                                    "url" => "#",
//                                ],
//                                [
//                                    "label" => "Second level",
//                                    "url" => "#",
//                                    "icon" => "table",
//                                    "items" => [
//                                        [
//                                            "label" => "Default",
//                                            "url" => "#",
//                                        ],
//                                        [
//                                            "label" => "Red",
//                                            "url" => "#",
//                                            "icon" => "table",
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
                    ],
                ]
            )
            ?>
            <?}catch (\Exception $exception){}?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <?php if (isset($this->params['breadcrumbs'])): ?>
                <?=
                \yii\widgets\Breadcrumbs::widget(
                    [
                        'encodeLabels' => false,
                        'homeLink' => [
                            'label' => new \rmrevin\yii\fontawesome\component\Icon('home') . ' Главная',
                            'url' => '/admin',
                        ],
                        'links' => $this->params['breadcrumbs'],
                    ]
                )
                ?>
            <?php endif; ?>
        </section>

        <!-- Main content -->
        <section class="content">
            <?= $content ?>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; <a href="http://yiister.ru">Yiister</a> <?= date("Y") ?>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

            </div><!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                            Some information about this general settings option
                        </p>
                    </div><!-- /.form-group -->
                </form>
            </div><!-- /.tab-pane -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
