@extends('layouts.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Category Table</h6>
                        <a class="btn btn-primary" href="{{ route('category.create') }}">Create</a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            Kategori</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>
                                                <span class="text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold">{{ $item->name }}</span>
                                            </td>
                                            <td><a class="btn btn-primary" href="{{ route('category.edit', $item->id) }}">Edit</a>
                                                <a onclick="return confirm('Yakin hapus {{ $item->name }}?')" class="btn btn-danger" href="{{ route('category.delete', $item->id) }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
