@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<section class="site-shell space-y-8">
    <div class="panel panel-pad">
        <div class="grid gap-6 lg:grid-cols-[1fr,auto] lg:items-end">
            <div class="space-y-4">
                <span class="eyebrow">Profile and account settings</span>
                <h1 class="page-display">
                    {{ $user->name }}
                    <span class="signal-text">profile</span>
                </h1>
                <p class="lead-copy">
                    Manage your account, update your password, and keep track of the Rick and Morty characters you have saved.
                </p>
            </div>
            <div class="grid gap-3 sm:grid-cols-2">
                <article class="stat-card">
                    <span class="stack-label">Member since</span>
                    <strong class="text-3xl">{{ $user->created_at->format('M Y') }}</strong>
                    <p class="record-subtitle">{{ $user->created_at->format('F d, Y') }}</p>
                </article>
                <article class="stat-card">
                    <span class="stack-label">Saved favorites</span>
                    <strong data-favorites-count>{{ $favorites->count() }}</strong>
                    <p class="record-subtitle">Directly linked to your favorites vault.</p>
                </article>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1.1fr,0.9fr]">
        <div class="panel panel-pad space-y-5">
            <div>
                <span class="stack-label">Identity</span>
                <h2 class="section-title mt-2">Account record</h2>
            </div>
            <div class="info-stack">
                <div class="info-row">
                    <span class="info-label">Name</span>
                    <span class="info-value">{{ $user->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $user->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Member since</span>
                    <span class="info-value">{{ $user->created_at->format('F d, Y') }}</span>
                </div>
            </div>
        </div>

        <div class="panel panel-pad space-y-5">
            <div>
                <span class="stack-label">Security</span>
                <h2 class="section-title mt-2">Password controls</h2>
            </div>
            <p class="record-subtitle">Choose between an email reset link or an in-session password update with current-password verification.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('password.request') }}" class="ghost-button">
                    <x-ui.icon name="mail" class="h-4 w-4" />
                    Reset via email
                </a>
                <button type="button" class="accent-button" data-modal-open="#passwordModal">
                    <x-ui.icon name="key" class="h-4 w-4" />
                    Change password
                </button>
            </div>
        </div>
    </div>

    <div class="panel panel-pad space-y-5">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <span class="stack-label">Saved cast</span>
                <h2 class="section-title mt-2">Favorite snapshot</h2>
            </div>
            <a href="{{ route('favorites.index') }}" class="ghost-button">
                <x-ui.icon name="favorite" class="h-4 w-4" />
                Open vault
            </a>
        </div>

        @if($favorites->isEmpty())
            <p class="record-subtitle">You have not saved any characters yet.</p>
        @else
            <div class="profile-strip">
                @foreach($favorites as $favorite)
                    <figure class="thumb-tile">
                        @if($favorite->image)
                            <img src="{{ $favorite->image }}" alt="{{ $favorite->name }}">
                        @endif
                        <figcaption>{{ $favorite->name }}</figcaption>
                    </figure>
                @endforeach
            </div>
        @endif
    </div>
</section>

<div id="passwordModal" class="hidden fixed inset-0 z-50 bg-black/70 p-4 backdrop-blur-sm">
    <div class="mx-auto mt-10 w-full max-w-xl panel panel-pad">
        <div class="flex items-start justify-between gap-4">
            <div>
                <span class="stack-label">Update credentials</span>
                <h2 class="section-title mt-2 !text-[2rem]">Change password</h2>
            </div>
            <button type="button" class="ghost-button !min-h-[2.6rem] !rounded-full !px-3" data-modal-close="#passwordModal">
                <x-ui.icon name="close" class="h-4 w-4" />
            </button>
        </div>

        @if(session('status'))
            <div class="flash-banner success mt-5">
                <x-ui.icon name="beacon" class="mt-0.5 h-5 w-5 flex-none" />
                <p>{{ session('status') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="flash-banner error mt-5">
                <x-ui.icon name="close" class="mt-0.5 h-5 w-5 flex-none" />
                <div>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <form action="{{ route('profile.password.update') }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <div>
                <label class="mb-2 block text-sm text-[var(--rm-muted)]" for="current_password">Current password</label>
                <input id="current_password" name="current_password" type="password" class="custom-field" required>
            </div>
            <div>
                <label class="mb-2 block text-sm text-[var(--rm-muted)]" for="password">New password</label>
                <input id="password" name="password" type="password" class="custom-field" required>
            </div>
            <div>
                <label class="mb-2 block text-sm text-[var(--rm-muted)]" for="password_confirmation">Confirm new password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="custom-field" required>
            </div>
            <div class="flex flex-wrap gap-3 pt-2">
                <button type="button" class="ghost-button" data-modal-close="#passwordModal">Cancel</button>
                <button type="submit" class="accent-button">Update password</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    @if ($errors->any() || session('status'))
        document.getElementById('passwordModal')?.classList.remove('hidden');
    @endif
});
</script>
@endsection
