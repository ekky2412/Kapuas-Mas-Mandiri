<?php
class Database_model extends CI_Model
{
    public function getData($table, $where = false, $orderby = false)
    {
        if ($where) {
            if($orderby){
                return $this->db
                        ->order_by($orderby)
                        ->get_where($table, $where)
                        ->result_array();
            }
            else{
                return $this->db
                ->get_where($table, $where)
                ->result_array();
            }
        } 
        else {
            return $this->db
                ->get($table)
                ->result_array();
        }
    }

    public function getDataOB($id = false)
    {
        if (!$id) {
            return $this->db->join('penerima', 'orderbill.penerima = penerima.idPenerima', 'inner')
                ->join('pengirim', 'orderbill.pengirim = pengirim.idPengirim', 'inner')
                ->get('orderbill')
                ->result_array();
        }
        else{
            return $this->db->join('penerima', 'orderbill.penerima = penerima.idPenerima', 'inner')
                ->join('pengirim', 'orderbill.pengirim = pengirim.idPengirim', 'inner')
                ->get_where('orderbill',$id)
                ->row_array();
        }
    }

    public function cekSequence()
    {
        $query = "SELECT nextval(pg_get_serial_sequence('orderbill', 'serial'))";
        return $this->db->query($query)
            ->result_array();
    }

    public function tambahData($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function editData($id, $table, $data)
    {
        $this->db->where($id)
            ->update($table, $data);
    }

    public function deleteData($table, $id)
    {
        $this->db->where($id)
            ->delete($table);
    }
}
