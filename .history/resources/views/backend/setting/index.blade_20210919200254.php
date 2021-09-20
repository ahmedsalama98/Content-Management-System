@extends('layouts.backend.master')

@section('title')
Settings
@endsection

@section('description')
Admin | Settings page
@endsection

@section('content')

<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Settings</h4>
        </div>
        <div class="card-body" style="padding: 0">


            {{-- <div style="padding: 10px">
                <form  action="{{ route('admin.category.index') }}">

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

                                </select>
                            </div>

                        </div>


                        <div class="col">

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block d-block">    <i class="fas fa-search"></i></button>

                            </div>

                        </div>
                    </div>




                </form>
            </div> --}}

            <div class="row">
                <div class="col-md-2">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true">General</a>
                    <a class="nav-link " id="v-pills-social_accounts-tab" data-toggle="pill" href="#v-pills-social_accounts" role="tab" aria-controls="v-pills-social_accounts" aria-selected="true">Social Accounts</a>

                  </div>
                </div>
                <div class="col-md-10">
                  <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">.


                      </div>
                    <div class="tab-pane fade show " id="v-pills-social_accounts" role="tabpanel" aria-labelledby="v-pills-social_accounts-tab">...



                    </div>



                </div>
                </div>
              </div>
        </div>
    </div>

</div>
@endsection
