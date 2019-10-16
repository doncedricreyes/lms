<!DOCTYPE html>
<html lang="en">
<head>
       
        <link rel="shortcut icon" type="image/x-icon" href="/storage/images/logo3.ico">
        
        <title>SCCV-LMS</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="{{asset('bower_components/elegant-fonts.css')}}">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="{{asset('bower_components/themify-icons.css')}}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{asset('bower_components/swiper.min.css')}}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('bower_components/style.css')}}">
    
   
    <style>  


    img {
  position: absolute;
  left: 50px;
  top: -13px;
  z-index: -1;


  
}
    
 </style> 
</head>
<body>
         
        
    <div class="hero-content">
        <header class="site-header">
            

            <div class="nav-bar">
                <div>
                    <div class="row">
                        <div class="col-9 col-lg-3">
                               <img src="/storage/images/logo3.png" width="80" height="80">
                            <div class="site-branding">                       
                                <h3 class="site-title"><a href="/" rel="home">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SCCV-<span>LMS</span></a></h3>
                            
                            </div><!-- .site-branding -->
                        </div><!-- .col -->
                    

                        <div class="col-3 col-lg-9 justify-content-end align-content-center">
                            <nav class="site-navigation flex justify-content-end align-items-center">
                                <ul class="nav navbar-nav justify-content-end align-content-center">
                                    <li class="current-menu-item"><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home </span></a></li>
                                    <li><a href="about"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> About</a></li>                   
                                    <li><a href="contact"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> Contact</a></li>  
                                    <li><a href="learnmore"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span> Learn More</a></li>
  <!--yung login button-->          <li><a href="student/login"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Login </a></li>
   <!--pero login lang, pipili pa sila sa mismong login page ng role(?) 
    or kung gusto mo lagyan mo na lang dropdown hah-->                                 
                                </ul>                                       
                                </ul>

                              <div class="hamburger-menu d-md-none"  >
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>

                           

                                
                            </nav><!-- .site-navigation -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .container -->
            </div><!-- .nav-bar -->
        </header><!-- .site-header -->



        <div class="hero-content-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-content-wrap flex flex-column justify-content-center align-items-start">
                            <header class="entry-header">
                                <h4>Get started!</h4>
                                <h1> An easy access to <br>student's Quality education</h1>
                            </header><!-- .entry-header -->

                           <div class="entry-content">
                                <p id="sccv"> St. Catherine College of Valenzuela Learning Management.<br>
                                    A technological and systematic approach to student's quality education.               
                                </p>
                            </div>

                            <footer class="entry-footer read-more">
                               <p id="log"> Login as a..</p>
                               <ul class="nav nav-pills" id="login">
<!--diretso login na button dito--> <li role="presentation"><a href="/teacher/login"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Teacher</a></li>
                                    <li role="presentation"><a href="/student/login"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Student</a></li>
                                    <li role="presentation"><a href="/parent/login"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Parent</a></li>
                                  </ul>
                            

                            </footer><!-- .entry-footer -->
                        </div><!-- .hero-content-wrap -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .hero-content-hero-content-overlay -->
    </div><!-- .hero-content -->



