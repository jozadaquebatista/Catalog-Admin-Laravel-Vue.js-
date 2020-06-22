<template>
    <div>
        <sidebar></sidebar>
        <input type="" placeholder="Title"/><br>
        <input type="" placeholder="Content"/><br>
        <input @click="insert" type="button" value="Insert"/>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                form: {
                    title: '',
                    content: ''
                }
            }
        },
        mounted() {
            if(this.$route.params.id)
            {
                this.edit(this.$route.params.id);
            }
        },
        methods: {
            insert() {
                if(this.form.title && this.form.content)
                {
                    axios.post('announcements', form).then(response => {
                        console.warn(response);
                    }).catch(error => {
                        console.error(error);
                    });
                } else {
                    alert('preencha o formulário.');
                }
            },
            edit(id) {
                axios.get('announcements/' + id).then(response => {
                    console.warn(response);
                }).catch(error => {
                    console.error(error);
                });
            }
        }
    }
</script>

<style scoped>
    table {
        margin: 0 auto;
        width: 80%;
        border-collapse: collapse;
        border: 1px solid #111;
        box-shadow: 0 0 20px 0px #d2d2d2;
        text-align: center;
    }
</style>
