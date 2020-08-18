
<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="{{ route('home')}}"><img src="{{ asset('backend/logo.png')}}" width="25"><span class="m-l-10">Ishakiro LTD</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="profile.html"><img src="{{ asset('backend/assets/images/users/form_avatar.jpg')}}" alt="User"></a>
                    <div class="detail">
                        <h4>{{Auth::user()->firstname}}</h4>
                        <small style="text-transform: uppercase">{{ Auth::user()->role}}</small>                        
                    </div>
                </div>
            </li>
            <li class="{{ Request::is('agent')?'active':''}}"><a href="{{ route('home')}}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
            <li class="{{ Request::is('agent/documents list')?'active':''}}"><a href="{{ route('agent.all.document')}}"><i class="zmdi zmdi-folder"></i><span>Documents</span></a></li>
            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-plus"></i><span>Add New Document</span></a>
                <ul class="ml-menu">
                    <li class=""{{ Request::is('agent/lost item')?'active':''}}"><a href="{{ route('agent.add.lost')}}">Lost Document</a></li>
                    <li class="{{ Request::is('agent/found item')?'active':''}}"><a href="{{ route('agent.add.found')}}">Found Document</a></li>                   
                </ul>
            </li>
            <li class="{{ Request::is('agent/search item')?'active':''}}"><a href="{{ route('agent.search')}}"><i class="zmdi zmdi-search"></i><span>Search</span></a></li>
        </ul>
    </div>
</aside>
<form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none">
    {{ csrf_field() }}
    @csrf
</form>