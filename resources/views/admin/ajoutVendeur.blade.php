<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/InscriptionVendeur (2).css')}}">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/boxicons.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <title>Document</title>
    <style>
        /* Global Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }



        .container1 {

            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f0f0f0;
            border-radius: 8px;

            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .image {
            display: flex;
            justify-content: center;
            text-align: center;
            align-items: center;
            align-content: center;
            max-width: 400px;
            height: 200px;
            background-color: #FFE0D3;
            border-radius: 10px;
            border-top: 2px solid #bb785b;
        }

        .image:hover {
            opacity: 20%;
            background-color: #ef8922;
        }

        .form-control {
            width: 80%;
            height: 40px;
            padding: 10px;
            font-size: 16px;

            border-top: none;
            border-left: none;
            border-right: none;
            border-bottom: 2px solid #ef8922;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .form-control:focus,
        option {
            outline: none;

            border-top: none;
            border-left: none;
            border-right: none;
            border-bottom: 3px solid #FF8000;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn {
            width: 80%;
            height: 40px;
            padding: 10px;
            font-size: 16px;
            background-color: #FF8000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #a75f18;
        }

        /* Password Toggle Icon */
        .password-toggle {
            position: absolute;
            top: 12px;
            right: 15px;
            color: #aaa;
            cursor: pointer;
        }

        .password-toggle:hover {
            color: #666;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container1 {
                margin: 20px auto;

            }

            .form-control {
                height: 35px;
                padding: 8px;
                font-size: 14px;
            }

            .btn {
                height: 35px;
                padding: 8px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {


            .form-control {


                font-size: 12px;
            }

            .btn {
                height: 30px;
                padding: 6px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">

            <div class="photo-container">
                <img id="photo-preview" src="@if(Auth::user()->photo!=''){{url('/')}}/photosUsers/{{Auth::user()->photo }} @else {{url('/')}}/avatar.png @endif" alt="Photo de profil">
            </div>

        </a>

        <ul class="side-menu top">

            <h3 style="text-align:center;color:#FF8000; margin-top:-6%;">{{Auth::user()->name}}</h3>
            <li>
                <a href="{{route('admin.index')}}" style="justify-content:flex-start;gap: 11px;">
                    <i class='fa fa-users' style="margin-left:10px;"></i>
                    <span class="text">Vendeur</span>
                </a>
            </li>
            <li><a href="{{route('contact')}}" style="justify-content:flex-start;gap: 11px;">
                    <i class='fa fa-phone' style="margin-left:10px;"></i>
                    <span class="nav-item">Contactez -nous</span>
                </a>
            </li>
          
            <li><a href="{{route('admin.profile')}}" style="justify-content:flex-start;gap: 11px;">
                    <i class='fa fa-user' style="margin-left:10px;"></i>
                    <span class="nav-item">Profile</span>
                </a>
            </li>


        </ul>
        <ul class="side-menu">

            <li>
                <a class="logout">
                    <form method="POST" action="{{ route('logout') }}" style="display: flex;flex-direction:row;justify-content:flex-start;gap: 11px;">
                        @csrf
                        <i class="fas fa-sign-out-alt" style="margin-left:10px;"></i>
                        <div :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            <span class="text"> {{ __('Log Out') }}</span>

                        </div>
                    </form>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->


    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Categories</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">5</span>
            </a>
            <a href="#" class="profile">
                <img src="{{asset('New_Pages/image/add employee3.png')}}">
            </a>
        </nav>
        <!-- NAVBAR -->

        <main>
            <div class="container1" style="display: grid;grid-template-columns: repeat(1, 1fr);justify-content: space-around;width: 450px;">

                <form method="POST" action="{{route('superadmin.insert')}}" enctype="multipart/form-data">
                    @csrf
                    <img id="preview" class="image" alt="Photo d'entete" onclick="openFileInput() ">
                    <input class="" type="file" accept="image/*" style="display: none;" name="photo" onchange="displaySelectedImage(event) ">
                    <div class="form-group" style="margin-top:10px;">
                        <input type="text" class="form-control" placeholder="Nom" name="name" :value="old('name')" required>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    <div class="form-group" style="margin-top:10px;">
                        <input type="text" class="form-control" placeholder="Email" id="email" name="email" :value="old('email')" required>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <div class="form-group">
                        <input class="form-control" placeholder="Telephone" id="telephone" type="phone" name="telephone" :value="old('telephone')" required autofocus autocomplete="telephone" autofocus autocomplete="telephone"  pattern="[0-9]{9}" title="Veuillez entrer un numéro de téléphone valide à 9 chiffres" >
                        <i class="fas fa-eye-slash password-toggle" id="toggle-password"></i>
                    </div>
                    <x-input-error :messages="$errors->get('telephone')" class="mt-2" />

                    <div class="form-group">
                        <input class="form-control" id="password" type="password" name="password" placeholder="Mot de passe" required autocomplete="new-password">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    <div class="form-group">
                        <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirmation" required autocomplete="new-password">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                    <div class="form-group">
                        <select class="form-control" name="categorie" style="background:white;color:black">
                            <option class="form-control" style="background:white;color:black" value="Bronze">Bronze</option>
                            <option class="form-control" style="background:white;color:black" value="Argent">Argent</option>
                            <option class="form-control" style="background:white;color:black" value="Or">Or</option>
                            <option class="form-control" style="background:white;color:black" value="Platine">Platine</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button class="btn">Enregistrer</button>
                    </div>
                </form>
            </div>
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



            <div class="left">

            </div>
            <a href="#" class="btn-download">

            </a>
            </div>

            <ul class="box-info">


                <div class="iconBx">
                    <ion-icon name="eye-outline"></ion-icon>
                </div>
                </div>


                <div class="iconBx">
                    <ion-icon name="eye-outline"></ion-icon>
                </div>
                </div>

                <div class="iconBx">
                    <ion-icon name="eye-outline"></ion-icon>
                </div>
                </div>






                </div>
                </div>

                </div>

        </main>
        <script src="{{asset('New_Pages/js/Scriptdash.js')}}"></script>
</body>

</html>