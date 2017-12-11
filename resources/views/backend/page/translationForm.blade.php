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
            <div class="col-lg-6">
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
            <div class="col-lg-6">
                <input type="text" name="slug" id="slug"
                       class="form-control m-input {{ $errors->has('slug') ? ' is-invalid' : '' }}"
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