@include('componentes.header')
@include('componentes.alerts')
@include('componentes.ModalButtons')
<div class="table-responsive-sm">
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="" style="user-select:none;"> <input class="form-check-input" type="checkbox"
                        value="" id="selectAllCheck">
                    <label class="form-check-label" for="selectAllCheck">
                        Selecionar
                    </label>
                </th>
                <th scope="col" style="cursor:pointer; user-select:none;">ID</th>
                <th scope="col" style="cursor:pointer; user-select:none;">Informação</th>
                <th scope="col" style="cursor:pointer; user-select:none;">Data de Criação</th>
                <th scope="col" style="cursor:pointer; user-select:none;">Data de Atualização</th>
                <th scope="col" style="user-select:none;">Editar / Deletar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listInformacoes as $informacao)
                <tr id="tableInformacaoRow">
                    <th>
                        <div class="form-check">
                            <input class="form-check-input children" type="checkbox" value="" id="checkbox{{$informacao->id}}">
                            <label class="form-check-label" for="checkbox{{$informacao->id}}">
                                Selecione
                            </label>
                        </div>
                    </th>
                    <th>{{ $informacao->id }}</th>
                    <th>{{ $informacao->informacao }}</th>
                    <th>{{ $informacao->dataCriacao }}</th>
                    <th>{{ $informacao->dataAtualizacao }}</th>
                    <td class="row align-items-center justify-content-center">
                        <a class="text-bg-warning col-md-5 text-center m-1 p-1" href="http://"><i
                                class="fa-solid fa-pen"></i></a>
                        <a class="text-bg-danger col-md-5 text-center m-1 p-1" href="http://"><i
                                class="fa-solid fa-trash"></i></a>

                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            @if ($paginaAtual === 1)
                <li class="page-item disabled">
                    <a class="page-link">Antes</a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ route('home', ['pagina' => $paginaAtual - 1]) }}">Antes</a>
                </li>
            @endif
            @for ($n = 1; $n <= $paginacao; $n++)
                @if ($paginaAtual == $n)
                    <li class="page-item active">
                        <a class="page-link" href="{{ route('home', ['pagina' => $n]) }}">{{ $n }}</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ route('home', ['pagina' => $n]) }}">{{ $n }}</a>
                    </li>
                @endif
            @endfor
            @if ($paginaAtual == $paginacao)
                <li class="page-item disabled">
                    <a class="page-link">Próximo</a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ route('home', ['pagina' => $paginaAtual + 1]) }}">Próximo</a>
                </li>
            @endif
        </ul>
    </nav>
</div>
@include('componentes.footer')
