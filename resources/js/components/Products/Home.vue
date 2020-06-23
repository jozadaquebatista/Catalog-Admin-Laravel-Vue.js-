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
                      <v-icon :color="product.pictures.length ? 'blue-grey darken-2' : 'pink accent-3'">{{product.pictures.length > 0 ? 'mdi-image' : 'mdi-image-off'}}</v-icon>
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
                      <v-switch v-else v-model="product.status" :disabled="Number(product.status) !== 0"></v-switch>
                    </td>
                    <!-- if admin -->
                    <td>
                      <v-chip :color="status[Number(product.status)].color" dark>{{status[Number(product.status)].text}}</v-chip>
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
            status: {
              0: { text: 'pendente', color: 'amber' },
              1: { text: 'em análise', color: 'blue-grey darken-2' },
              2: { text: 'aprovado', color: 'green' },
              3: { text: 'reprovado', color: 'pink accent-3' },
            },
            form: {
              headers: {
                'content-type': 'application/json'
              },
              endpoint: null,
              payload: {}
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
          for(let product of this.products)
          {
            if(Number(product.id) === Number(payload.id))
            {
              product.status = payload.status;
              this.form.payload.status = payload.status;
              this.form.payload.name = payload.name;
            }
          }
        }

        if(this.authenticated && !Number(this.user.admin))
        {
          this.products = this.products.map(item => {

            if(Number(item.id) === Number(payload.id))
            {
              item.status = 1;
              this.form.payload.status = item.status;
              this.form.payload.name = payload.name;
            }

            return item;
          }); 
        }

        axios.put(this.form.endpoint, this.form.payload).then(response => {
          console.log(response.status);
        }).catch(error => {
            console.error('Não foi possível salvar o produto - ', error.toString());
        });
      }
    },
  }
</script> 

<style scoped>
  .actions button {
    margin: 0 5px;
    color: #444;
  }

  .actions button:hover {
    color: #aa4;
  }
  
</style>