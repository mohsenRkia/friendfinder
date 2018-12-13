<header id="header" class="lazy-load">
    <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">
            <form action="{{route('search.index')}}" class="navbar-form navbar-right hidden-sm">
                <div class="form-group">
                    <i class="icon ion-android-search"></i>
                    <input name="key" type="text" class="form-control" placeholder="Search users">
                </div>
            </form>
            <hr>
            <a href="{{route('home.index')}}">Home</a>
            <hr>
            <a href="{{route('contact.index')}}">ContactUs</a>
            <hr>
            @if(Auth::user())
                <a href="{{route('user.profile.timeline',['id' => Auth::user()->id,'name' => Auth::user()->name])}}">My Profile</a>
                <hr>
                <a href="{{route('home.index')}}/user">Setting</a>
            @else
                <a href="{{route('home.index')}}/login">Login</a>
            @endif

        </div><!-- /.container -->
    </nav>
</header>