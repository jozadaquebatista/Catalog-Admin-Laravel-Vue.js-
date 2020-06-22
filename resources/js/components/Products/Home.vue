<!-- paginacao --> 
<template>
  <div>
    <v-row class="fill-height">
      <v-col sm="10" offset-sm="1">

        <v-text-field v-model="search"
          :counter="50"
          label='Digite para Pesquisar'
          prepend-inner-icon='mdi-magnify'
          solo
          required
        ></v-text-field>

        <!--card tabela de produtos -->
        <v-card>
          <v-card-text>
            <v-simple-table>
              <template v-slot:default>
                <thead>
                  <tr>
                    <th>Imagem</th>
                    <th>Produto</th>
                    <th>Avaliação</th>
                    <th>Status - Atual</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="product in filteredList">
                    <td>
                      <v-icon>{{product.pictures.length > 0 ? 'mdi-image' : 'mdi-image-off'}}</v-icon>
                    </td>
                    <td>
                      {{product.name}}
                    </td>
                    <!-- if admin -->
                    <td v-if="Number(user.admin)">
                      <v-radio-group row @change="productStatus(product)" v-model="product.status">
                        <v-radio label="Aprovar" value="2"></v-radio>
                        <v-radio label="Reprovar" value="3"></v-radio>
                      </v-radio-group>
                    </td>
                    <td v-else>
                      <v-switch v-if="Number(product.status) === 0" value='0' @change="productStatus(product)"></v-switch>
                      <v-switch v-else value='1' disabled></v-switch>
                    </td>
                    <td>
                      <span v-if="Number(product.status) === 0">
                        <v-chip color="orange" dark>pendente</v-chip>
                      </span>

                      <span v-if="Number(product.status) === 1">
                        <v-chip color="blue" dark>em análise</v-chip>
                      </span>

                      <span v-if="Number(product.status) === 2">
                        <v-chip color="green" dark>aprovado</v-chip>
                      </span>

                      <span v-if="Number(product.status) === 3">
                        <v-chip color="red" dark>reprovado</v-chip>
                      </span>
                    </td>
                    <!-- if admin -->
                    <td class="actions">
                      <span class="edit">
                      <v-icon @click="edit(product.id)">mdi-circle-edit-outline</v-icon>
                    </span>
                      <v-icon @click="remove(product.id)" class="delete">mdi-delete-circle</v-icon>
                    </td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
          </v-card-text>
        </v-card>
        <!--card tabela de produtos -->
      </v-col>
    </v-row>

    <!-- paginacao -->
    <div class="text-center">
      <v-pagination
        v-model="page"
        :length="10"
        :total-visible="7"
      ></v-pagination>
    </div>
    <!-- paginacao -->
  </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'

  export default {
      data() {
        return {
            vswitch: {
              enabled: true,
              disabled: false,
            },
            status: {
              '0': 'pendente',
              '1': 'em análise',
              '2': 'aprovado',
              '3': 'reprovado',
            },
            form: {
              status: null,

            },
            search: '',
            products: [],
            page: 1,
            itemsPerPage: 8,
        }
    },
    mounted() {
        this.show();
    },
    computed: {
      ...mapGetters({
          authenticated: 'authenticated',
          user: 'user',
      }),
      filteredList()
      {
        return (this.search.length < 1) ? this.products : this.products.filter(item => item.name.indexOf(this.search) > -1);
      }
    },
    methods: {
        show() {
            axios.get('api/v1/products').then(response => {
                this.products = response.data.data;
                console.warn(response);
            }).catch(error => {
                console.error(error);
            });
        },
        edit: function(id) {
            this.$router.push({name: 'products.edit', params: { id: id }});
        },
        remove(id) {
            axios.delete(`api/v1/products/${id}`).then(response => {
                console.log(response.data);
                this.show();
            }).catch(error => {
                console.error(error);
            });
        },
        productStatus(payload) {

          this.form.endpoint = `/api/v1/products${payload.id ? `/${payload.id}` : ''}`;

          if(this.authenticated && Number(this.user.admin))
          {
            this.products.forEach(product => {
              if(Number(product.id) === Number(payload.id))
              {
                // product.status = 2;
                console.warn('produto encontrado! mandando atualização.');
                console.log(payload);
                // axios.post().then(response => null).catch(error => null);
              }
            });
          }

          if(this.authenticated && !Number(this.user.admin))
          {
            this.products = this.products.map(item => {

              if(Number(item.id) === Number(payload.id))
              {
                item.status = 1;
                console.warn('produto encontrado! mandando atualização.');
                console.log(payload);
                // axios.post().then(response => null).catch(error => null);
              }

              return item;
            }); 
          }

          let payload = new FormData();

          payload.append('_method', 'PUT');
          payload.append('name', this.product.name);
          payload.append('status', this.status);

          axios.post(this.form.endpoint, payload, {
              headers: {
                  'content-type': 'application/json'
              }
          }).then(response => {
              console.log(response.response.status);
              this.$router.push({name: 'products.edit', params: { id: id }});
          }).catch(error => {
              console.error('Não foi possível salvar o produto', error.toString());
          });
        },
    },
  }
</script>

<style scoped>
  .actions button {
    background: #fff;
    padding: 0 5px;
    border:  1px solid #ddd;
    border-radius: 5px;
    margin: 0 3px;
    color: #555;
  }

  .actions button:first-child {
    color: #088675;
  }

  .actions button:nth-child(2) {
    color: #f33409;
  }

  .actions button:hover {
    background: #eee;
  }
  
</style>