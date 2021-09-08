
@extends('layouts.frontend.master')


@section('title')
Dashboard
@endsection

@section('description')
User Dashboard
@endsection


@section('content')
<!-- Start Blog Area -->

<div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
    <div class="container">
        <h2> My Posts</h2>

        <div class="row mt--20">
            <div class="col-lg-9 col-12">
                <div class="table-responsive ">

                <table class="table table-hover ">

                    <thead>
                        <tr>
                            <th> Title </th>
                            <th> Status </th>
                            <th> Comments </th>
                            <th> Actions </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($posts as $post )
                            <tr id="parent-id-{{ $post->id }}">
                                <td>  <a href="{{ route('post.show' , $post->slug) }}">{{ $post->title }} </a></td>
                                <td>{{ $post->status ==1 ? 'Active':'InActive' }}</td>
                                <td>{{ $post->comment_able ==1 ? 'Allowed':'Not Allowed' }}</td>
                                <td>

                                    <a class="btn btn-primary" href="{{ route('post.edit', $post->id) }}"><i class="fa fa-edit"></i></a>

                                    <form data-parentid="{{ $post->id }}" method="POST" class="ajax-delete-confirm" style="display: inline-block" action="{{ route('post.destroy', $post->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                        <tr>
                            <td colspan="4"> Ops you dont have any post , click <a href="{{ route('post.create') }}">here</a> to add new one </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                </div>




                {!! $posts->appends(request()->input())->onEachSide(1)-> links() !!}
            </div>
            <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">

                @include('layouts.frontend.dashboard_sidebar')
            </div>
        </div>
    </div>
</div>
<!-- End Blog Area -->
@endsection
