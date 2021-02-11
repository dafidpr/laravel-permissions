@extends('admin.layouts.app')
@section('content')

<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{ $title }}</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li><a href="/administrator/menus" class="btn btn-light bg-white"><em class="icon ni ni-arrow-left"></em><span> Back</span></a></li>
                        </ul>
                    </div>
                </div><!-- .toggle-wrap -->
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner">
                <div class="preview-block">
                    <form action="/administrator/menus/store" method="post" id="formSubmit">
                        <div class="row gy-4">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Title <span class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" autocomplete="off">
                                        <i class="text-danger small d-none" id="titleErr"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Url <span class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <label class="input-group-text" for="inputGroupSelect01">{{ url("") }}</label>
                                            <input type="text" class="form-control" id="url" name="url" placeholder="Ex: /administrator/dashboard" autocomplete="off">
                                          </div>
                                    </div>
                                    <i class="text-danger small d-none" id="urlErr"></i>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-03">Icon</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Ex: icon ni ni-eye" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-03">Position <span class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="number" class="form-control" id="position" name="position" placeholder="Position" autocomplete="off">
                                    </div>
                                    <i class="text-danger small d-none" id="positionErr"></i>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Target <span class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <select class="form-select form-control form-control-lg" name="target">
                                            <option value="none">none</option>
                                            <option value="_blank">_blank</option>
                                        </select>
                                        <i class="text-danger small d-none" id="targetErr"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Menu Type <span class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <select class="form-select form-control form-control-lg" name="type">
                                            <option value="Backend">Back End</option>
                                            <option value="Frontend">Front End</option>
                                        </select>
                                        <i class="text-danger small d-none" id="typeErr"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Menu Groups <span class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <select class="form-select form-control form-control-lg" data-search="on" name="group">
                                            @foreach ($menu_groups as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <i class="text-danger small d-none" id="groupErr"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="preview-hr">
                        <button type="submit" class="btn btn-primary"><em class="icon ni ni-send"></em><span> Save changes </span> </button>
                    </form>
                </div>
            </div>
        </div><!-- .card -->
    </div><!-- .nk-block -->
</div>

@endsection
