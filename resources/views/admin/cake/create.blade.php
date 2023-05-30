@extends('layouts.master');

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create Cake</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" enctype="multipart/form-data" action="{{ route('cake.store') }}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Masukkan nama kue">
                  </div>
                  <div class="form-group">
                    <label >Price</label>
                    <input type="text" name="price" class="form-control" id="exampleInputPassword1" placeholder="Berapa harga kue">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Masukkan Gambar Kue</label>


                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">


                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <input type="text" name="desc" class="form-control" id="exampleInputPassword1" placeholder="Deskripsi Kue">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Category</label>
                    <select name="category_id" class="form-control">
                        @foreach ($category as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                  </div>
                  <div class="form-group">
                    <label>Stock</label>
                    <input type="text" name="stock" class="form-control"  placeholder="Berapa banyak stok kue yang tersedia">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Create Cake</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
