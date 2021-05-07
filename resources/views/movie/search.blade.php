@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Search Movies</h1>
@stop

@section('content')
    <form class="form-inline" action="{{route('searchresult')}}" method="POST">
        <div class="form-group">
            @csrf
            <label for="title">Movie Title:</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form> <br><br>

    @isset($movies)
    <div class="table-responsive">

        <table id="search-table" class="table table-striped">

                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Year</th>
                        <th scope="col">imdbID</th>
                        <th scope="col">Type</th>
                        <th scope="col">Poster</th>
                        <th scope="col">Add Movie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movies['Search'] as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data['Title']}}</td>
                        <td>{{$data['Year']}}</td>
                        <td>{{$data['imdbID']}}</td>
                        <td>{{$data['Type']}}</td>
                        <td><img src="{{$data['Poster']}}" class="img-responsive" height="100px"></td>
                        <td>
                            <button type="button" class="btn btn-success btn-lg add_movie" id="add_movie" data-title="{{$data['Title']}}" data-year="{{$data['Year']}}" data-imdbid="{{$data['imdbID']}}" data-type="{{$data['Type']}}" data-poster="{{$data['Poster']}}">Add</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

        </table>

    </div>
    @endisset

@stop

@section('css')
   
@stop

@section('js')
    <script> 
        $('#search-table').DataTable();
        
        $(".add_movie").click(function(e){
            e.preventDefault();
            var title = $(this).attr('data-title');
            var year = $(this).attr('data-year');
            var imdbid = $(this).attr('data-imdbid');
            var type = $(this).attr('data-type');
            var poster = $(this).attr('data-poster');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{route('addmovie')}}",
                type:'POST',
                data:{
                    title:title, 
                    year:year, 
                    imdbid:imdbid,
                    type:type,
                    poster:poster
                },
                success:function(data){
                    alert(data.success);
                }
            });

            $(this).prop('disabled', true);

        });
    </script>
@stop