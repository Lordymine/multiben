
<input type="hidden" name="codigo" id="codigo" value="{{$customers->matricula}}">
<div class="row">
    <div class="col-sm-12 text-center">
    <div class="col-sm-12 text-center mb-4"><img class="d-block w-150 mx-auto img-thumbnail rounded-circle mb-2" src="{{ ($customers->avatar) ? url('storage/avatars/'.$customers->avatar) : asset('img/account/user-ava.png')}}" alt="Team">
        <h6>{{$customers->name}} {{$customers->sobrenome}}</h6>
        <p class="text-muted mb-2">{{$customers->matricula}}</p>

    </div>
    </div>
</div>
