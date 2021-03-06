<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Master_model_absensi extends CI_Model {
		
		public function data_master_absensi($id_shoes_category=false){
			if($id_shoes_category!=false){
				$this->db->where('id',$id_shoes_category);
			}
		
			$get_query=$this->db->get('tb_geoatt');
			if($get_query){
				$result=$get_query->result_array();
			}else{
				$result=0;
			}
			return $result;
		}
		
				public function data_master_absensi_setuju($id_shoes_category=false){
		
			 $get_query=$this->db->query('select * from tb_geoatt where status_approv="0" ORDER BY id DESC LIMIT 0,4 ');
			if($get_query){
				$result=$get_query->result_array();
			}else{
				$result=0;
			}
			return $result;
		}
		
		public function total_absensi_setuju($offset=false,$number=false){
			
		
		
			 $status=$this->db->query('select * from tb_geoatt where status_approv="0"');
		
		
			
				$result=$status->num_rows();
			 
			
			 return $result;
		}
		
				public function data_master_absensi2($day=false,$month=false,$year=false,$id_kategori=false){
			$id_pegawai = $id_kategori;
			$get_query=$this->db->query("SELECT
	TIME(start_date)as waktu,id
FROM
	 tb_geoatt
WHERE
	DAY (start_date) = '".$day."'
AND MONTH (start_date) = '".$month."'
AND YEAR (start_date) = '".$year."'
AND user_id ='".$id_pegawai."'
AND (start_date = ( SELECT
	MAX(start_date)
FROM
	tb_geoatt
WHERE
	DAY (start_date) = '".$day."'
AND MONTH (start_date) = '".$month."'
AND YEAR (start_date) = '".$year."'
AND user_id ='".$id_pegawai."' )
OR start_date = ( SELECT
	MIN(start_date)
FROM
	tb_geoatt
WHERE
	DAY (start_date) = '".$day."'
AND MONTH (start_date) = '".$month."'
AND YEAR (start_date) = '".$year."'
AND user_id ='".$id_pegawai."'
)
)
ORDER BY start_date ASC
");
			if($get_query){
				$result=$get_query->result_array();
			}else{
				$result=0;
			}
			return $result;
		}
		
			public function data_master_area($id_shoes_category=false){
			if($id_shoes_category!=false){
				$this->db->where('id_area',$id_shoes_category);
			}
			
			$this->db->where('deleted',0);
				$this->db->order_by('id_area','ASC');
			$get_query=$this->db->get('master_data_area');
			if($get_query){
				$result=$get_query->result_array();
			}else{
				$result=0;
			}
			return $result;
		}
		
		public function approval_absensi($id_shoes_category){
			
		
			$query=$this->db->query('update tb_geoatt  set status_approv="0"  WHERE id="'.$id_shoes_category.'"');
			
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function data_master_absensi_approval($id_shoes_category=false){
			if($this->session->userdata('user_level') == "admin"){
				if($id_shoes_category!=false){
				$this->db->where('id',$id_shoes_category);
			}
			if($this->session->userdata('user_level') == "admin"){
				
			}else{
				$this->db->where('user_id',$this->session->userdata('id_user'));
			}
			$this->db->where('status_approv',1);
			$get_query=$this->db->get('tb_geoatt');
			}
			
			else{
				
				$get_query=$this->db->query('select a.*,b.* from  tb_users a JOIN tb_geoatt b ON a.id=b.user_id where a.atasan_1="'.$this->session->userdata('jabatan').'" and a.atasan_2="'.$this->session->userdata('id_user').'" and b.status_approv="1"');
			
			}
			if($get_query){
				$result=$get_query->result_array();
			}else{
				$result=0;
			}
			return $result;
		}
		
		
			public function data_master_area_tidak_terpilih($id_shoes_category=false){
			$get_query=$this->db->query('select * from master_data_area where deleted="0" and id_area NOT IN (select otoritas from master_data_otoritas where deleted="0" and id_user_insert="'.$id_shoes_category.'")');
			
			if($get_query){
				$result=$get_query->result_array();
			}else{
				$result=0;
			}
			return $result;
		}
		
		public function data_master_area_set($id_shoes_category=false){
			
			$get_query=$this->db->query('select a.*,b.* from master_data_otoritas a JOIN master_data_area b ON a.otoritas=b.id_area where a.deleted="0" and id_user_insert="'.$id_shoes_category.'"');
			
			if($get_query){
				$result=$get_query->result_array();
			}else{
				$result=0;
			}
			return $result;
		}
		
		public function data_master_area_set_area($id_shoes_category=false){
			
			$get_query=$this->db->query('select a.*,b.* from master_data_otoritas a JOIN master_data_user b ON a.id_user_insert=b.id where a.deleted="0" and b.deleted="0" and a.otoritas="'.$id_shoes_category.'"');
			
			if($get_query){
				$result=$get_query->result_array();
			}else{
				$result=0;
			}
			return $result;
		}
	
		
		public function save_data_absensi($data){
			/*$status2=$this->db->query('select COUNT(username)AS cek_code_brands from tb_users where  username="'.$data['username'].'"');
			$result2=$status2->result_array();
			if($result2[0]['cek_code_brands'] > 0){
				return false;
			}else{*/
				
			$date=date("Y-m-d");
				$data_barang['user_id']=$data['user_id'];
				$data_barang['start_date']="".$date."		".$data['start_date']."";
				$data_barang['keterangan']='nope';
				$data_barang['lat']=$data['lat'];
				$data_barang['lang']=$data['long'];
				$data_barang['status_approv']=1;
				
				$insert=$this->db->insert('tb_geoatt',$data_barang);
				
			
				
				if($insert){
					return true;
				}else{
					return true;
				}
			//}
		}
		
		
		public function edit($data){
				//$fileprofil_ = explode('.', $_FILES['nama_file']['name']);
				//$file_profil_save=md5($_FILES['nama_file']['name']).'.'.$fileprofil_[1].'';
				
				//$data['gambar']=$file_profil_save;
				if($_FILES['profile_image']['name'] == ""){
					$file_name_foto_profil=$data['gambar_profil_db'];
					
					$data_barang['profile_image']=$file_name_foto_profil;
				}else{
					$fileprofil_ = explode('.', $_FILES['profile_image']['name']);
				$file_profil_save=md5($_FILES['profile_image']['name']).'.'.$fileprofil_[1].'';
				
				$data_barang['profile_image']=$file_profil_save;
				}
				
				
				
				$data_barang['username']=$data['username'];
			//	$data_barang['password']=md5($data['password']);
				$data_barang['first_name']=$data['first_name'];
				$data_barang['kode_jabatan']=$data['kode_jabatan'];
				$data_barang['nama_jabatan']=$data['nama_jabatan'];
				$data_barang['kode_unit']=$data['kode_unit'];
				$data_barang['nama_unit_kerja']=$data['nama_unit_kerja'];
				$data_barang['atasan_1']=$data['atasan_1'];
				$data_barang['atasan_2']=$data['atasan_2'];
				
					
					$this->db->where('id',$data['id']);
					$update=$this->db->update('tb_users',$data_barang);
					
					
			
				if($update){
					return true;
				}else{
					return false;
				}
			
		}
		
			public function edit_profil($data_set){
				
				if($_FILES['nama_file']['name'] == ""){
					$file_name_foto_profil=$data_set['nama_file_db'];
					$data_set['gambar']=$file_name_foto_profil;
				}else{
					$fileprofil_ = explode('.', $_FILES['nama_file']['name']);
				$file_profil_save=md5($_FILES['nama_file']['name']).'.'.$fileprofil_[1].'';
				
				$data['gambar']=$file_profil_save;
				}
				if($data_set['password'] == ""){
					
					$password=$data_set['password_db'];
				}else{
					$password=md5($data_set['password']);
				}
				$data['username']=$data_set['username'];
				$data['nama']=$data_set['nama'];
				$data['no_telepon']=$data_set['no_telepon'];
				$data['email']=$data_set['email'];
				$data['user_id']=$data_set['user_id'];
				$data['password']=$password;
				
					
					$this->db->where('id',$data_set['id']);
					$update=$this->db->update('master_data_user',$data);
					
					
			
				if($update){
					return true;
				}else{
					return false;
				}
			
		}
		
		public function edit_password($data){
					$status2=$this->db->query('select COUNT(username)AS cek_code_brands from master_data_user where deleted="0" and password="'.md5($data['password_lama']).'"');
			$result2=$status2->result_array();
			if($result2[0]['cek_code_brands'] > 0){
				$data_set['password']=md5($this->input->post('password_baru'));
					$this->db->where('id',$data['id_ubah_pwd']);
					$update=$this->db->update('master_data_user',$data_set);
				if($update){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
					
			
		}
		
		public function delete($id_shoes_category){
			
		
			$query=$this->db->query('update master_data_user set deleted="1" WHERE id="'.$id_shoes_category.'"');
			
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function delete_oto($id_shoes_category){
			$query=$this->db->query('delete from master_data_otoritas  WHERE id_otoritas="'.$id_shoes_category.'"');
			
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function backup_user(){
			 $data=date('d_m_y h_i_s A');
			$get_query=$this->db->query("select * from master_data_user where deleted='0' into outfile 'D:\\ backup_$data.csv' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n';");
			if($get_query){
				$result=$get_query->result_array();
			}else{
				$result=0;
			}
			return $result;
		}
		
			public function upload_foto_kk($name, $file_name){
			$file_ = explode('.', $file_name);
			// $config['file_name']		= '';
			$nama_file = explode('.', $file_name);
			
			$config['upload_path'] 		= './upload/foto_user/';
			$config['allowed_types'] 	= 'jpg|png';
			$config['max_size']			= '1000';
			$config['file_name']		= md5($file_name);

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload($name)) {
				$data = array('error' => $this->upload->display_errors());
			}
			else{
				$data = array('upload_data' => $this->upload->data());
			}

			return $file_name;
		}
		
		
	}

?>
