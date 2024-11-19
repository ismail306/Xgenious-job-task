<x-admin.layouts.master>
    <!-- Session Status -->
    <!--login Area start-->
    <section class="loginForm">
        <div class="loginForm__flex">
            <div class="loginForm__left">
                <div class="loginForm__left__inner desktop-center">
                    <div class="loginForm__header">
                        <h2 class="loginForm__header__title">Welcome TO Xgenious</h2>
                        <p class="loginForm__header__para mt-3">Login Or Register with your data .</p>
                    </div>
                    <div class="loginForm__wrapper mt-4">
                        <!-- Form -->
                        <a href="{{route('login')}}" class="cmn_btn w-100 radius-5">Sign In</a>

                        <a href="{{route('register')}}" class="cmn_btn w-100 radius-5 mt-3">Sign Up</a>

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
    

</x-admin.layouts.master>