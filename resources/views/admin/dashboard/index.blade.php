@extends('admin.layouts.app')
@section('content')
<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{ $title }}</h3>
                <div class="nk-block-des text-soft">
                    <p>Welcome to Analytics Dashboard.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span class="d-none d-md-inline">Last</span> 30 Days</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>Last 30 Days</span></a></li>
                                            <li><a href="#"><span>Last 6 Months</span></a></li>
                                            <li><a href="#"><span>Last 1 Years</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
                        </ul>
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-lg-7">
                <div class="card card-bordered h-100">
                    <div class="card-inner">
                        <div class="card-title-group pb-3 g-2">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Audience Overview</h6>
                                <p>How have your users, sessions, bounce rate metrics trended.</p>
                            </div>
                            <div class="card-tools shrink-0 d-none d-sm-block">
                                <ul class="nav nav-switch-s2 nav-tabs bg-white">
                                    <li class="nav-item"><a href="#" class="nav-link">7 D</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link active">1 M</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">3 M</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="analytic-ov">
                            <div class="analytic-data-group analytic-ov-group g-3">
                                <div class="analytic-data analytic-ov-data">
                                    <div class="title">Users</div>
                                    <div class="amount">2.57K</div>
                                    <div class="change up"><em class="icon ni ni-arrow-long-up"></em>12.37%</div>
                                </div>
                                <div class="analytic-data analytic-ov-data">
                                    <div class="title">Sessions</div>
                                    <div class="amount">3.98K</div>
                                    <div class="change up"><em class="icon ni ni-arrow-long-up"></em>47.74%</div>
                                </div>
                                <div class="analytic-data analytic-ov-data">
                                    <div class="title">Users</div>
                                    <div class="amount">28.49%</div>
                                    <div class="change down"><em class="icon ni ni-arrow-long-down"></em>12.37%</div>
                                </div>
                                <div class="analytic-data analytic-ov-data">
                                    <div class="title">Users</div>
                                    <div class="amount">7m 28s</div>
                                    <div class="change down"><em class="icon ni ni-arrow-long-down"></em>0.35%</div>
                                </div>
                            </div>
                            <div class="analytic-ov-ck">
                                <canvas class="analytics-line-large" id="analyticOvData"></canvas>
                            </div>
                            <div class="chart-label-group ml-5">
                                <div class="chart-label">01 Jan, 2020</div>
                                <div class="chart-label d-none d-sm-block">15 Jan, 2020</div>
                                <div class="chart-label">30 Jan, 2020</div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-6 col-lg-5">
                <div class="card card-bordered h-100">
                    <div class="card-inner">
                        <div class="card-title-group align-start pb-3 g-2">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Active Users</h6>
                                <p>How do your users visited in the time.</p>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help" data-toggle="tooltip" data-placement="left" title="Users of this month"></em>
                            </div>
                        </div>
                        <div class="analytic-au">
                            <div class="analytic-data-group analytic-au-group g-3">
                                <div class="analytic-data analytic-au-data">
                                    <div class="title">Monthly</div>
                                    <div class="amount">9.28K</div>
                                    <div class="change up"><em class="icon ni ni-arrow-long-up"></em>4.63%</div>
                                </div>
                                <div class="analytic-data analytic-au-data">
                                    <div class="title">Weekly</div>
                                    <div class="amount">2.69K</div>
                                    <div class="change down"><em class="icon ni ni-arrow-long-down"></em>1.92%</div>
                                </div>
                                <div class="analytic-data analytic-au-data">
                                    <div class="title">Daily (Avg)</div>
                                    <div class="amount">0.94K</div>
                                    <div class="change up"><em class="icon ni ni-arrow-long-up"></em>3.45%</div>
                                </div>
                            </div>
                            <div class="analytic-au-ck">
                                <canvas class="analytics-au-chart" id="analyticAuData"></canvas>
                            </div>
                            <div class="chart-label-group">
                                <div class="chart-label">01 Jan, 2020</div>
                                <div class="chart-label">30 Jan, 2020</div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .nk-block -->
</div>
@endsection
