<x-admin.layouts.master>
    <!-- Session Status -->
    <!--login Area start-->
    <section class="loginForm">
        <div class="loginForm__flex">
            <div class="loginForm__left">
                <div class="loginForm__left__inner desktop-center">
                    <div class="loginForm__header">
                        <h2 class="loginForm__header__title">Welcome Back</h2>
                        <p class="loginForm__header__para mt-3">Login with your data that you entered during registration.</p>
                    </div>
                    <div class="loginForm__wrapper mt-4">
                        <!-- Form -->
                        <form method="POST" id="loginForm">
                            @csrf
                            <div class="single_input">
                                <label class="label_title">Email</label>
                                <div class="include_icon">
                                    <input class="form--control radius-5" id="email" type="email" name="email" placeholder="Enter your email address">
                                    <div class="icon"><span class="material-symbols-outlined">mail</span></div>
                                </div>
                                <small class="text-danger d-none" id="emailError"></small>
                            </div>
                            <div class="single_input">
                                <label class="label_title">Password</label>
                                <div class="include_icon">
                                    <input class="form--control radius-5" id="password" type="password" name="password" placeholder="Enter your password">
                                    <div class="icon"><span class="material-symbols-outlined">lock</span></div>
                                </div>
                                <small class="text-danger d-none" id="passwordError"></small>
                            </div>
                            <div class="loginForm__wrapper__remember single_input">
                                <div class="dashboard_checkBox">
                                    <input class="dashboard_checkBox__input" id="remember" type="checkbox">
                                    <label class="dashboard_checkBox__label" for="remember">Remember me</label>
                                </div>
                                <!-- forgetPassword -->
                                <div class="forgotPassword">
                                    <a href="{{route('password.request')}}" class="forgotPass">Forgot passwords?</a>
                                </div>
                            </div>
                            <div class="btn_wrapper single_input">
                                <button type="button" id="loginBtn" class="cmn_btn w-100 radius-5">Sign In</button>
                            </div>
                            <div class="btn-wrapper mt-4">
                                <p class="loginForm__wrapper__signup"><span>Don’t have an account ? </span> <a href="{{route('register')}}" class="loginForm__wrapper__signup__btn">Sign Up</a></p>
                                <div class="loginForm__wrapper__another d-flex flex-column gap-2 mt-3">
                                    <a href="javascript:void(0)" class="loginForm__wrapper__another__btn radius-5 w-100"><img src="html/assets/img/icon/googleIocn.svg" alt="" class="icon"> Login With Google</a>
                                    <a href="javascript:void(0)" class="loginForm__wrapper__another__btn radius-5 w-100"><img src="html/assets/img/icon/fbIcon.svg" alt="" class="icon">Login With Facebook</a>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
            <div class="loginForm__right loginForm__bg " style="background-image: url(html/assets/img/login.jpg);">
                <div class="loginForm__right__logo">
                    <div class="loginForm__logo">
                        <a href="index.html"><img src="html/assets/img/logo.webp" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login Area end -->

    @push('scripts')
    <script>
        $('#loginBtn').on('click', function() {
            // Clear previous errors
            $('#emailError').addClass('d-none').text('');
            $('#passwordError').addClass('d-none').text('');

            // Gather form data
            $('#loader').show();
            const email = $('#email').val();
            const password = $('#password').val();

            // Send AJAX request
            $.ajax({
                url: "{{ route('login') }}", // Laravel login route
                method: "POST",
                data: {
                    email: email,
                    password: password,
                    _token: "{{ csrf_token() }}" // Add CSRF token for security
                },
                success: function(response) {
                    $('#loader').hide();
                    if (response.success) {
                        // Redirect to the intended page or dashboard
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        if (errors.email) {
                            $('#emailError').removeClass('d-none').text(errors.email[0]);
                        }
                        if (errors.password) {
                            $('#passwordError').removeClass('d-none').text(errors.password[0]);
                        }
                    } else {
                        console.error('An error occurred:', xhr.responseText);
                    }
                    $('#loader').hide();
                }
            });

        });
    </script>
    @endpush
</x-admin.layouts.master>