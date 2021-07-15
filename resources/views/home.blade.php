@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}

                        <div>
                            <div>Ваши привязки:</div>
                            <div>
                                github:
                                @if (!empty(Auth::user()->github_id))
                                    привязан, айди {{Auth::user()->github_id}}
                                @else
                                    не привязан, <a class="btn btn-github" href="{{ url('/auth/github') }}"><i class="fa fa-github"></i>привязать</a>
                                @endif
                            </div>
                            <div>
                                facebook:
                                @if (!empty(Auth::user()->facebook_id))
                                    привязан, айди {{Auth::user()->facebook_id}}
                                @else
                                    не привязан
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
