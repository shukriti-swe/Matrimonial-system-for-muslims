<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model
{
    /*
     *  Developed by: Active IT zone
     *  Date    : 18 September, 2017
     *  Active Matrimony CMS
     *  http://codecanyon.net/user/activeitezone
     */

    function __construct()
    {
        parent::__construct();
    }

    function clear_cache()
    {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /////////GET NAME BY TABLE NAME AND ID/////////////
    function get_type_name_by_id($type, $type_id = '', $field = 'name')
    {
		
        if ($type_id != '') {
            $l = $this->db->get_where($type, array(
                $type . '_id' => $type_id
            ));
            $n = $l->num_rows();
			//echo $l->row()->$field;die();
            if ($n > 0) {
                return $l->row()->$field;
            }
        }
    }
    function get_settings_value($type, $type_name = '', $field = 'value')
    {
        if ($type_name != '') {
            return $this->db->get_where($type, array('type' => $type_name))->row()->$field;
        }
    }

    /////////Filter One/////////////
    function filter_one($table, $type, $value)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($type, $value);
        return $this->db->get()->result_array();
    }

    // FILE_UPLOAD
    function img_thumb($type, $id, $ext = '.jpg', $width = '400', $height = '400')
    {
        ini_set("memory_limit", "-1");
        $this->load->library('image_lib');

        $config1['image_library']  = 'gd2';
        $config1['create_thumb']   = TRUE;
        $config1['maintain_ratio'] = TRUE;
        $config1['width']          = $width;
        $config1['height']         = $height;
        $config1['source_image']   = 'uploads/' . $type . '_image/' . $type . '_' . $id . $ext;

        
        $this->image_lib->clear();
        $this->image_lib->initialize($config1);
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
    }

    // FILE_UPLOAD
    function file_up($name, $type, $id, $multi = '', $no_thumb = '', $ext = '.jpg')
    {
        if ($multi == '') {
            $destFile = 'uploads/profile_image/' . $id;
            if (!file_exists($destFile)) {
                mkdir($destFile, 0777, true);
            }
            $imageName = str_replace(" ", "_", $_FILES[$name]['name']);
            move_uploaded_file($_FILES[$name]['tmp_name'], $destFile ."/". $imageName);
            // chmod($destFile, 0777);
            // if ($no_thumb == '') {
            //     $this->Crud_model->img_thumb($type, $id, $ext);
            // }
        } elseif ($multi == 'multi') {
            $ib = 1;
            foreach ($_FILES[$name]['name'] as $i => $row) {
                $ib = $this->file_exist_ret($type, $id, $ib);
                move_uploaded_file($_FILES[$name]['tmp_name'][$i], 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext);
                if ($no_thumb == '') {
                    $this->Crud_model->img_thumb($type, $id . '_' . $ib, $ext);
                }
            }
        }
    }
    
    
    function file_up_main($name, $type, $id, $multi = '', $no_thumb = '', $ext = '.jpg')
    {
        if ($multi == '') {
            $destFile = 'uploads/profile_image_main/' . $id;
            if (!file_exists($destFile)) {
                mkdir($destFile, 0777, true);
            }
            $imageName = str_replace(" ", "_", $_FILES[$name]['name']);
            move_uploaded_file($_FILES[$name]['tmp_name'], $destFile ."/". $imageName);
            // chmod($destFile, 0777);
            // if ($no_thumb == '') {
            //     $this->Crud_model->img_thumb($type, $id, $ext);
            // }
        } elseif ($multi == 'multi') {
            $ib = 1;
            foreach ($_FILES[$name]['name'] as $i => $row) {
                $ib = $this->file_exist_ret($type, $id, $ib);
                move_uploaded_file($_FILES[$name]['tmp_name'][$i], 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext);
                if ($no_thumb == '') {
                    $this->Crud_model->img_thumb($type, $id . '_' . $ib, $ext);
                }
            }
        }
    }


    function file_upCover($name, $type, $id, $multi = '', $no_thumb = '', $ext = '.jpg')
    {
        $size = getimagesize($_FILES[$name]['tmp_name']);
        $width = $size[0];
        $height = $size[1];
        if ($width < 800) {
            echo json_encode(["error"=>"Image Width less then 800 Pixel"]); die();
        }
        if ($height < 450) {
            echo json_encode(["error"=>"Image Height less then 450 Pixel"]);die();
        }
        
        if ($multi == '') {
            $destFile = 'uploads/home_slide/';
            if (!file_exists($destFile)) {
                mkdir($destFile, 0777, true);
            }
            $imageName = str_replace(" ", "_", $_FILES[$name]['name']);

            move_uploaded_file($_FILES[$name]['tmp_name'], $destFile ."/". $id. "-". $imageName);
            // resize image
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = $destFile ."/". $id. "-". $imageName;
            $config['maintain_ratio'] = TRUE;
            $config['width']     = 800;
            $config['height']   = 450;

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            // chmod($destFile, 0777);
            // if ($no_thumb == '') {
            //     $this->Crud_model->img_thumb($type, $id, $ext);
            // }
        } elseif ($multi == 'multi') {
            $ib = 1;
            foreach ($_FILES[$name]['name'] as $i => $row) {
                $ib = $this->file_exist_ret($type, $id, $ib);
                move_uploaded_file($_FILES[$name]['tmp_name'][$i], 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext);
                if ($no_thumb == '') {
                    $this->Crud_model->img_thumb($type, $id . '_' . $ib, $ext);
                }
            }
        }
    }
	
	function file_upAdvertisement($name, $type, $id, $multi = '', $no_thumb = '', $ext)
    {
        $size = getimagesize($_FILES[$name]['tmp_name']);
        // $width = $size[0];
        // $height = $size[1];
        // if ($width < 800) {
        //     echo json_encode(["error"=>"Image Width less then 800 Pixel"]); die();
        // }
        // if ($height < 450) {
        //     echo json_encode(["error"=>"Image Height less then 450 Pixel"]);die();
        // }
        
        if ($multi == '') {
            $destFile = 'uploads/ads_logo/';
            if (!file_exists($destFile)) {
                mkdir($destFile, 0777, true);
            }
            //$imageName = str_replace(" ",$ext);
            $imageName = $id.$ext;

            move_uploaded_file($_FILES[$name]['tmp_name'], $destFile ."/".$imageName );
            // resize image
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = $destFile ."/".$imageName;
            $config['maintain_ratio'] = TRUE;
            $config['width']     = 150;
            $config['height']   = 150;

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            // chmod($destFile, 0777);
            // if ($no_thumb == '') {
            //     $this->Crud_model->img_thumb($type, $id, $ext);
            // }
        } elseif ($multi == 'multi') {
            $ib = 1;
            foreach ($_FILES[$name]['name'] as $i => $row) {
                $ib = $this->file_exist_ret($type, $id, $ib);
                move_uploaded_file($_FILES[$name]['tmp_name'][$i], 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext);
                if ($no_thumb == '') {
                    $this->Crud_model->img_thumb($type, $id . '_' . $ib, $ext);
                }
            }
        }
    }

    function plan_file_up($name, $type, $id, $multi = '', $no_thumb = '', $ext = '.jpg')
    {
        if ($multi == '') {
            move_uploaded_file($_FILES[$name]['tmp_name'], 'uploads/' . $type . '_image/' . $type . '_' . $id . $ext);
            if ($no_thumb == '') {
                $this->Crud_model->img_thumb($type, $id, $ext);
            }
        } elseif ($multi == 'multi') {
            $ib = 1;
            foreach ($_FILES[$name]['name'] as $i => $row) {
                $ib = $this->file_exist_ret($type, $id, $ib);
                move_uploaded_file($_FILES[$name]['tmp_name'][$i], 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext);
                if ($no_thumb == '') {
                    $this->Crud_model->img_thumb($type, $id . '_' . $ib, $ext);
                }
            }
        }
    }


    // FILE_UPLOAD : EXT :: FILE EXISTS
    function file_exist_ret($type, $id, $ib, $ext = '.jpg')
    {
        if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext)) {
            $ib = $ib + 1;
            $ib = $this->file_exist_ret($type, $id, $ib);
            return $ib;
        } else {
            return $ib;
        }
    }


    // FILE_VIEW
    function file_view($type, $id, $width = '100', $height = '100', $thumb = 'no', $src = 'no', $multi = '', $multi_num = '', $ext = '.jpg')
    {
        if ($multi == '') {
            if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . $ext)) {
                if ($thumb == 'no') {
                    $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . $ext;
                } elseif ($thumb == 'thumb') {
                    $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_thumb' . $ext;
                }

                if ($src == 'no') {
                    return '<img src="' . $srcl . '" height="' . $height . '" width="' . $width . '" />';
                } elseif ($src == 'src') {
                    return $srcl;
                }
            }
            else{
                return base_url() . 'uploads/'. $type.'_image/default.jpg';
            }

        } else if ($multi == 'multi') {
            $num    = $this->Crud_model->get_type_name_by_id($type, $id, 'num_of_imgs');
            //$num = 2;
            $i      = 0;
            $p      = 0;
            $q      = 0;
            $return = array();
            while ($p < $num) {
                $i++;
                if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext)) {
                    if ($thumb == 'no') {
                        $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext;
                    } elseif ($thumb == 'thumb') {
                        $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . '_thumb' . $ext;
                    }

                    if ($src == 'no') {
                        $return[] = '<img src="' . $srcl . '" height="' . $height . '" width="' . $width . '" />';
                    } elseif ($src == 'src') {
                        $return[] = $srcl;
                    }
                    $p++;
                } else {
                    $q++;
                    if ($q == 10) {
                        break;
                    }
                }

            }
            if (!empty($return)) {
                if ($multi_num == 'one') {
                    return $return[0];
                } else if ($multi_num == 'all') {
                    return $return;
                } else {
                    $n = $multi_num - 1;
                    unset($return[$n]);
                    return $return;
                }
            } else {
                if ($multi_num == 'one') {
                    return base_url() . 'uploads/'. $type.'_image/default.jpg';
                } else if ($multi_num == 'all') {
                    return array(base_url() . 'uploads/'. $type.'_image/default.jpg');
                } else {
                    return array(base_url() . 'uploads/'. $type.'_image/default.jpg');
                }
            }
        }
    }


    // FILE_VIEW
    function file_dlt($type, $id, $ext = '.jpg', $multi = '', $m_sin = '')
    {
        if ($multi == '') {
            if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . $ext)) {
                unlink("uploads/" . $type . "_image/" . $type . "_" . $id . $ext);
            }
            if (file_exists("uploads/" . $type . "_image/" . $type . "_" . $id . "_thumb" . $ext)) {
                unlink("uploads/" . $type . "_image/" . $type . "_" . $id . "_thumb" . $ext);
            }

        } else if ($multi == 'multi') {
            $num = $this->Crud_model->get_type_name_by_id($type, $id, 'num_of_imgs');
            if ($m_sin == '') {
                $i = 0;
                $p = 0;
                while ($p < $num) {
                    $i++;
                    if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext)) {
                        unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $i . $ext);
                        $p++;
                        $data['num_of_imgs'] = $num - 1;
                        $this->db->where($type . '_id', $id);
                        $this->db->update($type, $data);
                    }

                    if (file_exists("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $i . "_thumb" . $ext)) {
                        unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $i . "_thumb" . $ext);
                    }
                    if ($i > 50) {
                        break;
                    }
                }
            } else {
                if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $m_sin . $ext)) {
                    unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $m_sin . $ext);
                }
                if (file_exists("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $m_sin . "_thumb" . $ext)) {
                    unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $m_sin . "_thumb" . $ext);
                }
                $data['num_of_imgs'] = $num - 1;
                $this->db->where($type . '_id', $id);
                $this->db->update($type, $data);
            }
        }
    }

    //DELETE MULTIPLE ITEMS
    function multi_delete($type, $ids_array)
    {
        foreach ($ids_array as $row) {
            $this->file_dlt($type, $row);
            $this->db->where($type . '_id', $row);
            $this->db->delete($type);
        }
    }

    //DELETE SINGLE ITEM
    function single_delete($type, $id)
    {
        $this->file_dlt($type, $id);
        $this->db->where($type . '_id', $id);
        $this->db->delete($type);
    }

    //GET PRODUCT LINK
    function product_link($product_id,$quick='')
    {
        if($quick=='quick'){
            return base_url() . 'index.php/home/quick_view/' . $product_id;
        } else {
            $name = url_title($this->Crud_model->get_type_name_by_id('product', $product_id, 'title'));
            return base_url() . 'index.php/home/product_view/' . $product_id . '/' . $name;
        }
    }

    //GET PRODUCT LINK
    function blog_link($blog_id)
    {
        $name = url_title($this->Crud_model->get_type_name_by_id('blog', $blog_id, 'title'));
        return base_url() . 'index.php/home/blog_view/' . $blog_id . '/' . $name;
    }

    //GET PRODUCT LINK
    function vendor_link($vendor_id)
    {
        $name = url_title($this->Crud_model->get_type_name_by_id('vendor', $vendor_id, 'display_name'));
        return base_url() . 'index.php/home/vendor_profile/' . $vendor_id . '/' . $name;
    }

    /////////GET CHOICE TITLE////////
    function choice_title_by_name($product,$name)
    {
        $return = '';
        $options = json_encode($this->get_type_name_by_id('product',$product_id,'options'),true);
        foreach ($options as $row) {
            if($row['name'] == $name){
                $return = $row['title'];
            }
        }
        return $return;
    }

    /////////SELECT HTML/////////////
    function select_html($from, $name, $field, $type, $class, $e_match = '', $condition = '', $c_match = '', $onchange = '',$condition_type='single',$tabindex=2)
    {
        $return = '';
        $other  = '';
        $multi  = 'no';
        $phrase = $name;
        $style = '';
        if ($class == 'demo-cs-multiselect') {
            $other = 'multiple';
            $name  = $name . '[]';
            if ($type == 'edit') {
                $e_match = json_decode($e_match);
                if ($e_match == NULL) {
                    $e_match = array();
                }
                $multi = 'yes';
            }
        }
        $return = '<select name="' . $name . '" onChange="' . $onchange . '(this.value,this)" class="form-control-sm ' . $class . '" ' . $other .  'style="' . $style . ' data-placeholder="' . $phrase . '" tabindex="'.$tabindex.'" data-hide-disabled="true" >';
        if (!is_array($from)) {
            if ($condition == '') {
                if ($from == 'country')
				{
					$all=$this->db->query("SELECT * FROM country where name = 'United States' UNION SELECT * FROM country where name = 'Pakistan' UNION SELECT * FROM country where name = 'India'  UNION SELECT * FROM country")->result_array();
				}
				else if ($from == 'profession')
				{
					$this->db->order_by("name", "asc");
					$all = $this->db->get($from)->result_array();
				}else
				{
					$all = $this->db->get($from)->result_array();
				}
            } else if ($condition !== '') {
                if($condition_type=='single'){
                    $all = $this->db->get_where($from, array(
                        $condition => $c_match
                    ))->result_array();
                }else if($condition_type=='multi'){
                    $this->db->where_in($condition,$c_match);
                    $all = $this->db->get($from)->result_array();
                }
            }

             if ($name == 'age_range') {
                $return .= '<option value=""><b>AGE: ALL</b></option>';
            }elseif ($name == 'country') {
                $return .= '<option value=""><b>COUNTRY: ALL</b></option>';
            }elseif ($name == 'profession') {
                $return .= '<option value=""><b>PROFESSION: ALL</b></option>';
            }

            $return .= '<option value="">Choose one</option>';

            
            // $return .= '<option value="">Choose one</option>';
            
            foreach ($all as $row):
                if ($type == 'add') {
                    $return .= '<option value="' . $row[$from . '_id'] . '">' . $row[$field] . '</option>';
                } else if ($type == 'edit') {
                    $return .= '<option value="' . $row[$from . '_id'] . '" ';
                    if ($multi == 'no') {
                        if ($row[$from . '_id'] == $e_match) {
                            $return .= 'selected=."selected"';
                        }
                    } else if ($multi == 'yes') {
                        if (in_array($row[$from . '_id'], $e_match)) {
                            $return .= 'selected=."selected"';
                        }
                    }
                    $return .= '>' . $row[$field] . '</option>';
                }
            endforeach;
        } else {
            $all = $from;
            $return .= '<option value="">Choose one</option>';
            foreach ($all as $row):
                if ($type == 'add') {
                    $return .= '<option value="' . $row . '">';
                    if ($condition == '') {
                        $return .= ucfirst(str_replace('_', ' ', $row));
                    } else {
                        $return .= $this->Crud_model->get_type_name_by_id($condition, $row, $c_match);
                    }
                    $return .= '</option>';
                } else if ($type == 'edit') {
                    $return .= '<option value="' . $row . '" ';
                    if ($row == $e_match) {
                        $return .= 'selected=."selected"';
                    }
                    $return .= '>';

                    if ($condition == '') {
                        $return .= ucfirst(str_replace('_', ' ', $row));
                    } else {
                        $return .= $this->Crud_model->get_type_name_by_id($condition, $row, $c_match);
                    }

                    $return .= '</option>';
                }
            endforeach;
        }
        $return .= '</select>';
        return $return;
    }

    //CHECK IF PRODUCT EXISTS IN TABLE
    function exists_in_table($table, $field, $val)
    {
        $ret = '';
        $res = $this->db->get($table)->result_array();
        foreach ($res as $row) {
            if ($row[$field] == $val) {
                $ret = $row[$table . '_id'];
            }
        }
        if ($ret == '') {
            return false;
        } else {
            return $ret;
        }

    }

    //FORM FIELDS
    function form_fields($array)
    {
        $return = '';
        foreach ($array as $row) {
            $return .= '<div class="form-group">';
            $return .= '    <label class="col-sm-4 control-label" for="demo-hor-inputpass">' . $row . '</label>';
            $return .= '    <div class="col-sm-6">';
            $return .= '       <input type="text" name="ad_field_values[]" id="demo-hor-inputpass" class="form-control">';
            $return .= '       <input type="hidden" name="ad_field_names[]" value="' . $row . '" >';
            $return .= '    </div>';
            $return .= '</div>';
        }
        return $return;
    }

    // PAGINATION
    function pagination($type, $per, $link, $f_o, $f_c, $other, $current, $seg = '3', $ord = 'desc')
    {
        $t   = explode('#', $other);
        $t_o = $t[0];
        $t_c = $t[1];
        $c   = explode('#', $current);
        $c_o = $c[0];
        $c_c = $c[1];

        $this->load->library('pagination');
        $this->db->order_by($type . '_id', $ord);
        $config['total_rows']  = $this->db->count_all_results($type);
        $config['base_url']    = base_url() . $link;
        $config['per_page']    = $per;
        $config['uri_segment'] = $seg;

        $config['first_link']      = '&laquo;';
        $config['first_tag_open']  = $t_o;
        $config['first_tag_close'] = $t_c;

        $config['last_link']      = '&raquo;';
        $config['last_tag_open']  = $t_o;
        $config['last_tag_close'] = $t_c;

        $config['prev_link']      = '&lsaquo;';
        $config['prev_tag_open']  = $t_o;
        $config['prev_tag_close'] = $t_c;

        $config['next_link']      = '&rsaquo;';
        $config['next_tag_open']  = $t_o;
        $config['next_tag_close'] = $t_c;

        $config['full_tag_open']  = $f_o;
        $config['full_tag_close'] = $f_c;

        $config['cur_tag_open']  = $c_o;
        $config['cur_tag_close'] = $c_c;

        $config['num_tag_open']  = $t_o;
        $config['num_tag_close'] = $t_c;
        $this->pagination->initialize($config);

        $this->db->order_by($type . '_id', $ord);
        return $this->db->get($type, $config['per_page'], $this->uri->segment($seg))->result_array();
    }

    //TOTALING OF CART ITEMS BY TYPE
    function cart_total_it($type)
    {
        $carted = $this->cart->contents();
        $ret    = 0;
        if (count($carted) > 0) {
            foreach ($carted as $items) {
                $ret += $items[$type] * $items['qty'];
            }
            return $ret;
        } else {
            return false;
        }
    }

    //GETTING ADDITIONAL FIELDS FOR PRODUCT ADD
    function get_additional_fields($product_id)
    {
        $additional_fields = $this->Crud_model->get_type_name_by_id('product', $product_id, 'additional_fields');
        $ab                = json_decode($additional_fields,true);
        $name = json_decode($ab['name']);
        $value = json_decode($ab['value']);
        $final = array();
        if(!empty($name)){
            foreach ($name as $n => $row) {
                $final[] = array(
                    'name' => $row,
                    'value' => $value[$n]
                );
            }
        }
        return $final;
    }

    //GETTING IDS OF A TABLE FILTERING SPECIFIC TYPE OF VALUE RANGE
    function ids_between_values($table, $value_type, $up_val, $down_val)
    {
        $this->db->order_by($table . '_id', 'desc');
        return $this->db->get_where($table, array(
            $value_type . ' <=' => $up_val,
            $value_type . ' >=' => $down_val
        ))->result_array();
    }

    //DAYS START-END TIMESTAMP
    function date_timestamp($date, $type)
    {
        $date = explode('-', $date);
        $d    = $date[2];
        $m    = $date[1];
        $y    = $date[0];
        if ($type == 'start') {
            return mktime(0, 0, 0, $m, $d, $y);
        }
        if ($type == 'end') {
            return mktime(0, 0, 0, $m, $d + 1, $y);
        }
    }

    //GETTING BOOTSTRAP COLUMN VALUE
    function boot($num)
    {
        return (12 / $num);
    }

    //GETTING LIMITING CHARECTER
    function limit_chars($string, $char_limit)
    {
        $length = 0;
        $return = array();
        $words  = explode(" ", $string);
        foreach ($words as $row) {
            $length += strlen($row);
            $length += 1;
            if ($length < $char_limit) {
                array_push($return, $row);
            } else {
                array_push($return, '...');
                break;
            }
        }

        return implode(" ", $return);
    }

    //GETTING LOGO BY TYPE
    function logo($type)
    {
        $logo = $this->db->get_where('ui_settings', array(
            'type' => $type
        ))->row()->value;
        return base_url() . 'uploads/logo_image/logo_' . $logo . '.png';
    }


    //GETTING MONTH'S TOTAL BY TYPE
    function month_total($type, $filter1 = '', $filter_val1 = '', $filter2 = '', $filter_val2 = '', $notmatch = '', $notmatch_val = '')
    {
        $ago = time() - (86400 * 30);
        $a   = 0;
        if ($type == 'sale') {
            $result = $this->db->get_where('sale', array(
                'sale_datetime >= ' => $ago,
                'sale_datetime <= ' => time()
            ))->result_array();
            foreach ($result as $row) {
                if($this->session->userdata('title') == 'admin'){
                    if($this->sale_payment_status($row['sale_id'],'admin') == 'fully_paid'){
                        //make version for vendor
                        $res_cat = $this->db->get_where('product', array(
                            'category' => $filter_val1
                        ))->result_array();
                        foreach ($res_cat as $row1) {
                            if ($p = $this->product_in_sale($row['sale_id'], $row1['product_id'], 'subtotal')) {
                                $a += $p;
                            }
                        }
                    }
                }
                if($this->session->userdata('title') == 'vendor'){
                    if($this->sale_payment_status($row['sale_id'],'vendor',$this->session->userdata('vendor_id')) == 'fully_paid'){
                        //make version for vendor
                        $res_cat = $this->db->get_where('product', array(
                            'category' => $filter_val1
                        ))->result_array();
                        foreach ($res_cat as $row1) {
                            if ($p = $this->vendor_share_in_sale($row['sale_id'],$this->session->userdata('vendor_id'),'paid')) {
                                $p = $p['total'];
                                $a += $p;
                            }
                        }
                    }
                }
            }
        } else if ($type == 'stock') {
            if($this->session->userdata('title') == 'admin'){
                $this->db->get_where('added_by',json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id'))));
                $this->db->get_where('datetime >= ',$ago);
                $this->db->get_where('datetime <= ',time());
                $result = $this->db->get('stock')->result_array();
                foreach ($result as $row) {
                    if ($row[$filter2] == $filter_val2) {
                        if ($row[$filter1] == $filter_val1) {
                            if ($notmatch == '') {
                                $a += $row['total'];
                            } else {
                                if ($row[$notmatch] !== $notmatch_val) {
                                    $a += $row['total'];
                                }
                            }
                        }
                    }
                }
            }
            if($this->session->userdata('title') == 'vendor'){
                $result = $this->db->get_where('stock', array(
                    'datetime >= ' => $ago,
                    'datetime <= ' => time()
                ))->result_array();
                foreach ($result as $row) {
                    if ($row[$filter2] == $filter_val2) {
                        if ($row[$filter1] == $filter_val1) {
                            if ($notmatch == '') {
                                $a += $row['total'];
                            } else {
                                if ($row[$notmatch] !== $notmatch_val) {
                                    $a += $row['total'];
                                }
                            }
                        }
                    }
                }
            }
        }
        return $a;
    }

    function email_invoice($sale_id){
        $email = $this->get_type_name_by_id('user', $this->get_type_name_by_id('sale', $sale_id, 'buyer'), 'email');
        $sale_code = '#'.$this->get_type_name_by_id('sale', $sale_id, 'sale_code');
        $from = $this->db->get_where('general_settings', array(
            'type' => 'system_email'
        ))->row()->value;
        $from_name = $this->db->get_where('general_settings', array(
            'type' => 'system_name'
        ))->row()->value;
        $page_data['sale_id'] = $sale_id;
        $text = $this->load->view('front/shopping_cart/invoice_email', $page_data, TRUE);
        $this->email_model->do_email($from, $from_name, $email, $sale_code, $text);
        $admins = $this->db->get_where('admin',array('role'=>'1'))->result_array();
        foreach ($admins as $row) {
            $this->email_model->do_email($from, $from_name, $row['email'], $sale_code, $text);
        }
    }

    //GETTING VENDOR PERMISSION
    function vendor_permission($codename)
    {
        if ($this->session->userdata('vendor_login') !== 'yes') {
            return false;
        } else {
            return true;
        }
    }

    function is_added_by($type,$id,$user_id,$user_type = 'vendor')
    {
        $added_by = json_decode($this->db->get_where($type,array($type.'_id'=>$id))->row()->added_by,true);
        if($user_type == 'admin'){
            $user_id = $added_by['id'];
        }
        $this->benchmark->mark_time();
        if($added_by['type'] == $user_type && $added_by['id'] == $user_id){
            return true;
        } else {
            return false;
        }
    }

    //SALE WISE TOTAL BY TYPE
    function provider_detail($type,$id='',$with_link='')
    {
        if($type == 'admin'){
            $name = $this->db->get_where('general_settings',array('type'=>'system_name'))->row()->value;
            if($with_link == ''){
                return $name;
            } else if($with_link == 'with_link') {
                return '<a href="'.base_url().'">'.$name.'</a>';
            }
        } else if($type == 'vendor'){
            $name = $this->db->get_where('vendor',array('vendor_id'=>$id))->row()->display_name;
            if($with_link == ''){
                return $name;
            } else if($with_link == 'with_link') {
                return '<a href="'.$this->vendor_link($added_by['id']).'">'.$name.'</a>';
            }
        }
    }

    function sale_payment_status($sale_id,$type='',$id=''){
        $payment_status = json_decode($this->db->get_where('sale', array(
            'sale_id' => $sale_id
        ))->row()->payment_status,true);
        $paid = '';
        $unpaid = '';
        foreach ($payment_status as $row) {
            if($type == ''){
                if($row['status'] == 'paid'){
                    $paid = 'yes';
                }
                if($row['status'] == 'due'){
                    $unpaid = 'yes';
                }
            } else {
                if(isset($row[$type])){
                    if($type == 'vendor'){
                        if($row[$type] == $id){
                            if($row['status'] == 'paid'){
                                $paid = 'yes';
                            }
                            if($row['status'] == 'due'){
                                $unpaid = 'yes';
                            }
                        }
                    } else if($type == 'admin'){
                        if($row['status'] == 'paid'){
                            $paid = 'yes';
                        }
                        if($row['status'] == 'due'){
                            $unpaid = 'yes';
                        }
                    }
                }
            }
        }
        if($paid == 'yes' && $unpaid == ''){
            return 'fully_paid';
        }
        else if($paid == 'yes' && $unpaid == 'yes'){
            return 'partially_paid';
        }
        else if($paid == '' && $unpaid == 'yes'){
            return 'due';
        }
        if($paid == '' && $unpaid == ''){
            return 'due';
        }
    }


    //GETTING ADMIN PERMISSION
    function admin_permission($codename)
    {
       $admin_id   = $this->session->userdata('admin_id');
        $admin        = $this->db->get_where('admin', array(
            'admin_id' => $admin_id
        ))->row();

        $this->benchmark->mark_time();
        $permission = $this->db->get_where('permission', array(
            'codename' => $codename
        ))->row()->permission_id;

        if ($admin->role == 1) {
            return true;
        } else {
            $role             = $admin->role;
            $role_permissions = json_decode($this->Crud_model->get_type_name_by_id('role', $role, 'permission'));
            if (in_array($permission, $role_permissions)) {
                return true;
            } else {
                return false;
            }
        }/**/
    }


    //GETTING USER TOTAL
    function user_total($last_days = 0)
    {
        if ($last_days == 0) {
            $time = 0;
        } else {
            $time = time() - (24 * 60 * 60 * $last_days);
        }
        $sales  = $this->db->get_where('sale', array(
            'buyer' => $this->session->userdata('user_id'),
            'payment_status' => 'paid',
            'sale_datetime >=' => $time
        ))->result_array();
        $return = 0;
        foreach ($sales as $row) {
            $return += $row['grand_total'];
        }
        return number_format((float) $return, 2, '.', '');
    }


    //GETTING IP DATA OF PEOPLE BROWING THE SYSTEM
    function ip_data()
    {
        if(!$this->input->is_ajax_request()){
            $this->session->set_userdata('timestamp', time());
            $user_data = $this->session->userdata('surfer_info');
            $ip        = $_SERVER['REMOTE_ADDR'];
            if (!$user_data) {
                if ($_SERVER['HTTP_HOST'] !== 'localhost') {
                    $ip_data = file_get_contents("http://ip-api.com/json/" . $ip);
                    $this->session->set_userdata('surfer_info', $ip_data);
                }
            }
        }
    }


    function seo_stat($type='') {
        try {
            $url = base_url();
            $seostats = new \SEOstats\SEOstats;
            if ($seostats->setUrl($url)) {

                if($type == 'facebook'){
                    return SEOstats\Services\Social::getFacebookShares();
                }
                elseif ($type == 'gplus') {
                    return SEOstats\Services\Social::getGooglePlusShares();
                }
                elseif ($type == 'twitter') {
                    return SEOstats\Services\Social::getTwitterShares();
                }
                elseif ($type == 'linkedin') {
                    return SEOstats\Services\Social::getLinkedInShares();
                }
                elseif ($type == 'pinterest') {
                    return SEOstats\Services\Social::getPinterestShares();
                }

                elseif ($type == 'alexa_global') {
                    return SEOstats\Services\Alexa::getGlobalRank();
                }
                elseif ($type == 'alexa_country') {
                    return SEOstats\Services\Alexa::getCountryRank();
                }

                elseif ($type == 'alexa_bounce') {
                    return SEOstats\Services\Alexa::getTrafficGraph(5);
                }
                elseif ($type == 'alexa_time') {
                    return SEOstats\Services\Alexa::getTrafficGraph(4);
                }
                elseif ($type == 'alexa_traffic') {
                    return SEOstats\Services\Alexa::getTrafficGraph(1);
                }
                elseif ($type == 'alexa_pageviews') {
                    return SEOstats\Services\Alexa::getTrafficGraph(2);
                }

                elseif ($type == 'google_siteindex') {
                    return SEOstats\Services\Google::getSiteindexTotal();
                }
                elseif ($type == 'google_back') {
                    return SEOstats\Services\Google::getBacklinksTotal();
                }
                elseif ($type == 'search_graph_1') {
                    return SEOstats\Services\SemRush::getDomainGraph(1);
                }
                elseif ($type == 'search_graph_2') {
                    return SEOstats\Services\SemRush::getDomainGraph(2);
                }

            }
        }
        catch(\Exception $e) {
            echo 'Caught SEOstatsException: ' . $e->getMessage();
        }
    }


    function ticket_unread_messages($ticket_id,$user_type){
        $count = 0;
        if($ticket_id !== 'all'){
            $msgs  = $this->db->get_where('ticket_message',array('ticket_id'=>$ticket_id))->result_array();
        } else if($ticket_id == 'all'){
            $msgs  = $this->db->get('ticket_message')->result_array();
        }
        foreach($msgs as $row){
            $status = json_decode($row['view_status'],true);
            foreach($status as $type => $row1){
                if($type == $user_type.'_show'){
                    if($row1 == 'no'){
                        $count++;
                    }
                }
            }
        }
        return $count;

    }

    function ticket_message_viewed($ticket_id,$user_type){

        $msgs  = $this->db->get_where('ticket_message',array('ticket_id'=>$ticket_id))->result_array();
        foreach($msgs as $row){
            $status = json_decode($row['view_status'],true);
            $new_status = array();
            foreach($status as $type=>$row1){
                if($type == $user_type.'_show'){
                    $new_status[$type] =  'ok';
                } else{
                    $new_status[$type] =  $row1;
                }
            }
            $view_status = json_encode($new_status);
            $this->db->where('ticket_message_id', $row['ticket_message_id']);
            $this->db->update('ticket_message', array(
                'view_status' => $view_status
            ));

        }

    }

    function check_login($table, $username, $password)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        if ($table != "admin") {
            $this->db->where('is_deleted', 0);
        }
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    function alldata_count($table)
    {
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    function allbilling_count($table, $member_id)
    {
        $query = $this->db->get_where($table, array("member_id" => $member_id));
        return $query->num_rows();
    }

    function alldatas($table,$limit,$start,$col,$dir)
    {
        $query = $this->db->limit($limit,$start)->order_by($col,$dir)->get($table);
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function data_search($table,$limit,$start,$search,$col,$dir)
    {
        $query = $this->db->like($table.'_id',$search)->or_like('name',$search)->limit($limit,$start)->order_by($col,$dir)->get($table);


        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function data_search_count($table,$search)
    {
        $query = $this->db->like($table.'_id',$search)->or_like('name',$search)->get($table);

        return $query->num_rows();
    }

    function allmembers_count($membership)
    {
        if ($membership == "all") {
            $query = $this->db->get_where("member")->result();
        }
        elseif ($membership == "incomplete") {
            $query = $this->db->get_where("member", array("isProfileCompleted" => 0, "is_deleted =" => 0))->result();
        }
        else
        {
            $query = $this->db->get_where("member", array("membership" => $membership, "is_deleted =" => 0))->result();
        }
        return count($query);
    }

    function allmembers($membership,$limit,$start,$col,$dir)
    {
        if ($membership == "all") {
            $query = $this->db->limit($limit,$start)->order_by($col,$dir)->get_where("member");
        }
        elseif ($membership == "incomplete") {
            $arrWhere = array(
                "isProfileCompleted" => 0,
                "is_deleted =" => 0
            );
            $query = $this->db->limit($limit,$start)->order_by($col,$dir)->get_where("member", $arrWhere);
        }
        else
        {
            $arrWhere = array(
                "membership" => $membership,
                "is_deleted =" => 0,
                "isProfileCompleted =" => 1
            );

            $query = $this->db->limit($limit,$start)->order_by($col,$dir)->get_where("member", $arrWhere);
        }

        // echo $this->db->last_query();exit;
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function members_search($membership,$limit,$start,$search,$col,$dir)
    {
        $this->db->limit($limit,$start);
        $this->db->order_by($col,$dir);
        if ($membership == 1 || $membership == 2 || $membership == 3 || $membership == 4) {
            $this->db->where('membership',$membership);
			$this->db->where('isProfileCompleted', 1);
        }
        elseif($membership == 'incomplete')
        {
            $this->db->where('isProfileCompleted', 0);
            $this->db->where('is_deleted', 0);
        }
        $this->db->where("(member_id LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR member_profile_id LIKE '%$search%' OR email LIKE '%$search%'  OR display_member LIKE '%$search%')");
        $this->db->where('is_deleted', 0);
        $query = $this->db->get('member');

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function members_search_count($membership,$search)
    {
        if ($membership == 1 || $membership == 2 || $membership == 3 || $membership == 4) {
            $this->db->where('membership',$membership);
        }
        elseif($membership == 'incomplete')
        {
            $this->db->where('isProfileCompleted', 0);
            $this->db->where('is_deleted', 0);
        }
        $this->db->where("(member_id LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR member_profile_id LIKE '%$search%' OR email LIKE '%$search%'  OR display_member LIKE '%$search%')");
        $query = $this->db->get('member');
        return $query->num_rows();
    }

    function get_email_member($membership,$type)
    {
        $email_date = $this->db->order_by('member_email_id', 'DESC')->get_where("member_email", array("member_profile_id" => $membership,"type" => $type))->row();
		if ($email_date != null)
		{
			$email_date = $email_date->email_date;
			return $email_date;
		}

        return '';
    }

    function all_deleted_members_count($membership)
    {
        $query = $this->db->get_where("deleted_member")->result();
        return count($query);
    }

    function all_deleted_members($membership,$limit,$start,$col,$dir)
    {
        // $arrWhere = array(
        //     "is_deleted =" => 1
        // );
        // $query = $this->db->limit($limit,$start)->order_by($col,$dir)->get_where("member", $arrWhere);

        $query = $this->db->limit($limit,$start)->order_by($col,$dir)->get("deleted_member");
        // echo $this->db->last_query();exit;
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function deleted_members_search($membership,$limit,$start,$search,$col,$dir)
    {
        $this->db->limit($limit,$start);
        $this->db->order_by($col,$dir);
        $this->db->where("(member_id LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR member_profile_id LIKE '%$search%' )");
        $query = $this->db->get('deleted_member');

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function deleted_members_search_count($membership,$search)
    {
        $this->db->where("(member_id LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR member_profile_id LIKE '%$search%' OR display_member LIKE '%$search%')");
        $query = $this->db->get('deleted_member');

        return $query->num_rows();
    }

    function allstates($table,$limit,$start,$col,$dir)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.name, country.name AS country_name', FALSE);
        $this->db->from($table);
        $this->db->join('country', 'country.country_id = '.$table.'.country_id', 'left');
        $this->db->limit($limit,$start)->order_by($col,$dir);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function state_search($table,$limit,$start,$search,$col,$dir)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.name, country.name AS country_name', FALSE);
        $this->db->from($table);
        $this->db->join('country', 'country.country_id = '.$table.'.country_id', 'left');
        $this->db->like($table.'_id',$search)->or_like($table.'.name',$search)->or_like('country.name',$search)->limit($limit,$start)->order_by($col,$dir);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function state_search_count($table,$search)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.name, country.name AS country_name', FALSE);
        $this->db->from($table);
        $this->db->join('country', 'country.country_id = '.$table.'.country_id', 'left');
        $this->db->like($table.'_id',$search)->or_like($table.'.name',$search)->or_like('country.name',$search);
        $query = $this->db->get();

        return $query->num_rows();
    }



    function allcastes($table,$limit,$start,$col,$dir)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.caste_name, religion.name AS religion_name', FALSE);
        $this->db->from($table);
        $this->db->join('religion', 'religion.religion_id = '.$table.'.religion_id', 'left');
        $this->db->limit($limit,$start)->order_by($col,$dir);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function caste_search($table,$limit,$start,$search,$col,$dir)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.caste_name, religion.name AS religion_name', FALSE);
        $this->db->from($table);
        $this->db->join('religion', 'religion.religion_id = '.$table.'.religion_id', 'left');
        $this->db->like($table.'_id',$search)->or_like($table.'.caste_name',$search)->or_like('religion.name',$search)->limit($limit,$start)->order_by($col,$dir);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function caste_search_count($table,$search)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.caste_name, religion.name AS religion_name', FALSE);
        $this->db->from($table);
        $this->db->join('religion', 'religion.religion_id = '.$table.'.religion_id', 'left');
        $this->db->like($table.'_id',$search)->or_like($table.'.caste_name',$search)->or_like('religion.name',$search);
        $query = $this->db->get();

        return $query->num_rows();
    }

    function allsub_castes($table,$limit,$start,$col,$dir)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.sub_caste_name, caste.caste_name, religion.name AS religion_name', FALSE);
        $this->db->from($table);
        $this->db->join('caste', 'caste.caste_id = '.$table.'.caste_id', 'left');
        $this->db->join('religion', 'religion.religion_id = caste.religion_id', 'left');
        $this->db->limit($limit,$start)->order_by($col,$dir);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function sub_caste_search($table,$limit,$start,$search,$col,$dir)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.sub_caste_name, caste.caste_name AS caste_name, religion.name AS religion_name', FALSE);
        $this->db->from($table);
         $this->db->join('caste', 'caste.caste_id = '.$table.'.caste_id', 'left');
        $this->db->join('religion', 'religion.religion_id = caste.religion_id', 'left');
        $this->db->like($table.'_id',$search)->or_like($table.'.sub_caste_name',$search)->or_like('caste.caste_name',$search)->or_like('religion.name',$search)->limit($limit,$start)->order_by($col,$dir);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function sub_caste_search_count($table,$search)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.sub_caste_name, caste.caste_name AS caste_name, religion.name AS religion_name', FALSE);
        $this->db->from($table);
        $this->db->join('caste', 'caste.caste_id = '.$table.'.caste_id', 'left');
        $this->db->join('religion', 'religion.religion_id = caste.religion_id', 'left');
        $this->db->like($table.'_id',$search)->or_like($table.'.sub_caste_name',$search)->or_like('caste.caste_name',$search)->or_like('religion.name',$search);
        $query = $this->db->get();

        return $query->num_rows();
    }

    function allcities($table,$limit,$start,$col,$dir)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.name, state.name AS state_name, country.name AS country_name', FALSE);
        $this->db->from($table);
        $this->db->join('state', 'state.state_id = '.$table.'.state_id', 'left');
        $this->db->join('country', 'country.country_id = state.country_id', 'left');
        $this->db->limit($limit,$start)->order_by($col,$dir);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function city_search($table,$limit,$start,$search,$col,$dir)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.name, state.name AS state_name, country.name AS country_name', FALSE);
        $this->db->from($table);
        $this->db->join('state', 'state.state_id = '.$table.'.state_id', 'left');
        $this->db->join('country', 'country.country_id = state.country_id', 'left');
        $this->db->like($table.'_id',$search)->or_like($table.'.name',$search)->or_like('state.name',$search)->or_like('country.name',$search)->limit($limit,$start)->order_by($col,$dir);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function city_search_count($table,$search)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.name, state.name AS state_name, country.name AS country_name', FALSE);
        $this->db->from($table);
        $this->db->join('state', 'state.state_id = '.$table.'.state_id', 'left');
        $this->db->join('country', 'country.country_id = state.country_id', 'left');
        $this->db->like($table.'_id',$search)->or_like($table.'.name',$search)->or_like('state.name',$search)->or_like('country.name',$search);
        $query = $this->db->get();

        return $query->num_rows();
    }

    function allearnings($table,$limit,$start,$col,$dir)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.member_id,'.$table.'.package,'.$table.'.billing_cycle,'.$table.'.invoice_no,'.$table.'.amount,'.$table.'.status,'.$table.'.payment_process_date,'.$table.'.due_date,'.$table.'.next_billing_date, member.display_member, member.first_name AS member_first_name, member.last_name AS member_last_name, deleted_member.display_member, deleted_member.first_name AS dltd_member_first_name, deleted_member.last_name AS dltd_member_last_name,member.member_id as remove_member,member.package_info', FALSE);
        $this->db->from($table);
        $this->db->join('member', 'member.member_id = '.$table.'.member_id', 'left');
        $this->db->join('deleted_member', 'deleted_member.member_id = '.$table.'.member_id', 'left');
        $this->db->limit($limit,$start)->order_by($table.'.member_id');
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function earning_search($table,$limit,$start,$search,$col,$dir)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.member_id,'.$table.'.package,'.$table.'.billing_cycle,'.$table.'.invoice_no,'.$table.'.amount,'.$table.'.status,'.$table.'.payment_process_date,'.$table.'.due_date,'.$table.'.next_billing_date, member.display_member , member.first_name AS member_first_name, member.last_name AS member_last_name', FALSE);
        $this->db->from($table);
        $this->db->join('member', 'member.member_id = '.$table.'.member_id', 'left');
        $this->db->like($table.'.amount',$search)->or_like($table.'.status',$search)->or_like($table.'.invoice_no',$search)->or_like('member.first_name',$search)->or_like('member.last_name',$search)->limit($limit,$start)->order_by($table.'.member_id');
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function ads_allearnings($limit,$start,$col,$dir)
    {
        $this->db->select('advertisements.advertisements_id,advertisements.title,advertisements.ads_email,advertisements.ads_phone,advertisements.duration,advertisements.unique_id,advertisements.status,advertisements_payment.payment_by,advertisements_payment.amount,advertisements_payment.payment_date', FALSE);
        $this->db->from('advertisements');
        $this->db->join('advertisements_payment', 'advertisements_payment.advertisement_id = advertisements.advertisements_id', 'left');
        $this->db->join('advertisement_plans', 'advertisement_plans.id =advertisements.advertisement_plans_id', 'left');
        $this->db->where('advertisements_payment.payment_by <>','');
        $this->db->where('advertisements_payment.trns_id <>','');
        $this->db->limit($limit,$start)->order_by('advertisements.advertisements_id');
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function search_ads_allearnings($limit,$start,$search,$col,$dir)
    {
        $this->db->select('advertisements.advertisements_id,advertisements.title,advertisements.ads_email,advertisements.ads_phone,advertisements.duration,advertisements.unique_id,advertisements.status,advertisements_payment.payment_by,advertisements_payment.amount,advertisements_payment.payment_date', FALSE);
        $this->db->from('advertisements');
        $this->db->join('advertisements_payment', 'advertisements_payment.advertisement_id = advertisements.advertisements_id', 'left');
        $this->db->join('advertisement_plans', 'advertisement_plans.id =advertisements.advertisement_plans_id', 'left');
        $this->db->where('advertisements_payment.payment_by <>','');
        $this->db->where('advertisements_payment.trns_id <>','');
        $this->db->group_start();
        $this->db->like('advertisements.advertisements_id',$search)->or_like('advertisements.title',$search)->or_like('advertisements_payment.payment_by',$search)->or_like('advertisements_payment.amount',$search)->or_like('advertisements_payment.payment_date',$search);
        $this->db->group_end();
        $this->db->limit($limit,$start)->order_by('advertisements.advertisements_id');
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }


     function search_ads_allearnings_count($search)
    {
        $this->db->select('advertisements.advertisements_id,advertisements.title,advertisements.ads_email,advertisements.ads_phone,advertisements.duration,advertisements.unique_id,advertisements.status,advertisements_payment.payment_by,advertisements_payment.amount,advertisements_payment.payment_date', FALSE);
        $this->db->from('advertisements');
        $this->db->join('advertisements_payment', 'advertisements_payment.advertisement_id = advertisements.advertisements_id', 'left');
        $this->db->join('advertisement_plans', 'advertisement_plans.id =advertisements.advertisement_plans_id', 'left');
        $this->db->like('advertisements.advertisements_id',$search)->or_like('advertisements.title',$search)->or_like('advertisements_payment.payment_by',$search)->or_like('advertisements_payment.amount',$search)->or_like('advertisements_payment.payment_date',$search);
        $this->db->where('advertisements_payment.payment_by <>','');
        $this->db->where('advertisements_payment.trns_id <>','');
        $query = $this->db->get();
        return $query->num_rows();

    }

    function earning_search_count($table,$search)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.member_id,'.$table.'.package,'.$table.'.billing_cycle,'.$table.'.invoice_no,'.$table.'.amount,'.$table.'.status,'.$table.'.payment_process_date,'.$table.'.due_date,'.$table.'.next_billing_date, member.first_name AS member_first_name, member.last_name AS member_last_name', FALSE);
        $this->db->from($table);
        $this->db->join('member', 'member.member_id = '.$table.'.member_id', 'left');
        $this->db->like($table.'.amount',$search)->or_like($table.'.status',$search)->or_like($table.'.invoice_no',$search)->or_like('member.first_name',$search)->or_like('member.last_name',$search);
        $query = $this->db->get();

        return $query->num_rows();
    }



     function coverpic_allearnings($limit,$start,$col,$dir)
    {
        $this->db->select('cover_pic_payment.cover_pic_payment_id as payment_id,member.member_id,member.first_name,member.last_name,member.email,cover_pics.status,cover_pic_payment.payment_by,cover_pic_payment.amount,cover_pic_payment.payment_date,cover_pic_payment.trns_id,cover_pic_payment.payment_expire_date as expired_date', FALSE);
        $this->db->from('cover_pic_payment');
        $this->db->join('cover_pics', 'cover_pics.cover_pic_payment_id = cover_pic_payment.cover_pic_payment_id', 'left');
        $this->db->join('member', 'member.member_id =cover_pic_payment.member_id', 'left');
        $this->db->limit($limit,$start)->order_by('cover_pics.cover_pics_id');
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

     function search_coverpic_allearnings($limit,$start,$search,$col,$dir)
    {
        $this->db->select('cover_pic_payment.cover_pic_payment_id as payment_id,member.member_id,member.first_name,member.last_name,member.email,cover_pics.status,cover_pic_payment.payment_by,cover_pic_payment.amount,cover_pic_payment.payment_date,cover_pic_payment.trns_id,cover_pic_payment.payment_expire_date as expired_date', FALSE);
        $this->db->from('cover_pic_payment');
        $this->db->join('cover_pics', 'cover_pics.cover_pic_payment_id = cover_pic_payment.cover_pic_payment_id', 'left');
        $this->db->join('member', 'member.member_id =cover_pic_payment.member_id', 'left');
        $this->db->group_start();
        $this->db->like('cover_pic_payment.cover_pic_payment_id',$search)->or_like('member.first_name',$search)->or_like('member.last_name',$search)->or_like('cover_pic_payment.amount',$search)->or_like('cover_pic_payment.payment_date',$search)->or_like('cover_pic_payment.payment_by',$search);
        $this->db->group_end();
        $this->db->limit($limit,$start)->order_by('cover_pic_payment.cover_pic_payment_id');
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }


    function count_search_coverpic_allearnings($search)
    {
        $this->db->select('cover_pic_payment.cover_pic_payment_id as payment_id,member.first_name,member.last_name,member.email,cover_pics.status,cover_pic_payment.payment_by,cover_pic_payment.amount,cover_pic_payment.payment_date,cover_pic_payment.payment_expire_date as expired_date', FALSE);
        $this->db->from('cover_pic_payment');
        $this->db->join('cover_pics', 'cover_pics.cover_pic_payment_id = cover_pic_payment.cover_pic_payment_id', 'left');
        $this->db->join('member', 'member.member_id =cover_pic_payment.member_id', 'left');
        $this->db->group_start();
        $this->db->like('cover_pic_payment.cover_pic_payment_id',$search)->or_like('member.first_name',$search)->or_like('member.last_name',$search)->or_like('cover_pic_payment.amount',$search)->or_like('cover_pic_payment.payment_date',$search)->or_like('cover_pic_payment.payment_by',$search);
        $this->db->group_end();
        $query = $this->db->get();
        return $query->num_rows();

    }

    function allbillings($table,$limit,$start,$col,$dir,$member_id)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.member_id,'.$table.'.invoice_no,'.$table.'.package,'.$table.'.billing_cycle,'.$table.'.amount,'.$table.'.status,'.$table.'.payment_process_date,'.$table.'.due_date,'.$table.'.next_billing_date, member.first_name AS member_first_name, member.last_name AS member_last_name , member.mobile AS member_mobile , member.display_member AS member_display_id', FALSE);
        $this->db->from($table);
        $this->db->join('member', 'member.member_id = '.$table.'.member_id', 'left');
        $this->db->where($table.'.member_id', $member_id);
        $this->db->limit($limit,$start)->order_by($table.'.earning_id',$dir);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function billing_search($table,$limit,$start,$search,$col,$dir,$member_id)
    {
        $query = $this->db->query("SELECT
              earning.earning_id,
              earning.member_id,
              earning.invoice_no,
              earning.package,
              earning.billing_cycle,
              earning.amount,
              earning.status,
              earning.payment_process_date,
              earning.due_date,
              earning.next_billing_date,
              member.first_name AS member_first_name,
              member.last_name AS member_last_name,
              member.display_member AS member_display_id,
              member.mobile AS member_mobile
            FROM
              `earning`
              LEFT JOIN `member`
                ON `member`.`member_id` = `earning`.`member_id`
            WHERE `earning`.`member_id` = $member_id
              AND ( `earning`.`amount` LIKE '%$search%' ESCAPE '!'
              OR `earning`.`billing_cycle` LIKE '%$search%' ESCAPE '!'
              OR `earning`.`next_billing_date` LIKE '%$search%' ESCAPE '!')
            ORDER BY `earning`.`member_id`
            LIMIT 10")->result();

        if(count($query)>0)
        {
            return $query;
        }
        else
        {
            return null;
        }
    }

    function billing_search_count($table,$search,$member_id)
    {
        $query = $this->db->query("SELECT
              earning.earning_id,
              earning.member_id,
              earning.invoice_no,
              earning.package,
              earning.billing_cycle,
              earning.amount,
              earning.status,
              earning.payment_process_date,
              earning.due_date,
              earning.next_billing_date,
              member.first_name AS member_first_name,
              member.last_name AS member_last_name,
              member.display_member AS member_display_id,
              member.mobile AS member_mobile
            FROM
              `earning`
              LEFT JOIN `member`
                ON `member`.`member_id` = `earning`.`member_id`
            WHERE `earning`.`member_id` = $member_id
              AND ( `earning`.`amount` LIKE '%$search%' ESCAPE '!'
              OR `earning`.`billing_cycle` LIKE '%$search%' ESCAPE '!'
              OR `earning`.`next_billing_date` LIKE '%$search%' ESCAPE '!')
            ORDER BY `earning`.`member_id`
            LIMIT 10")->result();

        return count($query);
    }

    function allcontact_messages($table,$limit,$start,$col,$dir)
    {
        $this->db->select('*', FALSE);
        $this->db->from($table);
        $this->db->limit($limit,$start)->order_by($col,$dir);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function contact_message_search($table,$limit,$start,$search,$col,$dir)
    {
        $this->db->select('*', FALSE);
        $this->db->from($table);
        $this->db->like($table.'_id',$search)->or_like($table.'.name',$search)->or_like($table.'.subject',$search)->limit($limit,$start)->order_by($col,$dir);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function contact_message_search_count($table,$search)
    {
        $this->db->select('*', FALSE);
        $this->db->from($table);
        $this->db->like($table.'_id',$search)->or_like($table.'.name',$search)->or_like($table.'.subject',$search);
        $query = $this->db->get();

        return $query->num_rows();
    }

    function allstories($table,$limit,$start,$col,$dir)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.title, '.$table.'.image, '.$table.'.approval_status, '.$table.'.post_time,'. $table.'.partner_name, member.first_name AS member_name', FALSE);
        $this->db->from($table);
        $this->db->join('member', 'member.member_id = '.$table.'.posted_by', 'left');
        $this->db->limit($limit,$start)->order_by($col,$dir);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function story_search($table,$limit,$start,$search,$col,$dir)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.title, '.$table.'.image, '.$table.'.approval_status, '.$table.'.post_time,'. $table.'.partner_name, member.first_name AS member_name', FALSE);
        $this->db->from($table);
        $this->db->join('member', 'member.member_id = '.$table.'.posted_by', 'left');
        $this->db->like($table.'_id',$search)->or_like($table.'.title',$search)->or_like($table.'.partner_name',$search)->or_like('member.first_name',$search)->limit($limit,$start)->order_by($col,$dir);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function story_search_count($table,$search)
    {
        $this->db->select(''.$table.'.'.$table.'_id, '.$table.'.title, '.$table.'.image, '.$table.'.approval_status, '.$table.'.post_time,'. $table.'.partner_name, member.first_name AS member_name', FALSE);
        $this->db->from($table);
        $this->db->join('member', 'member.member_id = '.$table.'.posted_by', 'left');
        $this->db->like($table.'_id',$search)->or_like($table.'.title',$search)->or_like($table.'.partner_name',$search)->or_like('member.first_name',$search);
        $query = $this->db->get();

        return $query->num_rows();
    }

    function allchats($table,$limit,$start,$col,$dir)
    {
        $this->db->select('im_message.m_id,im_message.sender as message_from,im_message.receiver,im_message.message as message_text,im_message.date_time as timezone_datetime,im_group_members.u_id as message_to');
        $this->db->from('im_message');
        $this->db->join('im_group_members','im_group_members.g_id =im_message.receiver','left');
        $this->db->where('im_group_members.u_id != im_message.sender');
        // $this->db->where('im_message.m_id',36);
        $this->db->limit($limit,$start)->order_by('im_message.m_id',$dir);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }
	
   function convertDisplayMember($s){
		   
		   return(int)preg_replace('/[^\-\d]*(\-?\d*).*/','$1',$s);
	 }

    function chats_search($table,$limit,$start,$search,$col,$dir)
    {
		$coverted_number = $this->convertDisplayMember($search);
		
		if($coverted_number == 0){
			$sql = "CREATE OR REPLACE VIEW mytemp as SELECT `im_message`.`m_id`, `im_message`.`sender` as `message_from`, `im_message`.`receiver`, `im_message`.`message` as `message_text`, `im_message`.`date_time` as `timezone_datetime`, `im_group_members`.`u_id` as `message_to` FROM `im_message` JOIN `im_group_members` ON `im_group_members`.`g_id` =`im_message`.`receiver` WHERE `im_message`.`message` LIKE '%$search%' ORDER BY `im_message`.`m_id` DESC ";
		}else{
			$sql = "CREATE OR REPLACE VIEW mytemp as SELECT `im_message`.`m_id`, `im_message`.`sender` as `message_from`, `im_message`.`receiver`, `im_message`.`message` as `message_text`, `im_message`.`date_time` as `timezone_datetime`, `im_group_members`.`u_id` as `message_to` FROM `im_message` JOIN `im_group_members` ON `im_group_members`.`g_id` =`im_message`.`receiver` WHERE `im_message`.`message` LIKE '%$search%'  OR `im_message`.`sender` LIKE '%$coverted_number%'  OR `im_group_members`.`u_id` LIKE '%$coverted_number%'  ORDER BY `im_message`.`m_id` DESC ";
		}
		$this->db->query($sql);
		
		$query = $this->db->query("Select * from mytemp Where message_from != message_to limit $start,$limit ");

		//$D = $this->db->last_query();
		//echo "<pre>";print_r($D);die();
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
        
    }

    function chats_search_count($table,$search)
    {
        $this->db->select('im_message.m_id,im_message.sender as message_from,im_message.receiver,im_message.message as message_text,im_message.date_time as timezone_datetime,im_group_members.u_id as message_to');
        $this->db->from('im_message');
        $this->db->join('im_group_members','im_group_members.g_id =im_message.receiver','left');
        $this->db->where('im_group_members.u_id != im_message.sender');
        $this->db->like('im_message.sender',$search)->or_like('im_group_members.u_id',$search)->or_like('im_message.message',$search)->or_like('im_group_members.display_member',$search);
        // $this->db->where('im_message.m_id',36);
        $this->db->group_by('im_message.m_id');
        $query = $this->db->get();

        return $query->num_rows();
    }

    function get_listed_messaging_members($member_id)
    {
        $message_array1 = array();
        $message_array2 = array();

        // $message_list1 = $this->db->select(' mt.message_thread_from AS list')
        // ->select('message_thread_id')
        // ->select('message_thread_time');
        // //$message_list2 = $this->db->join('member AS mem', 'mt.message_thread_from = mem.member_id  AND mem.membership = 2');
        // $message_list1 = $this->db->join('member AS mem1', 'mt.message_thread_to = mem1.member_id AND (mem1.membership = 1 OR mem1.membership = 2)')
        // ->get_where('message_thread AS mt', array('mt.message_thread_to' => $member_id,'mt.thread_viewable_to' => 1))->result();

        // $message_list2 = $this->db->select(' mt.message_thread_to AS list')
        // ->select('message_thread_id')
        // ->select('message_thread_time');
        // //$message_list2 = $this->db->join('member AS mem', 'mt.message_thread_from = mem.member_id  AND mem.membership = 2');
        // $message_list2 = $this->db->join('member AS mem1', 'mt.message_thread_to = mem1.member_id AND (mem1.membership = 1 OR mem1.membership = 2)')
        // ->get_where('message_thread AS mt', array('mt.message_thread_from' => $member_id,'mt.thread_viewable_from' => 1))->result();

        $message_list1 = $this->db->select(' mt.message_thread_from AS list')
        ->select('message_thread_id')
        ->select('message_thread_timezone');
        //$message_list2 = $this->db->join('member AS mem', 'mt.message_thread_from = mem.member_id  AND mem.membership = 2');
        $message_list1 = $this->db->join('member AS mem1', 'mt.message_thread_to = mem1.member_id')
        ->get_where('message_thread AS mt', array('mt.message_thread_to' => $member_id,'mt.thread_viewable_to' => 1))->result();

        $message_list2 = $this->db->select(' mt.message_thread_to AS list')
        ->select('message_thread_id')
        ->select('message_thread_timezone');
        //$message_list2 = $this->db->join('member AS mem', 'mt.message_thread_from = mem.member_id  AND mem.membership = 2');
        $message_list2 = $this->db->join('member AS mem1', 'mt.message_thread_to = mem1.member_id')
        ->get_where('message_thread AS mt', array('mt.message_thread_from' => $member_id,'mt.thread_viewable_from' => 1))->result();

        
        foreach ($message_list1 as $list1) {
            // $message_array1[] = $list1->list;

             //take out the member ID & compare with deleted member table
            $this->db->select('member_id');
            $this->db->from('deleted_member');
            $this->db->where('member_id', $list1->list);
            $row = $this->db->get()->row();

            // if (!isset($row)){

                $message_array1[] = array('message_thread_id' => $list1->message_thread_id, 'member_id' => $list1->list, 'message_thread_time' => $list1->message_thread_timezone);
            // }
        }
        foreach ($message_list2 as $list2) {
                 //take out the member ID & compare with deleted member table
            $this->db->select('member_id');
            $this->db->from('deleted_member');
            $this->db->where('member_id', $list2->list);
            $row = $this->db->get()->row();

            // if (!isset($row)){

                $message_array2[] = array('message_thread_id' => $list2->message_thread_id, 'member_id' => $list2->list, 'message_thread_time' => $list2->message_thread_timezone);
            // }
        }

  
			$listed_messaging_members = array_unique (array_merge ($message_array1, $message_array2), SORT_REGULAR);
	//	print_r($listed_messaging_members);
		return $listed_messaging_members;
    }

    function getMessageCount($member_id)
    {
        // $counter = $this->db->query("SELECT COUNT(message_thread_id) AS messageCount FROM message_thread AS mt
        //     INNER JOIN member AS mem ON mt.message_thread_from = mem.member_id AND mem.membership = 2
        //     INNER JOIN member AS mem1 ON mt.message_thread_to = mem1.member_id AND mem1.membership = 2 
        //     WHERE (message_to_seen = '' AND message_thread_to = $member_id) OR (message_from_seen = '' AND message_thread_from = $member_id)")->result_array();

        $counter = $this->db->query("SELECT COUNT(message_thread_id) AS messageCount FROM message_thread AS mt
            INNER JOIN member AS mem ON mt.message_thread_from = mem.member_id AND mem.membership != 1
            INNER JOIN member AS mem1 ON mt.message_thread_to = mem1.member_id
            WHERE (message_to_seen = '' AND message_thread_to = $member_id) OR (message_from_seen = '' AND message_thread_from = $member_id)")->result_array();

        return $counter[0]['messageCount'];
    }

    function allsite_language($table,$limit,$start,$col,$dir)
    {
        $query = $this->db->limit($limit,$start)->order_by($col,$dir)->get($table);
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function site_language_search($table,$limit,$start,$search,$col,$dir)
    {
        $query = $this->db->like('word',$search)->limit($limit,$start)->order_by($col,$dir)->get($table);


        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    function site_language_search_count($table,$search)
    {
        $query = $this->db->like('word',$search)->get($table);

        return $query->num_rows();
    }

    function message_thread_member_position($thread_id,$member){
        $from = $this->db->get_where('message_thread',array('message_thread_id'=>$thread_id,'message_thread_from'=>$member))->num_rows();
        $to = $this->db->get_where('message_thread',array('message_thread_id'=>$thread_id,'message_thread_to'=>$member))->num_rows();
        if($from > 0){
            return 'from';
        } else if($to > 0){
            return 'to';
        }
    }

    function is_message_thread_seen($thread_id,$member){
        $position = $this->message_thread_member_position($thread_id,$member);
        $position_db_field = 'message_'.$position.'_seen';
        $seen = $this->db->get_where('message_thread', array('message_thread_id' => $thread_id))->row()->$position_db_field;
        if($seen == 'yes'){
            return true;
        }
        return false;
    }
}