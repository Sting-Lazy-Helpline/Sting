<form id="form_add" class="form" method="POST" action="{{ route('user.store') }}">
    @csrf
    <div class="py-10 px-7 px-lg-10">
        <label class="fs-6 fw-semibold mb-4">Image</label>
        <div class="fv-row mb-5">
            <style>
                .image-input-placeholder {
                    background-image: url({{ asset('theme/assets/media/svg/avatars/blank.svg') }});
                }

                [data-bs-theme="dark"] .image-input-placeholder {
                    background-image: url({{ asset('theme/assets/media/svg/avatars/blank-dark.svg') }});
                }
            </style>
            <div class="image-input image-input-outline image-input-empty" data-kt-image-input="true" style="background-image: url({{ asset('theme/assets/media/svg/avatars/blank.svg') }})">
                <div class="image-input-wrapper w-125px h-125px" style="background-image: none;"></div>
                <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                    <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                    <input type="hidden" name="avatar_remove" value="1">
                </label>
                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                    <i class="ki-outline ki-cross fs-3"></i>
                </span>
                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                    <i class="ki-outline ki-cross fs-3"></i>
                </span>
            </div>
        </div>
        <div class="fv-row mb-5">
            <label class="fs-6 fw-semibold mb-2">Full name</label>
            <input type="text" class="form-control form-control-solid" placeholder="Enter Full name" name="name" />
        </div>
        <div class="row mb-5 gap-5 gap-md-0">
            <div class="col-md-6">
                <label class="fs-6 fw-semibold mb-2">Email</label>
                <input type="email" class="form-control form-control-solid" placeholder="Enter Email" name="email" />
            </div>
            <div class="col-md-6">
                <label class="fs-6 fw-semibold mb-2">Password</label>
                <input type="password" class="form-control form-control-solid" placeholder="Enter Password" name="password" />
            </div>
        </div>
        <div class="fv-row mb-5">
            <label class="fs-6 fw-semibold mb-2">User role</label>
            <select name="user_role" class="form-select form-select-solid">
                <option>-- Select Role --</option>
                <option value="staff">Staff</option>
                <option value="admin">Admin</option>
            </select>
        </div>
    </div>
    <div class="modal-footer flex-center">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
        <button id="submitbutton" type="button" onclick="addUpdateData('submitbutton','form_add','modal_large_xl','yes')"
            class="btn btn-lg btn-primary">
            <label class="indicator-label">Submit</label>
            <label class="indicator-progress">Please wait...
                <label class="spinner-border spinner-border-sm align-middle ms-2"></label></label>
        </button>
    </div>
</form>
<script>
    KTImageInput.createInstances();
</script>
