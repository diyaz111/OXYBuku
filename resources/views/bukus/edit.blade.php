@section('js')

<script type="text/javascript">

$(document).ready(function() {
    $(".users").select2();
});

</script>

<script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
                return false
            })
        })
        </script>
@stop

@extends('layouts.app')

@section('content')

<form action="{{ route('bukus.update', $buku) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('put') }}
<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Edit Buku <b>{{$buku->judul}}</b> </h4>
                      <form class="forms-sample">
                        <div class="form-group{{ $errors->has('judul') ? ' has-error' : '' }}">
                            <label for="judul" class="col-md-4 control-label">Judul</label>
                            <div class="col-md-6">
                                <input id="judul" type="text" class="form-control" name="judul" value="{{ $buku->judul }}" required>
                                @if ($errors->has('judul'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('judul') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                     
                        <div class="form-group{{ $errors->has('penulis') ? ' has-error' : '' }}">
                            <label for="penulis" class="col-md-4 control-label">penulis</label>
                            <div class="col-md-6">
                                <input id="penulis" type="text" class="form-control" name="penulis" value="{{ $buku->penulis }}" required>
                                @if ($errors->has('penulis'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('penulis') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
                            <label for="deskripsi" class="col-md-4 control-label">Deskripsi</label>
                            <div class="col-md-12">
                                <input id="deskripsi" type="text" class="form-control" name="deskripsi" value="{{ $buku->deskripsi }}" >
                                @if ($errors->has('deskripsi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('deskripsi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Cover</label>
                            <div class="col-md-6">
                                <img width="200" height="200" @if($buku->cover) src="{{ asset('images/buku/'.$buku->cover) }}" @endif />
                                <input type="file" class="uploads form-control" style="margin-top: 20px;" name="cover">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit">
                                    Update
                        </button>
                        <a href="{{route('bukus.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>
@endsection