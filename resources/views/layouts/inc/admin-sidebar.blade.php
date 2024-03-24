    <!-- Sidebar -->
    <div class="sidebar px-2" id="sidebar" style="width: 140px">
        <div
          class="d-flex justify-content-center mb-3 py-2 align-items-center"
          id="menu-top"
        >
          <div class="logo d-none" id="logo">
            <a href="{{route('dashboard')}}">
            <img src="{{asset('assets/icons/logo.jpg')}}" alt="logo" class="w-100" />
          </a>
          </div>
          <div id="menu" class="p-2">
            <i class="fa fa-bars fa-2x" style="color: #ffffff"></i>
          </div>
        </div>
  
        <!-- Menu -->
        <ul class="menu text-center list-unstyled">
          <li class="menu-item mb-2 {{request()->is('admin/dashboard') ? 'active-page' : ''}}">
            <a href="{{route('dashboard')}}" class="text-decoration-none d-block">
              <img src="{{asset('assets/icons/business-report.png')}}" alt="" class="mb-1" />
              <span class="menu-title d-block m-0">Dashboard</span>
            </a>
          </li>

          <li class="menu-item mb-2 {{request()->is('admin/member-associations')|| request()->is('admin/add-member-association')|| request()->is('admin/edit-member-association*') ? 'active-page' : ''}}">
            <a href="{{route('associations')}}" class="text-decoration-none d-block">
              <img src="{{asset('assets/icons/association.png')}}" alt="" class="mb-1" />
              <span class="menu-title d-block m-0">Association</span>
            </a>
          </li>
  
          <li class="menu-item mb-2 {{ request()->is('admin/board-members')||request()->is('admin/add-board-member')|| request()->is('admin/edit-board-member*')||
            request()->is('admin/medical-members') || request()->is('admin/add-medical-member') || request()->is('admin/edit-medical-member*')|| 
            request()->is('admin/field-coordinator-members') || request()->is('admin/add-field-coordinator-member*') || request()->is('admin/edit-field-coordinator-member*')  ? 'active-page' : ''}}">
              <img src="{{asset('assets/icons/team.png')}}" alt="" class="mb-1" />
              <span class="menu-title d-block m-0">Our Team <i class="fa fa-angle-down"></i></span>
            <ul class="dropdown list-unstyled m-0 d-none">
              <li><a href="{{route('board-members')}}" class="dropdownlist-item text-decoration-none">Board Members</li></a>
              <li><a href="{{route('medical-members')}}" class="dropdownlist-item text-decoration-none">Medical Members</li></a>
              <li><a href="{{route('coordinator-members')}}" class="dropdownlist-item text-decoration-none">Field Coordinator Members</li></a>
            </ul>
          </li>

          <li class="menu-item mb-2 {{request()->is('admin/gallery')|| request()->is('admin/add-gallery') || request()->is('admin/edit-gallery*') ? 'active-page' : ''}}">
            <a href="{{route('gallery')}}" class="text-decoration-none d-block">
              <img src="{{asset('assets/icons/gallery.png')}}" alt="" class="mb-1" />
              <span class="menu-title d-block m-0">Gallery</span>
            </a>
          </li>

          <li class="menu-item mb-2 {{request()->is('admin/categories')|| request()->is('admin/add-category')|| request()->is('admin/edit-category*') ? 'active-page' : ''}}">
            <a href="{{route('categories')}}" class="text-decoration-none d-block">
              <img src="{{asset('assets/icons/category.png')}}" alt="" class="mb-1" />
              <span class="menu-title d-block m-0">Category</span>
            </a>
          </li>

          <li class="menu-item mb-2 {{request()->is('admin/news')|| request()->is('admin/add-news')|| request()->is('admin/show-news*')|| request()->is('admin/edit-news*')  ? 'active-page' : ''}}">
            <a href="{{route('news')}}" class="text-decoration-none d-block">
              <img src="{{asset('assets/icons/news.png')}}" alt="" class="mb-1" />
              <span class="menu-title d-block m-0">News</span>
            </a>
          </li>

          <li class="menu-item mb-2 {{request()->is('admin/events')|| request()->is('admin/add-event')|| request()->is('admin/edit-event*') ? 'active-page' : ''}}">
            <a href="{{route('events')}}" class="text-decoration-none d-block">
              <img src="{{asset('assets/icons/events.png')}}" alt="" class="mb-1" />
              <span class="menu-title d-block m-0">Events</span>
            </a> 
          </li>

          <li class="menu-item mb-2 {{request()->is('admin/rules')|| request()->is('admin/add-rule')|| request()->is('admin/show-rule*')|| request()->is('admin/edit-rule*') ? 'active-page' : ''}}">
            <a href="{{route('rules')}}" class="text-decoration-none d-block">
              <img src="{{asset('assets/icons/rules.png')}}" alt="" class="mb-1" />
              <span class="menu-title d-block m-0">Rules & Regulations</span>
            </a>
          </li>
  
          <li class="menu-item mb-2 {{request()->is('admin/milestones')|| request()->is('admin/add-milestone')|| request()->is('admin/edit-milestone*') ? 'active-page' : ''}}">
            <a href="{{route('milestones')}}" class="text-decoration-none d-block">
              <img src="{{asset('assets/icons/counter.png')}}" alt="" class="mb-1" />
              <span class="menu-title d-block m-0">Milestone</span>
            </a>
          </li>

          <li class="menu-item mb-2 {{request()->is('admin/notifications')|| request()->is('admin/add-notification')|| request()->is('admin/edit-notification*') ? 'active-page' : ''}}">
            <a href="{{route('notifications')}}" class="text-decoration-none d-block">
              <img src="{{asset('assets/icons/pop.png')}}" alt="" class="mb-1" />
              <span class="menu-title d-block m-0">Notification</span>
            </a>
          </li>

          <li class="menu-item mb-2 {{request()->is('admin/documents')|| request()->is('admin/add-document')|| request()->is('admin/edit-document*') ? 'active-page' : ''}}">
            <a href="{{route('documents')}}" class="text-decoration-none d-block">
              <img src="{{asset('assets/icons/document.png')}}" alt="" class="mb-1" />
              <span class="menu-title d-block m-0">Documents</span>
            </a>
          </li>

          <li class="menu-item mb-2 {{request()->is('admin/banners')|| request()->is('admin/add-banner')|| request()->is('admin/edit-banner*') ? 'active-page' : ''}}">
            <a href="{{route('banners')}}" class="text-decoration-none d-block">
              <img src="{{asset('assets/icons/banner.png')}}" alt="" class="mb-1" />
              <span class="menu-title d-block m-0">Banner</span>
            </a>
          </li>
          
          <li class="menu-item mb-2 {{request()->is('admin/users')|| request()->is('admin/add-user')|| request()->is('admin/edit-user*') ? 'active-page' : ''}}">
            @if (auth()->user()->role_as == '1')
            <a href="{{route('users')}}" class="text-decoration-none d-block">
              <img src="{{asset('assets/icons/profile.png')}}" alt="" class="mb-1" />
              <span class="menu-title d-block m-0">User</span>
            </a>
            @endif
          </li>
        </ul>
      </div>