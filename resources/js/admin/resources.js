import axios from "axios";
export default {
    deleteResource: async function (e) {
        e.preventDefault();
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        const id = e.target.dataset.id;
        const resource = e.target.dataset.resource;
        let url = `/admin/${resource}/${id}`;
        if(confirm(`Удалить запись с ID ${id}?`)) {
            axios.delete(url, {
                method: "delete",
                headers: {
                    'X-CSRF-TOKEN': token
                }
            })
                .then((response) => {
                    location.href = response.data.lastPage;
                })
                .catch((e) => {
                    console.log(e)
                })
        } else {
            alert('Удаление отменено');
        }
    },
    addListeners: function () {
        document.querySelectorAll('button[name=delete]')?.forEach(e => {
            e.addEventListener('click', this.deleteResource)
        });
    }
}
