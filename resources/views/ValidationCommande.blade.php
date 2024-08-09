     <!--  -->
     <link href="{{asset('New_pages/fivhier_css/bootstrap.min.css')}}" rel="stylesheet">

     <link href="{{asset('New_pages/fivhier_css/bootstrap-icons.css')}}" rel="stylesheet">

     <link href="{{asset('New_pages/fivhier_css/css.css')}}" rel="stylesheet">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


     <body>
         <div class="wrapper" style="  display:flex;flex-direction:row;background-color: rgba(0, 0, 0, 0.5);width:100%;height:100%;z-index:1;  position: fixed;  backdrop-filter: blur(5px);">
             <div class="tab-content shadow mt-5  col-md-8  form-wrapper sign-up overlay" style="margin-left: auto;margin-right: auto;width: 500px; " id="overlay1">
                 <div class="tab-pane fade show active" id="nav-ContactForm" role="tabpanel" aria-labelledby="nav-ContactForm-tab">
                     <form class="custom-form contact-form mb-5 " method="post" action="{{route('commande.valider')}}">
                         @csrf
                         <div style="display: flex;flex-direction: row;align-content: center;margin-bottom: 12px;width: 100%;justify-content: space-around;align-items: center;margin-top: 6%;">
                             <h3>Solde :</h3>
                             <label id="solde" style="height: 50px;width: 200px;background-color: #FFE0D3;text-align:center;">
                                 <p style="margin-top:10px;font-weight:bold;font-size:19px">
                                     @if (isset($vald))
                                     {{Auth::user()->solde}} FCFA
                                     @else
                                     *********
                                     @endif
                                 </p>

                             </label>
                             <p class="fas fa-eye-slash password-toggle signIn-link" style="text-align: center;text-decoration:none;" id="bout1"></p>
                         </div>
                         <div class="column">
                             <div>
                                 <input class="col-lg-4 col-md-10 col-8 mx-auto" type="text" name="name" id="contact-name" class="form-control" placeholder="Nom" style="width: 100%" required>
                             </div>
                             <div style="display: flex;flex-direction: row;">
                                 <input class="col-lg-4 col-md-10 col-8 mx-auto" type="password" name="password" id="password" class="form-control" style="width: 90%;border-right: none ;border: solid 1px gray;" placeholder="Mot de passe">
                                 <i class="fas fa-eye-slash password-toggle" style="border: solid 1px gray;border-left: none;width: 60px;text-align: center;" id="toggle-password"></i>
                             </div>
                             <div>

                                 <input type="hidden" name="quantite" value="{{$quantite}}">
                                 <input type="hidden" name="epargne" value="{{$epargne}}">
                                 <input type="hidden" name="prixtotal" value="{{$prixtotal}} ">

                                 <input class="col-lg-4 col-md-10 col-8 mx-auto" type="text" name="contact-company" id="contact-company" class="form-control" style="width: 100%;border:none;text-align: center;font-weight:bold;font-size:19px" placeholder="Nombre de produits : {{$quantite}}" disabled>
                                 <input class="col-lg-4 col-md-10 col-8 mx-auto" type="text" name="contact-company" id="contact-company" class="form-control" style="width: 100%;border:none;text-align: center;font-weight:bold;font-size:19px" placeholder="Epargne : {{$epargne}} FCFA" disabled>
                             </div>
                         </div>

                         <div>
                             <button type="submit" style="width: 300px;margin-left: auto;margin-right: auto;" class="form-control">Payer {{$prixtotal}} FCFA</button>
                         </div>
                     </form>
                     <div style="display: flex;flex-direction: row; margin-top: 5%;">
                         <a href="{{url('mycart')}}" style="text-decoration:none;">
                             <button action="" style="width: 100px;margin-left: 5%;margin-right: auto;" class="form-control">
                                 <i class=" fa fa-shopping-cart " style="color:#FF8000;height:15px;font-size :26px;" aria-hidden="true"></i>
                             </button>
                         </a>

                         <a href="{{route('recharge.index')}}" style="text-decoration:none;width: 120px;margin-left: auto;margin-right: 5%;">
                             <button style="font-weight:bold;display: flex;flex-direction:row;align-items:center" class="form-control">
                                 <i class=" fa fa-credit-card " style="color:#FF8000;height:15px;font-size :26px;margin-right: 5px;" aria-hidden="true"></i>
                                 Recharge
                             </button>
                         </a>

                     </div>
                 </div>


             </div>
             <!--           -->
             <div class="tab-content shadow mt-5  col-md-8  form-wrapper sign-in overlay" style="margin-left: auto;margin-right: auto;width: 500px;height:max-content;display:none" id="overlay2">
                 <div class="tab-pane fade show active" id="nav-ContactForm" role="tabpanel" aria-labelledby="nav-ContactForm-tab">
                     <form method="POST" action="{{url('client/affichesolde')}}">
                         @csrf
                         <div class=" ">
                             <div class="column">
                                 <div style="display: flex;flex-direction: row;">
                                     <input type="hidden" name="quantite" value="{{$quantite}}">
                                     <input type="hidden" name="epargne" value="{{$epargne}}">
                                     <input type="hidden" name="prixtotal" value="{{$prixtotal}} ">

                                     <input class="col-lg-4 col-md-10 col-8 mx-auto" type="password" name="motdepass" id="password2" class="form-control" style="width: 90%;border-right: none ;border: solid 1px gray;" placeholder="Mot de passe" required>
                                     <i class="fas fa-eye-slash password-toggle" style="border: solid 1px gray;border-left: none;width: 60px;text-align: center;" id="toggle-password2"></i>
                                 </div>

                             </div>

                             <div>
                                 <input type="submit" id="bout2" value="Verifier" style="width: 300px;margin-left: auto;margin-right: auto;text-align:center;background:#FF8000" class="form-control signUp-link">
                             </div>
                         </div>
                     </form>
                 </div>


             </div>
         </div>



         <!--  -->
         <script>
             const block1 = document.getElementById('overlay1');
             const block2 = document.getElementById('overlay2');
             const button1 = document.getElementById('bout1');
             const button2 = document.getElementById('bout2');

             button1.addEventListener('click', () => {
                 block2.style.display = 'block';
                 block1.style.display = 'none';
             });

             button2.addEventListener('click', () => {
                 block1.style.display = 'block';
                 block2.style.display = 'none';
             });
         </script>


         <script>
             const passwordInput = document.getElementById('password');
             const togglePasswordButton = document.getElementById('toggle-password');

             const passwordInput2 = document.getElementById('password2');
             const togglePasswordButton2 = document.getElementById('toggle-password2');


             togglePasswordButton.addEventListener('click', () => {
                 if (passwordInput.type === 'password') {
                     passwordInput.type = 'text';
                     togglePasswordButton.className = 'fas fa-eye';
                 } else {
                     passwordInput.type = 'password';
                     togglePasswordButton.className = 'fas fa-eye-slash';
                 }
             });

             togglePasswordButton2.addEventListener('click', () => {
                 if (passwordInput2.type === 'password') {
                     passwordInput2.type = 'text';
                     togglePasswordButton2.className = 'fas fa-eye';
                 } else {
                     passwordInput2.type = 'password';
                     togglePasswordButton2.className = 'fas fa-eye-slash';
                 }
             });
         </script>
     </body>