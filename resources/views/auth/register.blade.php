@extends('layouts.app')

@section('content')
<body>
    <div class="full-screen-container">
      <div class="login-container">
        <h3 class="login-title">Welcome</h3>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="input-group">
                @if($errors->has('name'))
                  <div class="text-danger">{{ $errors->first('name') }}</div>
                  @else
                  <label>{{ __('login.name') }}</label>
                  @endif
                <input type="text" name="name" />
            </div>
            <div class="input-group">
                @if($errors->has('phone'))
                  <div class="text-danger">{{ $errors->first('phone') }}</div>
                  @else
                  <label>{{ __('login.phone') }}</label>
                  @endif
                <input type="number" name="phone" />
            </div>

          <div class="input-group">
            @if($errors->has('email'))
              <div class="text-danger">{{ $errors->first('email') }}</div>
              @else
              <label>{{ __('login.email') }}</label>
              @endif
            <input type="email" name="email" />
          </div>
          <div class="input-group">
              <label>{{ __('login.password') }}</label>
            <input type="password" name="password" />
          </div>

          <div class="input-group">
            @if($errors->has('password'))
            <div class="text-danger">{{ $errors->first('password') }}</div>
            @else
            <label>{{ __('login.confirm_password') }}</label>
            @endif
          <input type="password" name="password_confirmation" />
        </div>

          {{-- {{ var_dump($errors) }} --}}
          @error('loginfail')
          <div class="text-danger">{{ $message }}</div>
          @enderror
          
 
          <button type="submit" class="login-button">{{ __('login.register') }}</button>
        </form>
      </div>
    </div>
  </body>
@endsection
