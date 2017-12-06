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

                    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                    Title:
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" name="titleForSlug" id="titleForSlug" class="form-control m-input" placeholder="Enter Title">
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
                                    <input type="text" name="slug" id="slug" class="form-control m-input" placeholder="Enter Slug">
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
                                    <select class="form-control m-select2" id="m_select2_1" name="param">
                                        <option value="AK">
                                            Alaska
                                        </option>
                                        <option value="HI">
                                            Hawaii
                                        </option>
                                        <option value="CA">
                                            California
                                        </option>
                                        <option value="NV">
                                            Nevada
                                        </option>
                                        <option value="OR">
                                            Oregon
                                        </option>
                                        <option value="WA">
                                            Washington
                                        </option>
                                        <option value="AZ">
                                            Arizona
                                        </option>
                                        <option value="CO">
                                            Colorado
                                        </option>
                                        <option value="ID">
                                            Idaho
                                        </option>
                                        <option value="MT">
                                            Montana
                                        </option>
                                        <option value="NE">
                                            Nebraska
                                        </option>
                                        <option value="NM">
                                            New Mexico
                                        </option>
                                        <option value="ND">
                                            North Dakota
                                        </option>
                                        <option value="UT">
                                            Utah
                                        </option>
                                        <option value="WY">
                                            Wyoming
                                        </option>
                                        <option value="AL">
                                            Alabama
                                        </option>
                                        <option value="AR">
                                            Arkansas
                                        </option>
                                        <option value="IL">
                                            Illinois
                                        </option>
                                        <option value="IA">
                                            Iowa
                                        </option>
                                        <option value="KS">
                                            Kansas
                                        </option>
                                        <option value="KY">
                                            Kentucky
                                        </option>
                                        <option value="LA">
                                            Louisiana
                                        </option>
                                        <option value="MN">
                                            Minnesota
                                        </option>
                                        <option value="MS">
                                            Mississippi
                                        </option>
                                        <option value="MO">
                                            Missouri
                                        </option>
                                        <option value="OK">
                                            Oklahoma
                                        </option>
                                        <option value="SD">
                                            South Dakota
                                        </option>
                                        <option value="TX">
                                            Texas
                                        </option>
                                        <option value="TN">
                                            Tennessee
                                        </option>
                                        <option value="WI">
                                            Wisconsin
                                        </option>
                                        <option value="CT">
                                            Connecticut
                                        </option>
                                        <option value="DE">
                                            Delaware
                                        </option>
                                        <option value="FL">
                                            Florida
                                        </option>
                                        <option value="GA">
                                            Georgia
                                        </option>
                                        <option value="IN">
                                            Indiana
                                        </option>
                                        <option value="ME">
                                            Maine
                                        </option>
                                        <option value="MD">
                                            Maryland
                                        </option>
                                        <option value="MA">
                                            Massachusetts
                                        </option>
                                        <option value="MI">
                                            Michigan
                                        </option>
                                        <option value="NH">
                                            New Hampshire
                                        </option>
                                        <option value="NJ">
                                            New Jersey
                                        </option>
                                        <option value="NY">
                                            New York
                                        </option>
                                        <option value="NC">
                                            North Carolina
                                        </option>
                                        <option value="OH">
                                            Ohio
                                        </option>
                                        <option value="PA">
                                            Pennsylvania
                                        </option>
                                        <option value="RI">
                                            Rhode Island
                                        </option>
                                        <option value="SC">
                                            South Carolina
                                        </option>
                                        <option value="VT">
                                            Vermont
                                        </option>
                                        <option value="VA">
                                            Virginia
                                        </option>
                                        <option value="WV">
                                            West Virginia
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="m-form__group m-form__group--last form-group row">
                                <label class="col-lg-2 col-form-label">
                                    Communication:
                                </label>
                                <div class="col-lg-6">
                                    <div class="m-checkbox-list">
                                        <label class="m-checkbox">
                                            <input type="checkbox">
                                            Email
                                            <span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input type="checkbox">
                                            SMS
                                            <span></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input type="checkbox">
                                            Phone
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions--solid">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-6">
                                        <button type="reset" class="btn btn-brand">
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
@endsection

@section('footerScripts')
    <script src="{{ asset('backend/demo/default/custom/components/forms/widgets/select2.js') }}" type="text/javascript"></script>
    <script>
        (function() {
            window.onload = function () {
                var title = $('#titleForSlug'),
                    slug = $('#slug');
                title.on('keyup', function() {
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

