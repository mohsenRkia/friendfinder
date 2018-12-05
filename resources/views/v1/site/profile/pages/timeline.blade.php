@extends('v1.site.profile.profile')

@section('title')
Your Profile {{$user->name}}
@endsection

@section('details')

    <div class="col-md-7">

    @if(Auth::user()->id === $user->id)
        <!-- Post Create Box
                        ================================================= -->
            <div class="create-post">
                <div class="row">
                    <div class="col-md-7 col-sm-7">
                        <div class="form-group">
                            <img src="/uploads/avatars/uplode/{{$profile->avatar}}" alt="" class="profile-photo-md" />
                            <textarea name="text" id="exampleTextarea" cols="30" rows="1" class="form-control" placeholder="Write what you wish" v-model="textPost"></textarea>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5">
                        <div class="tools">
                            <ul class="publishing-tools list-inline">
                                <li>
                                    <div class="image-upload">
                                        <label for="file-input">
                                            <span><i class="ion-images"></i></span>
                                        </label>

                                        <input id="file-input" type="file" name="image" ref="imagePost"/>
                                    </div>
                                </li>
                            </ul>
                            <button class="btn btn-primary pull-right" @click="sendPost({{$user->id}})">Publish</button>
                        </div>
                    </div>
                </div>
            </div><!-- Post Create Box End-->
        @else
            <span class="myBiography">
                        <h3>BioGraphy</h3>
                @if($profile->bio)
                    {{$profile->bio}}
                @else
                    Please Write Some Lines About Yoursaelf
                @endif
                    </span>
            <hr>
        @endif



    <!-- Post Content Vue -->
        <div class="post-content" v-for="post in posts">
            <!--Post Date-->
            <div class="post-date hidden-xs hidden-sm">
                @if($profile->nickname)
                    <h5>{{$profile->nickname}}</h5>
                @else
                    <h5>{{$user->name}}</h5>
                @endif
                <p class="text-grey">@{{post.created_at}}</p>
            </div><!--Post Date End-->

            <img :src="'/uploads/posts/' + post.path" alt="post-image" class="img-responsive post-image" />
            <div class="post-container">
                <img src="/uploads/avatars/uplode/{{$profile->avatar}}" alt="user" class="profile-photo-md pull-left" />
                <div class="post-detail">
                    <div class="user-info">
                        <h5><a href="{{route('user.profile.timeline',['id' => $user->id,'name' => $user->name])}}" class="profile-link">
                                @if($profile->nickname)
                                    <h3>{{$profile->nickname}}</h3>
                                @else
                                    <h3>{{$user->name}}</h3>
                                @endif
                            </a> <span class="following">
                                                @if(Auth::user()->id === $user->id)
                                    You Posted
                                @else
                                    @if($friend && $friend->iswhat === 1)
                                        Following
                                    @else
                                        No Follow
                                    @endif
                                @endif
                                            </span></h5>
                        <p class="text-muted">@{{post.created_at}}</p>
                    </div>
                    <div class="line-divider"></div>
                    <div class="post-text">
                        <p>
                            @{{post.text}}
                        </p>
                    </div>
                    <div class="line-divider"></div>
                    <div class="post-comment" v-for="comment in comments">
                        <img src="/images/users/user-11.jpg" alt="" class="profile-photo-sm" />
                        <p>
                            <a href="timeline.html" class="profile-link">@{{ comment.name }} </a><i class="em em-laughing"></i>
                            @{{ comment.text }}
                        </p>
                    </div>
                    <div class="post-comment">
                        <img src="/uploads/avatars/uplode/{{$profile->avatar}}" alt="" class="profile-photo-sm" />
                        <input type="text" class="form-control" placeholder="Post a comment" v-model="newComment">
                        <button class="btn btn-success" @click="sendComment({{Auth::user()->id}},post.id)">Send</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- End Post Content Vue -->



        <!-- Post Content
        ================================================= -->
        @foreach($posts as $post)
            <div class="post-content">
                <!--Post Date-->
                <div class="post-date hidden-xs hidden-sm">
                    @if($profile->nickname)
                        <h5>{{$profile->nickname}}</h5>
                    @else
                        <h5>{{$user->name}}</h5>
                    @endif
                    <p class="text-grey">{{$post->created_at}}</p>
                </div><!--Post Date End-->

                <img src="/uploads/posts/{{$post->file->path}}" alt="post-image" class="img-responsive post-image" />
                <div class="post-container">
                    <img src="/uploads/avatars/uplode/{{$profile->avatar}}" alt="user" class="profile-photo-md pull-left" />
                    <div class="post-detail">
                        <div class="user-info">
                            <h5><a href="{{route('user.profile.timeline',['id' => $user->id,'name' => $user->name])}}" class="profile-link">
                                    @if($profile->nickname)
                                        <h3>{{$profile->nickname}}</h3>
                                    @else
                                        <h3>{{$user->name}}</h3>
                                    @endif
                                </a> <span class="following">
                                                @if(Auth::user()->id === $user->id)
                                        You Posted
                                    @else
                                        @if($friend && $friend->iswhat === 1)
                                            Following
                                        @else
                                            No Follow
                                        @endif
                                    @endif
                                            </span></h5>
                            <p class="text-muted">{{$post->created_at}}</p>
                        </div>
                        <div class="reaction">
                            <a class="btn text-green" @click="like({{$post->id}},{{Auth::user()->id}},$event)">
                                <i class="icon ion-thumbsup">
                                    @if($post->like)
                                        {{$post->like->vote}}
                                    @else
                                        0
                                    @endif
                                </i>
                            </a>
                        </div>
                        <div class="line-divider"></div>
                        <div class="post-text">
                            <p>
                                {{$post->text}}
                            </p>
                        </div>
                        <div class="line-divider"></div>
                        <template v-if="postid == '{{$post->id}}'">

                            <template v-for="comment in comments">
                                <div class="post-comment" v-if="comment.post_id == postid">
                                    <img src="/images/users/user-11.jpg" alt="" class="profile-photo-sm" />
                                    <p>
                                        <a href="timeline.html" class="profile-link">@{{ comment.name }} </a><i class="em em-laughing"></i>
                                        @{{ comment.text }}
                                    </p>
                                </div>
                            </template>
                        </template>
                        @foreach($post->comments as $comment)
                            <div class="post-comment">
                                <img src="/images/users/user-11.jpg" alt="" class="profile-photo-sm" />
                                <p><a href="timeline.html" class="profile-link">{{$comment->user->name}} </a><i class="em em-laughing"></i>
                                    {{$comment->text}}
                                </p>
                            </div>
                        @endforeach
                        <div class="post-comment">
                            <img src="/uploads/avatars/uplode/{{$profile->avatar}}" alt="" class="profile-photo-sm" />
                            <input type="text" class="form-control" placeholder="Post a comment" v-model="newComment" v-once>
                            <button class="btn btn-success" @click="sendComment({{Auth::user()->id}},{{$post->id}})">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{$posts->links()}}
    </div>

@endsection