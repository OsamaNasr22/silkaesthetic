

@if(count($errors) > 0   )
    <div class="messeages">
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p class="lead">{{$error}}</p>
                @endforeach
        </div>
    </div>

    @elseif(Session::has('fail'))
    <div class="messeages">
        <div class="alert alert-danger">
            <p class="lead">{{Session::get('fail')}}</p>
        </div>
    </div>

@elseif(Session::has('success'))

    <div class="messeages">
        <div class="alert alert-success">
            <p class="lead">{{Session::get('success')}}</p>
        </div>
    </div>


@endif
