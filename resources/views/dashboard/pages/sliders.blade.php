@extends('dashboard.layouts.master')
@section('title') Banners @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Banners</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="table-responsive">
                @if($sliders)
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>image url</th>
                            <th>type</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($sliders as $slider)
                            <tr >
                                <td>{{$slider['id']}}</td>
                                <td>{{asset('storage/banners/'.$slider['image'])}}</td>
                                <td>{{$slider['type']}}</td>
                                <td id="manage">
                                    <a class='delete' href="" data-id="{{$slider['id']}}"><i class="fa fa-remove"></i> Delete</a>
                                </td>
                            </tr>

                        @empty
                            <div class="alert alert-warning">No Banners added yet </div>
                        @endforelse


                        </tbody>
                    </table>

                @else
                    <div class="alert alert-warning">No categories added yet </div>
                @endif
            </div>

        </div>

    </div>
    @endsection

@section('js')

    <script>
        $(function () {


            $('.delete').on('click',function (event) {
                event.preventDefault();
                let id= $(this).attr('data-id');

                let state = true;
                let parent = $(this).parent().parent();




                if(confirm('This banner will be deleted, Are you sure?')){
                    if(state == true){
                        state = false;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            'url':`http://localhost:8000/admin/sliders/${id}`,
                            'type':'delete',
                            'dataType':'json',
                            'contentType':false,
                            'cacheProcess':false,
                            'success':function (data) {
                                parent.remove();
                                state= true;
                            },
                            'error':function (data) {

                            }
                        });
                    }

                }



            })


        });

    </script>
    @endsection