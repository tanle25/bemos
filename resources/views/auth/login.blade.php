@extends('layouts.app')

@section('content')
<body>
    <div class="full-screen-container">
      <div class="login-container">
        <h3 class="login-title">Welcome</h3>
        <form action="{{ route('login') }}" method="POST">
            @csrf
          <div class="input-group">
            @if($errors->has('username'))
              <div class="text-danger">{{ $errors->first('username') }}</div>
              @else
              <label>{{ __('login.username') }}</label>
              @endif
            <input type="username" name="username" />
          </div>
          <div class="input-group">
              @if($errors->has('password'))
              <div class="text-danger">{{ $errors->first('password') }}</div>
              @else
              <label>{{ __('login.password') }}</label>
              @endif
            
            <input type="password" name="password" />
          </div>

          {{-- {{ var_dump($errors) }} --}}
          @error('loginfail')
          <div class="text-danger">{{ $message }}</div>
          @enderror
          
          <div class="form-group form-row">
            <div class="form-check col-md-6">
              <input class="form-check-input" type="checkbox" id="gridCheck">
              <label class="form-check-label" for="gridCheck">
                {{ __('login.remember') }}
              </label>
            </div>
            <div class="form-group col-md-6">
                <a href="#" class="d-flex justify-content-end" for="inputZip">{{ __('login.forgot') }}</a>
              </div>
          </div>
          <button type="submit" class="login-button">{{ __('login.login') }}</button>
          
        </form>
        <div class="d-flex justify-content-center text-light mt-3 mb-3"><a href="{{ route('register') }}">{{ __('login.register') }}</a> &nbsp;&nbsp;{{ __('login.login with socical') }}</div>
        <div class="d-flex justify-content-center">    
        <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-google"></a>
        </div>
      </div>
    </div>
  </body>
@endsection
