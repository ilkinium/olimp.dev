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

                    @if( $page->exists )
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
                                    <label class="col-lg-2 col-form-label" for="titleForSlug">
                                        Title:
                                    </label>
                                    <div class="col-lg-10">
                                        <input type="text" name="titleForSlug" id="titleForSlug"
                                               class="form-control m-input {{ $errors->has('slug') ? ' is-invalid' : '' }}"
                                               placeholder="Enter Title"
                                        >
                                        @if ($errors->has('slug'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('slug') }}</strong>
                                            </div>
                                        @endif
                                        <span class="m-form__help">
                                            Please enter title in english to generate slug
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label" for="slug">
                                        Slug:
                                    </label>
                                    <div class="col-lg-10">
                                        <input type="text" name="slug" id="slug" class="form-control m-input {{ $errors->has('slug') ? ' is-invalid' : '' }}"
                                               placeholder="Enter Slug"
                                               value="{{ old('slug') }}"
                                               required
                                        >
                                        @if ($errors->has('slug'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('slug') }}</strong>
                                            </div>
                                        @endif
                                        <span class="m-form__help">
                                            Slug will be automatically generated, but you can change it
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Template:
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control m-select2{{ $errors->has('slug') ? ' is-invalid' : '' }}" id="m_select2_1" name="template"
                                                data-placeholder="Select Template" required>
                                            <option></option>
                                            @foreach($templates as $template)
                                                <option value="{{ $template['value'] }}" {{ ( old('template') == $template['value'] ) ? 'selected' : ''}}>
                                                    {{ $template['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('template'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('template') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Icon:
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="icon" id="icon" class="form-control m-input"
                                               placeholder="Enter icon"
                                               value="{{ old('icon') }}"
                                        >
                                        <span class="m-form__help">
                                            Slug will be automatically generated, but you can change it
                                        </span>
                                    </div>
                                    <div class="col-lg-2">
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
                    @if( $page->exists )
                        @foreach(LaravelLocalization::getSupportedLocales() as $localCode => $properties)
                            <div class="tab-pane" id="m_tabs_{{ $localCode }}" role="tabpanel">
                                @include('backend.page.translationForm')
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
                        @include('backend.partials.iconsList')
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

    <script src="{{ asset('backend/demo/default/custom/components/forms/widgets/summernote.js') }}" type="text/javascript"></script>
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