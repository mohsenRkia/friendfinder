@extends('v1.site.profile.profile')

@section('details')

    <div class="col-md-7">

        <!-- Friend List
        ================================================= -->
        <div class="friend-list">
            <div class="row">
                @foreach($user->friends as $friend)
                <div class="col-md-6 col-sm-6">
                    <div class="friend-card">
                        <img src="/uploads/bgprofiles/uplode/{{$friend->profile->bgprofile}}" alt="profile-cover" class="img-responsive cover" height="150"/>
                        <div class="card-info">
                            <img src="/uploads/avatars/uplode/{{$friend->profile->avatar}}" alt="user" class="profile-photo-lg" />
                            <div class="friend-info">
                                <a href="#" class="pull-right text-green">My Friend</a>
                                <h5><a href="{{route('user.profile.timeline',['id' => $friend->user->id , 'name' => $friend->user->name])}}" class="profile-link">
                                        @if($friend->profile->nickname)
                                            {{$friend->profile->nickname}}
                                            @else
                                            {{$friend->user->name}}
                                        @endif
                                    </a></h5>
                                <p>
                                    @if($friend->profile->job)
                                        {{$friend->profile->job}}
                                    @else
                                        Has not job
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>


@endsection