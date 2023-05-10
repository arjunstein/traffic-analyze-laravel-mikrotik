<!DOCTYPE html>
<html lang="en">
<head>
	
    @include('partials.head')

</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="#" class="logo">
					<img src="../assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

                @include('partials.navbar')

            </nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">

            @include('partials.sidebar')

        </div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				
                @yield('content')

			</div>
			<footer class="footer">

                @include('partials.footer')

            </footer>
		</div>
		
		<!-- Custom template | don't include it in your project! -->
		<div class="custom-template">

            @include('partials.custom')

        </div>
		<!-- End Custom template -->
	</div>
	
    @include('partials.scripts')

</body>
</html>