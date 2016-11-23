<?php
class productos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    //métodos de consulta a la base de datos
    //los que van a utilizar el
    //active record
    public function getTodosPaginacion($pagina,$porpagina,$quehago)
    {
        switch($quehago)
        {
            case 'limit':
                $query=$this->db
                        ->select("id,nombre,precio,stock,fecha")
                        ->from("productos")
                        ->limit($porpagina,$pagina)
                        ->order_by("id","desc")
                        ->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
                        ->select("id,nombre,precio,stock,fecha")
                        ->from("productos")
                        ->count_all_results();
                return $query;
            break;
        }
    }
    public function getTodos()
    {
        $query=$this->db
                ->select("id,nombre,precio,stock,fecha")
                ->from("productos")
                ->order_by("id","desc")
                ->get();
        //echo $this->db->last_query();exit;        
        return $query->result();            
    }
    public function getTodosPorId($id)
    {
        $query=$this->db
                ->select("id,nombre,precio,stock,fecha")
                ->from("productos")
                ->where(array("id"=>$id))
                ->get();
        //echo $this->db->last_query();exit;        
        return $query->row();            
    }
    public function getFotosProductos($id)
    {
        $query=$this->db
                ->select("id,id_producto,foto")
                ->from("productos_fotos")
                ->where(array("id_producto"=>$id))
                ->get();
        //echo $this->db->last_query();exit;        
        return $query->result();            
    }
    public function insertar($data=array())
    {
        $this->db->insert('productos',$data);
        return $this->db->insert_id();
    }
    
    public function update($data=array(),$id)
    {
        $this->db->where('id',$id);
        $this->db->update('productos',$data);
    }
    public function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('productos');
    }
    /**
     * fotos
     * */
    public function getFotosPorId($id)
    {
        $query=$this->db
                ->select("*")
                ->from("productos_fotos")
                ->where(array("id"=>$id))
                ->get();
        //echo $this->db->last_query();exit;        
        return $query->row();            
    } 
    public function insertarFoto($data=array())
    {
        $this->db->insert('productos_fotos',$data);
        return $this->db->insert_id();
    }
    public function updateFoto($data=array(),$id)
    {
        $this->db->where('id',$id);
        $this->db->update('productos_fotos',$data);
    }
    public function deleteFoto($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('productos_fotos');
    }
}

