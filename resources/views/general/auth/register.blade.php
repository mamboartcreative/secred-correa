<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login - Secret Correa</title>
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1>Secret Correa</h1>
    </div>
    <div class="login-box" style="height: 520px;">
        <form class="login-form" method="post" action="{{ route('register') }}">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>REGISTRATION</h3>
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Full Name" value="{{ old('name') }}" name="name" id="name" required autofocus>
            </div>
            <div class="form-group">
                <input class="form-control" type="email" placeholder="Email" value="{{ old('email') }}" name="email" id="email" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" placeholder="Password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" placeholder="Password again" name="password_confirmation" id="password-confirm" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="tel" placeholder="Referral HP, leave empty if non" name="references" value="{{ old('references') }}">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Verification Code" value="{{ old('code') }}" name="code" id="code" required>
            </div>
            <div class="form-group">
                <select required name="role" id="role">
                    <option value="">Please Choose</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }} / Month RM {{ number_format($role->min_purchase,2) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-address-book fa-lg fa-fw"></i>REGISTER</button>
            </div>
        </form>
    </div>
</section>
<!-- Essential javascripts for application to work-->
<script src="{{ asset('theme/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('theme/js/popper.min.js') }}"></script>
<script src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('theme/js/main.js') }}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{ asset('theme/js/plugins/pace.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('theme/js/plugins/bootstrap-notify.min.js') }}"></script>
<script type="text/javascript">
    @if (count($errors) > 0)
    @foreach($errors->all() as $error)
        $.notify({
            title: "Errors : ",
            message: "{{ $error }}",
            icon: 'fa fa-times'
        },{
            type: "danger"
        });
    @endforeach
    @endif
</script>
</body>
</html>