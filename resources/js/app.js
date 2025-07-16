/**
 * Carga de dependencias
 */
import './bootstrap';
import { createApp } from 'vue';

/**
 * Crea la instancia de Vue
 */
const app = createApp({});

/**
 * Componentes Vue manuales
 */
import ExampleComponent from './components/ExampleComponent.vue';
import RegistroWizard from './components/RegistroWizard.vue';

app.component('example-component', ExampleComponent);
app.component('registro-wizard', RegistroWizard);

/**
 * Registro automático de componentes (opcional)
 * Puedes eliminar este bloque si no lo necesitas
 */
Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
    const name = path.split('/').pop().replace(/\.\w+$/, '');
    app.component(name, definition.default);
});

/**
 * Monta Vue en #app
 */
app.mount('#app');
