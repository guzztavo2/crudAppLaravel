<div class="row text-bg-warning p-2 mt-2 mb-2 justify-content-md-center">
    <button type="button" class="btn btn-success col-md-5 m-1" data-bs-toggle="modal" data-bs-target="#gerarInfoModal">
        Gerar informações
    </button>
    <button type="button" class="btn btn-primary col-md-5 m-1" data-bs-toggle="modal"
        data-bs-target="#inserirInformacaoModal">
        Registrar informação
    </button>
    {{-- Esse botão se altera conforme o javaScript --}}
    <button id="deletarInformacaoBTN" type="button" class="btn btn-danger col-md-5 m-1 " data-bs-toggle="modal"
        data-bs-target="#removerInformacao">
        Deletar informações
    </button>
    <button type="button" class="btn btn-danger col-md-5 m-1 " data-bs-toggle="modal"
        data-bs-target="#limparInformacaoModal">
        Limpar informações
    </button>

</div>
{{-- Modal Limpar Informação --}}
<div class="modal fade" id="limparInformacaoModal" tabindex="-1" aria-labelledby="ModalLimparTodasInformacoes"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-danger">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Limpar todas as informações</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('limparTodasInformacao') }}" method="post">
                @csrf
                <div class="modal-body text-center">
                    <span class="fs-7"> <b class="p-1 w-100 d-block text-bg-danger"> Tem certeza? </b> <br>Ao clicar
                        sim, você limpará todas as informações salvas no banco de dados.</span>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancelarGerarInfo" class="d-inline btn w-100 btn-secondary m-1"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="gerarInfoBtn" class=" d-inline m-1 btn btn-danger w-100">Deletar
                        Informações</button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Modal Gerar Informação -->
<div class="modal fade" id="gerarInfoModal" tabindex="-1" aria-labelledby="ModalGerarInformacao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-warning">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Gerar informações</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('gerarInformacao') }}" method="post">
                @csrf
                <div class="modal-body">
                    <label for="inputGerarInfo" class="form-label">Digite a quantidade de informações que você quer
                        gerar e salvar no banco de dados:</label>
                    <input type="text" id="inputGerarInfo" name="gerarInformacao" class="form-control is-invalid"
                        placeholder="Ex: 5">
                    <div id="labelGerarInfo" class="invalid-feedback d-flex w-100 flex-wrap">
                        Digite apenas em números:
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancelarGerarInfo" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="gerarInfoBtn" class="btn btn-primary">Gerar Informações</button>
                </div>
            </form>
        </div>
    </div>

</div>

{{-- Modal de alerta padrão. --}}
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="ModalAlertMessage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title title fs-5"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <p class="body">Cuidado</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancelarGerarInfo" class="btn btn-primary"
                    data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>

</div>

{{-- Modal de remover informação --}}
<div class="modal fade" id="removerInformacao" tabindex="-1" aria-labelledby="ModalRemoverInformacao"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-danger">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Remover as informações selecionadas:</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formRemoverInfo" action="{{ route('removerInformacao') }}" method="post">
                @csrf

                <div class="modal-body text-center">
                    <span class="fs-7"> <b class="p-1 w-100 d-block text-bg-danger"> Tem certeza? </b> <br>Ao clicar
                        em 'sim', você removerá todas as informações que estão selecionadas, do banco de dados.</span>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancelarGerarInfo" class="d-inline btn w-100 btn-secondary m-1"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="removerInformacaoBtn" class=" d-inline m-1 btn btn-danger w-100">Sim,
                        remover Informações</button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Modal de inserir uma nova Informação -->
<div class="modal fade" id="inserirInformacaoModal" tabindex="-1" aria-labelledby="ModalInserirInformacao"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Inserir uma nova informação</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('inserirNovaInformacao') }}" method="post">
                @csrf
                <div class="modal-body">
                    <label for="inputInserirNovaInformacao" class="form-label">Digite a informação que você gostaria
                        de guardar:</label>
                    <input type="text" id="inputInserirNovaInformacao" name="inserirInformacao"
                        class="form-control is-invalid" placeholder="Ex: Amêndoas não são tão legais quanto maçãs.">
                    <div id="labelInserirNovaInformacao" class="invalid-feedback d-flex w-100 flex-wrap">
                        0 / 100 Caracteres. Você precisa de no minimo 10 caracteres para salvar.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancelarGerarInfo" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="inserirInfoSaveBtn" class="btn btn-danger" disabled>Salvar
                        Informações</button>
                </div>
            </form>
        </div>
    </div>

</div>
{{-- editarInformacaoModal --}}
<div class="modal fade" id="editarInformacaoModal" tabindex="-1" aria-labelledby="ModalEditarInformacao"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar informação</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('editarInformacao') }}" method="post">
                @csrf
                <input type="hidden" name="idInformacao" id="informacaoEditarID">
                <div class="modal-body">
                    <div class="input-group flex-wrap p-1 mb-1 mt-2">
                        <label for="editarInformacaoIDinput" class="form-label col-12">Identificação da
                            Informação</label>
                        <span class="input-group-text" id="addon-wrapping">ID</span>
                        <input type="text" name="informacaoID" class="is-valid form-control col-12"
                            id="editarInformacaoIDinput" disabled aria-label="idInformacao"
                            aria-describedby="addon-wrapping">
                        <div class="valid-feedback d-flex w-100 flex-wrap">
                            Essa informação não pode ser editada!
                        </div>
                    </div>
                    <div class="input-group flex-wrap p-1 mb-1 mt-2 ">
                        <span class="input-group-text" id="addon-wrapping">Informação</span>
                        <input type="text" class="form-control" id="editarInformacaoInput"
                            name="editarInformacao" aria-describedby="addon-wrapping">
                        <div id="editarInformacaoLabel" class="valid-feedback d-flex w-100 flex-wrap">

                        </div>
                    </div>
                    <div class="input-group flex-wrap p-1 mb-1 mt-2">
                        <label for="editarInformacaoDataCriacaoInput" class="form-label col-12">Data e hora da criação
                            da Informação</label>
                        <span class="input-group-text" id="addon-wrapping">Data e hora da criação</span>
                        <input type="text" id="editarInformacaoDataCriacaoInput" class="is-valid form-control"
                            disabled aria-describedby="addon-wrapping">
                        <div class="valid-feedback d-flex w-100 flex-wrap">
                            Essa informação não pode ser editada!
                        </div>
                    </div>
                    <div class="input-group flex-wrap p-1 mb-1 mt-2">
                        <label for="editarInformacaoDataAtualizacaoInput" class="form-label col-12">Data e hora da
                            atualização da Informação</label>
                        <span class="input-group-text" id="addon-wrapping">Data e hora da atualização</span>
                        <input type="text" id="editarInformacaoDataAtualizacaoInput" class="is-valid form-control"
                            disabled aria-describedby="addon-wrapping">
                        <div class="valid-feedback d-flex w-100 flex-wrap">
                            Essa informação não pode ser editada!
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancelarGerarInfo" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="editarInfoSaveBtn" class="btn btn-success">Salvar Informações</button>
                </div>
            </form>
        </div>
    </div>

</div>
