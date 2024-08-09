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
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h2>Inscription</h2>
                <div class="input-box">


                    <div class="input-box">
                        <!-- <span class="icon"><img src=" C:\Users\WESLEY\Desktop\responsive\mail_26px.png" ></span> -->
                        <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <label>Nom</label>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    <div class="input-box">
                        <!-- <span class="icon"><img src=" C:\Users\WESLEY\Desktop\responsive\mail_26px.png" ></span> -->
                        <x-text-input id="email" type="text" name="email" :value="old('email')" required autofocus autocomplete="email" />
                        <label>Email</label>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <div class="input-box">
                        <!-- <span class="icon"><img src=" C:\Users\WESLEY\Desktop\responsive\mail_26px.png" ></span> -->
                        <x-text-input id="telephone" type="text" name="telephone" :value="old('telephone')" required autofocus autocomplete="telephone" autofocus autocomplete="telephone"  pattern="[0-9]{9}" title="Veuillez entrer un numéro de téléphone valide à 9 chiffres" />
                        <label>Telephone</label>
                    </div>
                    <x-input-error :messages="$errors->get('telephone')" class="mt-2" />

                    <div class="input-box">
                        <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                        <label>Password</label>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    <div class="input-box">
                        <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        <label>Confirmation</label>
                    </div>
               
                        <input id="creator_id" type="text" name="creator_id" value="{{0}}"  style="display:none;"/>
                       
                 
                    <button type="submit">Inscription</button>
                    <div class="register-link">
                        <p>Vous avez deja un compte? <a href="{{ route('login') }}">Login</a></p>
                    </div>
            </form>
        </div>
    </section>


</body>