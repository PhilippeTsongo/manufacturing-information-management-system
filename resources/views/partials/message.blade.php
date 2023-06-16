    @if(session()->has('message'))
    <br>
        <span class="alert alert-success">  {{ session()->get('message')  }} </span>
    <hr>
    @endif

    @if(session()->has('message_err'))
    <br>
        <span class="alert alert-danger">  {{ session()->get('message_err')  }} </span>
    <hr>
    @endif

    {{-- ERROR MESSAGE --}}
    @if($errors->any())
    <br>
        @foreach($errors->all() as $error)
            <span class="alert alert-danger"> {{ $error }} </span>
        @endforeach
    <hr>        

    @endif