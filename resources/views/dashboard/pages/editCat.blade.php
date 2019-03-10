@extends('dashboard.layouts.master')
@section('title') Edid Category @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit category</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <form  action="{{route('categories.update',$category['id'])}}"  method="post" enctype="multipart/form-data">
                {{method_field('PUT')}}
                @csrf
                <label class="label label-success">Category name</label>
                <div class="form-group">
                    <input type="text" name="category_name" class="form-control input-lg" placeholder="Edit category name" value="{{$category['name']}}">
                </div>
                <label class="label label-success">Cover</label>
                <div class="form-group">
                    <input type="file" name="cover" class="form-control" >
                </div>

                <div id="containerOptions">
                    @forelse($options as $option)
                        <div class="form-group">
                        <label class="label label-success">option</label>
                        <span title="Remove option" class="deleteOption pull-right" data-id="{{$option['id']}}"><i class="fa fa-remove"></i></span>
                        <input type="text" class="form-control" name="editTitles[{{$option['id']}}]" placeholder="Enter the option name" value="{{$option['key']}}">
                        <input type="file" name="editImage[{{$option['id']}}]" class="form-control">
                        <textarea id="messageArea" name="editDesc[{{$option['id']}}]" rows="7" class="form-control ckeditor" placeholder="Write the description of this option">
                          {!! html_entity_decode($option['value']) !!}
                        </textarea>
                        </div>
                        @empty

                        @endforelse

                    <a href="#" id="addNewOption" class="pull-right" style="margin-bottom: 2px"><i class="fa fa-plus"></i> add new option</a>

                </div>

                <input type="submit" class="btn btn-success btn-block" value="Edit">

            </form>

        </div>

    </div>
@endsection
@section('js')
    <script>
        var count = 0;
        $(function () {
            $('#containerOptions').on('click','#addNewOption',function (e) {
                e.preventDefault();
                var element =$(this);
                var divElement = $('<div/>',{"class":"form-group"});
                divElement.append(
                    $('<label/>',{'class':'label label-success','text':'option'}),
                    $('<span/>', {'title':'Remove option', 'class':'removeOption pull-right'}).append($('<i/>',{'class':'fa fa-remove'})),
                    $('<input/>',{'type':'text','class':'form-control','name':'titles['+count+']','placeholder':'Enter the option name'}),
                    $('<input/>',{'type':'file','class':'form-control','name':'optionImages['+count+']'}),
                    $('<textarea/>',
                        {'id':'messageArea'+count,'name':'desc['+count+']','rows':'7','class':'form-control ckeditor ','placeholder':'Write the description of this option'}),

                );
                element.before(divElement);

                //CKEDITOR.replace('messageArea1')
                for (name in CKEDITOR.instances){
                    if (name === 'messageArea'+count) CKEDITOR.instances[name].destroy();
                }
                CKEDITOR.replace('messageArea'+count);
                count ++;
            });

            $('#containerOptions').on('click','.removeOption',function (e) {
                var el= $(this);
                var id = el.siblings('textarea').attr('id');
                console.log(id);
                var parent = el.parent();
                if (confirm('Are you sure delete this option')){
                    parent.remove();
                    CKEDITOR.instances[id].destroy();
                    if (count > 0) count --;

                }
            })

            $('#containerOptions').on('click','.deleteOption',function (e) {
                e.preventDefault();
                var el= $(this);
                var parent= el.parent();
                var id= el.attr('data-id');

                if (confirm('This option will be deleted, Are you sure??')){

                    $.ajax({
                        'url':'http://www.silkaesthetic.com/admin/api/option/delete/'+id,
                        'type':'get',
                        'dataType':'json',
                        'success':function () {
                            parent.remove();
                        },
                        'error':function () {

                        }
                    });



                }


            })

        });
    </script>
@endsection