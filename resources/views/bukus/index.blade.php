@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

} );
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">

  @if (auth()->user()->isAdmin())
  <div class="col-lg-2">
    <a href="{{ route('bukus.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Buku</a>
  </div>
  @endif

    <div class="col-lg-12">
                  @if (Session::has('message'))
                  <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
                  @endif
                  </div>
</div>
<div class="row" style="margin-top: 20px;">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">

                <div class="card-body">
                  <h4 class="card-title pull-left">Data Buku</h4>
                 
                  <div class="table-responsive">
                    <table class="table table-striped" id="table">
                      <thead>
                        <tr>
                          <th>
                            Judul
                          </th>
                          <th>
                            deskripsi
                          </th>
                          <th>
                            Penulis
                          </th>
                         
                         
                          @if(auth()->user()->isAdmin())
                          <th>
                            Action
                          </th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($buku as $data)
                        <tr>
                          <td class="py-1">
                          @if($data->cover)
                            <img src="{{url('images/buku/'. $data->cover)}}" alt="image" style="margin-right: 10px;" />
                          @else
                            <img src="{{url('images/buku/default.png')}}" alt="image" style="margin-right: 10px;" />
                          @endif
                          <a href="{{route('bukus.show', $data->id)}}"> 
                            {{$data->judul}}
                          </a>
                          </td>
                          <td>
                            {{$data->deskripsi}}
                          </td>

                          <td>
                          {{$data->user->name}} 
                          </td>
                         
                          @if(auth()->user()->isAdmin())
                          <td>
                          <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                            <a class="dropdown-item" href="{{route('bukus.edit', $data->id)}}"> Edit </a>
                            <form action="{{ route('bukus.destroy', $data->id) }}" class="pull-left"  method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> Delete
                            </button>
                          </form>
                           
                          </div>
                        </div>
                          </td>
                          @endif
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
               {{--  {!! $bukus->links() !!} --}}
                </div>
              </div>
            </div>
          </div>
@endsection