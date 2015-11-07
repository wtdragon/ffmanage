<html lang="en">
<head>
  <meta charset="utf-8">
  <title>基金销售分红</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="基金销售分红">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="images/js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href={{ URL::asset('images/bootstrap.min.css') }} rel="stylesheet">
	<link href={{ URL::asset('images/css.css') }} rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="images/js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="images/img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="images/img/favicon.png">
  
	<script type="text/javascript" src={{ URL::asset('images/js/jquery.min.js') }}></script>
	<script type="text/javascript" src={{ URL::asset('images/js/bootstrap.min.js') }}></script>
	<script type="text/javascript" src={{ URL::asset('images/js/scripts.js') }}></script>
	 @yield('hdsrc')
</head>

<body>
<div class="container" style="width:100%">
	 <div id="wrap">
 <div id="top">

 <div id="nav">
  <ul>
  		@if(App::make('authenticator')->getLoggedUser())
    
         <li><a href="{{URL::to('user/logout')}}">登出</a></li> 
@else
         <li><a href="{{URL::to('login')}}">登录</a></li>
@endif
  </ul>
 </div>
 </div>
 <div id="main" style="height: auto;">
  <div class="mainleft">
   <ul>
    <li><a href="/intrests">客户分红明细 <span class="en"></span></a></li>
	 <li><a href="/contracts">合同记录 <span class="en"></span></a></li>
	 <li><a href="/products">产品信息 <span class="en"></span></a></li>
    <li><a href="/customers">客户信息 <span class="en"></span></a></li>
    <li><a href="/employees">员工信息<span class="en"></span></a></li>
        <li><a href="/positions">职位信息 <span class="en"></span></a></li>
         <li><a href="/reports">生成明细报表 <span class="en"></span></a></li> 
   </ul>
  </div>
  <div class="mainright">
   <div class="content">
   	@yield('content')
	  </div>
  </div>
 </div>
 
 
		<div id="footer">
			<p> <strong>XXX有限公司</strong></p>
			<p class='center'>版权所有</p>
 
			
		</div>
 
	@yield('bootor')
</div>
</body>
</html>
