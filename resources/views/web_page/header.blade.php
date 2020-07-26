<header id="header" id="home">
	<div class="header-top">
		<div class="container">
			<div class="row justify-content-end">
				<div class="col-lg-8 col-sm-4 col-8 header-top-right no-padding">
					<ul>
						<li>
							Lunes-Viernes: 8am a 2pm
						</li>
						<li>
							Sábado: 11am a 4pm
						</li>
						<li>
							<a href="tel:(81) 6985 2367">(81) 6985 2367</a>							
						</li>	
						<li>
							<a href="#"><i class="fab fa-facebook"></i></a>
						</li>
						<li>
							<a href="#"><i class="fab fa-instagram"></i></a>
						</li>
						<li>
							<a href="#"><i class="fab fa-twitter"></i></a>
						</li>
					</ul>
				</div>
			</div>			  					
		</div>
	</div>			  	
	<div class="container">
		<div class="row align-items-center justify-content-between d-flex">
			<div id="logo">
				<a href="index.html"><img src="img/logo.png" alt="" title="" /></a>
			</div>
			<nav id="nav-menu-container">
				<ul class="nav-menu">
					<li class="menu-active"><a href="#home">Inicio</a></li>
					<li><a href="#coffee">Café</a></li>
					
					<li><a href="#experiencies">Experiencias</a></li>
					<li><a href="#about">Nosotros</a></li>
					<li><a href="#footer">Contacto</a></li>

					
					@if(Auth::check())
					<li><a href="{!! route('home') !!}">
						<img src='{!! Auth::user()->image == "no_photo" ? "../../images/no_photo.jpg" : "../../uploads/users/". Auth::user()->id ."/".Auth::user()->image !!}' class="rounded-circle pull-left"
						alt="User Image" style="width: 20px; height: 20px" />
					<span> &nbsp; {{ Auth::user()->name}}</span></a></li>
					@else
					<li><a href="{!! route('login') !!}"><span><i class="fas fa-address-book"></i> Registrar/Iniciar</span></a></li>
					@endif

					<li class="d-block d-lg-none"><a href="#"><i class="fab fa-facebook"></i></a></li>
					<li class="d-block d-lg-none"><a href="#"><i class="fab fa-instagram"></i></a></li>
					<li class="d-block d-lg-none"><a href="#"><i class="fab fa-twitter"></i></a></li>		
					
					<!--<li><a href="#blog">Blog</a></li>
					<li class="menu-has-children"><a href="">Pages</a>
						<ul>
							<li><a href="generic.html">Generic</a></li>
							<li><a href="elements.html">Elements</a></li>
						</ul>
					</li>-->
				</ul>
			</nav><!-- #nav-menu-container -->		    		
		</div>
	</div>
</header><!-- #header -->