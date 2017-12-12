<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
      method="{{ (isset( $translations[$localCode] )) ? 'PUT' : 'POST' }}"
      action="{{ (isset( $translations[$localCode] )) ? route('admin.pages.update', ['translation' => $translations[$localCode] ]) : route('admin.pages.translations.store', ['page' => $page]) }}"
>
    {{ csrf_field() }}
    <input type="hidden" value="{{ $localCode }}" name="lang">

    <div class="m-portlet__body">
        <div class="form-group m-form__group row">
            <label class="col-lg-2 col-form-label" for="title">
                Title:
            </label>
            <div class="col-lg-6">
                <input type="text" name="title" id="title"
                       class="form-control m-input {{ $errors->has('title') ? ' is-invalid' : '' }}"
                       placeholder="Enter Title"
                       value="{{ old('title') }}"
                >
                @if ($errors->has('title'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('title') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group m-form__group row{{ $errors->has('body') ? ' has-danger' : '' }}">
            <label class="col-lg-2 col-form-label" for="body">
                Body:
            </label>
            <div class="col-lg-6">
                <textarea name="body" id="body" cols="30" rows="10" class="summernote"></textarea>
                @if ($errors->has('body'))
                    <div class="form-control-feedback">
                        <strong>{{ $errors->first('body') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group m-form__group row">
            <label class="col-lg-2 col-form-label" for="keywords">
                Description:
            </label>
            <div class="col-lg-6">
                <input type="text" name="keywords" id="keywords"
                       class="form-control m-input {{ $errors->has('keywords') ? ' is-invalid' : '' }}"
                       placeholder="Enter Description"
                       value="{{ old('keywords') }}"
                       required
                >
                @if ($errors->has('keywords'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('keywords') }}</strong>
                    </div>
                @endif
                <span class="m-form__help">
                    Slug will be automatically generated, but you can change it
                </span>
            </div>
        </div>

        {{--<div class="form-group m-form__group row">
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
        </div>--}}

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