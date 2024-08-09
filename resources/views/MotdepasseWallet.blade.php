     <!--  -->
     <link href="{{asset('New_pages/fivhier_css/bootstrap.min.css')}}" rel="stylesheet">

     <link href="{{asset('New_pages/fivhier_css/bootstrap-icons.css')}}" rel="stylesheet">

     <link href="{{asset('New_pages/fivhier_css/css.css')}}" rel="stylesheet">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


     <body>
         <div class="wrapper" style="  display:flex;flex-direction:column;background-color: rgba(0, 0, 0, 0.5);width:100%;height:100%;z-index:1;  position: fixed;  backdrop-filter: blur(5px);align-items:center;justify-content:space-around">
             <!--           -->
             <div class="tab-content shadow mt-5  col-md-8  form-wrapper sign-in overlay" style="margin-left: auto;margin-right: auto;width: 500px;height:max-content;" id="overlay2">
                 <div class="tab-pane fade show active" id="nav-ContactForm" role="tabpanel" aria-labelledby="nav-ContactForm-tab">
                     <form method="POST" action="{{route('client.verified.wallet')}}">
                         @csrf
                         <div class=" ">
                             <div class="column">
                                 <div style="display: flex;flex-direction: row;">
                                     <input class="col-lg-4 col-md-10 col-8 mx-auto" type="password" name="password" id="password2" class="form-control" style="width: 90%;border-right: none ;border: solid 1px gray;" placeholder="Mot de passe" required>
                                     <i class="fas fa-eye-slash password-toggle" style="border: solid 1px gray;border-left: none;width: 60px;text-align: center;" id="toggle-password2"></i>
                                 </div>

                             </div>

                             <div>
                                 <input type="submit" id="bout2" value="Verifier" style="width: 300px;margin-left: auto;margin-right: auto;text-align:center;background:#FF8000;color:white;font-weight:bold" class="form-control signUp-link">
                             </div>
                         </div>
                     </form>
                 </div>
             </div>

             @php
             $s='';
             if(Auth::user()->usertype=='user')
             {
             $s='/dashboard';
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


             <a class="compare"  href="{{url($s)}}" style="text-decoration:none;color:white;font-size:24px;margin-top:-100px">
                 <button style="width: 200px;margin-left:auto;margin-right:auto;height:50px;border-radius:20px;font-weight:bold;background-color:#FF8000;color:white;align-content:center">
                     <i class="fa fa-arrow-left" style="color:white"></i>
                     <span style="margin-left:8px">Back</span>
                 </button>
             </a>
         </div>

         <script>
             const passwordInput2 = document.getElementById('password2');
             const togglePasswordButton2 = document.getElementById('toggle-password2');

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