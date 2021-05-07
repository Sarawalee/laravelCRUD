@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Movies</h1>
@stop

@section('content')
    <a href="{{route('search')}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Search Movies</a> <br><br>

    @isset($movies)
    <div class="table-responsive">

        <table id="movies-table" class="table table-striped">

                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Year</th>
                        <th scope="col">imdbID</th>
                        <th scope="col">Type</th>
                        <th scope="col">Poster</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movies as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data['title']}}</td>
                        <td>{{$data['year']}}</td>
                        <td>{{$data['imdbId']}}</td>
                        <td>{{$data['type']}}</td>
                        <td><img src="{{$data['poster']}}" class="img-responsive" height="100px"></td>
                        <td>
                            <button type="button" class="btn btn-info edit_movie" id="edit_movie" data-id="{{$data['id']}}" data-title="{{$data['title']}}" data-year="{{$data['year']}}" data-imdbid="{{$data['imdbId']}}" data-type="{{$data['type']}}" data-poster="{{$data['poster']}}"><i class="fas fa-pencil-alt"></i></button>
                            <a href="{{url('/movie/delete').'/'.$data['id']}}" type="button" class="btn btn-danger delete_movie" id="delete_movie" ><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

        </table>

    </div>
    @endisset

    <div class="modal fade" id="modal-edit" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Movie Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('updatemovie')}}" method="POST">    
                        @csrf                   
                        <input type="hidden" class="form-control" id="mid" name="mid">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label>Year</label>
                            <input type="text" class="form-control" id="year" name="year">
                        </div>
                        <div class="form-group">
                            <label>imdbID</label>
                            <input type="text" class="form-control" id="imdbid" name="imdbid">
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" class="form-control" id="type" name="type">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
@stop

@section('css')
    
@stop

@section('js')
    <script>
        $('#movies-table').DataTable();

        $(".edit_movie").click(function(e){
            e.preventDefault();
            var mid = $(this).attr('data-id');
            var title = $(this).attr('data-title');
            var year = $(this).attr('data-year');
            var imdbid = $(this).attr('data-imdbid');
            var type = $(this).attr('data-type');
            var poster = $(this).attr('data-poster');

            $("#mid").val(mid);
            $("#title").val(title);
            $("#year").val(year);
            $("#imdbid").val(imdbid);
            $("#type").val(type);
            $('#modal-edit').modal('show');
        });
    </script>
@stop