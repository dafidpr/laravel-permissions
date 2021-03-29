@extends('admin.layouts.app')
@section('content')

<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{ $title }}</h3>
                <div class="nk-block-des text-soft">
                    <p>You can make settings for your application on this page.</p>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-preview">
            <div class="card-inner-group">
                <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabGeneral"><em class="icon ni ni-db"></em><span> General</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabImage"><em class="icon ni ni-layout"></em><span> Image</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabConfig"><em class="icon ni ni-layout"></em><span> Config</span></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabGeneral">
                        <div class="card-inner p-4">
                            <div class="nk-block">
                                <div class="nk-block-head" style="margin-top:-15px">
                                    <h5 class="title">General Settings</h5>
                                    <p>The basic settings for your application are here.</p>
                                </div><!-- .nk-block-head -->
                                <div class="nk-data data-list" style="margin-top:-5px">
                                    <div class="data-head">
                                        <h6 class="overline-title">Basics</h6>
                                    </div>
                                    @foreach ($general as $generalSetting )    
                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                            <div class="data-col">
                                                <span class="data-label">{{ $generalSetting->options }}</span>
                                                <span class="data-value">{{ $generalSetting->value }}</span>
                                            </div>
                                            <div class="data-col data-col-end"><a href="/administrator/settings/{{ Hashids::encode($generalSetting->id) }}/edit" class="data-more"><em class="icon ni ni-forward-ios"></em></a></div>
                                        </div><!-- data-item -->
                                    @endforeach
                                </div><!-- data-list -->
                            </div>
                        </div><!-- .card-inner -->
                    </div>
                    <div class="tab-pane" id="tabImage">
                        <div class="card-inner p-4">
                            <div class="nk-block">
                                <div class="nk-block-head" style="margin-top:-15px">
                                    <h5 class="title">Image Settings</h5>
                                    <p>Your app's image settings are here.</p>
                                </div><!-- .nk-block-head -->
                            </div>
                        </div><!-- .card-inner -->
                    </div>
                    <div class="tab-pane" id="tabConfig">
                        <div class="card-inner p-4">
                            <div class="nk-block">
                                <div class="nk-block-head" style="margin-top:-15px">
                                    <h5 class="title">Config Settings</h5>
                                    <p>Your application configuration settings are here.</p>
                                </div><!-- .nk-block-head -->
                            </div>
                        </div><!-- .card-inner -->
                    </div>
                </div>
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
</div>
@endsection