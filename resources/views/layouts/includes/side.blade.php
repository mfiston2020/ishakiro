<!-- Right Icon menu Sidebar -->
<div class="navbar-right">
    <ul class="navbar-nav">
        <li class="dropdown">
            <a href="{{ route('admin.profile')}}" class="dropdown-toggle">
                <i class="zmdi zmdi-account"></i>
            </a>
        </li>
        <li><a href="javascript:void(0);" class="js-right-sidebar" title="Setting"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
        <li><a href="{{ route('logout')}}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="zmdi zmdi-power"></i></a></li>
    </ul>
</div>


<!-- Right Sidebar -->
<aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs sm">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#setting"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="setting">
            <div class="slim_scroll">
                <div class="card">
                    <h6>Theme Option</h6>
                    <div class="light_dark">
                        <div class="radio">
                            <input type="radio" name="radio1" id="lighttheme" value="light" checked=""
                            onclick="event.preventDefault();document.getElementById('white-form').submit();">
                            <label for="lighttheme">Light Mode</label>
                        </div>
                        <div class="radio mb-0">
                            <input type="radio" name="radio1" id="darktheme" value="dark" {{(Session::get('mode')=='dark')?'checked':''}} 
                            onclick="event.preventDefault();document.getElementById('dark-form').submit();">
                            <label for="darktheme">Dark Mode</label>
                        </div>
                    </div>
                </div>               
            </div>                
        </div>
    </div>
</aside>

<form id="dark-form" method="get" action="{{ route('mode1.change') }}" style="display:none">
    {{ csrf_field() }}
    @csrf
</form>

<form id="white-form" method="get" action="{{ route('mode2.change') }}" style="display:none">
    {{ csrf_field() }}
    @csrf
</form>