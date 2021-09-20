@extends('layouts.backend.master')

@section('title')
Contact Messages
@endsection

@section('description')
Admin | Contact Messages page
@endsection

@section('content')

<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Contact Messages</h4>

        </div>
        <div class="card-body" style="padding: 0">


            <div style="padding: 10px">
                <form  action="{{ route('admin.contact-message.index') }}">

                    <div class="row justify-content-center align-content-center">
                        <div class="col-3">

                            <div class="form-group">

                                <input placeholder="Search ..." value="{{ request()->search }}" type="text" name="search" class="form-control" >

                            </div>

                        </div>


                        <div class="col">

                            <div class="form-group">
                                <select name="only" class="form-control">

                                    <option value="" >All</option>
                                    <option value="0" {{ request()->only == '0' ? 'selected':''}} >unReaded Only</option>
                                    <option value="1" {{ request()->only == '1' ? 'selected':''}} >Readed Only</option>

                                </select>
                            </div>


                        </div>

                        <div class="col">

                            <div class="form-group">
                                <select name="sorted_by" class="form-control">

                                    <option value="created_at"  {{ request()->sorted_by == 'created_at' ? 'selected':''}}>created at</option>
                                    <option value="name" {{ request()->sorted_by == 'name' ? 'selected':''}} >From</option>
                                    <option value="message" {{ request()->sorted_by == 'message' ? 'selected':''}} >message</option>
                                    <option value="subject" {{ request()->sorted_by == 'subject' ? 'selected':''}} >subject</option>

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
                            <th>From</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse ($messages as $message)
                            <tr id="parent-id-{{ $message->id }}">
                                <td>   {{ Str::limit($message->name , 25) }} </td>
                                <td>   {{ $message->subject }} </td>
                                <td>   {{ $message->message }} </td>
                                <td id="status-{{ $message->id }}"> {{ $message->status ==1 ?'Read' :'New'}}</td>
                                <td> {{ $message->created_at->format('Y M d H:i A') }}</td>
                                <td style="width: 190px; text-align:center">

                                 @if ( $message->status ==0 &&  Auth::user()->isAbleTo('contact-messages-update'))

                                    <form data-parentid="{{ $message->id }}" method="POST" class="read-message" style="display: inline-block" action="{{ route('admin.contact-message.read', $message->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-eye"></i></button>
                                    </form>
                                @else
                                    <button class="btn btn-primary disabled"><i class="fa fa-eye"></i></button>

                                @endif


                                @if (  Auth::user()->isAbleTo('contact-messages-delete'))

                                    <form data-parentid="{{ $message->id }}" method="POST" class="ajax-delete-confirm" style="display: inline-block" action="{{ route('admin.contact-message.destroy', $message->id) }}">
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
                                <h5 >No Messages Founded</h5>
                            </td>
                        </tr>
                        @endforelse


                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="7" >


                                <div class="m-auto " style="width: max-content">
                                    {!! $messages->appends(request()->input())->onEachSide(1)-> links() !!}
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

@section('script')
   <script>


    let readMessagesForms = Array.from(document.querySelectorAll('.read-message'));


    readMessagesForms.forEach((messageForm)=>{

        messageForm.addEventListener('submit',(event)=>{
            event.preventDefault()
            let targetForm = event.target;
            if( ! targetForm.classList.contains('disabled')){

               let url = targetForm.action,
                   id = targetForm.dataset.parentid,
                   form_data = new FormData(targetForm);



                fetch(url , {
                    method:'POST',
                    body:form_data
                })
                .then(response=> response.json())
                .then( (response)=>{

                    if( response.success ==true){
                        document.getElementById('status-'+id).innerHTML = 'Read';
                    }

                })



            }
           targetForm.classList.add('disabled');
           targetForm.querySelector('[type="submit"]').classList.add('disabled');
        })
    })

</script>
@endsection
