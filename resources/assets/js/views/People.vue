<template>
        <div class="row justify-content-center">
                <div class="card card-default">
                  <div class="card-header">People
                    <button style="float: right;" class="btn btn-square btn-success" @click="NewPeople()" type="button"><i class="fa fa-plus fa-1x"></i> Nueva Persona</button>
                    </div>

                <vue-good-table
                        :columns="columns"
                        :rows="DataRow"
                        :searchOptions="{
                          enabled: true,
                          placeholder: 'Busqueda Global',
                        }"
                        :sort-options="{
                              enabled: true,
                              initialSortBy: [
                                {field: 'nombre', type: 'asc'},
                              ],
                            }"
                        :pagination-options="{
                          enabled: true,
                          nextLabel: 'Siguiente',
                          prevLabel: 'Anterior',
                          rowsPerPageLabel: 'Paginas',
                          ofLabel: 'de',
                          perPage: 10,
                        }"
                      styleClass="table table-bordered">
                      <template slot="table-row" slot-scope="props">
                        <div v-if="props.column.field == 'id'">
                          {{props.row.id}}
                        </div>
                        <div v-if="props.column.field == 'nombre'">
                          {{props.row.nombre}}
                        </div>
                        <div v-if="props.column.field == 'correo'">
                          {{props.row.correo}}
                        </div>
                        <div v-if="props.column.field == 'cedula'">
                          {{props.row.cedula}}
                        </div>
                        <div v-if="props.column.field == 'cargo'">
                          {{props.row.cargo}}
                        </div>
                        <div v-if="props.column.label == 'Action'">
                          <button class="btn btn-square btn-secondary" type="button"  @click="ShowPeople(props.row)"><i class="fa fa-pencil"></i> Editar</button>
                          <button class="btn btn-square btn-danger" type="button"  @click="removePeople(props.row)"><i class="fa fa-minus-circle"></i> Eliminar</button>

                        </div>
                      </template>
                      </vue-good-table>
                      <modal name="ModalPeople"
                          transition="nice-modal-fade"
                          :adaptive="true"
                          :scrollable="true"
                          :reset="true"
                          width="80%"
                          height="auto"
                          :clickToClose="false">
                          <div class="container">
                            <br>
                            <button class="btn btn-square btn-danger" type="button"  @click="$modal.hide('ModalPeople')"><i class="fa fa-times"></i></button>
                          <br>
                           <ValidationObserver ref="observer" v-slot="{ passes }">
                          <div class="row">
                            <div class="form-group col-md-6">
                               <label for="inputUser">Nombre <i style="color:red;">*</i> </label>
                               <ValidationProvider rules="required|alpha|max:100" ref="People" v-slot="{ errors }">
                                 <input type="text" v-model="formPeople.nombre" name="nombre" class="form-control" placeholder="Nombre">
                                  <span class="badge badge-danger">{{ errors[0] }}</span>
                               </ValidationProvider>
                           </div>
                           <div class="form-group col-md-6">
                               <label >Correo <i style="color:red;">*</i></label>
                               <ValidationProvider rules="required|email" ref="Correo" v-slot="{ errors }">
                                 <input  name="correo" v-model="formPeople.correo" class="form-control" placeholder="Correo">
                                  <span class="badge badge-danger">{{ errors[0] }}</span>
                                </ValidationProvider>
                           </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-6">
                               <label for="inputUser">Cedula <i style="color:red;">*</i></label>
                               <ValidationProvider rules="required|numeric|max:6" ref="cedula" v-slot="{ errors }">
                                 <input :disabled="Edit" type="text" v-model="formPeople.cedula" name="cedula" class="form-control" placeholder="Cedula">
                                  <span class="badge badge-danger">{{ errors[0] }}</span>
                               </ValidationProvider>
                           </div>
                           <div class="form-group col-md-6">
                               <label >Cargo</label>
                               <select v-model="formPeople.cargo" class="form-control" placeholder="Cargo">
                                    <option value="Adminsitrador">Adminsitrador</option>
                                    <option value="No Definido">No Definido</option>
                                    <option value="Contador">Contador</option>
                                    <option value="Ingeniero">Ingeniero</option>
                                    <option value="Técnico">Técnico</option>
                                    <option value="Técnico">Soldador</option>
                                  </select>
                                 <!-- <input  name="correo" v-model="formPeople.cargo" class="form-control" placeholder="Cargo"> -->
                           </div>
                          </div>
                        </ValidationObserver>
                          <div class="form-group" style="float: right;">
                            <button v-show="!this.Edit" class="btn btn-square btn-success" @click="SavePeople()" type="button"><i class="fa fa-save fa-1x"></i></button>
                            <button v-show="this.Edit" class="btn btn-square btn-success" @click="UpdatePeople(IdPeople)" type="button"><i class="fa fa-refresh fa-1x"></i></button>
                         </div>
                        </form>
                      </div>
                      </modal>
                    </div>
      </div>
</template>
<script>
import { ValidationObserver, ValidationProvider, extend} from "vee-validate";
import { required, confirmed, length, email, alpha, max, numeric} from "vee-validate/dist/rules";

extend("required", {
  ...required,
  message: "Campo Requerido"
});

extend("email", {
  ...email,
  message: "Formato Correo Invalido"
});

extend("confirmed", {
  ...confirmed,
  message: "This field confirmation does not match"
});

