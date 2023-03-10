window.onload = function () {
    main();

}
function main() {
    ModalScript();
    tableScript();
}





function tableScript() {
    selectAllBtnCheckBox();
    informacaoRow();
    removerInformacaoBtnAction();

    function removerInformacaoBtnAction() {
        // data-bs-target="#removerInformacao"
        let deletarInformacaobtn = document.querySelector('#deletarInformacaoBTN');
        alertModal('Ops...', 'Você precisa selecionar a informação antes de remove-la.');
        deletarInformacaobtn.setAttribute('data-bs-target', '#alertModal');

        deletarInformacaobtn.addEventListener('click', function () {
            let itensSelecionados = [];
            document.querySelectorAll('.form-check-input.children').forEach((item) => {
                if (item.checked === true)
                    itensSelecionados.push(item.parentElement.parentElement.parentElement.querySelector('.id').innerHTML);
            })

            if (itensSelecionados.length > 0) {
                deletarInformacaobtn.setAttribute('data-bs-target', '#removerInformacao');
                let ModalRemover = document.querySelector('#removerInformacao');
                let count = 1;
                itensSelecionados.forEach(function (item, index) {
                    itensSelecionados[index] = '<input type="hidden" name="informacoes[' + itensSelecionados[index] + ']">'
                    ModalRemover.querySelector('#formRemoverInfo').innerHTML += itensSelecionados[index];
                    count++;
                })

            }
        })
    }
    function informacaoRow() {
        let rows = document.querySelectorAll('#tableInformacaoRow');
        let inputSelectAll = document.querySelector('#selectAllCheck');
        let childrensCheckBox = document.querySelectorAll('.form-check-input.children');

        rows.forEach((row) => {
            row.addEventListener('click', function () {
                let estaCheck = this.querySelector('.form-check-input.children').checked;
                if (estaCheck === true)
                    this.querySelector('.form-check-input.children').checked = false;
                else
                    this.querySelector('.form-check-input.children').checked = true;

                let count = 0;
                childrensCheckBox.forEach(function (item) {
                    if (item.checked === true)
                        count++;
                })
                let deletarInformacaobtn = document.querySelector('#deletarInformacaoBTN');

                if (count == 0) {
                    inputSelectAll.indeterminate = null;
                    inputSelectAll.checked = false;
                    alertModal('Ops...', 'Você precisa selecionar a informação antes de remove-la.');
                    deletarInformacaobtn.setAttribute('data-bs-target', '#alertModal');

                } else if (childrensCheckBox.length > count)
                    inputSelectAll.indeterminate = true;

                deletarInformacaobtn.setAttribute('data-bs-target', '#removerInformacao');

                if (childrensCheckBox.length == count) {
                    deletarInformacaobtn.setAttribute('data-bs-target', '#removerInformacao');
                    inputSelectAll.indeterminate = null;
                    inputSelectAll.checked = true;
                }
            })
        })
    }
    function selectAllBtnCheckBox() {
        let childrensCheckBox = document.querySelectorAll('.form-check-input.children');
        let childrensLabel = document.querySelectorAll('.form-check-input.children');
        childrensLabel.forEach((item) => {
            item.addEventListener('click', function () {
                if (this.checked === true)
                    this.checked = false;
                else
                    this.checked = true;
            })
        })
        let inputSelectAll = document.querySelector('#selectAllCheck');
        let todosSelecionados;
        childrensCheckBox.forEach((children) => {
            children.checked = false;
            inputSelectAll.indeterminate = null;
            inputSelectAll.checked = false;

        })


        todosSelecionados = inputSelectAll.checked

        inputSelectAll.onclick = function () {
            let deletarInformacaobtn = document.querySelector('#deletarInformacaoBTN');


            childrensCheckBox.forEach(function (item) {
                item.checked = inputSelectAll.checked;
                if (inputSelectAll.checked === false) {
                    alertModal('Ops...', 'Você precisa selecionar a informação antes de remove-la.');
                    deletarInformacaobtn.setAttribute('data-bs-target', '#alertModal');
                } else deletarInformacaobtn.setAttribute('data-bs-target', '#removerInformacao');


            })
        }

        childrensCheckBox.forEach(function (item) {
            item.addEventListener('click', function () {
                if (this.checked === true)
                    this.checked = false;
                else
                    this.checked = true;
            })
            item.addEventListener('change', function () {
                let deletarInformacaobtn = document.querySelector('#deletarInformacaoBTN');

                count = 0;
                childrensCheckBox.forEach((item1) => {
                    if (item1.checked === true)
                        count++;
                })
                if (count == 0) {
                    inputSelectAll.indeterminate = null;
                    inputSelectAll.checked = false;
                    alertModal('Ops...', 'Você precisa selecionar a informação antes de remove-la.');
                    deletarInformacaobtn.setAttribute('data-bs-target', '#alertModal');

                } else if (childrensCheckBox.length > count) {
                    inputSelectAll.indeterminate = true;
                    deletarInformacaobtn.setAttribute('data-bs-target', '#removerInformacao');
                }

                if (childrensCheckBox.length == count) {
                    inputSelectAll.indeterminate = null;
                    inputSelectAll.checked = true;
                    deletarInformacaobtn.setAttribute('data-bs-target', '#removerInformacao');

                }

            })
        })

        console.log(childrensCheckBox);
    }
}


