<meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- Mobile Metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- Site Metas -->
   <title>Constructed</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- Site Icons -->
   <link rel="shortcut icon" href="images/fevicon.ico.png" type="image/x-icon" />
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <!-- Site CSS -->
   <link rel="stylesheet" href="style.css">
   <!-- Colors CSS -->
   <link rel="stylesheet" href="css/colors.css">
   <!-- ALL VERSION CSS -->
   <link rel="stylesheet" href="css/versions.css">
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- building CSS -->
   <link rel="stylesheet" href="css/building.css">
   </head>
   <body class="building_version" data-spy="scroll" data-target=".header">


<div class="content-wrapper">
            <div class="page-header" align="center">
              <h2 class="page-title"> Connectez-vous ! </h2>
                <form method="POST" action="{{route('loginClient')}}">
                 @csrf

                  <div class="form-group">
                    <label><x-input-label for="email" :value="__('Numéro téléphone')" />
                            <x-text-input  class="form-control p_input" type="number" id="numero" name="numero"  value="0340590099"/>
                            @error('numero')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
              <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Charts</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Chart-js</li>
                </ol>
              </nav> -->
            </div>
              <div class="text-center">
                    <button type="submit" class="btn btn-success">Se Connecter</button>
                  </div>
            </div>
            </div>
  
            <footer id="footer">
         <div id="footer-widgets" class="container style-1">
            <div class="row">
               <div class="col-md-4">
                  <div class="widget widget_text">
                     <h2 class="widget-title"><span>ABOUT US</span></h2>
                     <div class="textwidget">
                        <a class="navbar-brand" href="index-building.html"><img src="images/logo-icon.png" alt="image"><span>Constructed</span></a>
                        <p>Aenean suscipit eget mi act fermentum phasellus vulputate turpis tincidunt. Aenean suscipit eget. Aenean suscipit eget mi act fermentum phasellus vulputate turpis tincidunt. Aenean suscipit ege  Aenean suscipit eget mi act fermentum phasellus.</p>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="widget widget_links">
                     <h2 class="widget-title"><span>COMPANY LINKS</span></h2>
                     <ul class="wprt-links clearfix col2">
                        <li><a data-scroll="" href="#home">Home</a></li>
                        <li><a data-scroll="" href="#about">About Us</a></li>
                        <li><a data-scroll="" href="#services">Services</a></li>
                        <li><a data-scroll="" href="#projects">Our Work</a></li>
                        <li><a data-scroll="" href="#testimonials">Testimonials</a></li>
                        <li><a data-scroll="" href="#price">Price</a></li>
                        <li><a data-scroll="" href="#contact">Contact Us</a></li>
					 </ul>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="widget widget_information">
                     <h2 class="widget-title"><span>CONTACT INFO</span></h2>
                     <ul>
                        <li class="address clearfix">
                           <span class="hl">Address:</span>
                           <span class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                        </li>
                        <li class="phone clearfix">
                           <span class="hl">Phone:</span> 
                           <span class="text">+56 (0) 012 345 6789</span>
                        </li>
                        <li class="email clearfix">
                           <span class="hl">E-mail:</span>
                           <span class="text">business@support.com</span>
                        </li>
                     </ul>
                  </div>
                 
               </div>
            </div>
         </div>
         <div id="bottom" class="clearfix style-1">
            <div class="container">
               <div id="bottom-bar-inner" class="wprt-container">
                  <div class="bottom-bar-inner-wrap">
                     <div class="bottom-bar-content">
                        <div id="copyright">All Rights Reserved. Company Name © 2018</div>
                        <!-- /#copyright -->
                     </div>
                     <!-- /.bottom-bar-content -->
                     <div class="bottom-bar-menu pull-right">
                        <ul class="bottom-nav">
                           <li><a href="#/">HISTORY</a></li>
                           <li><a href="#/">FAQ</a></li>
                           <li><a href="#/">EVENTS</a></li>
                        </ul>
                     </div>
                     <!-- /.bottom-bar-menu -->
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <a href="#home" data-scroll class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>
      <!-- ALL JS FILES -->
      <script src="js/all.js"></script>
      <!-- ALL PLUGINS -->
      <script src="js/custom.js"></script>
      <script src="js/portfolio.js"></script>
      <script src="js/hoverdir.js"></script>   
   </body>
</html>

   

