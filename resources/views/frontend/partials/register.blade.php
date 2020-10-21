<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModal">{{ __('Register') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="registerForm">
                    @csrf

                    <div class="form-group row">
                        <label for="nameInput" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="nameInput" type="text" class="form-control" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                            <span class="invalid-feedback" role="alert" id="nameError">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="emailInput" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email_registerInput" type="email" class="form-control" name="email_register" value="{{ old('email') }}"  autocomplete="email">

                            <span class="invalid-feedback" role="alert" id="email_registerError">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="passwordInput" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password_registerInput" type="password" class="form-control" name="password_register"  autocomplete="new-password">

                            <span class="invalid-feedback" role="alert" id="password_registerError">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password_confirmationInput" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            <span class="invalid-feedback" role="alert" id="password_confirmationError">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
