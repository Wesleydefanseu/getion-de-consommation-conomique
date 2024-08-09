@php
use App\Models\User;
$user=User::findOrFail(Auth::user()->id);
@endphp
<section>
    <link rel="stylesheet">
    <link rel="stylesheet" href="{{asset('New_Pages/AjoutPhotoVendeur/styles.css')}}">
    <header>
        <h2 class="text-lg font-medium text-gray-900" style="font-size:24px">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600" >
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" enctype="multipart/form-data" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div id="contt" style="width:100px" onclick="openFileInput()">
            <img id="preview" src="{{url('/')}}/photosUsers/{{$user->photo}}" alt="" style="width: 100px; height: 100px; border-radius: 50%; background: white;" :value="old('photo', $user->photo)">
            <input type="file" id="photo" name="photo" style="opacity:0%" accept="image/*" onchange="displaySelectedImage(event)">
            <x-text-input id="oldphoto" name="oldphoto" type="hidden" class="mt-1 block w-full" :value="old('photo', $user->photo)" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="telephone" :value="__('Telephone')"  />
            <x-text-input id="tel" name="telephone" type="text" class="mt-1 block w-full" :value="old('telephone', $user->telephone)" required autofocus autocomplete="telephone"   pattern="[0-9]{9}" title="Veuillez entrer un numéro de téléphone valide à 9 chiffres" />
            <x-input-error class="mt-2" :messages="$errors->get('telephone')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')"  />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button style="background:#ff8000" >{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>


</section>
@include('profile.partials.photo')

<script src="{{asset('New_Pages/AjoutPhotoVendeur/java.js')}}"> </script>
<script type="text/javascript">
    function openFileInput() {
        document.querySelector('input[type="file"]').click();
    }

    function displaySelectedImage(event) {
        const fileInput = event.target;
        const previewImage = document.getElementById('preview');
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>