@extends('layouts.backend.master')

@section('title')
Posts
@endsection

@section('description')
Admin | Posts page
@endsection

@section('content')

<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Posts</h4>

        </div>
        <div class="card-body" style="padding: 0">


            <div style="padding: 10px">
                <form  action="{{ route('admin.post.index') }}">

                    <div class="row justify-content-center align-content-center">
                        <div class="col-3">

                            <div class="form-group">

                                <input placeholder="Search ..." value="{{ request()->search }}" type="text" name="search" class="form-control" >

                            </div>

                        </div>


                        <div class="col">

                            <div class="form-group">

                                <select name="category_id" class="form-control">

                                    <option value="">All Categories</option>
                                    @forelse ($global_categories as $categories)
                                    <option value="{{ $categories->id }}"

                                        {{ request()-> category_id == $categories->id ? 'selected':''}}
                                        >{{ $categories->title }}</option>

                                    @empty
                                    ...
                                    @endforelse
                                </select>
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
                            <th>Title</th>
                            <th>category</th>
                            <th>Status</th>
                            <th>author</th>
                            <th>Created At</th>
                            <th>Comments</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse ($posts as $post)
                            <tr id="parent-id-{{ $post->id }}">
                                <td>  <a href="{{ route('post.show', $post->slug) }}">  {{ Str::limit($post->title , 15) }}</a> </td>
                                <td> <a href="{{ route('admin.post.index', ['category_id'=>$post->category->id]) }}">{{ $post->category->title }}</a></td>
                                <td> {{ $post->status ==1 ?'Active' :'InActive'}}</td>
                                <td>    <a href="{{ route('admin.post.index' ,['user_id'=>$post->user->id]) }}"> {{  Str::limit( $post->user->name, 10) }} </a></td>
                                <td> {{ $post->created_at->format('Y M d H:i A') }}</td>
                                <td> {!! $post->comments_count > 1? '<a href="'.route('admin.comment.index', ['post_id'=>$post->id]).'">'.$post->comments_count.'</a>' : 0 !!}


                                </td>
                                <td style="width: 190px; text-align:center">



                               @if (Auth::user()->isAbleTo('posts-update'))
                                   <a class="btn btn-primary" href="{{ route('admin.post.edit', $post->id) }}"><i class="fa fa-edit"></i></a>
                               @else
                                    <button class="btn btn-primary disabled"> <i class="fa fa-edit"></i></button>
                                @endif

                                @if (Auth::user()->isAbleTo('posts-delete'))

                                    <form data-parentid="{{ $post->id }}" method="POST" class="ajax-delete-confirm" style="display: inline-block" action="{{ route('admin.post.destroy', $post->id) }}">
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
                                    {!! $posts->appends(request()->input())->onEachSide(1)-> links() !!}
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
