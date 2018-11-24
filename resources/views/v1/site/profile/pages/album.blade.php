@extends('v1.site.profile.profile')

@section('details')


    <div class="col-md-7">

        <!-- Photo Album
        ================================================= -->
        <ul class="album-photos">
            @foreach($user->posts as $post)
            <li>
                <div class="img-wrapper" data-toggle="modal" data-target=".photo-1">
                    <img src="/uploads/posts/{{$post->file->path}}" alt="photo" />
                </div>
                <div class="modal fade photo-1" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <img src="/uploads/posts/{{$post->file->path}}" alt="photo" />
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>




@endsection