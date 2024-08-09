<ul class="side-menu top">
			<h2 style="text-align:center;color:#FF8000">{{Auth::user()->name}}</h2>
			<li class="active">
				<a href="{{url('seller/dashboard')}}"  style="justify-content:flex-start;gap: 11px;">
					<i class='fa fa-th-large' style="margin-left:10px;"></i>
					<span class="text" >Dashboard</span>
				</a>
			</li>
			<li>
				<a href="{{route('ajouterCategorieprod')}}" style="justify-content:flex-start;gap: 11px;">
					<i class='fa fa-list-alt' style="margin-left:10px;"></i>
					<span class="text">Categorie</span>
				</a>
			</li>
			<li>
				<a href="{{route('afficheProduit')}}"  style="justify-content:flex-start;gap: 11px;">
				<i class="fa fa-book" aria-hidden="true" style="margin-left:10px"></i>
					<span class="text">Produits</span>
				</a>
			</li>
		
			<li>
				<a href="{{route('afficheclient')}}" style="justify-content:flex-start;gap: 11px;">
					<i class='fa fa-users' style="margin-left:10px;"></i>
					<span class="text">Clients</span>
				</a>
			</li>
			<li>
				<a href="{{route('affichecommande')}}" style="justify-content:flex-start;gap: 11px;">
					<i class='fa fa-credit-card' style="margin-left:10px;"></i>
					<span class="text">Commandes</span>
				</a>
			</li>

			<li>
				<a href="{{route('viewVerificationWallet')}}" style="justify-content:flex-start;gap: 11px;">
					<i class='fas fa-wallet' style="margin-left:10px;"></i>
					<span class="text">Wallet</span>
				</a>
			</li>
			<li><a href="{{route('contact')}}" style="justify-content:flex-start;gap: 11px;">
                    <i class='fa fa-phone' style="margin-left:10px;"></i>
                    <span class="nav-item">Contactez -nous</span>
                </a>
            </li>
			<li><a href="{{route('profile.edit')}}" style="justify-content:flex-start;gap: 11px;">
					<i class="fa fa-user" style="margin-left:10px;"></i>
					<span class="nav-item">Profile</span>
				</a>
			</li>
		</ul>