function alertModal(title, body) {
    let modal = document.querySelector('#alertModal');
    let titleModal = modal.querySelector('.title');
    let bodyModal = modal.querySelector('.body');
    titleModal.innerHTML = title;
    bodyModal.innerHTML = body;

}





function ModalScript() {
    gerarInformacoesModal();
    inserirInformacaoModal();
    editarInformacaoModal();

    function editarInformacaoModal() {

        let ListopenModalInput = document.querySelectorAll('#btnOpenEditarModal'),
            inputInformacao = document.getElementById('editarInformacaoInput'),
            inputID = document.getElementById('editarInformacaoIDinput'),
            inputDataCriacao = document.getElementById('editarInformacaoDataCriacaoInput'),
            inputDataAtualizacao = document.getElementById('editarInformacaoDataAtualizacaoInput'),
            label = document.getElementById('editarInformacaoLabel'),
            salvarBtn = document.getElementById('editarInfoSaveBtn');

        ListopenModalInput.forEach((input) => {
            input.onclick = (event) => {
                let Element = event.target.parentElement.parentElement;
                inputInformacao.value = Element.querySelector('.informacao').innerHTML;
                document.querySelector('#informacaoEditarID').value = Element.querySelector('.id').innerHTML;
                inputID.value = Element.querySelector('.id').innerHTML;
                inputDataCriacao.value = Element.querySelector('.dataCriacao').innerHTML;
                inputDataAtualizacao.value = new Date().toLocaleString();
                returnAlertMessageInputs(inputInformacao, label, inputInformacao.value.length + ' / 100 caracteres');
                setInterval(() => {
                    inputDataAtualizacao.value = new Date().toLocaleString();

                }, 1000);

                inputInformacao.addEventListener('keyup', function (event) {

                    let maxLenght = 10;

                    if (event.target.value.length < maxLenght) {
                        returnAlertMessageInputs(inputInformacao, label, event.target.value.length + ' / 100 caracteres. Você precisa de no minimo ' + (maxLenght - event.target.value.length) + ' caracter(es).', true)
                        maxLenght = maxLenght - 1;
                        salvarBtn.classList.replace('btn-success', 'btn-danger');
                        salvarBtn.setAttribute('disabled', '');
                    } else {
                        returnAlertMessageInputs(inputInformacao, label, event.target.value.length + ' / 100 caracteres. Tudo certo, só clicar em salvar!', false)
                        salvarBtn.removeAttribute('disabled');
                        salvarBtn.classList.replace('btn-danger', 'btn-success');

                    }

                    let minLenght = 100;

                    if (event.target.value.length > minLenght) {
                        returnAlertMessageInputs(inputInformacao, label, event.target.value.length + ' / 100 caracteres. Você precisa apagar: ' + (event.target.value.length - minLenght) + ' caracteres.', true)
                        maxLenght = maxLenght - 1;
                        salvarBtn.setAttribute('disabled', '');
                        salvarBtn.classList.replace('btn-success', 'btn-danger');

                    }
                })

            }
        });


    }


    function inserirInformacaoModal() {
        let input = document.getElementById('inputInserirNovaInformacao');
        let label = document.getElementById('labelInserirNovaInformacao');
        let salvarBtn = document.getElementById('inserirInfoSaveBtn')
        const myModalEl = document.getElementById('inserirInformacaoModal')
        myModalEl.addEventListener('hidden.bs.modal', event => {
            input.value = '';
            label.innerHTML = '';
        })
        input.addEventListener('keyup', function (event) {

            let maxLenght = 10;

            if (event.target.value.length < maxLenght) {
                returnAlertMessageInputs(input, label, event.target.value.length + ' / 100 caracteres. Você precisa de no minimo ' + (maxLenght - event.target.value.length) + ' caracter(es).', true)
                maxLenght = maxLenght - 1;
                salvarBtn.classList.replace('btn-success', 'btn-danger');
                salvarBtn.setAttribute('disabled', '');
            } else {
                returnAlertMessageInputs(input, label, event.target.value.length + ' / 100 caracteres. Tudo certo, só clicar em salvar!', false)
                salvarBtn.removeAttribute('disabled');
                salvarBtn.classList.replace('btn-danger', 'btn-success');

            }

            let minLenght = 100;

            if (event.target.value.length > minLenght) {
                returnAlertMessageInputs(input, label, event.target.value.length + ' / 100 caracteres. Você precisa apagar: ' + (event.target.value.length - minLenght) + ' caracteres.', true)
                maxLenght = maxLenght - 1;
                salvarBtn.setAttribute('disabled', '');
                salvarBtn.classList.replace('btn-success', 'btn-danger');

            }
        })
    }
    function gerarInformacoesModal() {

        let input = document.getElementById('inputGerarInfo');
        let label = document.getElementById('labelGerarInfo');
        let salvarBtn = document.getElementById('gerarInfoBtn')
        const myModalEl = document.getElementById('gerarInfoModal')
        myModalEl.addEventListener('hidden.bs.modal', event => {
            input.value = '';
            label.innerHTML = '';
        })
        input.classList.remove('is-invalid');

        input.addEventListener('keyup', function (event) {
            let regexOnlyNumbers = /\D/g;

            if (event.target.value.match(regexOnlyNumbers)) {
                returnAlertMessageInputs(input, label, 'Esse campo aceita apenas numeros', true)
                this.value = this.value.replace(regexOnlyNumbers, '');
                return;
            }

            if (this.value.length == 0) {
                returnAlertMessageInputs(input, label, 'Esse campo é preciso ter ao menos um caracter numérico.', true)
                salvarBtn.setAttribute('disabled', '');

            } else if (this.value.length > 0 && this.value.length <= 2) {
                returnAlertMessageInputs(input, label, 'Tudo certo, só clicar em gerar!', false)
                salvarBtn.removeAttribute('disabled');

            } else if (this.value.length > 2) {
                this.value = this.value.substring(0, this.value.length - 1);
                returnAlertMessageInputs(input, label, 'Esse campo tem que ter até 2 números.', true)
                salvarBtn.removeAttribute('disabled');
            }

        })
    }


}

function returnAlertMessageInputs(input, label, message, isInvalid) {
    let listLabelValidator = { true: 'invalid-feedback', false: 'valid-feedback' };
    let listInputValidator = { true: 'is-invalid', false: 'is-valid' }
    input.classList.remove(listInputValidator[!isInvalid]);
    input.classList.add(listInputValidator[isInvalid]);
    label.classList.remove(listLabelValidator[!isInvalid]);
    label.classList.add(listLabelValidator[isInvalid]);
    label.innerHTML = message;
}
