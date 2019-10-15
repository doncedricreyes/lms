
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>St. Catherine College of Valenzuela | Learning Management System</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/fullcalendar/dist/fullcalendar.min.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/fullcalendar/dist/fullcalendar.print.min.css')}}" media="print">
  <link rel="stylesheet" href="https://cdnjs.cloudfare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
  <link rel="stylesheet"
   <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />
  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/skin-blue.min.css')}}">
     <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Tell the browser to be responsive to screen width -->
    

     <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('/js/fontawesome.js') }}"></script>
    <script src="{{ asset('/js/fontawesome.min.js') }}"></script> 

  <script src="{{asset('bower_components/moment/moment.js')}}"></script>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
<style>
    body{
      font-family:"raleway";
    }
  </style>
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
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="/storage/images/sccv.jpg" class="img-circle" id="logo" height="45" width="45"></span>
      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg">    <img src="/storage/images/sccv.jpg" class="img-circle" id="logo" height="45" width="45"></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
    
   
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
   
     
              <span >{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                  @if(Auth::user()->role == "teacher")
                  <a href="/teacher/profile/{{Auth::user()->id}}"> <img src="/storage/images/{{$teacher_profiles->get(0)->profile_pic}}" class="img-circle" alt="User Image" height="100"></a>
                  @endif
                  @if(Auth::user()->role == "student")
                  <a href="/student/profile/{{Auth::user()->id}}"><img src="/storage/images/{{$profiles->get(0)->profile_pic}}" class="img-circle" alt="User Image" height="100"></a>
                  @endif

                <p>
                  {{Auth::user()->name}}
               
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-md-8 text-center">
                    @if(Auth::user()->role == "student")
                    <a href="/student/profile/{{Auth::user()->id}}">Profile</a>
                @endif
                @if(Auth::user()->role == "teacher")
                    <a href="/teacher/profile/{{Auth::user()->id}}">Profile</a>
                @endif
                @if(Auth::user()->role == "superadmin")
                <a href="/admin/create" >Create Admin Account</a>
                @endif
                @if(Auth::user()->role == "parent")
                <a href="/parent/classes" >Students</a>
                @endif
                  </div>
                  <div class="col-xs-4 text-center">
                    @if(Auth::user()->role == "student")
                    <a href="/student/messages/{{Auth::user()->id}}/inbox">Messages</a>
                @endif
                @if(Auth::user()->role == "teacher")
                    <a href="/teacher/messages/{{Auth::user()->id}}/inbox">Messages</a>
                @endif
                @if(Auth::user()->role == "parent")
                <a href="/parent/messages/{{Auth::user()->id}}/inbox">Messages</a>
            @endif
    
            @if(Auth::user()->role == "superadmin")
            <a href="/admin/messages/{{Auth::user()->id}}/inbox">Messages</a>
        @endif
                  </div>
                 
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
     
              <li class="user-footer">
             
                   
                <div class="pull-left">
                  @if(Auth::user()->role == "parent")
                  <a href="/parent/account" class="btn btn-default btn-flat">Account</a>
                  @endif
                </div>
                <div class="pull-left">
                    @if(Auth::user()->role == "admin" || Auth::user()->role == "superadmin")
                    <a href="/admin/account" class="btn btn-default btn-flat">Account</a>
                    @endif
                  </div>
                  <div class="pull-left">
                      @if(Auth::user()->role == "teacher")
                      <a href="/teacher/account" class="btn btn-default btn-flat">Account</a>
                      @endif
                    </div>
                    <div class="pull-left">
                        @if(Auth::user()->role == "student")
                        <a href="/student/account" class="btn btn-default btn-flat">Account</a>
                        @endif
                      </div>
                
               
                
                <div class="pull-right">
                    @if(Auth::user()->role == "teacher")
                  <a href="/teacher/logout" class="btn btn-default btn-flat">Sign out</a>
                  @endif
                </div>
                <div class="pull-right">
                  @if(Auth::user()->role == "student")
                  <a href="/student/logout" class="btn btn-default btn-flat">Sign out</a>
                  @endif
                </div>
                <div class="pull-right">
                  @if(Auth::user()->role == "parent")
                  <a href="/parent/logout" class="btn btn-default btn-flat">Sign out</a>
                  @endif
                </div>
                <div class="pull-right">
                  @if(Auth::user()->role == "admin"|| Auth::user()->role == "superadmin")
                  <a href="/admin/logout" class="btn btn-default btn-flat">Sign out</a>
                  @endif
                </div>
             
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
         
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
            @if(Auth::user()->role == "teacher")
            <img src="/storage/images/{{$teacher_profiles->get(0)->profile_pic}}" class="img-circle" alt="User Image">
            @endif
            @if(Auth::user()->role == "student")
            <img src="/storage/images/{{$profiles->get(0)->profile_pic}}" class="img-circle" alt="User Image">
            @endif
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <!-- Status -->
    
        </div>
      </div>



      <!-- Sidebar Menu -->
      @if(Auth::user()->role=="parent")
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
        <li><a href="/parent/enrollment"><i class="fa fa-plus-circle"></i> <span>Enrollment</span></a></li>
        <li><a href="/parent/classes"><i class="fa fa-user"></i> <span>Students</span></a></li>
        <li><a href="/parent/messages/{{Auth::user()->id}}/inbox"><i class="fa fa-envelope"></i> <span>Messages</span></a></li>
        <li><a href="/parent/students/grades"><i class="fa fa-graduation-cap"></i> <span>Grades</span></a></li>
        <li><a href="/parent/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
      </ul>
      @endif
      @if(Auth::user()->role=="admin" || Auth::user()->role == "superadmin")
      <ul class="sidebar-menu" data-widget="tree">
          <!-- Optionally, you can add icons to the links -->
          <li class="{{Request::is('admin/admins') || Request::is('admin/teachers') || Request::is('admin/students') || Request::is('admin/parents')  ? 'active' : ''}} treeview">
              <a href="#"><i class="fa fa-users"></i> <span>Users</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                  <li class="{{Request::is('admin/admins') ? 'active' : ''}}"><a href="{{url('admin/admins')}}"><i class="fa fa-user-o"></i>Admins</a></li>
                <li class="{{Request::is('admin/teachers') ? 'active' : ''}}"><a href="{{url('admin/teachers')}}"><i class="fa fa-user-o"></i>Teachers</a></li>
                <li class="{{Request::is('admin/students') ? 'active' : ''}}"><a href="{{url('admin/students')}}"><i class="fa fa-user-o"></i>Students</a></li>
                <li class="{{Request::is('admin/parents') ? 'active' : ''}}"><a href="{{url('admin/parents')}}"><i class="fa fa-user-o"></i>Parents</a></li>
              </ul>
            </li>
          <li class = "{{Request::is('admin/subjects')  ? 'active' : ''}}"><a href="{{url('admin/subjects')}}"><i class="fa fa-book"></i> <span>Subjects</span></a></li>
          <li class="{{Request::is('admin/class') ? 'active' : ''}}"><a href="{{url('admin/class')}}"><i class="fa fa-graduation-cap"></i> <span>Class</span></a></li>
          <li class="{{Request::is('/admin/messages/inbox') ? 'active' : ''}}"><a href="/admin/messages/{{Auth::user()->id}}/inbox"><i class="fa fa-envelope"></i> <span>Messages</span></a></li>
          <li class="{{Request::is('admin/calendar') ? 'active' : ''}}"><a href="/admin/calendar"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>
          <li class="treeview" >
            <a href="#"><i class="fa fa-archive"></i> <span>Archive</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{Request::is('admin/archive/admins') ? 'active' : ''}}"><a href="/admin/archive/admins"><i class="fa fa-user-o"></i>Admins</a></li>
              <li class="{{Request::is('admin/archive/teachers') ? 'active' : ''}}"><a href="/admin/archive/teachers"><i class="fa fa-user-o"></i>Teachers</a></li>
              <li class="{{Request::is('admin/archive/students') ? 'active' : ''}}"><a href="/admin/archive/students"><i class="fa fa-user-o"></i>Students</a></li>
              <li class="{{Request::is('admin/archive/parents') ? 'active' : ''}}"><a href="/admin/archive/parents"><i class="fa fa-user-o"></i>Parents</a></li>
              <li class="{{Request::is('admin/archive/class') ? 'active' : ''}}"><a href="/admin/archive/class"><i class="fa fa-graduation-cap"></i>Class</a></li>
            </ul>
          </li>
          <li><a href="/admin/logout"><i class="fa fa-sign-out"></i>  <span>Logout</span></a></li>
       
        </ul>
        @endif
        @if(Auth::user()->role=="student")
        <ul class="sidebar-menu" data-widget="tree">
            <!-- Optionally, you can add icons to the links -->
            <li><a href="/student/class"><i class="fa fa-graduation-cap"></i> <span>Class</span></a></li>
            <li><a href="/student/subjects"><i class="fa fa-book"></i> <span>Subjects</span></a></li>
            <li><a href="/student/grades/{{Auth::user()->id}}"><i class="fa fa-pencil-square-o"></i> <span>Grades</span></a></li>
            <li><a href="/student/schedule/{{Auth::user()->id}}"><i class="fa fa-book"></i> <span>Schedule</span></a></li>
            <li><a href="/student/messages/{{Auth::user()->id}}/inbox"><i class="fa fa-envelope"></i> <span>Messages</span></a></li>
            <li><a href="/student/profile/{{Auth::user()->id}}"><i class="fa  fa-user"></i> <span>Profile</span></a></li>
            <li><a href="/student/calendar"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>
            <li><a href="/student/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
          </ul>
          @endif
          @if(Auth::user()->role=="teacher")
          <ul class="sidebar-menu" data-widget="tree">
              <!-- Optionally, you can add icons to the links -->
              <li><a href="/teacher/subjects"><i class="fa fa-book"></i> <span>Subjects</span></a></li>
              <li><a href="/teacher/class"><i class="fa fa-graduation-cap"></i> <span>Class</span></a></li>
              <li><a href="/teacher/profile/{{Auth::user()->id}}"><i class="fa  fa-user"></i> <span>Profile</span></a></li>
              <li><a href="/teacher/messages/{{Auth::user()->id}}/inbox"><i class="fa fa-envelope"></i> <span>Messages</span></a></li>
              <li><a href="/teacher/calendar"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>
              <li><a href="/teacher/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
            </ul>
            @endif
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
  
   
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

  @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
   
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->

      
       
        
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
    
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js></script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
    
</body>
</html>
