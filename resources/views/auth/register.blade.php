@extends('layouts.app')

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center text-muted">{{ __('新規登録') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row justify-content-center">
                            <div class="col-md-8">
                            <input id="name" type="text" placeholder="アカウントネーム" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row justify-content-center">
                                <div class="col-md-8">
                                    <select type="text" class="form-control @error('age') is-invalid @enderror" name="age" required autocomplete="age" autofocus>
                                        <option disabled selected value="{{ old('age') }}">年代</option>
                                        @foreach (Config::get('age.age_select') as $key => $val)
                                            <option value="{{ $key }}" @if(old('age')== $key) selected @endif>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <div class="col-md-8">
                                    <select type="text" class="form-control @error('occupation') is-invalid @enderror" name="occupation" required autocomplete="occupation" autofocus>
                                        <option disabled selected value="{{ old('occupation') }}">職業</option>
                                        @foreach (Config::get('occupation.job_name') as $key => $val)
                                            <option value="{{ $key }}" @if(old('occupation')== $key) selected @endif>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    @error('occuration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div style="text-transform: none;">※あなたの職種に合ったものを選んで、コスメをオススメできたり探せたりします。</div>
                                </div>
                            </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-md-8">
                                <input id="email" type="email" placeholder="お使いのメールアドレスを登録" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-md-8">
                                <input id="password" type="password" placeholder="パスワード設定" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('passward') }}" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-md-8">
                                <input id="password-confirm" type="password" placeholder="パスワードの確認"class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="detail btn-anime bgleft text-center text-muted">
                                    <a href="{{ __('Register') }}"><span>新規登録</span></a>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{ route('login.twitter') }}"><i class="fab fa-twitter">Twitterでログイン</i></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
