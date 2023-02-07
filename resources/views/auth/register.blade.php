@extends('layouts.frontend.index')

@section('content')
<!-- content start -->
    <div class="container-fluid p-0 home-content container-top-border">
        <!-- account block start -->
        <div class="container">
            <nav class="navbar clearfix secondary-nav pt-0 pb-0 login-page-seperator">
                <ul class="list mt-0">
                     <li><a href="{{ route('login') }}" >Login</a></li>
                     <li><a href="{{ route('register.getData') }}" class="active">Register</a></li>
                </ul>
            </nav>

            <div class="row">
                <div class="col-lg-12" style="margin-left: 27.5%">
                    <div class="rightRegisterForm">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}" id="registerForm">
                        {{ csrf_field() }}
                        <div class="p-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="required">First name</label>
                                        <input required type="text" class="form-control form-control-sm" placeholder="First name" value="@if(!empty($name)){{ $name }}@else{{ old('first_name') }}@endif" name="first_name"   >
                                        @if ($errors->has('first_name'))
                                        <label class="error" for="first_name">{{ $errors->first('first_name') }}</label>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label class="required">Last name</label>
                                        <input required type="text" class="form-control form-control-sm" placeholder="Last name" value="{{ old('last_name') }}" name="last_name">
                                        @if ($errors->has('last_name'))
                                        <label class="error" for="last_name">{{ $errors->first('last_name') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>What type of user are you?</label>
                                <select class="custom-select" name="role" id="role">
                                    <option value=""></option>
                                    <option value="student">Student</option>
                                    <option value="researcher">Academic</option>
                                    <option value="business">Business</option>
                                    <option value="ngo">Organization</option>
                                    <option value="community">Local Community</option>
                                    <option value="other">Other</option>
                                </select>
                                @if ($errors->has('institution_type'))
                                    <label class="error" for="institution_type">{{ $errors->first('institution_type') }}</label>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="required">Your institution</label>
                                <select class="custom-select" name="institution" id="institution">
                                    <option value=""></option>
                                    @foreach($institutions as $institution)
                                        <option value="{{$institution->id}}">{{$institution->name}}</option>
                                    @endforeach
                                </select>
{{--                                <input required type="text" class="form-control form-control-sm" placeholder="Institution name" value="@if(!empty($institution)){{ $institution }}@else{{ old('institution') }}@endif" name="institution">--}}
                                @if ($errors->has('institution'))
                                    <label class="error" for="institution">{{ $errors->first('institution') }}</label>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="required">Email ID</label>
                                <input required type="text" class="form-control form-control-sm" placeholder="Email ID" value="@if(!empty($name)){{ $email }}@else{{ old('email') }}@endif" name="email">
                                @if ($errors->has('email'))
                                <label class="error" for="email">{{ $errors->first('email') }}</label>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Twitter username</label>
                                <i class="fab fa-twitter"></i>
                                <input type="text" class="form-control form-control-sm" placeholder="Twitter username" value="@if(!empty($twitter)){{ $twitter }}@else{{ old('twitter') }}@endif" name="twitter">
                                @if ($errors->has('twitter'))
                                    <label class="error" for="twitter">{{ $errors->first('twitter') }}</label>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="required">Password</label>
                                <input required type="password" class="form-control form-control-sm" placeholder="Password" name="password" id="password">
                                @if ($errors->has('password'))
                                <label class="error" for="password">{{ $errors->first('password') }}</label>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="required">Confirm password</label>
                                <input required type="password" class="form-control form-control-sm" placeholder="Confirm password" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                <label class="error" for="password_confirmation">{{ $errors->first('password_confirmation') }}</label>
                                @endif
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-lg btn-block login-page-button">Register</button>
                            </div>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- account block end -->
    </div>
    <!-- content end -->
@endsection

@section('javascript')
<script type="text/javascript">
$(document).ready(function()
{
    $("#registerForm").validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email:{
                    required: true,
                    email:true,
                    remote: "{{ url('checkUserEmailExists') }}"
                },
                password:{
                    required: true,
                    minlength: 6
                },
                password_confirmation:{
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                first_name: {
                    required: 'The fname field is required.'
                },
                last_name: {
                    required: 'The lname field is required.'
                },
                email: {
                    required: 'The email field is required.',
                    email: 'The email must be a valid email address.',
                    remote: 'The email has already been taken.'
                },
                password: {
                    required: 'The password field is required.',
                    minlength: 'The password must be at least 6 characters.'
                },
                password_confirmation: {
                    required: 'The password confirmation field is required.',
                    equalTo: 'The password confirmation does not match.'
                }
            }
        });

});
</script>
@endsection