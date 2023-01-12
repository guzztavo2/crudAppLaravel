@include('componentes.header')
@include('componentes.alerts')
@include('componentes.ModalButtons')



<form action="{{ route('home') }}" method="get">
    @csrf
    @if (isset($buscar))
        <label for="buscarInfo" class="form-label d-block">Você está buscando por: {{ $buscar }} <br> <a
                href="{{ route('home') }}">Clique aqui e volte para o inicio!</a></label>
    @else
        <label for="buscarInfo" class="form-label">Você pode buscar por informações aqui:</label>
    @endif
    <input type="text" id="buscarInfo" name="buscar" class="form-control" placeholder="Ex: A">
</form>
<div class="table-responsive-sm">
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="" style="user-select:none;"> <input class="form-check-input"
                        type="checkbox" value="" id="selectAllCheck">
                    <label class="form-check-label" for="selectAllCheck">
                        Selecionar
                    </label>
                </th>
                <th scope="col" style="cursor:pointer; user-select:none;"><a
                        href="{{ route('home', ['id' => isset($orderByInvertido) ? $orderByInvertido : 'desc', 'pagina' => $paginaAtual]) }}">ID</a>
                </th>
                <th scope="col" style="cursor:pointer; user-select:none;"><a
                        href="{{ route('home', ['informacao' => isset($orderByInvertido) ? $orderByInvertido : 'desc', 'pagina' => $paginaAtual]) }}">Informação</a>
                </th>
                <th scope="col" style="cursor:pointer; user-select:none;"><a
                        href="{{ route('home', ['dataCriacao' => isset($orderByInvertido) ? $orderByInvertido : 'desc', 'pagina' => $paginaAtual]) }}">Data
                        de Criação</a></th>
                <th scope="col" style="cursor:pointer; user-select:none;"><a
                        href="{{ route('home', ['dataAtualizacao' => isset($orderByInvertido) ? $orderByInvertido : 'desc', 'pagina' => $paginaAtual]) }}">Data
                        de Atualização</a></th>
                <th scope="col" style="user-select:none;">Editar / Deletar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listInformacoes as $informacao)
                <tr id="tableInformacaoRow">
                    <th>
                        <div class="form-check">
                            <input class="form-check-input children" type="checkbox" value=""
                                id="checkbox{{ $informacao->id }}">
                            <label class="form-check-label children" for="checkbox{{ $informacao->id }}">
                                Selecione
                            </label>
                        </div>
                    </th>
                    <th class="id">{{ $informacao->id }}</th>
                    <th class="informacao">{{ $informacao->informacao }}</th>
                    <th class="dataCriacao">{{ $informacao->dataCriacao }}</th>
                    <th class="dataAtualizacao">{{ $informacao->dataAtualizacao }}</th>
                    <td class="row align-items-center justify-content-center">
                        <form action="{{ route('removerInformacao') }}" class="col-md-6" method="post">
                            @csrf
                            <input type="hidden" name="informacoes[{{ $informacao->id }}]">
                            <input class="text-bg-danger col-md-12 text-center p-1" type="submit" value="Deletar">
                        </form>

                        <button type="button" id="btnOpenEditarModal" class="btn p-1 rounded-0 btn-warning col-md-6 squared" data-bs-toggle="modal"
                        data-bs-target="#editarInformacaoModal">
                        Editar
                    </button>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <nav aria-label="Page navigation example">
        @if (isset($buscar))
            <ul class="pagination justify-content-center">
                @if ($paginaAtual === 1)
                    <li class="page-item disabled">
                        <a class="page-link">Antes</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link"
                            href="{{ route('home', ['pagina' => $paginaAtual - 1, $orderBy[0] => $orderBy[1], 'buscar' => $buscar]) }}">Antes</a>
                    </li>
                @endif
                @for ($n = 1; $n <= $paginacao; $n++)
                    @if ($paginaAtual == $n)
                        <li class="page-item active">
                            <a class="page-link"
                                href="{{ route('home', ['pagina' => $n, $orderBy[0] => $orderBy[1], 'buscar' => $buscar]) }}">{{ $n }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link"
                                href="{{ route('home', ['pagina' => $n, $orderBy[0] => $orderBy[1], 'buscar' => $buscar]) }}">{{ $n }}</a>
                        </li>
                    @endif
                @endfor
                @if ($paginaAtual == $paginacao)
                    <li class="page-item disabled">
                        <a class="page-link">Próximo</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link"
                            href="{{ route('home', ['pagina' => $paginaAtual + 1, $orderBy[0] => $orderBy[1], 'buscar' => $buscar]) }}">Próximo</a>
                    </li>
                @endif
            </ul>
        @else
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
                            <a class="page-link"
                                href="{{ route('home', ['pagina' => $n, $orderBy[0] => $orderBy[1]]) }}">{{ $n }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link"
                                href="{{ route('home', ['pagina' => $n, $orderBy[0] => $orderBy[1]]) }}">{{ $n }}</a>
                        </li>
                    @endif
                @endfor
                @if ($paginaAtual == $paginacao)
                    <li class="page-item disabled">
                        <a class="page-link">Próximo</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link"
                            href="{{ route('home', ['pagina' => $paginaAtual + 1, $orderBy[0] => $orderBy[1]]) }}">Próximo</a>
                    </li>
                @endif
            </ul>
        @endif
    </nav>
</div>

@include('componentes.footer')
