@extends('layouts.admint')

@section('content')
<div class="tb-content tb-style1">
    <div class="tb-padd-lr-30 tb-uikits-heading mb-3 mt-2">
        <h2 class="tb-uikits-title">{{ @!$edit ? 'Tambah' : 'Edit' }} Kategori</h2>
    </div>
    <div class="container-fluid">
        @include('layouts.feedback')
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ @$edit ? url('admin/categories/'. $category->id) : url('admin/categories') }}" method="POST">
                            @csrf
                            {{ @$edit ? method_field('PUT') : '' }}
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input type="text" class="form-control col-6" id="name" name="name" placeholder="Nama kategori" autofocus value="{{ @$edit ? $category->name : '' }}">
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection