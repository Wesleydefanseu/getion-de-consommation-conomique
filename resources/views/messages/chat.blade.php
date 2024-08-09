@php
use App\Models\User;
use App\Models\Message;
use App\Models\Chat;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neomorphic Chat Message Screen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        .neo-shadow {
            box-shadow: 5px 5px 10px #d1d9e6, -5px -5px 10px #ffffff;
        }

        .neo-inset {
            box-shadow: inset 5px 5px 10px #d1d9e6, inset -5px -5px 10px #ffffff;
        }

        .listDiscussion {
            width: 30%;

        }

        .individu {
            display: flex;
            justify-content: space-between;
            flex-direction: row;
            height: 15%;
            background-color: #FFE0D3;
            justify-items: center;
            align-items: center;
            border-radius: 12px;
            margin-bottom: 9px;
            border: #FF8000 solid 1px;

        }

        .individu:hover {
            background-color: gray;
        }

        .litee {
            background-color: #e4662f;

        }

        .individu img {
            margin-left: 6px;
            background-color: #d1d9e6;
            border-radius: 50px;
            width: 75px;
            height: 75px;
        }

        .span {
            width: 75%;
            display: flex;
            flex-direction: column;
        }

        .span span {

            justify-content: space-between;
            flex: 1;
            display: flex;
            flex-direction: row;
            margin-bottom: 1%;
            margin-right: 5px;
        }

        .pNom {
            font-size: 22px;
            font-weight: bold;

        }

        .pNum {

            display: flex;
            justify-content: center;
            min-width: 20px;
            min-height: 20px;
            width: auto;
            height: 20px;
            font-weight: bold;
            background-color: #ff8000;
            color: white;
            border-radius: 5px;
            align-items: center;
        }

        .ok i {
            color: #d1d9e6;
        }

        .blue {
            color: blue;
        }

        .gray {
            background-color: #AAAAAA;
            ;
        }

        body {
            display: flex;
            justify-content: space-between;
            flex-direction: row;
        }

        .chattt {
            width: 71%;
            height: 700px;
        }

        .bacck2 {
            text-decoration: none;
            color: white;
            font-size: 24px;
            margin-top: -100px;
            margin-left: auto;
            margin-right: auto;
            display: none;
        }

        #messages {
            height: 80%;
        }

        #navigator {
            color: #FF8000;
            font-size: 24px;
            font-weight: bold;
            margin-left: 90%;
            display: none;
        }

        @media screen and (max-width: 968px) {

            body {
                display: flex;
                justify-content: space-between;
                flex-direction: column-reverse;
            }


            .listDiscussion {
                background-color: #e4662f;
                width: 100%;
                height: 850px;
                display: none;
                @php
                if(isset($query))
                {
                echo  "display: block; ";
                }
                @endphp
            }

            .chattt {
                width: 100%;
                margin-bottom: 20px;
                height: 850px;
                @php
                if(isset($query))
                {
                echo  "display: none";
                }
                @endphp
            }

            .boxi {
                width: auto;
                height: 200px;
                margin: auto auto auto auto;
                margin-top: 50px;
                min-width: 120px;
            }

            #navigator {
                display: inline;
            }

            .bacck2 {
                display: contents;
            }


            #messages {
                height: 75%;
            }

        }
    </style>

</head>

