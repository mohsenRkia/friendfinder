<header id="header" class="lazy-load">
    <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">
            <input type="search">
            <hr>
            <a href="{{route('home.index')}}">Home</a>
            <hr>
            <a href="{{route('contact.index')}}">ContactUs</a>
            <hr>
            <a href="{{route('home.index')}}/login">Login</a>
            <hr>
            @if(Auth::user())
                <a href="{{route('user.profile.timeline',['id' => Auth::user()->id,'name' => Auth::user()->name])}}">My Profile</a>
            @endif

        </div><!-- /.container -->
    </nav>
</header>