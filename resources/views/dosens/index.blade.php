@extends('template.default')


@section('content')


<form
class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search border" action="/products/cari" method="GET">
<div class="input-group">
    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
        aria-label="Search" aria-describedby="basic-addon2" value="{{ old('cari') }}">
    <div class="input-group-append">
        <input type="submit" value="Search" class="btn btn-primary">
    </div>
</div>
</form>


<div class="container mt-5">
    <a href="/dosens/cetak/pdf" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('dosens.create') }}" class="btn btn-md btn-success mb-3">ADD PRODUCT</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Mata Kuliah</th>
                                <th scope="col">No Hp</th>
                                <th scope="col" style="width: 20%">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @forelse ($dosens as $dosen)
                                <tr>
                                    <td class="text-center">
                                      {{$no++}}
                                    </td>
                                    <td>{{ $dosen->nama }}</td>
                                    <td>{{ $dosen->alamat }}</td>
                                    <td>{{ $dosen->mata_kuliah }}</td>
                                    <td>{{ $dosen->no_telp }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('dosens.destroy', $dosen->id) }}" method="POST">

                                            <a href="{{ route('dosens.edit', $dosen->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data dosens belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $dosens->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