extend("length", {
  ...length,
  message: "This field must have 2 options"
});
extend("alpha", {
  ...alpha,
  message: "Solo puede contener caracteres alfabéticos"
});
extend("max", {
  ...max,
  message: "No puede exceder la longitud especificada"
});
extend("numeric", {
  ...numeric,
  message: "Solo Numerico"
});

    export default {
      name: "People",
      components: {
         ValidationObserver,
         ValidationProvider
       },
      data(){
        return{
        DataRow: [],
        Edit: false,
        IdPeople: '',
        errors: [],
        columns: [
          {
            label: 'Id',
            field: 'id',
          },
          {
            label: 'Nombre',
            field: 'nombre',
          },
          {
            label: 'Correo',
            field: 'correo',
          },
          {
            label: 'Cedula',
            field: 'cedula',
          },
          {
            label: 'Cargo',
            field: 'cargo',
          },
          {
            label: 'Action',
            field: 'action',
          },
        ],
        formPeople: {
            nombre: '',
            correo: '',
            cedula: '',
            cargo: '',
        },

      }
    },
  mounted() {
            // console.log('Component mounted.')
            this.getData();
            // this.$modal.show('ModalPeople');
        },
methods: {
  getData(){
    axios.get('api/People')
    .then(response => {
      // console.log(response.data);
      this.DataRow = response.data;
    })
    .catch(error => {
      // console.log(error.response);
    })
  },
  NewPeople(){
    this.Edit = false;
    this.formPeople.nombre = '';
    this.formPeople.correo = '';
    this.formPeople.cedula = '';
    this.formPeople.cargo = '';
    this.$modal.show('ModalPeople');
  },
  SavePeople(){

      this.$fire({
        title: 'Deseas Guardar a '+ this.formPeople.nombre+' ?',
        text: "Si Aceptas tus Datos se Guardaran!",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar!',
        confirmButtonText: 'Guardar!'
      }).then((result) => {
        if (result.value) {
          this.$refs.observer.validate().then((dat) => {
            if (dat) {
          axios.post('api/People', this.formPeople)
          .then(response => {
          this.$fire({
            title: "Operación Exitosa",
            // position: 'top-end',
            showConfirmButton: false,
            text: "Sus datos se actualizaron",
            type: "success",
            timer: 1000
            }).then(r => {
            this.getData();
            this.$modal.hide('ModalPeople');
            this.formPeople.nombre = '';
            this.formPeople.correo = '';
            this.formPeople.cedula = '';
            this.formPeople.cargo = '';
            this.Edit = false;
          });
        })
        .catch(error => {
          this.$fire({
            title: "Error",
            // position: 'top-end',
            showConfirmButton: false,
            text: error.response.data.errors.cedula ? "Cedula Ya Existente" : error.response.data.errors,
            type: "warning",
            timer: 3000
            }).then(r => {
              // console.log(error.response.data.errors);
          });
        })
      }
     });
        }
      })

  },
  ShowPeople(data) {
    var valor = data.id
    axios.get('api/People/'+valor)
    .then(response => {
      this.Edit = true;
      this.$modal.show('ModalPeople');
      this.IdPeople = response.data.id
      this.formPeople.nombre = response.data.nombre
      this.formPeople.correo = response.data.correo
      this.formPeople.cedula = response.data.cedula
      this.formPeople.cargo = response.data.cargo
    })
    .catch(error => {
      console.log(error.response.data.errors);
    })
  },
  UpdatePeople(id) {

      this.$fire({
        title: 'Deseas Actualizar a ' + this.formPeople.nombre+ ' ?',
        text: "Si Aceptas tus Datos se Guardaran!",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar!',
        confirmButtonText: 'Actualizar!'
      }).then((result) => {
        if (result.value) {
          axios.put('api/People/'+id, this.formPeople)
          .then(response => {
          this.$fire({
            title: "Operación Exitosa",
            // position: 'top-end',
            showConfirmButton: false,
            text: "Sus datos se actualizaron",
            type: "success",
            timer: 1000
            }).then(r => {
            this.getData();
            this.$modal.hide('ModalPeople');
            this.formPeople.nombre = '';
            this.formPeople.correo = '';
            this.formPeople.cedula = '';
            this.formPeople.cargo = '';
            this.Edit = false;
          });
          })
          .catch(error => {
            console.log(error.response);
          })
        }
      })

  },
  removePeople(data) {
    this.$fire({
      title: 'Deseas Eliminar a '+ data.nombre +' ?',
      text: "Si Aceptas tus Datos se Eliminarán!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar!',
      confirmButtonText: 'Eliminar!'
    }).then((result) => {
      if (result.value) {
        axios.delete('api/People/'+data.id)
        .then(response => {
        this.$fire({
          title: "Operación Exitosa",
          // position: 'top-end',
          showConfirmButton: false,
          text: "Sus datos se Eliminarón",
          type: "success",
          timer: 1000
          }).then(r => {
          this.getData();
          this.$modal.hide('ModalPeople');
          this.formPeople.nombre = '';
          this.formPeople.correo = '';
          this.formPeople.cedula = '';
          this.formPeople.cargo = '';
          this.Edit = false;
        });
        })
        .catch(error => {
          console.log(error.response);
        })
      }
    })
  }
}
    }
</script>
