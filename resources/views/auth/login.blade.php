<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')"
                placeholder="you@example.com" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" />
            <div style="position:relative">
                <x-text-input id="password" type="password" name="password"
                    placeholder="••••••••" required autocomplete="current-password"
                    style="padding-right:48px" />
                <button type="button" onclick="togglePw()"
                    style="position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#9A9A96;padding:0;display:flex;align-items:center">
                    <svg id="pw-eye" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mt-5">
            <label for="remember_me" class="flex items-center gap-3 cursor-pointer select-none" style="color:#454745;font-size:14px">
                <div style="position:relative;width:20px;height:20px;flex-shrink:0">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="peer"
                        style="width:20px;height:20px;border-radius:6px;border:1.5px solid #D6D6CF;background:#F5F4F0;appearance:none;-webkit-appearance:none;cursor:pointer;transition:all 0.2s">
                    <svg style="position:absolute;inset:0;margin:auto;pointer-events:none;opacity:0;transition:opacity 0.15s" id="check-icon" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M2 6l3 3 5-5" stroke="#1A1A1A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span>{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-7">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   style="font-size:13px;color:#9A9A96;text-decoration:none;font-weight:500"
                   onmouseover="this.style.color='#1A1A1A'" onmouseout="this.style.color='#9A9A96'">
                    {{ __('Forgot password?') }}
                </a>
            @endif
            <x-primary-button>{{ __('Log in') }}</x-primary-button>
        </div>
    </form>

    <script>
    function togglePw() {
        var inp = document.getElementById('password');
        inp.type = inp.type === 'password' ? 'text' : 'password';
    }
    document.getElementById('remember_me').addEventListener('change', function() {
        document.getElementById('check-icon').style.opacity = this.checked ? '1' : '0';
        this.style.background = this.checked ? '#9FE870' : '#F5F4F0';
        this.style.borderColor = this.checked ? '#9FE870' : '#D6D6CF';
    });
    </script>
</x-guest-layout>
