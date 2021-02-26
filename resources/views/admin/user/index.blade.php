@extends('admin.layouts.app')
@section('content')

<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{ $title }}</h3>
                <div class="nk-block-des text-soft">
                    <p>You have total {{ $collection->count() }} users.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            @can('create-users')
                                <li><a href="/administrator/users/create" class="btn btn-light bg-white"><em class="icon ni ni-plus"></em><span>Add New User</span></a></li>
                            @endcan
                        </ul>
                    </div>
                </div><!-- .toggle-wrap -->
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner position-relative card-tools-toggle">
                    <div class="card-title-group">
                        <div class="card-tools">
                            <div class="form-inline flex-nowrap gx-3">
                                <div class="form-wrap w-150px">
                                    <select class="form-select form-select-sm" data-search="off" data-placeholder="Bulk Action">
                                        <option value="">Bulk Action</option>
                                        <option value="delete">Delete</option>
                                        <option value="block">Block</option>
                                    </select>
                                </div>
                                <div class="btn-wrap">
                                    <span class="d-none d-md-block"><button class="btn btn-dim btn-outline-light disabled">Apply</button></span>
                                    <span class="d-md-none"><button class="btn btn-dim btn-outline-light btn-icon disabled"><em class="icon ni ni-arrow-right"></em></button></span>
                                </div>
                            </div><!-- .form-inline -->
                        </div><!-- .card-tools -->
                        <div class="card-tools mr-n1">
                            <ul class="btn-toolbar gx-1">
                                <li>
                                    <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                </li><!-- li -->
                                <li class="btn-toolbar-sep"></li><!-- li -->
                                <li>
                                    <div class="toggle-wrap">
                                        <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-menu-right"></em></a>
                                        <div class="toggle-content" data-content="cardTools">
                                            <ul class="btn-toolbar gx-1">
                                                <li class="toggle-close">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-arrow-left"></em></a>
                                                </li><!-- li -->
                       
                                                <li>
                                                    <div class="dropdown">
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="dropdown">
                                                            <em class="icon ni ni-setting"></em>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                                            <ul class="link-check">
                                                                <li><span>Show</span></li>
                                                                <li class="active"><a href="#">10</a></li>
                                                                <li><a href="#">20</a></li>
                                                                <li><a href="#">50</a></li>
                                                            </ul>
                                                            <ul class="link-check">
                                                                <li><span>Order</span></li>
                                                                <li class="active"><a href="#">DESC</a></li>
                                                                <li><a href="#">ASC</a></li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .dropdown -->
                                                </li><!-- li -->
                                            </ul><!-- .btn-toolbar -->
                                        </div><!-- .toggle-content -->
                                    </div><!-- .toggle-wrap -->
                                </li><!-- li -->
                            </ul><!-- .btn-toolbar -->
                        </div><!-- .card-tools -->
                    </div><!-- .card-title-group -->
                    <div class="card-search search-wrap" data-search="search">
                        <div class="card-body">
                            <div class="search-content">
                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or email">
                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                            </div>
                        </div>
                    </div><!-- .card-search -->
                </div><!-- .card-inner -->
                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-ulist">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="uid">
                                    <label class="custom-control-label" for="uid"></label>
                                </div>
                            </div>
                            <div class="nk-tb-col"><span class="sub-text">Full Name</span></div>
                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Email</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Phone</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Role</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Last Login</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                            <div class="nk-tb-col nk-tb-col-tools text-right"></div>
                        </div><!-- .nk-tb-item -->
                        @foreach ($collection as $item)
                            
                        <div class="nk-tb-item">
                            <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input uid" id="uid{{ $loop->iteration  }}">
                                    <label class="custom-control-label" for="uid{{ $loop->iteration  }}"></label>
                                </div>
                            </div>
                            <div class="nk-tb-col">
                                <a href="#">
                                    <div class="user-card">
                                        <div class="user-avatar bg-primary">
                                           <img src="{{ asset('admin/uploads/img/profile').'/'.$item->picture }}" alt="">
                                        </div>
                                        <div class="user-info">
                                            <span class="tb-lead">{{ $item->name }}</span>
                                            <span>{{ $item->username }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="nk-tb-col tb-col-mb">
                                <span>{{ $item->email }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span>{{ $item->phone_number }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span><em class="icon ni ni-shield-star"></em> {{ $item->roles[0]['name'] }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span>{{ $item->last_login }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                @if ($item->block == 'N')
                                    <span class="tb-status text-success">Active</span>
                                    @else
                                    <span class="tb-status text-danger">Block</span>
                                @endif
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="/administrator/users/{{ Hashids::encode($item->id) }}/edit"><em class="icon ni ni-edit"></em><span>Edit User</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete User</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>User Detail</span></a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#"><em class="icon ni ni-na"></em><span>Block User</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-tb-item -->
                        @endforeach
                    </div><!-- .nk-tb-list -->
                </div><!-- .card-inner -->
                <div class="card-inner">
                    <div class="nk-block-between-md g-3">
                        <div class="g">
                            <ul class="pagination justify-content-center justify-content-md-start">
                                <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul><!-- .pagination -->
                        </div>
                        <div class="g">
                            <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                <div>Page</div>
                                <div>
                                    <select class="form-select form-select-sm" data-search="on" data-dropdown="xs center">
                                        <option value="page-1">1</option>
                                    </select>
                                </div>
                                <div>OF 1</div>
                            </div>
                        </div><!-- .pagination-goto -->
                    </div><!-- .nk-block-between -->
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
</div>

@endsection