<x-admin.layouts.master>
    <!--login Area start-->
    <section class="loginForm">
        <div class="loginForm__flex">
            <div class="loginForm__left">
                <div class="loginForm__left__inner desktop-center">
                    <div class="loginForm__header">
                        <h2 class="loginForm__header__title">Forgot Password</h2>
                        <p class="loginForm__header__para mt-3">Login with your data that you entered during registration.</p>
                    </div>
                    <div class="loginForm__wrapper mt-4">
                        <!-- Form -->
                        <form id="passwordResetForm">
                            @csrf
                            <div class="single_input">
                                <label class="label_title">Enter Email</label>
                                <div class="include_icon">
                                    <input class="form--control radius-5" id="email" name="email" type="email" placeholder="Enter email or phone">
                                    <div class="icon"><span class="material-symbols-outlined">email</span></div>
                                </div>
                                <small id="email_error" class="text-danger"></small>
                            </div>
                            <div class="btn_wrapper single_input d-flex gap-2 mt-3">
                                <button type="button" id="submitPasswordReset" class="cmn_btn w-100 radius-5">Submit</button>
                                <a href="{{ route('login') }}" class="cmn_btn outline_btn w-100 radius-5">Cancel</a>
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
            $('#submitPasswordReset').click(function(e) {
                e.preventDefault();
                $('#loader').show();
                // Clear previous error messages
                $('#email_error').text('');

                // Get the email input value
                let email = $('#email').val();

                // Perform AJAX request
                $.ajax({
                    url: "{{ route('password.email') }}", // Laravel's default route for password reset email
                    method: "POST",
                    data: {
                        email: $('#email').val(), // Get email input
                        _token: '{{ csrf_token() }}' // Include CSRF token
                    },

                    success: function(response) {
                        $('#loader').hide();
                        //console.log(response);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#passwordResetForm')[0].reset(); // Reset the form if needed
                        });
                    },
                    error: function(xhr) {
                        // console.log(xhr);
                        $('#loader').hide();
                        if (xhr.status === 422) {
                            // Handle validation errors (Laravel uses 422 for validation errors)
                            let response = xhr.responseJSON; // Extract JSON response
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error!',
                                text: response.message || 'Please provide a valid email address.',
                                confirmButtonText: 'OK'
                            });

                            // Optionally update the error message near the input field
                            if (response.errors && response.errors.email) {
                                $('#email_error').text(response.errors.email[0]);
                            }
                        } else {
                            // General error handling
                            $('#loader').hide();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: xhr.responseJSON?.message || 'Something went wrong. Please try again.',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });

            });
        });
    </script>
    @endpush
</x-admin.layouts.master>