
<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
  <meta name="author" content="themefisher.com">
	
	<title>{{ $title }}</title>
  

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ url('front') }}/{{ url('front') }}/images/favicon.ico" />

  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="{{ url('front') }}/plugins/bootstrap/css/bootstrap.min.css">
  <!-- Icon Font Css -->
  <link rel="stylesheet" href="{{ url('front') }}/plugins/icofont/icofont.min.css">
  <!-- Slick Slider  CSS -->
  <link rel="stylesheet" href="{{ url('front') }}/plugins/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="{{ url('front') }}/plugins/slick-carousel/slick/slick-theme.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="{{ url('front') }}/css/style.css">

</head>

<body id="top">
<?php $setting = \App\Models\SettingModel::get(); ?>
<?php $category = \App\Models\CategoryModel::get() ?>
<header>
	<nav class="navbar navbar-expand-lg navigation" id="navbar">
		<div class="container">
		 	 <a class="navbar-brand" href="{{ url('/') }}">
				
				@if ($setting[0]->logo == '')
					<h3>{{ $setting[0]->name_web }}</h3>
				@else
					<img src="{{ url('assets') }}/image/{{ $setting[0]->logo }}" alt="" class="img-fluid">
				@endif
			  </a>

		  	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
			<span class="icofont-navigation-menu"></span>
		  </button>
	  
		  <div class="collapse navbar-collapse" id="navbarmain">
			<ul class="navbar-nav ml-auto">
			  <li class="nav-item active">
				<a class="nav-link" href="{{ url('/') }}">Home</a>
			  </li>

			    <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="department.html" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category <i class="icofont-thin-down"></i></a>
					<ul class="dropdown-menu" aria-labelledby="dropdown02">
						@foreach ($category as $item)
							<li><a class="dropdown-item" href="{{ url('/category/'.$item->slug_category) }}">{{ $item->category }}</a></li>
						@endforeach
					</ul>
			  	</li>

				  <li class="nav-item"><a class="nav-link" href="{{ url('/page/about') }}">About</a></li>
			</ul>
		  </div>
		</div>
	</nav>
</header>


	


{{-- <section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block text-center">
            <span class="text-white">Our blog</span>
            <h1 class="text-capitalize mb-5 text-lg">Blog articles</h1>
  
            <!-- <ul class="list-inline breadcumb-nav">
              <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
              <li class="list-inline-item"><span class="text-white">/</span></li>
              <li class="list-inline-item"><a href="#" class="text-white-50">Our blog</a></li>
            </ul> -->
          </div>
        </div>
      </div>
    </div>
  </section> --}}