<br> <br> <br>
    <div class="icon-boxes">
        <div class="container-fluid">
            <div class="flex justify-content-center align-items-center">
                
                <div class="icon-box">
                    <div class="icon">
                       
                        <span class="glyphicon glyphicon-user"></span>
                    </div><!-- .icon -->

                    <header class="entry-header">
                        <h2 class="entry-title">For Teachers</h2>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <p>Proctors can send messages, track each student's progress, and deliver materials anywhere. Save your time by using this tool!</p>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer read-more">
                        <a href="learnmore">Read more<i class="fa fa-long-arrow-right"></i></a>
                    </footer><!-- .entry-footer -->
                </div><!-- .icon-box -->

                <div class="icon-box">
                        <div class="icon">
                           
                            <span class="glyphicon glyphicon-user"></span>
                        </div><!-- .icon -->
    
                        <header class="entry-header">
                            <h2 class="entry-title">For Students</h2>
                        </header><!-- .entry-header -->
    
                        <div class="entry-content">
                            <p>Experience and increase your knowledge in the modernization of our education system!</p>
                        </div><!-- .entry-content -->
    
                        <footer class="entry-footer read-more">
                            <a href="learnmore">Read more<i class="fa fa-long-arrow-right"></i></a>
                        </footer><!-- .entry-footer -->
                    </div><!-- .icon-box -->

                    <div class="icon-box">
                            <div class="icon">
                               
                                <span class="glyphicon glyphicon-user"></span>
                            </div><!-- .icon -->
        
                            <header class="entry-header">
                                <h2 class="entry-title">For Families</h2>
                            </header><!-- .entry-header -->
        
                            <div class="entry-content">
                                <p>Get update, track progress and get in touch with teachers to see activities and grade to help stdents stay on track!</p>
                            </div><!-- .entry-content -->
        
                            <footer class="entry-footer read-more">
                                <a href="learnmore">Read more<i class="fa fa-long-arrow-right"></i></a>
                            </footer><!-- .entry-footer -->
                        </div><!-- .icon-box -->            
                
            </div><!-- .row -->
        </div><!-- .container-fluid -->
    </div><!-- .icon-boxes -->

    

                
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .courses-wrap -->

    

    

   

    

    

    <br> <br> <br>

    

        <div class="footer-bar">
            <div class="container">
                    <footer class="site-footer">
                            <div class="footer-widgets">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <div class="foot-about">
                                                    
                                            <a class="foot-logo" href="/"><img src="/storage/images/logo3.png" width="90" height="90"><br></a>
                    
                                                <p>This Learning Management System is for St. Catherine College of Valenzuela only. </p>
                    
                                                <p class="footer-copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </p>
                                            </div><!-- .foot-about -->
                                        </div><!-- .col -->
                    
                                        <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                                            <div class="foot-contact">
                                                <h2>Contact Us</h2>
                    
                                                <ul>
                                                    <li>Email: st.catherinecollegeof<br>valenzuela@yahoo.com</li>
                                                    <li>Phone: (02) 443 1860</li>
                                                    <li>Address: Sto. Rosario Street, Mapulang Lupa, 1448 Valenzuela City, Metro Manila</li>
                                                </ul>
                                            </div><!-- .foot-contact -->
                                        </div><!-- .col -->
                    
                                        <div class="col-12 col-md-6 col-lg-3 mt-5 mt-lg-0">
                                            <div class="quick-links flex flex-wrap">
                                                <h2 class="w-100">Quick Links</h2>
                    
                                                <ul class="w-50" >
                                                    <li style="position:relative;right:100%;"><a href="about">About </a></li>
                                                    <li style="position:relative;right:100%;"><a href="contact">Contact </a></li>
                                                    <li style="position:relative;right:100%;"><a href="learnmore">Learn More</a></li>
                       <!--login page-->            <li style="position:relative;right:100%;"><a href="/student/login">Login</a></li>
                                                </ul>
                    
                                                
                                            </div><!-- .quick-links -->
                                        </div><!-- .col -->
                    
                                        <div class="col-12 col-md-6 col-lg-3 mt-5 mt-lg-0">
                                            <div class="follow-us">
                                                <h2>Follow Us</h2>
                    
                                                <ul class="follow-us flex flex-wrap align-items-center">
                                                    <li><a href="https://www.facebook.com/sccvofficial"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                </ul>
                                            </div><!-- .quick-links -->
                                        </div><!-- .col -->
                                    </div><!-- .row -->
                                </div><!-- .container -->
                            </div><!-- .footer-widgets -->
            </div><!-- .container -->
        </div><!-- .footer-bar -->
    </footer><!-- .site-footer -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
<script src="{{asset('bower_components/jquery.js')}}"></script>
<script src="{{asset('bower_components/swiper.min.js')}}"></script>
<script src="{{asset('bower_components/masonry.pkgd.min.js')}}"></script>
<script src="{{asset('bower_components/jquery.collapsible.min.js')}}"></script>
<script src="{{asset('bower_components/custom.js')}}"></script>


</body>
</html>
