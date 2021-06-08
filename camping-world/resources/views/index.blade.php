@extends('layout')

@section('title', 'Programming Challenge!')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/app.css">
@endpush

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Camping World coding challenge</h1>
            <p class="col-md-8 fs-4">Import a csv file to sort and search</p>
            <form action="{{route('importCSV')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 col-md-5">
                    <label for="uploadedFile" class="form-label">Import a csv here:</label>
                    <input class="form-control" type="file" id="uploadedFile" name="uploadedFile">
                </div>
                <button class="btn btn-info" type="submit">Import File</button>
            </form>

        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="mb-3 ps-5 col-md-3">
            <label for="searchTerm">Search:</label>
            <input type="text" id="searchTerm" name="searchTerm">
        </div>
    </div>
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" >Camper Make <i class="bi bi-arrow-down-up" id="camper_make"></i></th>
                <th scope="col">Camper Brand <i class="bi bi-arrow-down-up" id="camper_brand"></i></th>
                <th scope="col">Sleep Number <i class="bi bi-arrow-down-up" id="sleep_number"></i></th>
                <th scope="col">Price <i class="bi bi-arrow-down-up" id="price"></i></th>
            </tr>
            </thead>
            <tbody>
            @foreach($campers as $camper)
                <tr>
                    <td>{{$camper->camper_make}}</td>
                    <td>{{$camper->camper_brand}}</td>
                    <td>{{$camper->sleep_number}}</td>
                    <td>{{$camper->price}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="./js/app.js"></script>
@endpush
