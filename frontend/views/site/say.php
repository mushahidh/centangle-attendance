<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\DashboardAsset;
use yii\helpers\Html;

use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

DashboardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="skin-blue sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels
          <span class="logo-mini"><b>Centangle</b>LT</span>
      -->
      <span class="logo-mini"><b>Centangle</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Centangle Attendence</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
      
          <!-- Notifications: style can be found in dropdown.less -->
     
          <!-- Tasks: style can be found in dropdown.less -->
 
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
               <?php  if (Yii::$app->user->isGuest){?>
                <a href="<?php echo \Yii::$app->request->BaseUrl.'/index.php?r=site%2Flogin';?>" >
          
              <span class="hidden-xs">Login</span>
            </a>
           
                 <?php }
                 else
                 ?>
              
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
            <span class="hidden-xs">logout(<?php echo Yii::$app->user->identity->username; ?>)</span>
            </a>
           
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" data-method="post" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                   
                  <a href="<?php echo \Yii::$app->request->BaseUrl.'/index.php?r=site/logout';?>" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
      <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
   
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"> <a href="<?php echo \Yii::$app->request->BaseUrl.'/index.php?r=attendence';?>"><i class="fa fa-pie-chart"></i>Attendence</a></li>
       <li class="header"> <a href="<?php echo \Yii::$app->request->BaseUrl.'/index.php?r=company';?>"><i class="fa fa-pie-chart"></i>Company</a></li>
       <li class="header"> <a href="<?php echo \Yii::$app->request->BaseUrl.'/index.php?r=staff';?>"><i class="fa fa-pie-chart"></i>Staff</a></li>
       <!-- <li class="header"> <a href="<?php //echo \Yii::$app->request->BaseUrl.'/index.php?r=fine';?>"><i class="fa fa-pie-chart"></i>Fine</a></li>
       <li class="header"> <a href="<?php //echo \Yii::$app->request->BaseUrl.'/index.php?r=holidays';?>"><i class="fa fa-pie-chart"></i>Holidays</a></li>
         <li class="header"> <a href="<?php //echo \Yii::$app->request->BaseUrl.'/index.php?r=vocation';?>"><i class="fa fa-pie-chart"></i>Vocation</a></li> -->
    </section>
    <!-- /.sidebar -->
  </aside>
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?= $content ?>
    </section>
    </div>

</div>

     <footer class="main-footer">
    <div class="pull-right hidden-xs">
       <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
    </div>
  <p class="pull-right"><?= Yii::powered() ?></p>
  </footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
