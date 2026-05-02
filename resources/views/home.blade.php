@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="site-shell">
    <div class="panel panel-pad">
        <span class="stack-label">Legacy route alias</span>
        <h1 class="section-title mt-3">Use the dashboard entrypoint.</h1>
        <p class="mt-3 record-subtitle">This view remains only as a safe fallback. The active `/home` route redirects to the dashboard.</p>
        <div class="mt-5">
            <a href="{{ auth()->check() ? route('dashboard') : route('home') }}" class="accent-button">Continue</a>
        </div>
    </div>
</section>
@endsection
