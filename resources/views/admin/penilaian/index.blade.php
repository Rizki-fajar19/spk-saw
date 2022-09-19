@extends('layouts.app')
@section('title','SPK SAW | Penilaian Alternatif')
@section('content')
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#listkriteria" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
        aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Penilaian Alternatif</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="listkriteria">
        <div class="card-body">
            @if(Session::has('msg'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Info!</strong> {{ Session::get('msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="table-responsive">
                <form action="/import" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        {{-- <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1"> --}}
                        <input type="file" name="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" id="button-addon2">Import</button>
                        {{-- <button class="mt-3 btn btn-sm btn-success" type="submit" id="button-addon2">Import</button> --}}
                    </div>
                </form>
                <form action="{{ route('penilaian.store') }}" method="post">
                    @csrf
                    <button  class="btn btn-sm btn-primary float-right">Simpan</button>
                    {{-- <a href="" class="btn btn-sm btn-success float-left">Import</a> --}}
                    {{-- <form action="/" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" id="button-addon2">Import</button>
                    </form> --}}
                    {{-- <a href="" class="ml-3 btn btn-sm btn-success float-left">Unduh Template</a>
                    <a href="" class="ml-3 btn btn-sm btn-danger float-left">Reset</a> --}}
                    {{-- <form>
                        <div class="form-group">
                            <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                            <button class="mt-3 btn btn-sm btn-success" type="submit" id="button-addon2">Import</button>
                        </div>
                    </form> --}}
                    <br></br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Alternatif</th>
                                @foreach($kriteria as $key => $value)
                                <th>{{ $value->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alternatif as $alt => $valt)
                            {{-- $alt sebagai index, $valt sebagai value --}}
                            <tr>
                                <td>{{ $valt->nama_alternatif }}</td>
                                @if(count($valt->penilaian) > 0)
                                    @foreach($kriteria as $key => $value)
                                    <td>
                                        <select name="crips_id[{{ $valt->id }}][]" class="form-control">
                                            @foreach($value->crips as $k_1 => $v_1)
                                            <option value="{{ $v_1->id }}"
                                                {{ $v_1->id == $valt->penilaian[$key]->crips_id ? 'selected' : '' }}>
                                                {{ $v_1->nama_crips }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    @endforeach
                                @else
                                    @foreach($kriteria as $key => $value)
                                    <td>
                                        <select name="crips_id[{{ $valt->id }}][]" class="form-control">
                                            @foreach($value->crips as $k_1 => $v_1)
                                            <option value="{{ $v_1->id }}">{{ $v_1->nama_crips }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    @endforeach
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td>Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
