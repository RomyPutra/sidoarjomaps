<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?=APP_NAME?></title>
    <link rel="shortcut icon" href="<?php echo base_url('adminlte/dist'); ?>/img/150x150.png" />
    <!-- <style type="text/css"  id="debugbar_dynamic_style"></style> -->
    <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins'); ?>/bootstrap/css/bootstrap_4_5_2.min.css">
    <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins'); ?>/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins'); ?>/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins'); ?>/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins'); ?>/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins'); ?>/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins'); ?>/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?php echo base_url('adminlte/dist'); ?>/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins'); ?>/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins');?>/bootstrap-fileinput/bootstrap-fileinput.css">
    <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins');?>/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins');?>/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
    <!--fullcalendar plugin files -->
    <link rel="stylesheet" href="<?php echo base_url('fullcalendar'); ?>/fullcalendar.css" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url('optionimg'); ?>/DynamicSelect.css">
    <script src="<?php echo base_url('adminlte/plugins'); ?>/jquery/jquery.min.js"></script>
    <style type="text/css">
        #myCarousel {
          img {
            height: 50%;
            width: auto;
            margin-left: auto;
            margin-right: auto;
            display: block;
          }
        }

        #thumbSlider {
          .carousel-inner {
            padding-left: 3rem;
            padding-right: 3rem;
            
            .row {
              overflow: hidden;
            }
            
            .thumb {
                flex: 1;
              &:hover {
                cursor: pointer;
              }
              &.active img {
                opacity: 1;
              }
            }
            
            img {
              height: 150px;
              margin-left: auto;
              margin-right: auto;
              display: block;
              opacity: .5;
              
              &:hover {
                opacity: 1;
              }
            }
            
            .carousel-control-prev-icon {
              background-image: url("data:image/svg+xml;charset=utf8,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20fill='%23000'%20viewBox='0%200%208%208'%3E%3Cpath%20d='M5.25%200l-4%204%204%204%201.5-1.5-2.5-2.5%202.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
            }
            .carousel-control-next-icon {
              background-image: url("data:image/svg+xml;charset=utf8,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20fill='%23000'%20viewBox='0%200%208%208'%3E%3Cpath%20d='M2.75%200l-1.5%201.5%202.5%202.5-2.5%202.5%201.5%201.5%204-4-4-4z'/%3E%3C/svg%3E");
            }
          }
        }
    </style>
    <style>
    #map {
        width: 100%;
        height: 65vh;
    }
    #debug-icon {
      display: none !important;
    }
    .select2-container--default .select2-selection--single {
        height: calc(2.25rem + 2px) !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(2.25rem + 2px) !important;
    }
    .select2-container {
        max-width: 300px;
    }
    .custom-minwidth {
        min-width:300px !important;
    }
    .upload-note {
        font-size: 11px;
        color: green;
    }
    .custom-background {
        color: #fff !important;
        background-color: #6EACDA !important;
    }
    .custom-button {
        color: #fff !important;
        background-color: #03346E !important;
    }
    .nav-sidebar>.nav-item>.nav-link.active {
        background-color: #fff !important;
        color: #000 !important;
    }
    .card-title {
        float: none !important;
    }
    .content-wrapper {
        height: auto !important;
    }
/*    .btn-primary {
        background: #008000 !important;
    }*/
    .custom-menu-background {
        background: #E1DA24 !important;
    }

    .circle {
        display: inline-block;
        width: 20px; /* Adjust the width and height to change the size of the circle */
        height: 20px; /* Adjust the width and height to change the size of the circle */
        background-color: #dc3545; /* Background color of the circle (red in this example) */
        border-radius: 50%; /* Make the element a circle by setting border-radius to 50% */
        text-align: center;
        line-height: 15px; /* Center content vertically */
        color: #fff; /* Text color */
    }

    /* Center images in carousel items */
    .carousel-item {
        /*display: flex;*/
        justify-content: center;
        align-items: center;
    }

    .carousel-item img {
        max-width: 100%;
        height: auto; /* Maintains aspect ratio */
    }

    /* Customize carousel control buttons */
    .carousel-control-prev, .carousel-control-next {
        filter: invert(0%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(100%) contrast(100%);
        color: black; /* Change color of text (if any) */
    }

    /* Optional: Style the icons specifically */
    .carousel-control-prev-icon, .carousel-control-next-icon {
        background-color: black; /* Background color of the icons */
    }

    .item.active {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-container img {
        width: 350px;
        height: 350px;
    }

    @media (min-width: 768px){
        .dl-horizontal dt {
            float: left;
            width: 160px;
            overflow: hidden;
            clear: left;
            text-align: right;
            margin-right: 15px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    }

    .card-success:not(.card-outline)>.card-header {
        background-color: #6EACDA !important;
    }
    
    .katkec {
        display: inline-flex;
    }

    .katkec .form-group {
        margin: 2px;
    }

    @media only screen and (max-width: 767px) and (orientation: portrait) {
        .katkec {
            display: block;
        }
    }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="<?php echo session('pic') !== null ? base_url('public/uploads/profile/').session('pic') : base_url('public/uploads/profile/default.png'); ?>" class="img-circle elevation-2" alt="User Image" style="width: 2.1rem;">
                <?php echo session('name'); ?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="<?php echo base_url('profile'); ?>" class="dropdown-item">
                    <i class="nav-icon far fa-id-card"></i> &nbsp;Profile
                </a>
                <a href="<?php echo base_url('auth/logout'); ?>" class="dropdown-item">
                    <i class="nav-icon fa fa-power-off text-danger"></i> &nbsp;Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<?php echo view('_partials/sidebar'); ?>