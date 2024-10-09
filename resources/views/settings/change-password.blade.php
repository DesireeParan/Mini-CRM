@extends('adminlte::page')

@section('title', __('passwords.title'))

@section('content_header')
    <h1>{{ __('passwords.title') }}</h1>
@stop

@section('content')
    <div class="d-flex justify-content-center align-items-center min-vh-80">
        <div class="col-md-10">
            <div class="card shadow-lg bg-white">
                <div class="row no-gutters">
                    <div class="col-md-6 border-right">
                        <div class="card-body">
                            <h5>Password Requirements</h5>
                            <ul>
                                <br id="length" class="text-danger">&#10003; Minimum of 8 characters
                                <br id="uppercase" class="text-danger">&#10003; At least one capital letter
                                <br id="lowercase" class="text-danger">&#10003; At least one small letter
                                <br id="number" class="text-danger">&#10003; At least one numeric number
                                <br id="special" class="text-danger">&#10003; At least one special character
                            </ul>
                            <h5>Password Tips</h5>
                            <ul>
                                <br>&#10003; Avoid using easily guessable information like your name or birthdate.
                                <br>&#10003; Use a mix of letters, numbers, and special characters.
                                <br>&#10003; Consider using a passphrase made up of multiple words.
                                <br>&#10003; Change your passwords regularly.
                                <br>&#10003; Do not reuse passwords across different sites.
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                       <form method="POST" action="{{ route('password.update') }}" onsubmit="return validatePassword()">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="current_password">{{ __('passwords.current_password') }}</label>
            <input type="password" class="form-control" id="current_password" name="current_password" value="{{ old('current_password') }}" required>
        </div>
        <div class="form-group position-relative">
            <label for="new_password">{{ __('passwords.new_password') }}</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required onfocus="showPasswordRequirements()" onblur="hidePasswordRequirements()" oninput="checkPasswordStrength()">
            <small id="passwordHelp" class="form-text text-muted">Password Strength: <span id="passwordStrength">0%</span></small>
            <div class="progress">
                <div id="passwordStrengthBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div id="passwordRequirements" class="card mt-2 p-2 position-absolute" style="display: none;">
                <ul>
                    <li id="length" class="text-danger">Minimum of 8 characters</li>
                    <li id="uppercase" class="text-danger">At least one capital letter</li>
                    <li id="lowercase" class="text-danger">At least one small letter</li>
                    <li id="number" class="text-danger">At least one numeric number</li>
                    <li id="special" class="text-danger">At least one special character</li>
                </ul>
            </div>
            <small class="form-text text-muted text-right mt-2"><a href="#" onclick="generatePassword()">Generate Password</a></small>
        </div>
        <div class="form-group">
            <label for="confirm_password">{{ __('passwords.confirm_password') }}</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">{{ __('password.update') }}</button>
        </div>
    </div>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showPasswordRequirements() {
            document.getElementById('passwordRequirements').style.display = 'block';
        }

        function hidePasswordRequirements() {
            document.getElementById('passwordRequirements').style.display = 'none';
        }

        function checkPasswordStrength() {
            const password = document.getElementById('new_password').value;
            let strength = 0;

            if (password.length >= 8) {
                strength += 20;
                document.getElementById('length').classList.remove('text-danger');
                document.getElementById('length').classList.add('text-success');
            } else {
                document.getElementById('length').classList.remove('text-success');
                document.getElementById('length').classList.add('text-danger');
            }

            if (/[A-Z]/.test(password)) {
                strength += 20;
                document.getElementById('uppercase').classList.remove('text-danger');
                document.getElementById('uppercase').classList.add('text-success');
            } else {
                document.getElementById('uppercase').classList.remove('text-success');
                document.getElementById('uppercase').classList.add('text-danger');
            }

            if (/[a-z]/.test(password)) {
                strength += 20;
                document.getElementById('lowercase').classList.remove('text-danger');
                document.getElementById('lowercase').classList.add('text-success');
            } else {
                document.getElementById('lowercase').classList.remove('text-success');
                document.getElementById('lowercase').classList.add('text-danger');
            }

            if (/\d/.test(password)) {
                strength += 20;
                document.getElementById('number').classList.remove('text-danger');
                document.getElementById('number').classList.add('text-success');
            } else {
                document.getElementById('number').classList.remove('text-success');
                document.getElementById('number').classList.add('text-danger');
            }

            if (/[\W_]/.test(password)) {
                strength += 20;
                document.getElementById('special').classList.remove('text-danger');
                document.getElementById('special').classList.add('text-success');
            } else {
                document.getElementById('special').classList.remove('text-success');
                document.getElementById('special').classList.add('text-danger');
            }

            document.getElementById('passwordStrength').innerText = strength + '%';
            document.getElementById('passwordStrengthBar').style.width = strength + '%';
            document.getElementById('passwordStrengthBar').setAttribute('aria-valuenow', strength);
        }

        function validatePassword() {
            const password = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                return false;
            }

            if (password.length < 8 || !/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/\d/.test(password) || !/[\W_]/.test(password)) {
                alert('Password does not meet the requirements.');
                return false;
            }

            return true;
        }

        function generatePassword() {
            const length = 12;
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+~`|}{[]:;?><,./-=";
            let password = "";
            for (let i = 0, n = charset.length; i < length; ++i) {
                password += charset.charAt(Math.floor(Math.random() * n));
            }
            document.getElementById('new_password').value = password;
            document.getElementById('new_password').type = 'text'; // Make the password visible
            checkPasswordStrength();
        }
    </script>
@stop
