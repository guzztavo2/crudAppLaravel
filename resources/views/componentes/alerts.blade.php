@if (count($errors->gerarInformacao) > 0)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Erro no campo: 'Gerar Informação'</strong><br> {{ $errors->gerarInformacao->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


@if (Session::get('SucessoGerarInformacao') !== null)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Tudo certo!</strong><br> {{ Session::get('SucessoGerarInformacao') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


@if (Session::get('SucessoLimparInformacao') !== null)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Tudo certo!</strong><br> {{ Session::get('SucessoLimparInformacao') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (Session::get('ErroLimparInformacao') !== null)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Tudo certo!</strong><br> {{ Session::get('ErroLimparInformacao') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (Session::get('ErrorInserirInformacao') !== null)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Ops, deu errado!</strong><br> {{ Session::get('ErrorInserirInformacao') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (Session::get('sucessoInserirInformacao') !== null)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Tudo certo!</strong><br> {{ Session::get('sucessoInserirInformacao') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (count($errors->inserirInformacao) > 0)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <strong>Erro no campo: 'Inserir Informação'</strong><br> {{ $errors->inserirInformacao->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (count($errors->editarInformacao) > 0)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <strong>Erro no campo: 'Editar Informação'</strong><br>
        @foreach ($errors->{'editarInformacao'}->all() as $erro)
            {{ $erro }}<br>
        @endforeach


        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (Session::get('editarInformacaoErro') !== null)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Um erro na edição da informação!</strong><br> {{ Session::get('editarInformacaoErro') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
