@extends('layouts.app')

@section('content')
    <main class="py-0">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">
	                {{ ucfirst(auth()->user()->role) }} Dashboard
                </h2>
            </div>
            <div class="card-body p-0 m-0">
                <div class="row">
                    <div class="col-sm-2 border-right border-secondary-50 mx-0 px-0">
                        @include('layouts.side-nav')
                    </div>
                    <div class="col-sm-10">
                        <div class="pr-4">
                            @yield('dashboard-content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
