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
                if (count == 0) {
                    inputSelectAll.indeterminate = null;
                    inputSelectAll.checked = false;
                } else if (childrensCheckBox.length > count)
                    inputSelectAll.indeterminate = true;

                if (childrensCheckBox.length == count) {
                    inputSelectAll.indeterminate = null;
                    inputSelectAll.checked = true;
                }
            })
        })
    }
    function selectAllBtnCheckBox() {
        let childrensCheckBox = document.querySelectorAll('.form-check-input.children');
        let inputSelectAll = document.querySelector('#selectAllCheck');
        let todosSelecionados;
        childrensCheckBox.forEach((children)=>{
            children.checked = false;
            inputSelectAll.indeterminate = null;
            inputSelectAll.checked = false;
        })
        if (inputSelectAll.indeterminate === true)
            todosSelecionados = false;
        else
            todosSelecionados = inputSelectAll.checked

        inputSelectAll.onclick = function () {
            childrensCheckBox.forEach(function (item) {
                if (todosSelecionados === false) {
                    item.checked = true;
                } else {
                    item.checked = false;
                }
            })
            if (todosSelecionados === false)
                todosSelecionados = true;
            else
                todosSelecionados = false;
        }

        childrensCheckBox.forEach(function (item) {
            item.addEventListener('click', function(){
                if(this.checked === true)
                this.checked = false;
                else
                this.checked = true;
            })
            item.addEventListener('change', function () {

                count = 0;
                childrensCheckBox.forEach((item1) => {
                    if (item1.checked === true)
                        count++;
                })
                if (count == 0) {
                    inputSelectAll.indeterminate = null;
                    inputSelectAll.checked = false;
                } else if (childrensCheckBox.length > count)
                    inputSelectAll.indeterminate = true;
                else if (childrensCheckBox.length == count) {
                    inputSelectAll.indeterminate = null;
                    inputSelectAll.checked = true;
                }
            })
        })

        console.log(childrensCheckBox);
    }
}







function ModalScript() {
    gerarInformacoesModal();

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
