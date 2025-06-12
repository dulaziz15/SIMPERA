<header id="page-topbar">
	<div class="navbar-header">
		<div class="d-flex">
			<!-- LOGO -->
			<div class="navbar-brand-box">
				<a href="{{ url('/dashboard') }}" class="logo logo-dark">
					<span class="logo-sm">
						<img src="{{ asset('template/assets/images/logo.png') }}" alt="" height="30">
					</span>
					<span class="logo-lg">
						<img src="{{ asset('template/assets/images/logo.png') }}" alt="" height="30">
						<span class="logo-txt">SIMPERA</span>
					</span>
				</a>

				<a href="{{ url('/dashboard') }}" class="logo logo-light">
					<span class="logo-sm">
						<img src="{{ asset('template/assets/images/logo.png') }}" alt="" height="30">
					</span>
					<span class="logo-lg">
						<img src="{{ asset('template/assets/images/logo.png') }}" alt="" height="30">
						<span class="logo-txt">SIMPERA</span>
					</span>
				</a>
			</div>

			<button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
				<i class="fa fa-fw fa-bars"></i>
			</button>

		</div>

		<div class="d-flex">


			<div class="dropdown d-none d-sm-inline-block">
				<button type="button" class="btn header-item" id="mode-setting-btn">
					<i data-feather="moon" class="icon-lg layout-mode-dark"></i>
					<i data-feather="sun" class="icon-lg layout-mode-light"></i>
				</button>
			</div>

			<div class="dropdown d-none d-lg-inline-block ms-1">
				<button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">
					<i data-feather="grid" class="icon-lg"></i>
				</button>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
					<div class="p-2">
						<div class="row g-0">
							<div class="col">
								<a class="dropdown-icon-item" href="https://github.com/dulaziz15/SIMPERA" target="_blank">
									<img src="{{ asset('template/assets/images/brands/github.png') }}" alt="Github">
									<span>GitHub</span>
								</a>
							</div>
							<div class="col">
								<a class="dropdown-icon-item" href="https://wa.me/+6285748957630" target="_blank">
									<img src="{{ asset('template/assets/images/brands/wa.webp') }}" alt="bitbucket">
									<span>WhatsApp</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="dropdown d-inline-block">
				<button type="button" class="btn header-item noti-icon position-relative"
					id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i data-feather="bell" class="icon-lg"></i>
					<span class="badge bg-danger rounded-pill">5</span>
				</button>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
					aria-labelledby="page-header-notifications-dropdown">
					<div class="p-3">
						<div class="row align-items-center">
							<div class="col">
								<h6 class="m-0"> Notifications </h6>
							</div>
							<div class="col-auto">
								<a href="#!" class="small text-reset text-decoration-underline"> Unread
									(3)</a>
							</div>
						</div>
					</div>
					<div data-simplebar style="max-height: 230px;">
						<a href="#!" class="text-reset notification-item">
							<div class="d-flex">
								<div class="flex-shrink-0 me-3">
									<img src="{{ asset('template/assets/images/users/avatar-3.jpg') }}" class="rounded-circle avatar-sm"
										alt="user-pic">
								</div>
								<div class="flex-grow-1">
									<h6 class="mb-1">James Lemire</h6>
									<div class="font-size-13 text-muted">
										<p class="mb-1">It will seem like simplified English.</p>
										<p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hour
												ago</span></p>
									</div>
								</div>
							</div>
						</a>
						<a href="#!" class="text-reset notification-item">
							<div class="d-flex">
								<div class="flex-shrink-0 avatar-sm me-3">
									<span class="avatar-title bg-primary rounded-circle font-size-16">
										<i class="bx bx-cart"></i>
									</span>
								</div>
								<div class="flex-grow-1">
									<h6 class="mb-1">Your order is placed</h6>
									<div class="font-size-13 text-muted">
										<p class="mb-1">If several languages coalesce the grammar</p>
										<p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min
												ago</span></p>
									</div>
								</div>
							</div>
						</a>
						<a href="#!" class="text-reset notification-item">
							<div class="d-flex">
								<div class="flex-shrink-0 avatar-sm me-3">
									<span class="avatar-title bg-success rounded-circle font-size-16">
										<i class="bx bx-badge-check"></i>
									</span>
								</div>
								<div class="flex-grow-1">
									<h6 class="mb-1">Your item is shipped</h6>
									<div class="font-size-13 text-muted">
										<p class="mb-1">If several languages coalesce the grammar</p>
										<p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min
												ago</span></p>
									</div>
								</div>
							</div>
						</a>

						<a href="#!" class="text-reset notification-item">
							<div class="d-flex">
								<div class="flex-shrink-0 me-3">
									<img src="{{ asset('template/assets/images/users/avatar-6.jpg') }}" class="rounded-circle avatar-sm"
										alt="user-pic">
								</div>
								<div class="flex-grow-1">
									<h6 class="mb-1">Salena Layfield</h6>
									<div class="font-size-13 text-muted">
										<p class="mb-1">As a skeptical Cambridge friend of mine occidental.
										</p>
										<p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hour
												ago</span></p>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="p-2 border-top d-grid">
						<a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
							<i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span>
						</a>
					</div>
				</div>
			</div>

			<div class="dropdown d-inline-block">
				<button type="button" class="btn header-item right-bar-toggle me-2">
					<i data-feather="settings" class="icon-lg"></i>
				</button>
			</div>

			<div class="dropdown d-inline-block">
				<button type="button" class="btn header-item bg-light-subtle border-start border-end"
					id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img class="rounded-circle header-profile-user" {{ var_dump(auth()->user()->profil?->foto_profil) }}
						src="{{ asset('storage/foto_profil/' . Auth::user()->profil?->foto_profil) ?? asset('template/assets/images/users/avatar-1.jpg') }}"
					alt="Header Avatar" ration="1:1">
					<span class="d-none d-xl-inline-block ms-1 fw-medium">{{ Auth::user()->nama_pengguna }}</span>
					<i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
				</button>
				<div class="dropdown-menu dropdown-menu-end">
					<!-- item-->
					<a class="dropdown-item" href="{{ url('profil') }}"><i
							class="mdi mdi mdi-face-man font-size-16 align-middle me-1"></i> Profile</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="{{ url('logout') }}"><i
							class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
				</div>
			</div>

		</div>
	</div>
</header>
