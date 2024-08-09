<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/inscription.css')}}">
</head>


<style>
     @media screen and (max-width: 968px) 
     {
        .parent
        {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
        }
        .monBlock
       {
        margin: auto auto auto auto;
       }
       
     }
</style>


<body>
    <section class="parent">
        <div class="photo">
            <div class="lev">
                <img src="{{asset('New_Pages/image/icon1.png')}}" width="200px" height="200px" style="border-radius: 50%;" alt="">
            </div>
            <label for="" class="texte">Acheter et economiser</label>
        </div>
        <div class="login-box monBlock">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <h2>Connexion</h2>
                <div class="input-box">
                    <!-- <span class="icon"><img src=" C:\Users\WESLEY\Desktop\responsive\mail_26px.png" ></span> -->
                    <x-text-input id="email" type="text" name="email" :value="old('email')" required autofocus autocomplete="email" />
                    <label>Email</label>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 " style="color:red;font-size:10px" />
                <div class="input-box">
                    <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                    <label>Password</label>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <div class="remember-forgot">
                    <label><input type="checkbox"> Remember me
                    </label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                    <br><br>   {{ __('Mot de passe oublié?') }}
                    </a>
                    @endif
                </div>
                <button type="submit">Connexion</button>
                <div class="register-link">
                    <p>Pas de compte? <a href="{{ route('register') }}">S'inscrire</a></p>
                </div>
            </form>
        </div>
    </section>


</body>

</html>

