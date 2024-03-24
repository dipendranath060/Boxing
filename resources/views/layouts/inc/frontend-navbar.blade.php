    <!-- Navbar Start -->
    <header class="fixed-top bg-dark">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a href="{{route('homes')}}">
                    <img src="{{asset('assets/images/logo.jpg')}}" class="logo" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fa fa-bars" aria-hidden="true" style="color: white;"></i>
                </button>

                <div class="collapse navbar-collapse flex-grow-0" id="navbarNavAltMarkup">
                    <ul class="navbar-nav">
                        <li class=" {{ request()->is('/') ? 'active' : '' }}  nav-item"><a href="{{route('homes')}}" class="nav-link">Home</a></li>
                        <li class=" {{ request()->is('board-members') || request()->is('medical-team') || request()->is('field-coordinators') || 
                            request()->is('rules-and-regulations') || request()->is('partners-and-associations') ? 'active' : '' }} nav-item nav-dropdown"><a class="nav-link">About<i
                                    class="fa fa-angle-down ms-1"></i></a>
                            <ul class="nav-dropdown-menu p-2 bg-dark d-none d-lg-block">
                                <li><a class="nav-dropdown-item mb-2 text-decoration-none"
                                        href="{{route('board-member')}}">Board Members</a></li>
                                <li><a class="nav-dropdown-item mb-2 text-decoration-none"
                                        href="{{route('medical-team')}}">Medical Team</a></li>
                                <li><a class="nav-dropdown-item mb-2 text-decoration-none"
                                        href="{{route('field-coordinator')}}">Field Coordinator</a></li>
                                <li><a class="nav-dropdown-item mb-2 text-decoration-none"
                                        href="{{route('rule')}}">Rules & Regulations</a></li>
                                <li><a class="nav-dropdown-item mb-2 text-decoration-none"
                                        href="{{route('partners')}}">Partners & Associations</a></li>
                            </ul>
                        </li>
                        <li class=" {{ request()->is('events') || request()->is('event/*') ? 'active' : '' }} nav-item"><a href="{{route('event')}}" class="nav-link">Events</a></li>
                        <li class=" {{ request()->is('gallery') || request()->is('gallery/*') ? 'active' : '' }} nav-item"><a href="{{route('fgallery')}}" class="nav-link">Gallery</a></li>
                        <li class=" {{ request()->is('news') || request()->is('news/*') ? 'active' : '' }} nav-item"><a href="{{route('fnews')}}" class="nav-link">News</a></li>
                        <li class=" {{ request()->is('registration') ? 'active' : '' }} nav-item"><a href="{{route('registration')}}" class="nav-link">Registration</a></li>
                        <li class=" {{ request()->is('contact') ? 'active' : '' }} nav-item"><a href="{{route('contact')}}" class="nav-link">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- END nav -->