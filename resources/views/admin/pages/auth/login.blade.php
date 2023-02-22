<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Enigma admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Enigma Admin Template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>Login - Dua JIWA</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{asset('admin/dist/css/app.css')}}" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body>
        <div class="container sm:px-10">
            <div class="flex items-center h-screen justify-center">
                <!-- BEGIN: Login Form -->
                <form action="" method="POST">
                    @csrf
                    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                        <div class="my-auto mx-auto bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none" style="width: 21rem">
                            <h2 class="font-bold text-2xl xl:text-3xl text-center xl:text-left">
                                Sign In
                            </h2>
                            <div class="mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                            <div class="mt-8">
                                <input type="text" class="login__input form-control py-3 px-4 block" name="email" placeholder="Email">
                                <input type="password" class="login__input form-control py-3 px-4 block mt-4" name="password" placeholder="Password">
                            </div>
                            @if($errors->has('message'))
                                <div class="pristine-error text-danger mt-2">{{$errors->first('message')}}</div>
                            @endif
                            @if($errors->has('email'))
                                <div class="pristine-error text-danger mt-2">{{$errors->first('email')}}</div>
                            @endif
                            @if($errors->has('password'))
                                <div class="pristine-error text-danger mt-2">{{$errors->first('password')}}</div>
                            @endif
                            <div class="mt-5 xl:mt-8 text-center xl:text-left">
                                <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
                            </div>
                            {{-- <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left"> By signin up, you agree to our <a class="text-primary dark:text-slate-200" href="">Terms and Conditions</a> & <a class="text-primary dark:text-slate-200" href="">Privacy Policy</a> </div> --}}
                        </div>
                    </div>
                </form>
                <!-- END: Login Form -->
            </div>
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="{{asset('admin/dist/js/app.js')}}"></script>
        <!-- END: JS Assets-->
    </body>
</html>
