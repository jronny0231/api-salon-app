<?php
    namespace App\Modelos\ORM;

    use Exception;
    use App\Modelos\DB\Conexion;
    use PDO;

    class DB extends Conexion {

        protected $tabla = null;
        protected $sql = null;
        protected $selects = "";
        protected $wheres = "";
        protected $joins = "";

        protected $dbName = "salon_app";

        public function __construct($tabla){
            parent::__construct($this->dbName);
            $this->tabla = $tabla;
        }

        /**
         * Methodo principal static table
         * @param string table name in database.
         * @return instance of class indexing table collection.
         */
        /*
        public static function tabla(string $tabla) {
            if(!isset($instance)){
                $instance = new DB();
                $instance->tabla = $tabla;
                return $instance;
            }
            return;
        }

        /**
         * >> Metodos primarios CRUD
         * CREATE[insert(@)] => @param objData as array, @return Id_new_registry as int. 
         * UPDATE[update(@)] => @param objData as array, @return rows_affected as int.
         * READ[get()] => @return data as JSON Object.
         * DELETE[delete()] => @return rows_affected as int. 
         * 
         * >> Metodos secundarios CRUD
         * select(@) => SET FIELDS OF TABLE TO GET, @param selects as str like 'tabla.llave, tabla.llave2, tabla2.llave ...'
         * Where(@,@,@) => CONCAT WITH AND, @param llave as str, @param operador as str, @param valor as elseone.
         * orWhere(@,@) => CONCAT WITH OR, @param llave as str, @param operador as str, @param valor as elseone.
         * join(@,@,@,@); leftJoin(@,@,@,@); rightJoin(@,@,@,@) => JOIN TABLES, @param tabla as str foreign table, @param primaryKey as str like 'tabla.llave', @param operador as str, @param foreignKey as str llave of foreign table. 
         * 
         * >> Metodos finales CRUD
         * do() => @return id as int of row afected.
         */

        /**
         * Metodo get para obtener datos de la tabla
         * @return colection as array, can be used with limiters: where/orWhere and joins/leftJoin/rightJoin.
         */
        public function get(){
            try {
                $this->selects = ($this->selects == "") ? "*" : $this->selects;
                $this->sql = "SELECT {$this->selects} FROM {$this->tabla} {$this->joins} {$this->wheres}";
                $sth = $this->conexion->prepare($this->sql);
                $sth->execute();
                return $sth->fetchAll(PDO::FETCH_OBJ);

            } catch (Exception $exc) {
                throw new Exception("Error en el metodo get() " . $exc->getMessage());
            }
        }
    
        public function first(){
            $lista = (Array) $this->get();
            if (count($lista) > 0) {
                return $lista[0];
            } else {
                return null;
            }
        }

        /**
         * Metodo insert para registrar nuevos datos a la tabla
         * @param objData as array, @return Id_new_registry as int. 
         */
        public function insert(array $objData){
            try {
                $campos = implode("`, `", array_keys($objData)); //`key1`, `key2`, ... `keys`
                $valores = ":" . implode(", :", array_keys($objData)); // :key1, :key2, ... :keys
                $this->sql = "INSERT INTO {$this->tabla} (`{$campos}`) VALUES ({$valores})";
                $this->do($objData);
                $id = $this->conexion->lastInsertId();
                return $id;

            } catch (Exception $exc) {
                throw new Exception("Error en el metodo insert() " . $exc->getMessage());
            }
        }

        /**
         * Metodo update para actualizar datos de la tabla
         * @param objData as array, @return filasAfectadas as int, require where() limiters before this.
         */
        public function update(array $objData){
            try {
                $campos = "";
                foreach ($objData as $llave => $valor) {
                    $campos .= "`$llave`=:$llave,"; // key1=:key1, key2=:key2, ... keys=:keys
                }
                $campos = rtrim($campos, ",");
                $this->sql = "UPDATE {$this->tabla} SET {$campos} {$this->wheres}";
                $filasAfectadas = $this->do($objData);
                return $filasAfectadas;
            } catch (Exception $exc) {
                throw new Exception("Error en el metodo update() " . $exc->getMessage());
            }
        }

        /**
         * Metodo delete para eliminar datos de la tabla
         * @return rows_affected as int., require where() limiters before this.
         */
        public function delete(){
            try {
                $this->sql = "DELETE FROM {$this->tabla} {$this->wheres} ";
                return $this->do();
            } catch (Exception $exc) {
                throw new Exception("Error en el metodo delete() " . $exc->getMessage());
            }
        }

        public function select(String $selects){
            $this->selects = $selects;
            return $this;
        }

        /**
         * Metodo secundario para setear los limitadores wheres
         * CONCAT WITH AND, @param llave as str, @param operador as str, @param valor as elseone.
         */
        public function where(String $llave, String $operador, $valor){
            $this->wheres .= (strpos($this->wheres, "WHERE")) ? " AND " : " WHERE ";
            $valor = ($operador == "LIKE") ? "%$valor%" : $valor;

            $this->wheres .= "$llave $operador " . ((is_string($valor)) ? "\"$valor\"" : $valor) . " "; 
            return $this;
        }

        /**
         * Metodo secundario para setear los limitadores wheres
         * CONCAT WITH OR, @param llave as str, @param operador as str, @param valor as elseone.
         */
        public function orWhere(String $llave, String $operador, $valor){
            $this->wheres .= (strpos($this->wheres, "WHERE")) ? " OR " : " WHERE ";
            $valor = ($operador == "LIKE") ? "%$valor%" : $valor;
            
            $this->wheres .= "`$llave` $operador " . ((is_string($valor)) ? "\"$valor\"" : $valor) . " "; 
            return $this;
        }

        public function join(String $tabla, String $primaryKey, String $operador, $foreignKey) {
            $this->joins .= "INNER JOIN {$tabla} ON {$primaryKey} {$operador} {$foreignKey} ";
            return $this;
        }

        public function leftJoin(String $tabla, String $primaryKey = "", String $operador = "", $foreignKey = "") {
            $this->joins .= "LEFT JOIN {$tabla} ON {$primaryKey} {$operador} {$foreignKey} ";
            return $this;
        }

        public function rightJoin(String $tabla, String $primaryKey, String $operador, $foreignKey) {
            $this->joins .= "RIGHT JOIN {$tabla} ON {$primaryKey} {$operador} {$foreignKey} ";
            return $this;
        }



        private function do(array $obj = null){
            $sth = $this->conexion->prepare($this->sql);
            if($obj !== null){
                foreach ($obj as $llave => $valor) {
                    if(empty($valor)) {
                        $valor = NULL;
                    }
                    $sth->bindValue(":$llave", $valor);
                }
            }
            $sth->execute();
            return $sth->rowCount();
        }
    }
?>