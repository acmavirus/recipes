<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends Admin_Controller
{
    public $common_model;
    public $users_model;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/common_model');
        $this->load->model('admin/users_model');
        $this->common_model = new common_model();
        $this->users_model = new users_model();
    }

    function index()
    {
        $data = array_merge([], $this->___root());
        if ($this->session->userdata('logged_in')) {
            $this->__loadadminview('admin/dashboard', $data);
        } else {
            $data = $this->login();
            $data['__head'] = $this->load->view("$this->template_admin/__head_login", $data, true);
            $data['__script'] = $this->load->view("$this->template_admin/__script_login", $data, true);
            $this->__loadadminview('admin/login', $data);
        };
    }
    function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('admin');
    }
    function validate()
    {
        // get codes
        $encrypted_email = $this->input->get('e');
        $validation_code = $this->input->get('c');

        // validate account
        $validated = $this->users_model->validate_account($encrypted_email, $validation_code);

        if ($validated) {
            $this->session->set_flashdata('message', lang('users msg validate_success'));
        } else {
            $this->session->set_flashdata('error', lang('users error validate_failed'));
        }

        redirect(base_url());
    }

    /**************************************************************************************
     * PRIVATE VALIDATION CALLBACK FUNCTIONS
     **************************************************************************************/

    private function login()
    {
        if ($this->session->userdata('logged_in')) {
            $logged_in_user = $this->session->userdata('logged_in');
            if ($logged_in_user['is_admin']) {
                redirect('admin');
            } else {
                redirect(base_url());
            }
        }

        // set form validation rules
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('username', lang('users input username_email'), 'required|trim|max_length[256]');
        $this->form_validation->set_rules('password', lang('users input password'), 'required|trim|max_length[72]|callback__check_login');

        if ($this->form_validation->run() == TRUE) {

            if ($this->session->userdata('redirect')) {
                // redirect to desired page
                $redirect = $this->session->userdata('redirect');
                $this->session->unset_userdata('redirect');
                redirect($redirect);
            } else {
                $logged_in_user = $this->session->userdata('logged_in');
                if ($logged_in_user['is_admin']) {
                    // redirect to admin dashboard
                    $view = "$this->template_admin/index";
                } else {
                    // redirect to landing page
                    redirect(base_url());
                }
            }
        }
    }
    /**
     * Verify the login credentials
     *
     * @param  string $password
     * @return boolean
     */
    function _check_login($password)
    {
        // limit number of login attempts
        $ok_to_login = $this->users_model->login_attempts();
        if ($ok_to_login) {
            $login = $this->users_model->login($this->input->post('username', TRUE), $password);

            if ($login) {
                $this->session->set_userdata('logged_in', $login);
                redirect(base_url('admin'));
            }

            $this->form_validation->set_message('_check_login', lang('users error invalid_login'));
            return FALSE;
        }

        $this->form_validation->set_message('_check_login', sprintf(lang('users error too_many_login_attempts'), $this->config->item('login_max_time')));
        return FALSE;
    }


    /**
     * Make sure username is available
     *
     * @param  string $username
     * @return int|boolean
     */
    function _check_username($username)
    {
        if ($this->users_model->username_exists($username)) {
            $this->form_validation->set_message('_check_username', sprintf(lang('users error username_exists'), $username));
            return FALSE;
        } else {
            return $username;
        }
    }


    /**
     * Make sure email is available
     *
     * @param  string $email
     * @return int|boolean
     */
    function _check_email($email)
    {
        if ($this->users_model->email_exists($email)) {
            $this->form_validation->set_message('_check_email', sprintf(lang('users error email_exists'), $email));
            return FALSE;
        } else {
            return $email;
        }
    }


    /**
     * Make sure email exists
     *
     * @param  string $email
     * @return int|boolean
     */
    function _check_email_exists($email)
    {
        if (!$this->users_model->email_exists($email)) {
            $this->form_validation->set_message('_check_email_exists', sprintf(lang('users error email_not_exists'), $email));
            return FALSE;
        } else {
            return $email;
        }
    }

    private function _login_logs()
    {


        $this->db->select('data,timestamp');
        $this->db->from('ci_sessions');
        $this->db->limit('4');
        $test = $this->db->get();

        $session_log = $test->result();

        $all_data = array();
        foreach ($session_log as $key => $value) {


            $session_logion_data = $value->data;  // your BLOB data who are a String

            // array where you put your "BLOB" resolved data

            $offset = 0;

            while ($offset < strlen($session_logion_data)) {
                if (!strstr(substr($session_logion_data, $offset), "|")) {
                    throw new Exception("invalid data, remaining: " . substr($session_logion_data, $offset));
                }
                $pos = strpos($session_logion_data, "|", $offset);
                $num = $pos - $offset;
                $varname = substr($session_logion_data, $offset, $num);
                $offset += $num + 1;
                $data = unserialize(substr($session_logion_data, $offset));
                $return_data[$varname] = $data;
                $offset += strlen(serialize($data));
            }

            if (($return_data['logged_in'])) {



                $all_data[$key] = $return_data['logged_in'];
            }

            $all_data[$key]['time'] =  $value->timestamp;
        }

        return $all_data;
    }

    private function _login_attempts()
    {

        $this->db->select('*');
        $this->db->from('admin_login_attempts');
        $this->db->order_by('attempt', 'DESC');
        $this->db->limit(2);
        $data = $this->db->get();

        return $data->result_array();
    }

    public function backup_db()
    {


        $base_name =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        $base_name_without_slash = str_replace('/', '', $base_name);
        $this->load->dbutil();

        $prefs = array(
            'format'      => 'zip',
            'filename'    => $base_name_without_slash . '.sql'
        );


        $backup = &$this->dbutil->backup($prefs);

        $db_name = 'db-backup-' . date("d-m-Y") . '.zip';
        $save = $db_name;

        $this->load->helper('file');
        write_file($save, $backup);


        $this->load->helper('download');
        force_download($db_name, $backup);
    }

    public function count_by_condtion($table)
    {
        return $this->db
            ->where('deleted', '0')
            ->count_all_results($table);
    }
}
