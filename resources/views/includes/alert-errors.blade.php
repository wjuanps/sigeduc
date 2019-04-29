@if ($errors->any())
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Forão encontrados os seguintes erros no preenchemento do formulário</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row-fluid">
                <div class="col-md-12 alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
