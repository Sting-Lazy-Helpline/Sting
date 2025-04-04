<x-app-layout>
    <x-auth-session-status class="mb-4 text-danger" :status="session('error')" />
    <div class="d-flex flex-column flex-column-fluid">
    
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Tab divs-->
                <div class="row g-5 g-xl-10">
                    <div class="col-12">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="profiles_tab" role="tabpanel">
                                <div class="card mb-5 mb-xl-10">
                                    <div class="card-header border-0">
                                        <div class="card-title m-0">
                                            <h3 class="fw-bold m-0">{{ __('Profile Details') }}</h3>
                                        </div>
                                    </div>
                                    <div id="kt_account_settings_profile_details" class="collapse show">
                                        <form id="setting_form" class="form" method="POST" action="{{ route('settings.update',$user->id) }}" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="card-body border-top p-9">
                                                <div class="row mb-6">
                                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">{{ __('Avatar') }}</label>
                                                    <div class="col-lg-8">
                                                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('{{ asset($user->profile_picture) }}')">
                                                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset($user->profile_picture) }}')"></div>
                                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{ __('Change avatar') }}">
                                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                                <input type="hidden" name="avatar_remove" />
                                                            </label>
                                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="{{ __('Cancel avatar') }}">
                                                                <i class="bi bi-x fs-2"></i>
                                                            </span>
                                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="{{ __('Remove avatar') }}">
                                                                <i class="bi bi-x fs-2"></i>
                                                            </span>
                                                        </div>
                                                        <div class="form-text">{{ __('Allowed file types: png, jpg, jpeg.') }}</div>
                                                    </div>
                                                </div>
                                                <div class="row mb-6">
                                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Full Name') }}</label>
                                                    <div class="col-lg-8">
                                                        <div class="row">
                                                            <div class="col-lg-12 fv-row">
                                                                <input type="text" name="name" value="{{ $user->name }}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __('Please enter the Full Name') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-6">
                                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                        <span class="required">{{ __('Phone') }}</span>
                                                        <i class="ki-outline ki-information-5 ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Phone number must be active') }}"></i>
                                                    </label>
                                                    <div class="col-lg-8 fv-row">
                                                        <input type="tel" name="phone_number" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Please enter the Phone Number') }}" value="{{ $user->phone_number }}" />
                                                    </div>
                                                </div>
                                                <div class="row mb-6">
                                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                        <span class="">{{ __('Address') }}</span>
                                                    </label>
                                                    <div class="col-lg-8 fv-row">
                                                        <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Please enter the Address') }}" value="{{ $user->address }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                                <button id="submitbutton1" type="button" onclick="addUpdateData('submitbutton1','setting_form','modal_large','yes')"
                                                    class="btn btn-lg btn-primary">
                                                    <label class="indicator-label">{{ __('Update info') }}</label>
                                                    <label class="indicator-progress">{{ __('Please wait...') }}
                                                        <label class="spinner-border spinner-border-sm align-middle ms-2"></label></label>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card mb-5 mb-xl-10">
                                    <div class="card-header border-0">
                                        <div class="card-title m-0">
                                            <h3 class="fw-bolder m-0">{{ __('Sign-in Method') }}</h3>
                                        </div>
                                    </div>
                                    <div id="kt_account_settings_signin_method" class="collapse show">
                                        <div class="card-body border-top p-9">
                                            <div class="d-flex flex-wrap align-items-center">
                                                <div id="kt_signin_email">
                                                    <div class="fs-6 fw-bolder mb-1">{{ __('Email Address') }}</div>
                                                    <div class="fw-bold text-gray-600">{{ $user->email }}</div>
                                                </div>
                                                <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                                    <form id="setting_form_email_change" class="form" action="{{ route('updateEmail', ['id' => $user->id]) }}" method="POST"  novalidate="novalidate">
                                                        @csrf
                                                        <div class="row mb-6">
                                                            <div class="col-lg-6 mb-4 mb-lg-0">
                                                                <div class="fv-row mb-0">
                                                                    <label for="emailaddress" class="form-label fs-6 fw-bolder mb-3">{{ __('Enter New Email Address') }}</label>
                                                                    <input type="email" class="form-control form-control-lg form-control-solid" id="emailaddress" placeholder="{{ __('Email Address') }}" name="email" value="{{ $user->email }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="fv-row mb-0">
                                                                    <label for="confirmemailpassword" class="form-label fs-6 fw-bolder mb-3">{{ __('Confirm Password') }}</label>
                                                                    <input type="password" class="form-control form-control-lg form-control-solid" name="confirmemailpassword" id="confirmemailpassword" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex">
                                                            <button id="submitbutton2" type="button" onclick="addUpdateData('submitbutton2','setting_form_email_change','modal_large','yes')"
                                                                class="btn btn-lg btn-primary">
                                                                <label class="indicator-label">{{ __('Update info') }}</label>
                                                                <label class="indicator-progress">{{ __('Please wait...') }}
                                                                    <label class="spinner-border spinner-border-sm align-middle ms-2"></label></label>
                                                            </button>
                                                            <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">{{ __('Cancel') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div id="kt_signin_email_button" class="ms-auto">
                                                    <button class="btn btn-light btn-active-light-primary">{{ __('Change Email') }}</button>
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed my-6"></div>
                                            <div class="d-flex flex-wrap align-items-center mb-1">
                                                <div id="kt_signin_password">
                                                    <div class="fs-6 fw-bolder mb-1">{{ __('Password') }}</div>
                                                    <div class="fw-bold text-gray-600">************</div>
                                                </div>
                                                <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                                    <form id="setting_form_update_password" method="Post" class="form" novalidate="novalidate" action="{{ route('updatePassword', ['id' => $user->id]) }}">
                                                        @csrf
                                                        <div class="row mb-1">
                                                            <div class="col-lg-4">
                                                                <div class="fv-row mb-0">
                                                                    <label for="currentpassword" class="form-label fs-6 fw-bolder mb-3">{{ __('Current Password') }}</label>
                                                                    <input type="password" class="form-control form-control-lg form-control-solid" name="old_password" id="currentpassword" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="fv-row mb-0">
                                                                    <label for="newpassword" class="form-label fs-6 fw-bolder mb-3">{{ __('New Password') }}</label>
                                                                    <input type="password" class="form-control form-control-lg form-control-solid" name="password" id="newpassword" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="fv-row mb-0">
                                                                    <label for="confirmpassword" class="form-label fs-6 fw-bolder mb-3">{{ __('Confirm New Password') }}</label>
                                                                    <input type="password" class="form-control form-control-lg form-control-solid" name="password_confirmation" id="confirmpassword" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-text mb-5">{{ __('Password must be at least 8 character and contain symbols') }}</div>
                                                        <div class="d-flex">
                                                            <button id="submitbutton3" type="button" onclick="addUpdateData('submitbutton3','setting_form_update_password','modal_large','yes')"
                                                                class="btn btn-lg btn-primary">
                                                                <label class="indicator-label">{{ __('Update Password') }}</label>
                                                                <label class="indicator-progress">{{ __('Please wait...') }}
                                                                    <label class="spinner-border spinner-border-sm align-middle ms-2"></label></label>
                                                            </button>
                                                            <button id="kt_password_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">{{ __('Cancel') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div id="kt_signin_password_button" class="ms-auto">
                                                    <button class="btn btn-light btn-active-light-primary">{{ __('Reset Password') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Tab divs-->
            </div>
        </div>
        <!--end::Content-->
    </div>
</x-app-layout>
<script src="{{ asset('theme/assets/js/custom/account/settings/signin-methods.js') }}"></script>
