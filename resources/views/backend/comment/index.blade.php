@extends('layouts.backend.master')

@section('title')
Comment
@endsection

@section('description')
Admin | Comment page
@endsection

@section('content')

<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Comment</h4>

        </div>
        <div class="card-body" style="padding: 0">


            <div style="padding: 10px">
                <form  action="{{ route('admin.comment.index') }}">

                    <div class="row justify-content-center align-content-center">
                        <div class="col-3">

                            <div class="form-group">

                                <input placeholder="Search ..." value="{{ request()->search }}" type="text" name="search" class="form-control" >

                            </div>

                        </div>



                        <div class="col">

                            <div class="form-group">
                                <select name="sorted_by" class="form-control">

                                    <option value="created_at"  {{ request()->sorted_by == 'created_at' ? 'selected':''}}>created at</option>
                                    <option value="title" {{ request()->sorted_by == 'title' ? 'selected':''}} >Title</option>

                                </select>
                            </div>


                        </div>

                        <div class="col">

                            <div class="form-group">
                                <select name="order_by" class="form-control">
                                    <option value="desc" {{ request()->order_by == 'desc' ? 'selected':''}}>Descending</option>
                                    <option value="asc" {{ request()->order_by == 'asc' ? 'selected':''}}>Ascending</option>
                                </select>
                            </div>

                        </div>

                        <div class="col">

                            <div class="form-group">
                                <select name="limit" class="form-control">
                                    <option value="5" {{ request()->limit == 5 ? 'selected':''}} >5</option>
                                    <option value="10" {{ request()->limit == 10 ? 'selected':''}} >10</option>
                                    <option value="20" {{ request()->limit == 20 ? 'selected':''}}>20</option>
                                    <option value="50" {{ request()->limit == 50 ? 'selected':''}}>50</option>
                                    <option value="100" {{ request()->limit == 100 ? 'selected':''}}>100</option>
                                    <option value="200" {{ request()->limit == 200 ? 'selected':''}}>200</option>
                                    <option value="500" {{ request()->limit == 500 ? 'selected':''}}>500</option>

                                </select>
                            </div>

                        </div>


                        <div class="col">

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block d-block">  Search  <i class="fas fa-search"></i></button>

                            </div>

                        </div>
                    </div>




                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-hover  table-bordered text-center" >
                    <thead>
                        <tr class="text-center ">
                            <th>comment</th>
                            <th>Status</th>
                            <th>post</th>
                            <th>user</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse ($comments as $comment)
                            <tr id="parent-id-{{ $comment->id }}">
                                <td>   {{ Str::limit($comment->comment , 25) }} </td>
                                <td> {{ $comment->status ==1 ?'Active' :'InActive'}}</td>
                                <td> <a href="{{ route('admin.comment.index', ['post_id'=>$comment->post->id]) }}">{{Str::limit( $comment->post->title  , 15)}}</a></td>
                                <td>    <a href="{{ route('admin.comment.index' ,['user_id'=>$comment->user->id]) }}"> {{  Str::limit( $comment->user->name, 10) }} </a></td>
                                <td> {{ $comment->created_at->format('Y M d H:i A') }}</td>

                                <td style="width: 190px; text-align:center">



                               @if (Auth::user()->isAbleTo('comments-update'))
                                   <a class="btn btn-primary" href="{{ route('admin.comment.edit', $comment->id) }}"><i class="fa fa-edit"></i></a>
                               @else
                                    <button class="btn btn-primary disabled"> <i class="fa fa-edit"></i></button>
                                @endif

                                @if (Auth::user()->isAbleTo('comments-delete'))

                                    <form data-parentid="{{ $comment->id }}" method="POST" class="ajax-delete-confirm" style="display: inline-block" action="{{ route('admin.comment.destroy', $comment->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                @else
                                    <button class="btn btn-danger disabled"><i class="fa fa-trash"></i></button>

                                @endif




                                </td>

                            </tr>
                        @empty

                        <tr>
                            <td colspan="7">
                                <h5 >No Posts Founded</h5>
                            </td>
                        </tr>
                        @endforelse


                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="7" >


                                <div class="m-auto " style="width: max-content">
                                    {!! $comments->appends(request()->input())->onEachSide(1)-> links() !!}
                                </div>


                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