<body>
    <div class="bg-gray-100 rounded-xl neo-shadow p-6 listDiscussion" id="nept2">

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


        <a class="compare block11" href="{{url($s)}}" style="text-decoration:none;color:white;font-size:24px;margin-top:-100px;margin-left:auto;margin-right:auto">
            <button style="width: 50px;margin-bottom :20px;margin-right:auto;height:50px;border-radius:20px;font-weight:bold;background-color:#FF8000;color:white;align-content:center">
                <i class="fa fa-arrow-left" style="color:white"></i>

            </button>
        </a>

        <!-- Recherche -->
        <h3 style="margin-bottom:10px">Liste des discussion</h3>
        <form method="get" action="{{route('seller.search')}}">
            <div class="flex items-center space-x-2" style="margin-bottom:50px">
                <input type="hidden" name="page" value="11">
                @if (isset($id))
                <input type="hidden" name="id" value="{{$id}}">
                @endif
                <div class="flex-grow">
                    <input type="text" placeholder="Recherche" name="query" id="message" class="w-full p-3 rounded-lg neo-inset bg-transparent focus:outline-none" @if (isset($query)) value="{{$query}}" @endif required>
                </div>
                <button type="submit" class="p-3 rounded-lg neo-shadow hover:neo-inset transition-all duration-300 focus:outline-none">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg> -->
                    <i class="fa fa-search" style="color:#ff8000"></i>
                </button>
            </div>
        </form>
        <!--  -->

        @if (Auth::user()->usertype!='superadmin')
        @php
        $styl='';

        $super = User::where('usertype', 'superadmin')->latest()->first();
        $chat=Chat::where('id_emeteur',$super->id)->where('id_recepteur',Auth::id())->latest()->first();
        $lastmessage = $chat->messages()
        ->latest()
        ->first();

        if(isset($id))
        {
        if($chat->id==$id)
        {
        $styl='gray';
        }
        }
        @endphp
        <a href="{{url('Chat/Messagerie',  $chat->id)}}">
            <div class="individu  @php echo ''.$styl;   @endphp ">
                <img class="pp" src="{{asset('New_pages/image/icon1.png')}}" alt="" style="border:#FF8000 solid 2px">
                <div class="span">
                    <span>
                        <p class="pNom ">Administrateur</p>
                        <p class="pHeure">
                            {{ \Carbon\Carbon::parse($lastmessage->created_at)->format('H:i') }}<br>
                            {{ \Carbon\Carbon::parse($lastmessage->created_at)->format('M. Y') }}
                        </p>
                    </span>
                    <span>
                        <p class="pText">

                            @if ($lastmessage->id_emeteur==Auth::id())
                            Vous:
                            @else
                            Lui:
                            @endif

                            @php
                            $string=$lastmessage->message;
                            if (strlen($string) > 18) {
                            $newString = substr($string, 0, 18).'....';
                            } else {
                            $newString = $string;
                            }
                            @endphp

                            {{ $newString}}
                        </p>
                        @if ($lastmessage=$chat->messages()->where('statut',0)->where('id_recepteur',Auth::id())->count()>0)
                        <p class="pNum">{{$lastmessage=$chat->messages()->where('statut',0)->where('id_recepteur',Auth::id())->count()}}</p>
                        @endif

                    </span>
                </div>
            </div>
        </a>

        @endif


        @foreach ($chats as $chat)

        @php
        $styl='';
        $id_collegue=$chat->id_emeteur;
        if($chat->id_emeteur==Auth::id())
        {
        $id_collegue=$chat->id_recepteur;
        }
        $collegue=User::findOrFail($id_collegue);
        $lastmessage=$chat->messages()
        ->latest()
        ->first();
        if(isset($id))
        {
        if($chat->id==$id)
        {
        $styl='gray';
        }
        }
        @endphp
        @if ($collegue->usertype!='superadmin')

        @php
        if(isset($query))
        {
        if(in_array($id_collegue,$search)===false)
        {
        continue;
        }
        }
        @endphp

        <a href="{{url('Chat/Messagerie', $chat->id)}}">
            <div class="individu
             @php
            echo ''.$styl;
            @endphp
            ">
                <img class="pp" src="@if($collegue->photo!=''){{url('/')}}/photosUsers/{{$collegue->photo}} @else {{url('/')}}/avatar.png @endif" alt="">
                <div class="span">
                    <span>
                        <p class="pNom ">
                            {{strtoupper(substr($collegue->name, 0, 1)).substr($collegue->name, 1, 12) }}
                        </p>
                        <p class="pHeure">
                            {{ \Carbon\Carbon::parse($lastmessage->created_at)->format('H:i') }}<br>
                            {{ \Carbon\Carbon::parse($lastmessage->created_at)->format('d M. Y') }}
                        </p>
                    </span>
                    <span>
                        <p class="pText">
                            @if ($lastmessage->id_emeteur==Auth::id())
                            Vous:
                            @else
                            {{$collegue->name}}:
                            @endif

                            @php
                            $string=$lastmessage->message;
                            if (strlen($string) > 18) {
                            $newString = substr($string, 0, 18).'....';
                            } else {
                            $newString = $string;
                            }
                            @endphp

                            {{$newString}}
                        </p>
                        @if ($lastmessage=$chat->messages()->where('statut',0)->where('id_recepteur',Auth::id())->count()>0)
                        <p class="pNum">{{$lastmessage=$chat->messages()->where('statut',0)->where('id_recepteur',Auth::id())->count()}}</p>
                        @endif
                    </span>
                </div>
            </div>
        </a>
        @endif


        @endforeach


    </div>

    <div class=" bg-gray-100 rounded-xl neo-shadow p-6 chattt" id="nept1">
        <a class="bacck2" href="{{url($s)}}">
            <button style="width: auto;min-width:150px;margin-bottom :20px;margin-right:auto;height:50px;border-radius:20px;font-weight:bold;background-color:#FF8000;color:white;align-content:center;display:flex;flex-direction:row">
                <i class="fa fa-arrow-left" style="color:white;margin:auto auto auto auto"> Acceuil</i>
            </button>
        </a>
        <i class="fa fa-list" id="navigator" onclick="navigation()"></i>
        @if (isset($id))
        @php
        $chat=Chat::findOrFail($id);
        $messages=$chat->messages()->orderBy('created_at','asc')->get();
        $avc=User::findOrFail($chat->id_emeteur);
        $avc2=User::findOrFail($chat->id_recepteur);
        @endphp

        @if (Auth::user()->usertype=="user")
        <h1 class="text-2xl font-bold mb-4">
            {{strtoupper(substr($avc->name, 0, 1)).substr($avc->name, 1, 18) }}
        </h1>
        @else
        <h1 class="text-2xl font-bold mb-4">
            {{strtoupper(substr($avc2->name, 0, 1)).substr($avc2->name, 1, 18) }}
        </h1>
        @endif

        <div id="messages" class="space-y-4 mb-4 h-80 overflow-y-auto neo-inset p-4 rounded-lg">
            @if (Auth::user()->usertype!="user")
            Tel: {{$avc2->telephone}} <br> Email: {{$avc2->email}}
            @else
            Tel: {{$avc->telephone}} <br> Email: {{$avc->email}}
            @endif

            @foreach ($messages as $item)

            @if ($item->id_emeteur==Auth::id())

            <div class="flex items-start space-x-2 mb-4 justify-end ">
                <div class=" p-3 rounded-lg neo-shadow max-w-xs litee ok" style="min-width:200px">
                    <p class="text-sm text-white">{{$item->message}}</p>
                    <i class="fas @if ($item->statut==0) fa-check @else  fa-check-double  @endif " style="margin-left: 90%;
                     @if($item->statut==1)
                       color:#3C91E6
                     @endif
                     "></i>
                    <p style="font-size:10px;font-weight:bolder">
                        {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}<br>
                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M. Y') }}
                    </p>

                </div>
            </div>
            @else
            <!--  -->
            @php
            $user=User::findOrFail($item->id_emeteur);
            @endphp
            <div class="flex items-start space-x-2 mb-4">
                <div class="w-8 h-8 rounded-full neo-shadow flex items-center justify-center flex-shrink-0">
                    <!-- <span class="text-sm">JD</span> -->
                    <img class="text-sm" src="https://ui-avatars.com/api/?name={{$user->name}}" style="border-radius:50%">
                </div>
                <div class="bg-white p-3 rounded-lg neo-shadow max-w-xs" style="min-width:200px">
                    <p class="text-sm">{{$item->message}}</p>
                    <p style="font-size:10px;font-weight:bolder">
                        <br> <br>
                        {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} _
                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M. Y') }}
                    </p>
                </div>
            </div>
            <!--  -->
            @endif

            @endforeach
        </div>
        @else
        <h1 style="color:#ff8000;font-weight: bold;">Aucune discussion ouverte</h1>
        <div class="space-y-4 mb-4 h-80 overflow-y-auto neo-inset p-4 rounded-lg" style="height: 75%;">

        </div>
        @endif
        @if(isset($id))
        <form method="POST" action="{{route('chat.send')}}">
            @csrf
            <!-- Message input area -->
            <div class="flex items-center space-x-2">

                @if (isset($id))
                @php

                $id_collegue=$chat->id_emeteur;
                if($chat->id_emeteur==Auth::id())
                {
                $id_collegue=$chat->id_recepteur;
                }
                @endphp

                <input type="hidden" name="idConversation" value="{{$id}}">
                <input type="hidden" name="id_recepteur" value="{{$id_collegue}}">
                @endif

                <div class="flex-grow">
                    <input type="text" placeholder="Message..." name="message" id="message" class="w-full p-3 rounded-lg neo-inset bg-transparent focus:outline-none" required>
                </div>
                <button type="submit" class="p-3 rounded-lg neo-shadow hover:neo-inset transition-all duration-300 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>

            </div>
        </form>
     @endif
      
    </div>
</body>
<script>
    let list = document.getElementById('nept2');
    let chat = document.getElementById('nept1');

    function navigation() {
        list.style.display = 'block';
        chat.style.display = 'none';
    }
</script>

</html>