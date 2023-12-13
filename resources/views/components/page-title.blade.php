<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $title }}</h4>

            <div class="page-title-right">
                @if(@$add)
                    <a class="btn btn-sm btn-success float-end" href="{{ $add }}"><i class="mdi mdi-plus"></i> Tambah</a>
                @endif
                @if(@$return)
                    <a class="btn btn-sm btn-primary float-end" href="{{ $return }}"><i class="mdi mdi-arrow-left"></i> Kembali</a>
                @endif
            </div>
        </div>

    </div>
</div>
<!-- end page title -->
