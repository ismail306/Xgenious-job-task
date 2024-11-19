<x-admin.layouts.master>
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
                        <form id="registerForm" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="single_input">
                                <label class="label_title">Name</label>
                                <div class="include_icon">
                                    <input class="form--control radius-5" id="name" name="name" type="text" placeholder="Enter your Full Name" value="{{ old('name') }}">
                                    <div class="icon"><span class="material-symbols-outlined">person</span></div>
                                </div>
                                <span id="name_error" class="text-danger"></span>
                            </div>

                            <div class="single_input">
                                <label class="label_title">Email</label>
                                <div class="include_icon">
                                    <input class="form--control radius-5" type="email" id="email" name="email" placeholder="Enter your email address" value="{{ old('email') }}">
                                    <div class="icon"><span class="material-symbols-outlined">mail</span></div>
                                </div>
                                <span id="email_error" class="text-danger"></span>
                            </div>

                            <div class="single_input">
                                <label class="label_title">Password</label>
                                <div class="include_icon">
                                    <input class="form--control radius-5" type="password" id="password" name="password" placeholder="Enter your password">
                                    <div class="icon"><span class="material-symbols-outlined">lock</span></div>
                                </div>
                                <span id="password_error" class="text-danger"></span>
                            </div>

                            <div class="single_input">
                                <label class="label_title">Confirm Password</label>
                                <div class="include_icon">
                                    <input class="form--control radius-5" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
                                    <div class="icon"><span class="material-symbols-outlined">lock</span></div>
                                </div>
                                <span id="password_confirmation_error" class="text-danger"></span>
                            </div>

                            <div class="btn_wrapper single_input">
                                <button type="button" id="registerBtn" class="cmn_btn w-100 radius-5">Sign Up</button>
                            </div>
                            <div class="btn-wrapper mt-4">
                                <p class="loginForm__wrapper__signup"><span>Already have an Account? </span> <a href="{{route('login')}}" class="loginForm__wrapper__signup__btn">Sign In</a></p>
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
        $(document).ready(function() {
            $('#registerBtn').click(function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Get form data
                var formData = new FormData($('#registerForm')[0]);
                $('#loader').show();
                $.ajax({
                    url: "{{ route('register') }}",
                    method: 'POST',
                    data: formData,
                    processData: false, 
                    contentType: false, 
                    success: function(response) {
                        $('#loader').hide();
                        if (response.success) {
                            // Redirect to the intended page or dashboard
                            window.location.href = response.redirect;
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX error
                        //console.log("AJAX Error: " + status + error);
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            $('.text-danger').html('');
                            $.each(xhr.responseJSON.errors, function(field, messages) {
                                $('#' + field + '_error').html(messages[0]); // Show the first error message
                            });
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                        $('#loader').hide();
                    }

                });
            });
        });
    </script>
    @endpush
</x-admin.layouts.master>