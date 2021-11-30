<?php $setting = \App\Models\SettingModel::get(); ?>
@include('admin.template.header')
@include('admin.template.topbar')
@include('admin.template.sidebar')
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">{{ $title }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                <div class="col-md-12">
                    <div class="card full-height">
                        <div class="card-body row">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('admin.template.footer')



		

		

		
			