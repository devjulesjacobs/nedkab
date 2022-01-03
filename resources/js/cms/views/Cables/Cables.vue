<template>
    <div class="state-cables">
        <h1 class="text-3xl page-title leading-8 font-bold tracking-tight text-gray-900 mb-8">Kabels</h1>

        <form @submit.prevent="importCables" method="post" enctype="multipart/form-data">
            <label for="fileSelect" class="block mb-3">Excel bestand uploaden om te importeren</label>
            <input id="fileSelect" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />

            <button type="submit">Importeren</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Cables",

        methods: {
            importCables() {
                let excelFile = document.querySelector('#fileSelect');
                let formData = new FormData;

                console.log(excelFile.files[0]);

                formData.append("fileToImport", excelFile.files[0])

                axios.post('/api/cms/cables/import', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(res => { console.log(res) }).catch(err => { console.log(err) })

            }
        }
    }
</script>

<style scoped>

</style>
