import axios from "axios";
export default {
    deleteResource: async function (e) {
        e.preventDefault();
        const token = e.target.querySelector("input[name=_token]").value
        const id = e.target.dataset.id;
        const resource = e.target.dataset.resource;
        let url = `http://laravel.local:8000/admin/${resource}/${id}`;
        axios.delete(url, {
            method: "delete",
            headers: {
                'CSRF-TOKEN': token
            }
        })
            .then((response) => {
                location.href = response.data.lastPage;
            })
            .catch((e) => {
                console.log(e)
            })
    },
    addListeners: function () {
        document.querySelectorAll('button[name=delete]')?.forEach(e => {
            e.addEventListener('click', this.deleteResource)
        });
    }
}
