<div class="row text-bg-warning p-2 mt-2 mb-2 justify-content-md-center">
    <button type="button" class="btn btn-success col-md-5 m-1" data-bs-toggle="modal" data-bs-target="#gerarInfoModal">
        Gerar informações
    </button>
    <button type="button" class="btn btn-primary col-md-5 m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Registrar informações
    </button>
    <button id="deletarInformacaoBTN" type="button" class="btn btn-primary col-md-5 m-1 " data-bs-toggle="modal" data-bs-target="#removerInformacao">
        Deletar informações
    </button>
    <button type="button" class="btn btn-danger col-md-5 m-1 " data-bs-toggle="modal" data-bs-target="#limparInformacaoModal">
        Limpar informações
    </button>

</div>
{{-- Modal Limpar Informação --}}
<div class="modal fade" id="limparInformacaoModal" tabindex="-1" aria-labelledby="ModalLimparTodasInformacoes" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-danger">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Limpar todas as informações</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('limparTodasInformacao') }}" method="post">
                @csrf
                <div class="modal-body text-center">
                    <span class="fs-7"> <b class="p-1 w-100 d-block text-bg-danger"> Tem certeza? </b> <br>Ao clicar sim, você limpará todas as informações salvas no banco de dados.</span>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancelarGerarInfo" class="d-inline btn w-100 btn-secondary m-1" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="gerarInfoBtn" class=" d-inline m-1 btn btn-danger w-100">Deletar Informações</button>
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
                    <button type="button" id="cancelarGerarInfo" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
                </div>
        </div>
    </div>

</div>


<div class="modal fade" id="removerInformacao" tabindex="-1" aria-labelledby="ModalRemoverInformacao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-danger">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Limpar todas as informações</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formRemoverInfo" action="{{ route('removerInformacao') }}" method="post">
                @csrf

                <div class="modal-body text-center">
                    <span class="fs-7"> <b class="p-1 w-100 d-block text-bg-danger"> Tem certeza? </b> <br>Ao clicar em 'sim', você removerá todas as informações que estão selecionadas, do banco de dados.</span>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancelarGerarInfo" class="d-inline btn w-100 btn-secondary m-1" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="gerarInfoBtn" class=" d-inline m-1 btn btn-danger w-100">Sim, remover Informações</button>
                </div>
            </form>
        </div>
    </div>

</div>
