<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Methods</title>
    <link rel="stylesheet" href="{{asset('New_pages/Payement/stylee.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
</head>
<style>
    .boxi {
        margin-left: 30px;
    }

    @media screen and (max-width: 768px) {
        .blocus {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            justify-content: space-around;
            overflow-y: auto;
        }

        .boxi {
            width: auto;
            height: 200px;
            margin: auto auto auto auto;
            margin-top: 50px;
            min-width: 120px;
        }
    

    }
</style>

<body>



    <div class="wrapper" style=" display:grid;grid-template-columns: repeat(1, 1fr);background-color: rgba(0, 0, 0, 0.5);width:100%;height:100%;z-index:1;  position: fixed;  backdrop-filter: blur(2px);">
        <div class="payment-container blocus" id="operateurs" style="margin-left:auto;margin-right:auto;justify-content:space-around">


            <div class="payment-method mtn boxi">
                <h3><img src="{{asset('New_Pages/image/WhatsApp.svg')}}" alt="" width="90px" height="90px"></h3>
                <button id="whatsapp-button btnSpeccial" style="background:green">WhatSapp</button>
            </div>
            <div class="payment-method orange boxi">
                <h3><img src="{{asset('New_Pages/image/telegram.png')}}" alt="" width="90px" height="90px"></h3>
                <button id="telegram-button" style="background:cornflowerblue">Telegram</button>
            </div>
            <div class="payment-method orange boxi">
                <h3><i class="fa fa-envelope" style="font-size: 76px;margin-bottom:35px" aria-hidden="true"></i></h3>
                <button id="email-button" style="background:gray">Mail</button>
            </div>
            


        </div>

        @php
        $s='/';
        if(Auth::user()->usertype=='user')
        {
        $s='/dashboard';
        }
        if(Auth::user()->usertype=='admin')
        {
        $s='/admin/dashboard';
        }
        if(Auth::user()->usertype=='seller')
        {
        $s='/seller/dashboard';
        }
        if(Auth::user()->usertype=='superadmin')
        {
        $s='/superadmin/dashboard';
        }


        @endphp


        <a class="compare" href="{{url($s)}}" style="text-decoration:none;color:white;font-size:24px;margin-top:-100px;margin-left:auto;margin-right:auto">
            <button style="width: 200px;margin-left:auto;margin-right:auto;height:50px;border-radius:20px;font-weight:bold;background-color:#FF8000;color:white;align-content:center">
                <i class="fa fa-arrow-left" style="color:white"></i>
                <span style="margin-left:8px">Retour</span>
            </button>
        </a>


    </div>
    <script>
        document.getElementById('whatsapp-button').onclick = function() {
            var phoneNumber = '682014290'; // Remplacez par le numéro de téléphone souhaité
            var whatsappURL = 'https://wa.me/+237682014290';
            window.open(whatsappURL, '_blank');
        };
    </script>
    <script>
        document.getElementById('telegram-button').onclick = function() {
            var telegramUsername = 'Ndokguouo Mureille'; // Remplacez par le nom d'utilisateur Telegram souhaité
            var telegramURL = 'https://t.me/+237682014290';
            window.open(telegramURL, '_blank');
        };
    </script>
    <script>
        document.getElementById('email-button').onclick = function() {
            var email = 'mndokgouo@gmail.com'; // Remplacez par l'adresse email souhaitée
            var subject = 'Lumia Macket'; // Remplacez par l'objet souhaité
            var body = 'Bonjour mumu'; // Remplacez par le texte du corps souhaité
            var mailtoURL = 'mailto:' + email + '?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);
            window.open(mailtoURL, '_self');
        };
    </script>

</body>

</html>