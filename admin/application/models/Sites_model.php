<?php
class Sites_model extends CI_Model
{
	private $_table_name = 'sites';
	public function select($select = '*', $escape = NULL)
	{
		return $this->db->select($select,$escape);
	}
	public function select_max($select = '', $alias = '')
	{
		return $this->db->select_max($select, $alias);
	}
	public function select_min($select = '', $alias = '')
	{
		return $this->db->select_min($select, $alias);
	}
	public function select_avg($select = '', $alias = '')
	{
		return $this->db->select_avg($select, $alias);
	}
	public function select_sum($select = '', $alias = '')
	{
		return $this->db->select_sum($select, $alias);
	}
	public function distinct($val = TRUE)
	{
		return $this->db->distinct($val);
	}
	public function from()
	{
		return $this->db->from($this->_table_name);
	}
	public function join($table, $cond, $type = '', $escape = NULL)
	{
		return $this->db->join($table, $cond, $type, $escape);
	}
	public function where($key, $value = NULL, $escape = NULL)
	{
		return $this->db->where($key, $value, $escape);
	}
	public function or_where($key, $value = NULL, $escape = NULL)
	{
		return $this->db->or_where($key, $value, $escape);
	}
	public function where_in($key = NULL, $values = NULL, $escape = NULL)
	{
		return $this->db->where_in($key, $values, $escape);
	}
	public function or_where_in($key = NULL, $values = NULL, $escape = NULL)
	{
		return $this->db->or_where_in($key, $values, $escape);
	}
	public function where_not_in($key = NULL, $values = NULL, $escape = NULL)
	{
		return $this->db->where_not_in($key, $values, $escape);
	}
	public function or_where_not_in($key = NULL, $values = NULL, $escape = NULL)
	{
		return $this->db->or_where_not_in($key, $values, $escape);
	}
	public function like($field, $match = '', $side = 'both', $escape = NULL)
	{
		return $this->db->like($field, $match, $side, $escape);
	}
	public function not_like($field, $match = '', $side = 'both', $escape = NULL)
	{
		return $this->db->not_like($field, $match, $side, $escape );
	}
	public function or_like($field, $match = '', $side = 'both', $escape = NULL)
	{
		return $this->db->or_like($field, $match, $side, $escape);
	}
	public function or_not_like($field, $match = '', $side = 'both', $escape = NULL)
	{
		return $this->db->or_not_like($field, $match, $side, $escape);
	}
	public function group_start($not = '', $type = 'AND ')
	{
		return $this->db->group_start($not, $type);
	}
	public function or_group_start()
	{
		return $this->db->or_group_start();
	}
	public function not_group_start()
	{
		return $this->db->not_group_start();
	}
	public function or_not_group_start()
	{
		return $this->db->or_not_group_start();
	}
	public function group_end()
	{
		return $this->db->group_end();
	}
	public function group_by($by, $escape = NULL)
	{
		return $this->db->group_by($by, $escape);
	}
	public function having($key, $value = NULL, $escape = NULL)
	{
		return $this->db->having($key, $value, $escape);
	}
	public function or_having($key, $value = NULL, $escape = NULL)
	{
		return $this->db->or_having($key, $value, $escape);
	}
	public function order_by($orderby, $direction = '', $escape = NULL)
	{
		return $this->db->order_by($orderby, $direction, $escape);
	}
	public function limit($value, $offset = 0)
	{
		return $this->db->limit($value, $offset);
	}
	public function offset($offset)
	{
		return $this->db->offset($offset);
	}
	public function set($key, $value = '', $escape = NULL)
	{
		return $this->db->set($key, $value, $escape);
	}
	public function get_compiled_select($reset = TRUE)
	{
		return $this->db->get_compiled_select($this->_table_name, $reset);
	}
	public function get($limit = NULL, $offset = NULL)
	{
		return $this->db->get($this->_table_name, $limit, $offset);
	}
	public function count_all_results($table = '', $reset = TRUE)
	{
		if(empty($table))
			$table = $this->_table_name;
		return $this->db->count_all_results($table, $reset);
	}
	public function get_where($where = NULL, $limit = NULL, $offset = NULL)
	{
		return $this->db->get_where($this->_table_name, $where, $limit, $offset);
	}
	//before insert batch
	public function before_insert_batch($set = NULL, $escape = NULL, $batch_size = 100)
	{
		//do action here
	}
	//after insert batch
	public function after_insert_batch($set = NULL, $escape = NULL, $batch_size = 100)
	{
		//do action here
	}
	public function insert_batch( $set = NULL, $escape = NULL, $batch_size = 100)
	{
		$this->before_insert_batch($set, $escape, $batch_size);
		$result = $this->db->insert_batch($this->_table_name, $set, $escape, $batch_size);
		$this->after_insert_batch($set, $escape, $batch_size);
		return $result;
	}
	public function set_insert_batch($key, $value = '', $escape = NULL)
	{
		return $this->db->set_insert_batch($key, $value, $escape );
	}
	public function get_compiled_insert($reset = TRUE)
	{
		return $this->db->get_compiled_insert($this->_table_name, $reset);
	}
	//before insert
	public function before_insert($set = NULL, $escape = NULL)
	{
		//do action here	
	}
	//after insert
	public function after_insert($set = NULL, $escape = NULL)
	{
		//do action here
	}
	public function insert($set = NULL, $escape = NULL)
	{
		$this->before_insert($set, $escape);
		$result = $this->db->insert($this->_table_name, $set, $escape);
		$this->after_insert($set, $escape);
		return $result;
	}
	//before replace
	public function before_replace($set = NULL)
	{
		//do action here
	}
	//after replace
	public function after_replace($set = NULL)
	{
		//do action here
	}
	public function replace($set = NULL)
	{
		$this->before_replace($set);
		$result = $this->db->replace($this->_table_name, $set);
		$this->after_replace($set);
		return $result;
	}
	public function get_compiled_update( $reset = TRUE)
	{
		return $this->db->get_compiled_update($this->_table_name, $reset);
	}
	//before update
	public function before_update($set = NULL, $where = NULL, $limit = NULL)
	{
		//do action here
	}
	//after update
	public function after_update($set = NULL, $where = NULL, $limit = NULL)
	{
		//do action here
	}
	public function update( $set = NULL, $where = NULL, $limit = NULL)
	{
		$this->before_replace($set , $where , $limit);
		$result = $this->db->update($this->_table_name , $set , $where , $limit );
		$this->after_replace($set , $where , $limit);
		return $result;
	}
	//before update batch
	public function before_update_batch($set = NULL, $index = NULL, $batch_size = 100)
	{
		//do action here
	}
	//after update batch
	public function after_update_batch($set = NULL, $index = NULL, $batch_size = 100)
	{
		//do action here
	}
	public function update_batch($set = NULL, $index = NULL, $batch_size = 100)
	{
		$this->before_update_batch($index = NULL, $batch_size = 100);
		$result =  $this->db->update_batch($this->_table_name, $set, $index, $batch_size);
		$this->after_update_batch($index = NULL, $batch_size = 100);
		return $result;
	}
	public function set_update_batch($key, $index = '', $escape = NULL)
	{
		return $this->db->set_update_batch($key, $index, $escape );
	}
	//before update batch
	public function before_empty_table()
	{
		//do action here
	}
	//after update batch
	public function after_empty_table()
	{
		//do action here
	}
	public function empty_table()
	{
		$this->before_empty_table();
		$result= $this->db->empty_table($this->_table_name);
		$this->after_empty_table();
		return $result;
	}
	//before update batch
	public function before_truncate()
	{
		//do action here
	}
	//after update batch
	public function after_truncate()
	{
		//do action here
	}
	public function truncate()
	{
		$this->before_truncate();
		$result =  $this->db->truncate($this->_table_name);
		$this->after_truncate();
		return $result;
	}
	public function get_compiled_delete($reset = TRUE)
	{
		return $this->db->get_compiled_delete($this->_table_name, $reset);
	}
	//before delete batch
	public function before_delete($where = '')
	{
		//do action here
		$this->_old = array();
		if(!empty($where))
		{
			$this->db->where($where);
		}
		$arr = $this->db->get($this->_table_name)->result_array();
		for($i=0;$i<count($arr);$i++)
		{
			$this->_old[] = $arr[$i]['sites_logo'];
		}
	}
	//after delete batch
	public function after_delete($where = '')
	{
		//do action here
		if(count($this->_old)>0)
		{
			for($i=0;$i<count($this->_old);$i++)
			{
				if(isset($this->_old[$i]) && !empty($this->_old[$i]) && file_exists(config_item('upload_path').$this->_old[$i]))
				{
					unlink(config_item('upload_path').$this->_old[$i]);
				}		
			}
		}
		$this->_old = array();
	}
	public function delete($where = '')
	{
		if(!empty($where))
			$this->db->where($where);
			
		$_delete = $this->db->get_compiled_delete($this->_table_name,false);
		
		$this->before_delete($where);
		
		$result =  $this->db->query($_delete);
		
		$this->after_delete($where);
		return $result;
	}
	public function dbprefix()
	{
		return $this->db->dbprefix($this->_table_name);
	}
}