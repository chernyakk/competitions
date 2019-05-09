<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Панель Управления</div>

                    <div class="card-body">
                        <button class="btn btn-success" v-on:click="createContest">Создать соревнование</button>
                        <button class="btn btn-success" v-on:click="listContest">Список соревнований</button>
                        <button class="btn btn-success" v-on:click="configuration">Настройка</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            createContest: function (event) {
                window.location = '/contest/create';
            },
            listContest: function (event) {
                window.location = '/contest';
            },
            configuration: function (event) {
                window.location = '/configuration';
            }

        }
    }
</script>
