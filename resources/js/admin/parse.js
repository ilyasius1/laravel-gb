import axios from "axios";
export default {
    form: document.forms["parseForm"],
    formGroupNode: document.querySelector(".form-group-2").cloneNode(true),
    currentType: 'news',
    parseData: function(e) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        //const form = document.forms["parseForm"];
        e.preventDefault();
        const formData = new FormData(this.form);
        let url = `/admin/parser`;
        const data = {};
        data.type = formData.get('type');
        if(data.type === 'news') {
            data.source = formData.get('source')
        }
        console.dir(data);
        console.log(this.currentType);
        axios.post(url, {
            headers: {
                'X-CSRF-TOKEN': token
            },
            data
        })
            .then((response) => {
                console.log(response.data);
            })
            .catch((e) => {
                console.log(e);
            });
    },
    formSubmitHandler: function (e) {

    },
    radioInputChangeHandler:  function (e) {
        this.currentType = e.target.value;
        if(this.currentType === 'news' && !this.form.elements['source']){
            this.formGroup = this.form.insertBefore(this.formGroupNode.cloneNode(true), this.form.querySelector('br'));
        } else {
            this.form.removeChild(this.formGroup);
        }
        // console.log(this.currentType);
    },
    addListeners: function () {
        // const form = document.forms["parseForm"];
        // this.button.addEventListener('click', this.parseData);
        this.radioInputs.forEach(function (input) {
            input.addEventListener('change', this.radioInputChangeHandler.bind(this) )
        }, this);
       // this.form.addEventListener('submit', this.parseData.bind(this));
    },
    init: function (){
        this.radioInputs = this.form.elements['type'];
        this.formGroup = this.form.querySelector('.form-group-2');
        this.button = this.form.querySelector('button');
        this.addListeners();
    }
}
