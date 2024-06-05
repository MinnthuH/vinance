@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-md-12 mb-30">
            <div class="card bl--5-primary">
                <div class="card-body">
                    <p class="fw-bold text--info">@lang('If the logo and favicon are not changed after you update from this page, please clear the cache from your browser. As we keep the filename the same after the update, it may show the old image for the cache. usually, it works after clear the cache but if you still see the old logo or favicon, it may be caused by server level or network level caching. Please clear them too.')</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>@lang('Logo For Dark Background')</label>
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview logoPicPrev bg--dark" style="background-image: url({{ siteLogo() . '?' . time() }})">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>

                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" id="profilePicUpload1" accept=".png, .jpg, .jpeg" name="logo">
                                            <label for="profilePicUpload1" class="bg--primary">@lang('Browse File')</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label>@lang('Logo For Base Background')</label>
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview logoPicPrev " style="background-color:#{{ $general->base_color }};background-image: url({{ getImage(getFilePath('logoIcon') . '/logo_base.png', '?' . time()) }})">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" id="profilePicUpload" accept=".png, .jpg, .jpeg" name="logo_base">
                                            <label for="profilePicUpload" class="bg--primary">@lang('Browse File')</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label>@lang('Favicon')</label>
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview logoPicPrev" style="background-image: url({{ siteFavicon() .'?' . time() }})">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" id="profilePicUpload2" accept=".png" name="favicon">
                                            <label for="profilePicUpload2" class="bg--primary">@lang('Browse File')</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-lg-4">
                                <label>@lang('PWA Thumb')</label>
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview" style="background-image: url({{ getImage(getFilePath('logoIcon') . '/pwa_thumb.png', '?' . time()) }})">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" id="profilePicUpload4" accept=".png, .jpg, .jpeg" name="pwa_thumb">
                                            <label for="profilePicUpload4" class="bg--primary">@lang('Browse File')</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label>@lang('PWA Favicon')</label>
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview" style="background-image: url({{ getImage(getFilePath('logoIcon') . '/pwa_favicon.png', '?' . time()) }})">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" id="profilePicUpload5" accept=".png, .jpg, .jpeg" name="pwa_favicon">
                                            <label for="profilePicUpload5" class="bg--primary">@lang('Browse File')</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
