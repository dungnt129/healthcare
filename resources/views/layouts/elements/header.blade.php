<div id="header">
  <h1><a href="dashboard.html">Matrix Admin</a></h1>

  <h2><a href="dashboard.html">CARMAH Logo</a></h2>
</div>
<!--close-Header-part-->

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome {{ UserHelper::getLoginUserName() }}</span><b class="caret"></b></a>
      <ul class="dropdown-menu">
<!--        <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
        <li class="divider"></li>-->
        <li><a href="{{ route('logout') }}"><i class="icon-key"></i> Log Out</a></li>
      </ul>
    </li>
    <li class=""><a title="Logout" href="{{ route('logout') }}"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>