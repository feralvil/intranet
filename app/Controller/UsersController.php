<?php
/**
 * Controlador de la Clase User
 *
 * @author alfonso_fer
 */
class UsersController extends AppController {

    // Opciones de paginación por defecto:
    public $paginate = array(
        'limit' => 30,
        'order' => array('User.apellido1' => 'asc','User.apellido2' => 'asc','User.nombre' => 'asc')
    );

    public function index() {
        // Fijamos el título de la vista
        $this->set('title_for_layout', __('Usuarios de la Intranet COMDES'));

        // Array de condiciones para la búsqueda:
        $condiciones = array();
        // Comprobamos si hemos recibido datos del formulario:
        if ($this->request->is('post')) {
            // Condiciones iniciales:
            $tampag = 30;
            $pagina = 1;

            // Condición para elegir un usuario
            if (!empty($this->request->data['User']['usersel'])) {
                $addcond = array('User.id' => $this->request->data['User']['usersel']);
                $condiciones = array_merge($addcond, $condiciones);
            }
            // Condición para elegir un tipo de usuario
            if (!empty($this->request->data['User']['role'])) {
                $addcond = array('User.role' => $this->request->data['User']['role']);
                $condiciones = array_merge($addcond, $condiciones);
            }
            // Cambio de página
            if (!empty($this->request->data['User']['irapag']) && ($this->request->data['User']['irapag'] > 0)) {
                $this->paginate['page'] = $this->request->data['User']['irapag'];
            }
            // Tamaño de página
            if (!empty($this->request->data['User']['regPag']) && ($this->request->data['User']['regPag'] > 0)) {
                $this->paginate['limit'] = $this->request->data['User']['regPag'];
            }
        }
        $this->User->recursive = 0;
        $this->paginate['conditions'] = $condiciones;
        $this->set('users', $this->paginate());
    }
}
?>
