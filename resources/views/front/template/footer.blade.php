<!-- footer Start -->
<?php $setting = \App\Models\SettingModel::get(); ?>
<?php $category = \App\Models\CategoryModel::get() ?>
<?php $populer = \App\Models\ArticleModel::where('is_publish', '1')->orderBy('view', 'desc')->limit(4)->get() ?>
<footer class="footer section gray-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 mr-auto col-sm-6">
				<div class="widget mb-5 mb-lg-0">
					<div class="logo mb-4">
						@if ($setting[0]->logo == '')
							<h3>{{ $setting[0]->name_web }}</h3>
						@else
							<img src="{{ url('assets') }}/image/{{ $setting[0]->logo }}" alt="" class="img-fluid">
						@endif
					</div>
					{{ $setting[0]->description }}

					{{-- sosial media --}}
					{{-- <ul class="list-inline footer-socials mt-4">
						<li class="list-inline-item"><a href="https://www.facebook.com"><i class="icofont-facebook"></i></a></li>
						<li class="list-inline-item"><a href="https://twitter.com"><i class="icofont-twitter"></i></a></li>
						<li class="list-inline-item"><a href="https://www.pinterest.com/"><i class="icofont-linkedin"></i></a></li>
					</ul> --}}

				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="widget mb-5 mb-lg-0">
					<h4 class="text-capitalize mb-3">Category</h4>
					<div class="divider mb-4"></div>

					<ul class="list-unstyled footer-menu lh-35">
						@foreach ($category as $ct)
							<li><a href="{{ url('/category/'.$ct->slug_category) }}">{{ $ct->category }} </a></li>
						@endforeach
					</ul>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="widget mb-5 mb-lg-0">
					<h4 class="text-capitalize mb-3">Populer Post</h4>
					<div class="divider mb-4"></div>

					<ul class="list-unstyled footer-menu lh-35">
						@foreach ($populer as $item)
							<li><a href="{{ url('/blog/'.$item->slug_article) }}">{{ $item->title }} </a></li>
						@endforeach
				</div>
			</div>
		</div>
		
		<div class="footer-btm py-4 mt-5">
			<div class="row align-items-center justify-content-between">
				<div class="col-lg-6">
					<div class="copyright">
						&copy; Made By <span class="text-color"><a href="https://github.com/gumelarid">gumelarid, </a></span>
					</div>
				</div>

				{{-- subscribe --}}
				{{-- <div class="col-lg-6">
					<div class="subscribe-form text-lg-right mt-5 mt-lg-0">
						<form action="#" class="subscribe">
							<input type="text" class="form-control" placeholder="Your Email address">
							<a href="#" class="btn btn-main-2 btn-round-full">Subscribe</a>
						</form>
					</div>
				</div> --}}

			</div>

			<div class="row">
				<div class="col-lg-4">
					<a class="backtop js-scroll-trigger" href="#top">
						<i class="icofont-long-arrow-up"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</footer>
   

    <!-- 
    Essential Scripts
    =====================================-->

    
    <!-- Main jQuery -->
    <script src="{{ url('front') }}/plugins/jquery/jquery.js"></script>
    <!-- Bootstrap 4.3.2 -->
    <script src="{{ url('front') }}/plugins/bootstrap/js/popper.js"></script>
    <script src="{{ url('front') }}/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ url('front') }}/plugins/counterup/jquery.easing.js"></script>  
    
    <script src="{{ url('front') }}/js/script.js"></script>

  </body>
  </html>