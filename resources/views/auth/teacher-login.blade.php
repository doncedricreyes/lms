<!DOCTYPE html>
<html lang="en">
<head>
       
    <link rel="shortcut icon" type="image/x-icon" href="/storage/images/logo3.ico">
        
    <title>Login | SCCV-LMS</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 
<style>


.navbar-inverse {
  padding: 0 15px;
  height: 85px;
  line-height: 80px;
}



.navbar-text {
    padding: 10x 0;
    margin: 0;
    font-size: 32px;
    font-weight: 500;
    line-height: 0;
    text-align: left !important;
   
}

.navbar-text a {
    color: #fff;
    text-decoration: none;
}

.navbar-text a span {
    color: #19c880;
}

body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

body {
    text-align: center;
}
form {
    display: inline-block;
}

input[type=text], input[type=password] {
  width: 35%;
  padding: 11px 18px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid rgb(15, 1, 1);
  box-sizing: border-box;
}

button {
 
    background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 20%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
  
}

.imgcontainer {
  text-align: center;
  margin: 10px 0 2px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 50%;
  }
}

.userfooter { 
  display:table; 
  margin:0 auto;
}


 </style> 
</head>
<body>



        <nav class="navbar-inverse">
                <div class="container">
                  <div class="navbar-text">
                        <a href="/" class="navbar-left"><img src="/storage/images/logo3.png" height="70" width="70">SCCV-<span>LMS</span></a>
                  </div>
                </div>
              </nav>

              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
             

              
                <div class="imgcontainer">
                  <br>
                  <img src="/storage/images/img_avatar2.png" class="rounded" height="100" width="100">
                </div>
              
                <h4><mark> LOGIN AS TEACHER</mark></h4></p>
                <form method="POST" action="{{ route('teacher.login.submit') }}">
                  @csrf
                <div class="container">
               
                  <input id="username" placeholder="Enter Username" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus><br>


    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              
             
                  <input id="password" placeholder="Enter Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required><br>

              
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                      
                  <button type="submit">Login</button><br>
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        <label class="form-check-label" for="remember">
            {{ __('Remember Me') }}
        </label>
                </div> 
                </form>



                
        
                                    <footer class="userfooter">
                                     
                                       <ul class="nav nav-pills">
        <!--diretso login na button dito--> <li role="presentation"><a href="/teacher/login"> <span class="glyphicon glyphicon-user" aria-hidden="true"></span>Teacher</a></li>
                                            <li role="presentation"><a href="/student/login"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Student</a></li>
                                            <li role="presentation"><a href="/parent/login"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Parent</a></li>
                                          </ul>
                                    
        
                                    </footer><!-- .entry-footer -->
                                






              
                <div class="container" style="background-color:#f1f1f1">
                  <button type="button" class="cancelbtn"><a href="/"></a>Cancel</button>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  
                  <span class="psw"><a href="{{ route('teacher.password.request') }}">Forgot password? </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                  </span> 
                </div>
              </form>



              <div class="footer-bar">
                    <div class="container">
                            <footer class="site-footer">
                                    <div class="footer-widgets">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12 ">
                                                    <div class="foot-about">
                                                            
                                                  
                            
                                                        <p class="footer-copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </p>
                                                    </div><!-- .foot-about -->
                                                </div><!-- .col -->
                            
                                                
                                                </div><!-- .col -->
                                            </div><!-- .row -->
                                        </div><!-- .container -->
                                    </div><!-- .footer-widgets -->
                    </div><!-- .container -->
                </div><!-- .footer-bar -->
            </footer><!-- .site-footer -->





         





</body>
</html>
