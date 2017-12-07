@extends('layouts.backend')

@section('pageTitle', 'Create new page')

@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    {{ ($page->exists()) ? 'Edit Page' : 'Create new Page' }}
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="{{ route('admin.pages.index') }}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Pages
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">
                                {{ $page->exists ? 'Edit - ' . ((isset($page->translation()->first()->title)) ? $page->translation()->first()->title: 'Add translation to page') : 'Create New Page' }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <div class="m-content">
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ $page->exists ? 'Edit - ' . ((isset($page->translation()->first()->title)) ? $page->translation()->first()->title: 'Add translation to page') : 'Create New Page' }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#m_tabs_1_1">
                            <i class="la la-exclamation-triangle"></i>
                            Main Info
                        </a>
                    </li>
                    @if(!$page->exists)
                        @foreach(LaravelLocalization::getSupportedLocales() as $localCode => $properties)
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#m_tabs_{{ $localCode }}">
                                    <i class="la la-cloud-download"></i>
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="m_tabs_1_1" role="tabpanel">

                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                              method="{{ ($page->exists) ? 'PUT' : 'POST' }}"
                              action="{{ ($page->exists) ? route('admin.pages.update', ['page' => $page]) : route('admin.pages.store') }}"
                        >
                            {{ csrf_field() }}
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Title:
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" name="titleForSlug" id="titleForSlug"
                                               class="form-control m-input" placeholder="Enter Title">
                                        <span class="m-form__help">
                                        Please enter title in english to generate slug
                                    </span>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Slug:
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" name="slug" id="slug" class="form-control m-input"
                                               placeholder="Enter Slug"
                                               value="{{ old('slug') }}"
                                               required
                                        >
                                        <span class="m-form__help">
                                        Slug will be automatically generated, but you can change it
                                    </span>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Template:
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control m-select2" id="m_select2_1" name="template"
                                                data-placeholder="Select Template" required>
                                            <option></option>
                                            @foreach($templates as $template)
                                                <option value="{{ $template['value'] }}" {{ ( old('template') == $template['value'] ) ? 'selected' : ''}}>
                                                    {{ $template['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Icon:
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" name="icon" id="icon" class="form-control m-input"
                                               placeholder="Enter icon"
                                               value="{{ old('icon') }}"
                                        >
                                        <span class="m-form__help">
                                            Slug will be automatically generated, but you can change it
                                        </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_modal_icons">
                                            Open Icon List
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-brand">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-secondary">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    @if(!$page->exists)
                        @foreach(LaravelLocalization::getSupportedLocales() as $localCode => $properties)
                            <div class="tab-pane" id="m_tabs_{{ $localCode }}" role="tabpanel">
                                Section {{ $properties['native'] }}
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="m-separator m-separator--dashed"></div>
            </div>
        </div>
    </div>


    <!--begin::Modal-->
    <div class="modal fade" id="m_modal_icons" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Select Icon
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="400">
                        <div class="m-portlet__body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-glass"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-glass
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-music"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-music
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-search
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-envelope-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-envelope-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-heart"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-heart
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-star
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-star-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-user
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-film"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-film
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-th-large"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-th-large
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-th"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-th
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-th-list"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-th-list
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-check
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-remove"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-remove
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-close"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-close
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-times"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-times
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-search-plus"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-search-plus
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-search-minus"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-search-minus
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-power-off"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-power-off
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-signal"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-signal
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-gear"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-gear
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cog"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cog
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-trash-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-trash-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-home"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-home
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-clock-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-road"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-road
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-download"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-download
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrow-circle-o-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrow-circle-o-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrow-circle-o-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrow-circle-o-up
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-inbox"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-inbox
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-play-circle-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-play-circle-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-rotate-right"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-rotate-right
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-repeat"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-repeat
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-refresh"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-refresh
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-list-alt"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-list-alt
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-lock
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-flag"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-flag
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-headphones"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-headphones
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-volume-off"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-volume-off
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-volume-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-volume-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-volume-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-volume-up
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-qrcode"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-qrcode
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-barcode"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-barcode
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-tag"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-tag
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-tags"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-tags
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-book"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-book
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bookmark"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bookmark
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-print"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-print
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-camera"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-camera
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-font"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-font
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bold"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bold
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-italic"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-italic
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-text-height"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-text-height
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-text-width"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-text-width
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-align-left"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-align-left
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-align-center"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-align-center
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-align-right"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-align-right
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-align-justify"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-align-justify
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-list"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-list
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-dedent"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-dedent
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-outdent"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-outdent
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-indent"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-indent
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-video-camera"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-video-camera
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-photo"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-photo
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-image"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-image
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-picture-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-picture-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-pencil
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-map-marker
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-adjust"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-adjust
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-tint"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-tint
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-edit"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-edit
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-pencil-square-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-share-square-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-share-square-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-check-square-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-check-square-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrows"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrows
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-step-backward"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-step-backward
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-fast-backward"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-fast-backward
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-backward"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-backward
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-play"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-play
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-pause"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-pause
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-stop"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-stop
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-forward"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-forward
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-fast-forward"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-fast-forward
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-step-forward"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-step-forward
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-eject"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-eject
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-chevron-left"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-chevron-left
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-chevron-right"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-chevron-right
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-plus-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-plus-circle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-minus-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-minus-circle
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-times-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-times-circle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-check-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-check-circle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-question-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-question-circle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-info-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-info-circle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-crosshairs"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-crosshairs
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-times-circle-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-times-circle-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-check-circle-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-check-circle-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-ban"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-ban
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrow-left"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrow-left
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrow-right"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrow-right
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrow-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrow-up
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrow-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrow-down
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-mail-forward"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-mail-forward
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-share"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-share
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-expand"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-expand
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-compress"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-compress
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-plus
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-minus"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-minus
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-asterisk"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-asterisk
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-exclamation-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-exclamation-circle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-gift"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-gift
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-leaf"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-leaf
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-fire"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-fire
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-eye
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-eye-slash"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-eye-slash
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-warning"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-warning
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-exclamation-triangle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-plane"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-plane
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-calendar
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-random"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-random
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-comment"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-comment
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-magnet"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-magnet
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-chevron-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-chevron-up
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-chevron-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-chevron-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-retweet"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-retweet
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-shopping-cart
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-folder"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-folder
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-folder-open"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-folder-open
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrows-v"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrows-v
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrows-h"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrows-h
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bar-chart-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bar-chart"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bar-chart
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-twitter-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-twitter-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-facebook-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-facebook-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-camera-retro"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-camera-retro
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-key"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-key
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-gears"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-gears
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cogs"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cogs
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-comments"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-comments
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thumbs-o-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thumbs-o-up
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thumbs-o-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thumbs-o-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-star-half"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-star-half
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-heart-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-heart-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sign-out"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sign-out
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-linkedin-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-linkedin-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thumb-tack"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thumb-tack
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-external-link"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-external-link
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sign-in"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sign-in
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-trophy"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-trophy
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-github-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-github-square
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-upload"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-upload
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-lemon-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-lemon-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-phone
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-square-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-square-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bookmark-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bookmark-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-phone-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-phone-square
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-twitter"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-twitter
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-facebook-f"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-facebook-f
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-facebook"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-facebook
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-github"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-github
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-unlock"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-unlock
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-credit-card"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-credit-card
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-feed"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-feed
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-rss"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-rss
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hdd-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hdd-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bullhorn"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bullhorn
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bell"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bell
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-certificate"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-certificate
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hand-o-right"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hand-o-right
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hand-o-left"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hand-o-left
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hand-o-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hand-o-up
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hand-o-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hand-o-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrow-circle-left"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrow-circle-left
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrow-circle-right
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrow-circle-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrow-circle-up
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrow-circle-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrow-circle-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-globe"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-globe
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-wrench"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-wrench
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-tasks"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-tasks
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-filter"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-filter
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-briefcase"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-briefcase
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrows-alt"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrows-alt
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-group"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-group
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-users
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-chain"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-chain
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-link"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-link
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cloud"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cloud
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-flask"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-flask
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cut"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cut
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-scissors"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-scissors
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-copy"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-copy
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-files-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-files-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-paperclip"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-paperclip
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-save"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-save
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-floppy-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-floppy-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-navicon"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-navicon
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-reorder"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-reorder
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bars"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bars
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-list-ul"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-list-ul
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-list-ol"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-list-ol
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-strikethrough"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-strikethrough
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-underline"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-underline
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-table"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-table
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-magic"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-magic
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-truck
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-pinterest"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-pinterest
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-pinterest-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-pinterest-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-google-plus-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-google-plus-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-google-plus"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-google-plus
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-money
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-caret-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-caret-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-caret-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-caret-up
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-caret-left"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-caret-left
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-caret-right"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-caret-right
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-columns"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-columns
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-unsorted"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-unsorted
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sort"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sort
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sort-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sort-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sort-desc"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sort-desc
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sort-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sort-up
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sort-asc"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sort-asc
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-envelope
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-linkedin"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-linkedin
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-rotate-left"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-rotate-left
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-undo"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-undo
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-legal"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-legal
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-gavel"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-gavel
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-dashboard"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-dashboard
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-tachometer"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-tachometer
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-comment-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-comment-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-comments-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-comments-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-flash"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-flash
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bolt"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bolt
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sitemap"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sitemap
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-umbrella"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-umbrella
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-paste"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-paste
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-clipboard"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-clipboard
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-lightbulb-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-lightbulb-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-exchange"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-exchange
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cloud-download"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cloud-download
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cloud-upload"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cloud-upload
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-user-md"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-user-md
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-stethoscope"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-stethoscope
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-suitcase"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-suitcase
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bell-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bell-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-coffee"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-coffee
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cutlery"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cutlery
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-text-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-text-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-building-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-building-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hospital-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hospital-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-ambulance"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-ambulance
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-medkit"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-medkit
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-fighter-jet"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-fighter-jet
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-beer"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-beer
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-h-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-h-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-plus-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-plus-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-angle-double-left"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-angle-double-left
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-angle-double-right"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-angle-double-right
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-angle-double-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-angle-double-up
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-angle-double-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-angle-double-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-angle-left"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-angle-left
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-angle-right"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-angle-right
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-angle-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-angle-up
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-angle-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-desktop"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-desktop
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-laptop"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-laptop
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-tablet"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-tablet
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-mobile-phone"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-mobile-phone
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-mobile"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-mobile
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-circle-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-circle-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-quote-left"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-quote-left
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-quote-right"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-quote-right
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-spinner"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-spinner
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-circle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-mail-reply"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-mail-reply
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-reply"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-reply
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-github-alt"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-github-alt
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-folder-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-folder-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-folder-open-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-folder-open-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-smile-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-smile-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-frown-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-frown-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-meh-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-meh-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-gamepad"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-gamepad
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-keyboard-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-keyboard-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-flag-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-flag-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-flag-checkered"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-flag-checkered
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-terminal"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-terminal
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-code"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-code
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-mail-reply-all"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-mail-reply-all
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-reply-all"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-reply-all
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-star-half-empty"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-star-half-empty
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-star-half-full"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-star-half-full
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-star-half-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-star-half-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-location-arrow"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-location-arrow
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-crop"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-crop
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-code-fork"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-code-fork
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-unlink"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-unlink
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-chain-broken"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-chain-broken
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-question"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-question
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-info"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-info
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-exclamation"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-exclamation
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-superscript"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-superscript
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-subscript"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-subscript
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-eraser"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-eraser
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-puzzle-piece"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-puzzle-piece
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-microphone"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-microphone
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-microphone-slash"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-microphone-slash
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-shield"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-shield
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-calendar-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-calendar-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-fire-extinguisher"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-fire-extinguisher
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-rocket"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-rocket
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-maxcdn"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-maxcdn
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-chevron-circle-left"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-chevron-circle-left
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-chevron-circle-right"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-chevron-circle-right
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-chevron-circle-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-chevron-circle-up
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-chevron-circle-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-chevron-circle-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-html5"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-html5
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-css3"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-css3
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-anchor"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-anchor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-unlock-alt"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-unlock-alt
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bullseye"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bullseye
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-ellipsis-h
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-ellipsis-v
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-rss-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-rss-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-play-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-play-circle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-ticket"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-ticket
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-minus-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-minus-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-minus-square-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-minus-square-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-level-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-level-up
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-level-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-level-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-check-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-check-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-pencil-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-pencil-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-external-link-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-external-link-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-share-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-share-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-compass"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-compass
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-toggle-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-toggle-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-caret-square-o-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-caret-square-o-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-toggle-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-toggle-up
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-caret-square-o-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-caret-square-o-up
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-toggle-right"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-toggle-right
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-caret-square-o-right"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-caret-square-o-right
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-euro"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-euro
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-eur"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-eur
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-gbp"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-gbp
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-dollar"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-dollar
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-usd"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-usd
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-rupee"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-rupee
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-inr"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-inr
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cny"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cny
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-rmb"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-rmb
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-yen"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-yen
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-jpy"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-jpy
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-ruble"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-ruble
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-rouble"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-rouble
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-rub"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-rub
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-won"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-won
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-krw"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-krw
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bitcoin"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bitcoin
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-btc"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-btc
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-text
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sort-alpha-asc"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sort-alpha-asc
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sort-alpha-desc"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sort-alpha-desc
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sort-amount-asc"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sort-amount-asc
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sort-amount-desc"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sort-amount-desc
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sort-numeric-asc"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sort-numeric-asc
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sort-numeric-desc"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sort-numeric-desc
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thumbs-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thumbs-up
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thumbs-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thumbs-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-youtube-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-youtube-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-youtube"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-youtube
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-xing"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-xing
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-xing-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-xing-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-youtube-play"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-youtube-play
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-dropbox"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-dropbox
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-stack-overflow"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-stack-overflow
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-instagram"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-instagram
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-flickr"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-flickr
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-adn"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-adn
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bitbucket"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bitbucket
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bitbucket-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bitbucket-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-tumblr"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-tumblr
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-tumblr-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-tumblr-square
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-long-arrow-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-long-arrow-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-long-arrow-up"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-long-arrow-up
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-long-arrow-left"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-long-arrow-left
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-long-arrow-right"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-long-arrow-right
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-apple"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-apple
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-windows"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-windows
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-android"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-android
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-linux"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-linux
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-dribbble"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-dribbble
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-skype"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-skype
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-foursquare"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-foursquare
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-trello"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-trello
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-female"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-female
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-male"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-male
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-gittip"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-gittip
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-gratipay"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-gratipay
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sun-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sun-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-moon-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-moon-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-archive"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-archive
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bug"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bug
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-vk"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-vk
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-weibo"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-weibo
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-renren"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-renren
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-pagelines"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-pagelines
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-stack-exchange"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-stack-exchange
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrow-circle-o-right"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrow-circle-o-right
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-arrow-circle-o-left"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-arrow-circle-o-left
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-toggle-left"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-toggle-left
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-caret-square-o-left"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-caret-square-o-left
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-dot-circle-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-dot-circle-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-wheelchair"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-wheelchair
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-vimeo-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-vimeo-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-turkish-lira"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-turkish-lira
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-try"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-try
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-plus-square-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-plus-square-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-space-shuttle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-space-shuttle
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-slack"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-slack
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-envelope-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-envelope-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-wordpress"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-wordpress
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-openid"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-openid
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-institution"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-institution
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bank"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bank
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-university"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-university
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-mortar-board"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-mortar-board
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-graduation-cap"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-graduation-cap
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-yahoo"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-yahoo
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-google"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-google
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-reddit"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-reddit
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-reddit-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-reddit-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-stumbleupon-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-stumbleupon-circle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-stumbleupon"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-stumbleupon
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-delicious"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-delicious
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-digg"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-digg
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-pied-piper-pp"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-pied-piper-pp
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-pied-piper-alt"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-pied-piper-alt
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-drupal"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-drupal
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-joomla"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-joomla
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-language"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-language
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-fax"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-fax
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-building"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-building
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-child"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-child
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-paw"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-paw
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-spoon"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-spoon
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cube"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cube
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cubes"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cubes
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-behance"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-behance
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-behance-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-behance-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-steam"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-steam
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-steam-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-steam-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-recycle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-recycle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-automobile"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-automobile
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-car"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-car
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cab"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cab
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-taxi"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-taxi
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-tree"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-tree
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-spotify"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-spotify
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-deviantart"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-deviantart
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-soundcloud"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-soundcloud
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-database"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-database
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-pdf-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-word-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-word-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-excel-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-excel-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-powerpoint-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-powerpoint-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-photo-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-photo-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-picture-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-picture-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-image-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-image-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-zip-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-zip-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-archive-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-archive-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-sound-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-sound-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-audio-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-audio-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-movie-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-movie-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-video-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-video-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-code-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-file-code-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-vine"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-vine
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-codepen"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-codepen
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-jsfiddle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-jsfiddle
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-life-bouy"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-life-bouy
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-life-buoy"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-life-buoy
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-life-saver"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-life-saver
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-support"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-support
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-life-ring"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-life-ring
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-circle-o-notch"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-circle-o-notch
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-ra"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-ra
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-resistance"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-resistance
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-rebel"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-rebel
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-ge"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-ge
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-empire"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-empire
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-git-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-git-square
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-git"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-git
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-y-combinator-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-y-combinator-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-yc-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-yc-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hacker-news"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hacker-news
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-tencent-weibo"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-tencent-weibo
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-qq"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-qq
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-wechat"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-wechat
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-weixin"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-weixin
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-send"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-send
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-paper-plane"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-paper-plane
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-send-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-send-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-paper-plane-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-paper-plane-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-history"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-history
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-circle-thin"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-circle-thin
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-header"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-header
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-paragraph"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-paragraph
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sliders"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sliders
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-share-alt"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-share-alt
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-share-alt-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-share-alt-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bomb"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bomb
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-soccer-ball-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-soccer-ball-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-futbol-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-futbol-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-tty"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-tty
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-binoculars"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-binoculars
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-plug"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-plug
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-slideshare"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-slideshare
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-twitch"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-twitch
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-yelp"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-yelp
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-newspaper-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-newspaper-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-wifi"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-wifi
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-calculator"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-calculator
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-paypal"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-paypal
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-google-wallet"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-google-wallet
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cc-visa"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cc-visa
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cc-mastercard"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cc-mastercard
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cc-discover"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cc-discover
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cc-amex"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cc-amex
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cc-paypal"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cc-paypal
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cc-stripe"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cc-stripe
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bell-slash"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bell-slash
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bell-slash-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bell-slash-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-trash"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-trash
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-copyright"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-copyright
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-at"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-at
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-eyedropper"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-eyedropper
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-paint-brush"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-paint-brush
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-birthday-cake"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-birthday-cake
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-area-chart"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-area-chart
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-pie-chart"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-pie-chart
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-line-chart"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-line-chart
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-lastfm"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-lastfm
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-lastfm-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-lastfm-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-toggle-off"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-toggle-off
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-toggle-on"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-toggle-on
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bicycle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bicycle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bus"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bus
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-ioxhost"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-ioxhost
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-angellist"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-angellist
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cc"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cc
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-shekel"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-shekel
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sheqel"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sheqel
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-ils"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-ils
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-meanpath"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-meanpath
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-buysellads"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-buysellads
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-connectdevelop"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-connectdevelop
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-dashcube"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-dashcube
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-forumbee"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-forumbee
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-leanpub"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-leanpub
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sellsy"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sellsy
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-shirtsinbulk"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-shirtsinbulk
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-simplybuilt"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-simplybuilt
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-skyatlas"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-skyatlas
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cart-plus"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cart-plus
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cart-arrow-down"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cart-arrow-down
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-diamond"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-diamond
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-ship"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-ship
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-user-secret"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-user-secret
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-motorcycle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-motorcycle
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-street-view"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-street-view
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-heartbeat"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-heartbeat
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-venus"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-venus
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-mars"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-mars
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-mercury"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-mercury
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-intersex"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-intersex
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-transgender"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-transgender
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-transgender-alt"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-transgender-alt
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-venus-double"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-venus-double
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-mars-double"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-mars-double
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-venus-mars"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-venus-mars
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-mars-stroke"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-mars-stroke
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-mars-stroke-v"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-mars-stroke-v
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-mars-stroke-h"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-mars-stroke-h
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-neuter"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-neuter
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-genderless"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-genderless
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-facebook-official"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-facebook-official
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-pinterest-p"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-pinterest-p
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-whatsapp"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-whatsapp
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-server"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-server
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-user-plus"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-user-plus
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-user-times"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-user-times
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hotel"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hotel
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bed"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bed
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-viacoin"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-viacoin
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-train"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-train
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-subway"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-subway
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-medium"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-medium
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-yc"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-yc
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-y-combinator"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-y-combinator
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-optin-monster"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-optin-monster
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-opencart"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-opencart
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-expeditedssl"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-expeditedssl
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-battery-4"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-battery-4
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-battery"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-battery
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-battery-full"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-battery-full
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-battery-3"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-battery-3
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-battery-three-quarters"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-battery-three-quarters
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-battery-2"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-battery-2
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-battery-half"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-battery-half
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-battery-1"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-battery-1
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-battery-quarter"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-battery-quarter
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-battery-0"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-battery-0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-battery-empty"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-battery-empty
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-mouse-pointer"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-mouse-pointer
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-i-cursor"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-i-cursor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-object-group"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-object-group
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-object-ungroup"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-object-ungroup
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sticky-note"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sticky-note
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sticky-note-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sticky-note-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cc-jcb"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cc-jcb
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-cc-diners-club"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-cc-diners-club
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-clone"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-clone
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-balance-scale"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-balance-scale
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hourglass-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hourglass-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hourglass-1"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hourglass-1
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hourglass-start"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hourglass-start
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hourglass-2"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hourglass-2
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hourglass-half"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hourglass-half
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hourglass-3"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hourglass-3
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hourglass-end"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hourglass-end
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hourglass"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hourglass
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hand-grab-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hand-grab-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hand-rock-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hand-rock-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hand-stop-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hand-stop-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hand-paper-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hand-paper-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hand-scissors-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hand-scissors-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hand-lizard-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hand-lizard-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hand-spock-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hand-spock-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hand-pointer-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hand-pointer-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hand-peace-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hand-peace-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-trademark"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-trademark
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-registered"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-registered
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-creative-commons"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-creative-commons
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-gg"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-gg
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-gg-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-gg-circle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-tripadvisor"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-tripadvisor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-odnoklassniki"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-odnoklassniki
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-odnoklassniki-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-odnoklassniki-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-get-pocket"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-get-pocket
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-wikipedia-w"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-wikipedia-w
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-safari"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-safari
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-chrome"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-chrome
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-firefox"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-firefox
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-opera"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-opera
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-internet-explorer"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-internet-explorer
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-tv"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-tv
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-television"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-television
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-contao"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-contao
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-500px"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-500px
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-amazon"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-amazon
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-calendar-plus-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-calendar-plus-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-calendar-minus-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-calendar-minus-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-calendar-times-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-calendar-times-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-calendar-check-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-calendar-check-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-industry"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-industry
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-map-pin"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-map-pin
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-map-signs"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-map-signs
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-map-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-map-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-map"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-map
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-commenting"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-commenting
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-commenting-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-commenting-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-houzz"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-houzz
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-vimeo"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-vimeo
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-black-tie"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-black-tie
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-fonticons"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-fonticons
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-reddit-alien"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-reddit-alien
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-edge"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-edge
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-credit-card-alt"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-credit-card-alt
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-codiepie"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-codiepie
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-modx"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-modx
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-fort-awesome"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-fort-awesome
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-usb"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-usb
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-product-hunt"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-product-hunt
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-mixcloud"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-mixcloud
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-scribd"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-scribd
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-pause-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-pause-circle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-pause-circle-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-pause-circle-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-stop-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-stop-circle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-stop-circle-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-stop-circle-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-shopping-bag"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-shopping-bag
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-shopping-basket"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-shopping-basket
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hashtag"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hashtag
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bluetooth"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bluetooth
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bluetooth-b"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bluetooth-b
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-percent"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-percent
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-gitlab"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-gitlab
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-wpbeginner"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-wpbeginner
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-wpforms"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-wpforms
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-envira"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-envira
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-universal-access"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-universal-access
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-wheelchair-alt"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-wheelchair-alt
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-question-circle-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-question-circle-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-blind"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-blind
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-audio-description"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-audio-description
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-volume-control-phone"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-volume-control-phone
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-braille"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-braille
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-assistive-listening-systems"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-assistive-listening-systems
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-asl-interpreting"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-asl-interpreting
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-american-sign-language-interpreting"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-american-sign-language-interpreting
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-deafness"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-deafness
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-hard-of-hearing"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-hard-of-hearing
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-deaf"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-deaf
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-glide"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-glide
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-glide-g"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-glide-g
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-signing"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-signing
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-sign-language"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-sign-language
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-low-vision"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-low-vision
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-viadeo"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-viadeo
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-viadeo-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-viadeo-square
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-snapchat"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-snapchat
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-snapchat-ghost"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-snapchat-ghost
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-snapchat-square"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-snapchat-square
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-pied-piper"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-pied-piper
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-first-order"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-first-order
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-yoast"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-yoast
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-themeisle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-themeisle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-google-plus-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-google-plus-circle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-google-plus-official"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-google-plus-official
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-fa"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-fa
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-font-awesome"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-font-awesome
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-handshake-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-handshake-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-envelope-open"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-envelope-open
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-envelope-open-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-envelope-open-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-linode"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-linode
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-address-book"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-address-book
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-address-book-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-address-book-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-vcard"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-vcard
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-address-card"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-address-card
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-vcard-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-vcard-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-address-card-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-address-card-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-user-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-user-circle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-user-circle-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-user-circle-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-user-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-user-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-id-badge"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-id-badge
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-drivers-license"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-drivers-license
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-id-card"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-id-card
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-drivers-license-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-drivers-license-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-id-card-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-id-card-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-quora"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-quora
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-free-code-camp"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-free-code-camp
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-telegram"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-telegram
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thermometer-4"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thermometer-4
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thermometer"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thermometer
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thermometer-full"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thermometer-full
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thermometer-3"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thermometer-3
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thermometer-three-quarters"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thermometer-three-quarters
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thermometer-2"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thermometer-2
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thermometer-half"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thermometer-half
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thermometer-1"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thermometer-1
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thermometer-quarter"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thermometer-quarter
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thermometer-0"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thermometer-0
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-thermometer-empty"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-thermometer-empty
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-shower"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-shower
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bathtub"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bathtub
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-s15"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-s15
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bath"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bath
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-podcast"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-podcast
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-window-maximize"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-window-maximize
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-window-minimize"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-window-minimize
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-window-restore"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-window-restore
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-times-rectangle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-times-rectangle
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-window-close"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-window-close
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-times-rectangle-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-times-rectangle-o
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-window-close-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-window-close-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-bandcamp"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-bandcamp
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-grav"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-grav
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-etsy"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-etsy
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-imdb"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-imdb
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-ravelry"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-ravelry
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-eercast"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-eercast
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-microchip"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-microchip
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-snowflake-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-snowflake-o
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-superpowers"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-superpowers
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-wpexplorer"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-wpexplorer
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-meetup"></i>
                                        </div>
                                        <div class="m-demo-icon__class">
                                            fa-meetup
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
{{--                    <button type="button" class="btn btn-primary">
                        Save changes
                    </button>--}}
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->

@endsection

@section('footerScripts')
    <script src="{{ asset('backend/demo/default/custom/components/forms/widgets/select2.js') }}"
            type="text/javascript"></script>
    <script>
        (function () {
            window.onload = function () {
                var title = $('#titleForSlug'),
                    slug = $('#slug');
                title.on('keyup', function () {
                    var val = $(this).val();
                    val = val.toString().toLowerCase()
                        .substr(0, 50)
                        .replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                        .replace(/\s+/g, '-') // collapse whitespace and replace by -
                        .replace(/-+/g, '-');       // remove leading, trailing -
                    slug.val(val);
                });
            };
        }());
    </script>
@endsection

