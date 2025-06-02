<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="{{asset('public/backEnd/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/backEnd/assets/css/style.css')}}" rel="stylesheet">
  <style id="hb-stylesheet"></style></head>
  <body>
    <div class="auth-container" id="particles-js">
        <div class="login-form">
            <h4>LOGIN</h4>
            <p>Sign in to your account</p>
            <form method="POST" action="{{route('auth.login')}}" >
                @csrf
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Email</label>
                    <input type="email" id="emailaddress" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required   placeholder="Enter Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-3">

                    <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required  placeholder="Enter Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="text-center d-grid">
                    <button class="submit-btn" type="submit"> Login </button>
                </div>
            </form>
          </div>
   </div>
    <script src="{{asset('public/backEnd/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/backEnd/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/backEnd/assets/js/particles.min.js')}}"></script>
    <script src="{{asset('public/backEnd/assets/js/parsley.min.js')}}"></script>
    <script src="{{asset('public/backEnd/assets/js/particles-active.js')}}"></script>
    <script type="text/javascript">
    $(function () {
      $('form').parsley();
    });
    </script>
  
</body>
</html>