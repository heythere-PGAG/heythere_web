<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class api_models extends CI_Model {

	public function contactUsModel($jsonRequest){
		$fromEmail = $jsonRequest->fromEmail;
		$fromName = $jsonRequest->fromName;
		$fromPhone = $jsonRequest->fromPhone;
		$fromMessage = $jsonRequest->fromMessage;
		$sql = "INSERT INTO heythere_contact (from_email,from_name,phone_number,message)VALUES ('".$fromEmail."','".$fromName."','".$fromPhone."','".$fromMessage."');";
		$result = $this->db->query($sql);
		$data['success'] = $result;
		return $data;
	}
	
	public function profileDetailsModel($jsonRequest){
		$user_id = $jsonRequest->heythere_user_id;
		$sql = "SELECT b.fb_id,a.u_name,a.u_profile_pic,a.u_cover_pic FROM tbl_users a LEFT JOIN tbl_facebook b ON b.u_id = a.u_id  WHERE a.u_id=$user_id;";
		$result = $this->db->query($sql);
		return $result->row();
	}
	
	public function processLoginModel($jsonRequest){
		$email = $jsonRequest->heythere_email;
		$password =$jsonRequest->heythere_password;
		$response['success'] = 0;
		$response['heythere_user_id'] = 0;
		$sql = "SELECT u_id FROM tbl_users WHERE u_email='$email' AND u_password=MD5('$password');";
		$result = $this->db->query($sql);
		$count = $result->num_rows();
		if($count != 0){
			$response['success'] = 1;
			$response['heythere_user_id'] = $result->row()->u_id;
		}
		return $response;
	}
	
	public function fbAuthProcessModel($jsonRequest){
		$fb_id = $jsonRequest->heythere_fb_id;
		$email = $jsonRequest->heythere_email;
		$name = $jsonRequest->heythere_name;
		$profile_pic = $jsonRequest->heythere_profile_pic;
		$cover_pic = $jsonRequest->heythere_cover_pic;
		$sql_email = "SELECT u_id,
				(SELECT tbl_facebook.fb_id FROM tbl_facebook WHERE tbl_facebook.u_id = tbl_users.u_id) AS fb_id 
				FROM tbl_users WHERE u_email='$email';";
		$result_email = $this->db->query($sql_email);
		$count = $result_email->num_rows();
		if($count ==0){
			if($email != null && $name != null){
				$sql = "CALL sp_fb_signup('$fb_id','$name','$email','','$profile_pic','$cover_pic');";
				$result = $this->db->query($sql);
				$res = $result->row();
				$response['success'] = $res->success;
				$response['heythere_user_id'] = $res->user_id;
			}
		}else{
			$res = $result_email->row();
			if($res->fb_id == 0){
				$us_id = $res->u_id;
				$sql = "CALL sp_fb_register($us_id,'$fb_id');";
				$result = $this->db->query($sql);
				$res = $result->row();
				$response['success'] = $res->success;
				$response['heythere_user_id'] = $res->user_id;
			}else{
				$response['success'] = 1;
				$response['heythere_user_id'] = $res->u_id;
			}
		}
		return $response;
	}
	
	public function processSignupModel($jsonRequest){
		$email = $jsonRequest->heythere_email;
		$name = $jsonRequest->heythere_name;
		$password = $jsonRequest->heythere_password;
		$response['success'] = 0;
		$response['heythere_user_id'] = 0;
		$sql_email = "SELECT u_id FROM tbl_users WHERE u_email='$email';";
		$result_email = $this->db->query($sql_email);
		$count = $result_email->num_rows();
		if($count == 0){
			if($email != null && $name != null && $password != null){
				$sql = "CALL sp_signup('$name','$email','$password');";
				$result = $this->db->query($sql);
				$res = $result->row();
				$response['success'] = $res->success;
				$response['heythere_user_id'] = $res->user_id;
			}
		}else{
			$response['success'] = 2;
		}
		return $response;
	}
	
	public function getEventsModel($u_id){
		$sql = "SELECT event_id,event_name,event_address,event_city,event_date,event_poster,event_category,created_date,
				(SELECT COUNT(tbl_event_likes.u_id) FROM tbl_event_likes WHERE tbl_event_likes.e_id = tbl_events.event_id) AS likecount,
				(SELECT COUNT(tbl_event_likes.u_id) FROM tbl_event_likes WHERE tbl_event_likes.e_id = tbl_events.event_id AND tbl_event_likes.u_id = '$u_id' ) AS liked 
				FROM tbl_events;";
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	public function getEventsForMapModel($jsonRequest){
		$u_id = $jsonRequest->heythere_user_id;
		$lati = $jsonRequest->user_lat_value;
		$longi = $jsonRequest->user_lon_value;
		$sort = $jsonRequest->sorting;
		$cost = $jsonRequest->cost;
		$category = $jsonRequest->category;
		$cate = "";
		if($category != "" && $cost==""){
			$cate = "WHERE event_category IN ($category)";
		}else if($category != "" && $cost != ""){
			$cate = "AND event_category IN ($category)";
		}
		
		if($cost == ""){
			$sql ="SELECT a.lat,a.lon,b.event_id,b.event_name,b.event_category,b.event_city,b.event_date,b.event_address,b.event_poster,b.created_date,
   (SELECT COUNT(tbl_event_likes.u_id) FROM tbl_event_likes WHERE tbl_event_likes.e_id = b.event_id) AS likecount,
   (SELECT COUNT(tbl_event_likes.u_id) FROM tbl_event_likes WHERE tbl_event_likes.e_id = b.event_id AND tbl_event_likes.u_id = $u_id ) AS liked,
   (3959 * ACOS(COS(RADIANS($lati)) * COS(RADIANS(lat)) * COS(RADIANS(lon) - RADIANS($longi)) + SIN(RADIANS($lati)) * SIN(RADIANS(lat)))) AS distance 
   FROM tbl_lat_lon a LEFT JOIN tbl_events b ON b.event_id = a.e_id $cate HAVING distance < 100 ORDER BY $sort;";
		}else if($cost == "free"){
			$sql ="SELECT a.lat,a.lon,b.event_id,b.event_name,b.event_category,b.event_city,b.event_date,b.event_address,b.event_poster,b.created_date,
   (SELECT COUNT(tbl_event_likes.u_id) FROM tbl_event_likes WHERE tbl_event_likes.e_id = b.event_id) AS likecount,
   (SELECT COUNT(tbl_event_likes.u_id) FROM tbl_event_likes WHERE tbl_event_likes.e_id = b.event_id AND tbl_event_likes.u_id = $u_id ) AS liked,
   (3959 * ACOS(COS(RADIANS($lati)) * COS(RADIANS(lat)) * COS(RADIANS(lon) - RADIANS($longi)) + SIN(RADIANS($lati)) * SIN(RADIANS(lat)))) AS distance 
   FROM tbl_lat_lon a LEFT JOIN tbl_events b ON b.event_id = a.e_id WHERE b.events_fee='free' $cate HAVING distance < 100 ORDER BY $sort;";
		}else{
			$sql ="SELECT a.lat,a.lon,b.event_id,b.event_name,b.event_category,b.event_city,b.event_date,b.event_address,b.event_poster,b.created_date,
   (SELECT COUNT(tbl_event_likes.u_id) FROM tbl_event_likes WHERE tbl_event_likes.e_id = b.event_id) AS likecount,
   (SELECT COUNT(tbl_event_likes.u_id) FROM tbl_event_likes WHERE tbl_event_likes.e_id = b.event_id AND tbl_event_likes.u_id = $u_id ) AS liked,
   (3959 * ACOS(COS(RADIANS($lati)) * COS(RADIANS(lat)) * COS(RADIANS(lon) - RADIANS($longi)) + SIN(RADIANS($lati)) * SIN(RADIANS(lat)))) AS distance 
   FROM tbl_lat_lon a LEFT JOIN tbl_events b ON b.event_id = a.e_id WHERE b.events_fee != 'free' $cate HAVING distance < 100 ORDER BY $sort;";
		}
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	public function getEventDetailModel($jsonRequest){
		$u_id = $jsonRequest->heythere_user_id;
		$e_id = $jsonRequest->heythere_event_id;
		$sql = "SELECT a.*,COUNT(b.u_id) AS likecount,(SELECT COUNT(tbl_event_likes.u_id)FROM tbl_event_likes WHERE tbl_event_likes.u_id=$u_id AND tbl_event_likes.e_id=$e_id) AS liked FROM tbl_events a LEFT JOIN tbl_event_likes b ON b.e_id = a.event_id WHERE a.event_id=$e_id;";
		$result = $this->db->query($sql);
		return $result->row();
	}
	
	public function getEventsCategoryModel($jsonRequest){
		$u_id = $jsonRequest->heythere_user_id;
		$category = $jsonRequest->category;
		$sql = "SELECT event_id,event_name,event_address,event_city,event_date,event_poster,event_category,created_date,
				(SELECT COUNT(tbl_event_likes.u_id) FROM tbl_event_likes WHERE tbl_event_likes.e_id = tbl_events.event_id) AS likecount,
				(SELECT COUNT(tbl_event_likes.u_id) FROM tbl_event_likes WHERE tbl_event_likes.e_id = tbl_events.event_id AND tbl_event_likes.u_id = '$u_id' ) AS liked 
				FROM tbl_events WHERE event_category='$category';";
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	public function likeEventModel($jsonRequest){
		$u_id = $jsonRequest->heythere_user_id;
		$e_id = $jsonRequest->heythere_event_id;
		$sql = "CALL sp_like($u_id,$e_id);";
		$result = $this->db->query($sql);
		return $result->row();
	}
	
	public function dislikeEventModel($jsonRequest){
		$u_id = $jsonRequest->heythere_user_id;
		$e_id = $jsonRequest->heythere_event_id;
		$sql = "CALL sp_dislike($u_id,$e_id);";
		$result = $this->db->query($sql);
		return $result->row();
	}
}