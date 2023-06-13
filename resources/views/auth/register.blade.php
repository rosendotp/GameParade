<x-guest-layout>
    <x-authentication-card>
        <div class="flex items-center justify-center mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="150.000000pt" height="150.000000pt" viewBox="0 0 425.000000 432.000000" preserveAspectRatio="xMidYMid meet">

                <g  transform="translate(0.000000,432.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                <path d="M2339 3131 c-208 -116 -241 -154 -378 -420 -79 -156 -100 -205 -91 -214 18 -18 40 15 95 145 61 140 145 279 205 338 55 53 209 147 256 156 25 4 40 0 64 -18 91 -66 122 -239 66 -372 -45 -107 -249 -416 -275 -416 -4 0 -40 68 -79 150 -46 98 -77 150 -87 150 -8 0 -15 -6 -15 -14 0 -8 44 -104 98 -213 54 -109 115 -241 135 -292 l38 -93 -11 -86 c-19 -152 -19 -152 -44 -152 -48 0 -59 20 -57 108 2 74 0 82 -21 96 -13 8 -49 17 -80 21 -57 7 -57 7 -244 -86 -173 -87 -207 -110 -190 -126 3 -4 59 19 124 49 64 31 140 64 168 73 28 8 60 22 70 30 29 22 34 18 34 -24 0 -24 14 -68 36 -115 34 -71 36 -82 32 -149 -7 -105 -55 -187 -145 -246 -80 -53 -174 -38 -299 46 -108 73 -145 125 -205 288 -33 89 -34 92 -33 255 0 151 3 172 27 245 52 156 139 268 285 363 74 48 93 72 58 72 -17 0 -153 -94 -199 -138 -140 -134 -218 -364 -204 -602 9 -156 76 -336 159 -426 70 -76 208 -152 305 -169 86 -14 192 65 253 189 28 56 34 82 38 150 4 76 2 88 -27 155 -35 78 -38 134 -10 139 9 2 24 -5 34 -14 15 -15 16 -29 11 -85 -7 -79 8 -106 64 -118 29 -6 35 -11 33 -32 -16 -219 -17 -213 5 -256 42 -82 141 -113 224 -70 l47 24 15 -39 c9 -21 21 -38 26 -38 21 0 21 29 1 67 -18 37 -19 43 -5 84 13 36 14 54 4 104 -6 33 -13 67 -14 76 -6 32 13 121 38 174 16 32 26 71 26 97 -1 98 -85 174 -184 165 -27 -2 -54 -11 -60 -18 -13 -16 -56 -42 -61 -37 -2 2 -24 53 -49 112 l-46 109 35 42 c40 49 188 291 235 384 71 142 59 320 -29 414 -30 33 -72 57 -98 57 -10 0 -57 -22 -104 -49z m141 -1181 c0 -5 -4 -10 -9 -10 -6 0 -13 5 -16 10 -3 6 1 10 9 10 9 0 16 -4 16 -10z m121 -13 c-1 -12 -15 -9 -19 4 -3 6 1 10 8 8 6 -3 11 -8 11 -12z m-66 -57 c-3 -5 -10 -10 -16 -10 -5 0 -9 5 -9 10 0 6 7 10 16 10 8 0 12 -4 9 -10z m-161 -132 l-15 -33 5 34 c4 18 6 41 6 50 1 15 1 15 10 -1 7 -11 5 -26 -6 -50z m122 -174 c-4 -9 4 -19 22 -26 l27 -12 -27 -4 c-20 -2 -28 -9 -28 -23 0 -10 -4 -19 -10 -19 -5 0 -10 11 -10 25 0 18 -5 25 -20 25 -11 0 -20 4 -20 8 0 5 10 8 23 8 16 -1 23 5 25 22 2 12 8 20 13 16 6 -3 8 -12 5 -20z"/>
                </g>
                </svg>
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
