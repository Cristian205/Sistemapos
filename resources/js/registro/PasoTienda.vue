<template>
  <div class="form-step">
    <h2 class="title">Información de la Tienda</h2>

    <form @submit.prevent="continuar" class="form-grid">
      <div class="form-group">
        <label>Nombre de la Tienda</label>
        <input v-model="form.Nombre_tienda" type="text" required />
      </div>

      <div class="form-group">
        <label>Teléfono Corporativo</label>
        <input v-model="form.Telefono_corporativo" type="tel" required />
      </div>

      <div class="form-group">
        <label>Correo Corporativo</label>
        <input v-model="form.Correo_corporativo" type="email" required />
      </div>

      <div class="form-group">
        <label>Categoría de negocio</label>
        <select v-model="form.categoria_id" required>
          <option value="" disabled>Seleccione una categoría</option>
          <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
            {{ categoria.nombre }}
          </option>
        </select>
      </div>

      <div class="form-group">
        <label>Dirección Corporativa</label>
        <input v-model="form.Direccion_corporativa" type="text" required />
      </div>

      <div class="form-group">
        <label>NIT</label>
        <input v-model="form.NIT" type="text" required />
      </div>

      <div class="form-group">
        <label>Logo de la Tienda</label>
        <input type="file" @change="handleLogo" accept="image/*" />
      </div>

      <div class="form-group full">
        <label>Descripción Corporativa</label>
        <textarea v-model="form.Descripcion_corporativa" rows="3"></textarea>
      </div>

      

      <div class="actions">
        <button type="submit" class="btn-next">Siguiente</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'PasoTienda',
  emits: ['next', 'prev', 'update'],
  data() {
    return {
      categorias: [], // ← Aquí almacenaremos las categorías
      form: {
        Nombre_tienda: '',
        Telefono_corporativo: '',
        Correo_corporativo: '',
        Direccion_corporativa: '',
        NIT: '',
        Logo_tienda: null,
        Descripcion_corporativa: '',
        categoria_id: '',
      }
    };
  },
  mounted() {
    this.cargarCategorias();
  },
  methods: {
    async cargarCategorias() {
      try {
        const response = await axios.get('/categorias-negocio'); // asegúrate de que esta ruta sea correcta
        this.categorias = response.data;
      } catch (error) {
        console.error('Error cargando categorías:', error);
      }
    },
    continuar() {
      this.$emit('update', this.form);
      this.$emit('next');
    },
    handleLogo(event) {
      const file = event.target.files[0];
      this.form.Logo_tienda = file;
    }
  }
};

</script>

<style scoped>
.form-step {
  animation: fadeIn 0.4s ease-in-out;
  padding: 30px;
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}

.title {
  font-size: 1.8rem;
  margin-bottom: 30px;
  font-weight: 700;
  color: #1e293b;
  text-align: center;
}

.form-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 20px;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-group.full {
  grid-column: span 2;
}

label {
  font-size: 0.95rem;
  font-weight: 600;
  color: #334155;
  margin-bottom: 8px;
}

input,
textarea,
select {
  padding: 12px;
  border: 1px solid #cbd5e1;
  border-radius: 10px;
  background: #f8fafc;
  font-size: 1rem;
  color: #0f172a;
  transition: all 0.3s ease;
  font-family: inherit;
}

input:focus,
textarea:focus,
select:focus {
  outline: none;
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
}

input[type="file"] {
  padding: 10px;
  background-color: #fff;
  border-radius: 8px;
}

textarea {
  resize: none;
}

.actions {
  grid-column: span 2;
  display: flex;
  justify-content: flex-end;
  margin-top: 30px;
}

.btn-next {
  background: linear-gradient(to right, #3b82f6, #2563eb);
  color: #ffffff;
  padding: 12px 32px;
  font-size: 1rem;
  font-weight: 600;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-next:hover {
  background: linear-gradient(to right, #2563eb, #1d4ed8);
  transform: translateY(-1px);
  box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(12px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
