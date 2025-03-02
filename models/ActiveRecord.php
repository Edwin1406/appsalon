<?php
namespace Model;
class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Alertas y Mensajes
    protected static $alertas = [];
    
    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    // Registros - CRUD
    public function guardar() {
        $resultado = '';
        if(!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    // Todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function allDesc($orden = 'DESC') {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id {$orden}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    
    
    protected static function consultarSQL5($query) {
        $resultado = self::$db->query($query);
        $array = [];
        while ($row = $resultado->fetch_assoc()) { // ✅ Devuelve arrays asociativos
            $array[] = $row;
        }
        return $array;
    }
    
    


    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

     // Busca un registro por su id
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla  . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);//array_shift para que no devuelva un el primer elemento de un array
    }


    public static function contarDonde($campo1, $valor1, $campo2, $valor2) {
        $query = "SELECT COUNT(*) as total FROM citas WHERE $campo1 = ? AND $campo2 = ?";
        $stmt = self::$db->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param("ss", $valor1, $valor2); // Si los valores son strings, usa "ss". Si hay enteros, ajusta el tipo.
            $stmt->execute();
            $resultado = $stmt->get_result()->fetch_assoc();
            return $resultado['total'] ?? 0;
        }
        
        return 0; // Retornar 0 en caso de error
    }
    


// 
// public static function whereAgenda($columna, $valor) {
//     $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = ?";
//     $parametros = [$valor];

//     $resultado = self::consultarSQL($query, $parametros);
//     return array_shift($resultado); // Devuelve el primer resultado o NULL si no hay coincidencias
// }

public static function whereAgenda($columna1, $valor1, $columna2 = null, $valor2 = null) {
    $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna1} = ?";
    $parametros = [$valor1];

    if ($columna2 && $valor2) {
        $query .= " AND {$columna2} = ?";
        $parametros[] = $valor2;
    }

    // Conectar a la base de datos
    $conexion = self::$db->prepare($query);

    // Definir los tipos de parámetros dinámicamente
    $tipos = str_repeat('s', count($parametros)); // 's' para string, 'i' para integer si fuera necesario

    // Hacer bind de los parámetros
    $conexion->bind_param($tipos, ...$parametros);

    // Ejecutar la consulta
    $conexion->execute();
    $resultado = $conexion->get_result()->fetch_all(MYSQLI_ASSOC);

    return array_shift($resultado); // Devuelve el primer resultado o NULL si no hay coincidencias
}





    
    // consulta plana utilizar cuando los metodos no son suficientes para la consulta
    public static function SQL($query) {
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    

    // Obtener Registros con cierta cantidad
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // crea un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        // postman de la consulta para ver que se esta enviando
        // return json_encode(['query' => $query]);

        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
           'resultado' =>  $resultado,
           'id' => self::$db->insert_id
        ];
    }

    // Actualizar el registro
    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }
    protected function eliminarDependientes() {
        // Solo ejecutar si la tabla actual es 'citas'
        if (static::$tabla === 'citas') {
            $query = "DELETE FROM citasservicios WHERE citaId = " . self::$db->escape_string($this->id);
            self::$db->query($query);
        }
    }
    
    // Eliminar Cita
    public function eliminarCita() {
        $this->eliminarDependientes();
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }
    // Eliminar un Registro por su ID
    public function eliminar() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

}