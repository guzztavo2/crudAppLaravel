@if (count($errors->gerarInformacao) > 0)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Erro no campo: 'Gerar Informação'</strong><br> {{$errors->gerarInformacao->first()}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif


@if(Session::get('SucessoGerarInformacao') !== null)
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Tudo certo!</strong><br> {{Session::get('SucessoGerarInformacao')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif


@if(Session::get('SucessoLimparInformacao') !== null)
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Tudo certo!</strong><br> {{Session::get('SucessoLimparInformacao')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if(Session::get('ErroLimparInformacao') !== null)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Tudo certo!</strong><br> {{Session::get('ErroLimparInformacao')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
