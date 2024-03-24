<div class="top p-2 mb-4">
    <div class="d-flex justify-content-end gap-2">
        <div class="user position-relative">
            <img src="{{asset('assets/icons/user.png')}}" alt="" class="usericon">
            <ul class="list-unstyled user-dropdown">
                <li class="drop-item py-1"><a href="{{url('admin/profile')}}" class="text-decoration-none text-black">Profile</a></li>
                <li class="drop-item py-1 text-black" data-bs-toggle="modal" data-bs-target="#logoutmodal">Logout</li>
            </ul>
        </div>
        <img src="{{asset('assets/icons/half-moon.png')}}" id="theme" alt="">
    </div>
</div>

    <!--Logout Modal -->
    <div class="modal fade" id="logoutmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to log out?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary"> <a href="{{route('logout')}}" class="text-white text-decoration-none"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </div>
            </div>
        </div>
    </div>
    <script>
        var bulb = "{{ asset('assets/icons/bulb.png') }}";
        var moon = "{{ asset('assets/icons/half-moon.png') }}";
    </script>