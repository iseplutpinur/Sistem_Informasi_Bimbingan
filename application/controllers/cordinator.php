<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cordinator extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('auth');
        }
    }
    public function index()
    {
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_1', $data);
        $this->load->view('cordinator/index', $data);
        $this->load->view('templates/footer');
    }



    public function buku_pedoman()
    {
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_1', $data);
        $this->load->view('cordinator/buku_pedoman', $data);
        $this->load->view('templates/footer');
    }



    public function templet_laporan_proyek()
    {
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_1', $data);
        $this->load->view('cordinator/templet_laporan_proyek', $data);
        $this->load->view('templates/footer');
    }



    public function informasi_dosen_pembimbing()
    {
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_1', $data);
        $this->load->view('cordinator/informasi_dosen_pembimbing', $data);
        $this->load->view('templates/footer');
    }



    public function registration()
    {

        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];


        if ($data) {
            $query = 'select * from user order by data_id DESC LIMIT 1';
            $data_id = $this->db->query($query)->row_array();
            $id = $data_id['data_id'];
            $i = (int)$id + 1;
            $data1 = [
                'NIK' => $this->input->post('NIK', true),
                'name' => $this->input->post('name', true),
                'email' => $this->input->post('email', true),
                'dos_id' => $i

            ];
            $data2 = [
                'user_id' => $this->input->post('user_id', true),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'data_id' => $i,
                'dos_id' => $i,
                'date_created' => time()
            ];



            $this->db->insert('admin', $data1);
            $this->db->insert('user', $data2);
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            data berhasisl di tambahkan
            </div>');
            redirect('cordinator/informasi_dosen_pembimbing');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            data gagal di tambahkan
            </div>');
            redirect('cordinator/informasi_dosen_pembimbing');
        }
    }



    public function edit($id)
    {
        $mhs2 = "SELECT * FROM user JOIN admin
                ON user . dos_id  = admin . dos_id
        WHERE user . role_id = 2 AND admin . dos_id = $id ";
        // var_dump($mhs2);
        // die;
        $data['mhs'] = $this->db->query($mhs2)->row_array();
        $data['title'] = 'Menu Buku Pedoman';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];
        $m = $this->db->get_where('user', ['user_id'])->row_array();

        if ($data) {
            $NIK = $this->input->post('NIK');
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            // $user_id = $this->input->post('user_id');
            // $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);


            $this->db->set('NIK', $NIK);
            $this->db->set('name', $name);
            $this->db->set('email', $email);
            $this->db->set('email', $email);
            // $this->db->set('user_id', $user_id);
            // $this->db->set('password', $password);
            $this->db->where('dos_id', $id);
            // $this->db->update('user');
            $this->db->update('admin');
            // $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            // data berhasisl di ubah
            // </div>');
            redirect('cordinator/informasi_dosen_pembimbing');
        }
    }



    public function hapus($id)
    {
        $mhs2 = "SELECT * FROM user JOIN admin
                ON user . dos_id  = admin . dos_id
        WHERE user . role_id = 2 AND admin . dos_id = $id ";
        $data['mhs'] = $this->db->query($mhs2)->row_array();
        // var_dump($data);
        // die;
        $data['title'] = 'Menu Buku Pedoman';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];
        $m = $this->db->get_where('user', ['user_id'])->row_array();
        if ($data) {

            $this->db->where('dos_id', $id);
            $this->db->delete('admin');
            redirect('dosen/informasi_dosen_pembimbing');
        }
    }




    public function pembagian_pembimbing()
    {
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_1', $data);
        $this->load->view('cordinator/pembagian_pembimbing', $data);
        $this->load->view('templates/footer');
    }



    public function pembagian_pembimbing_tambah()
    {

        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        $data['admin'] = $this->db->get_where('admin', ['dos_id' =>
        $data['user']['dos_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];


        if ($data) {
            $mhs = $this->input->post('mhs_id[]', true);
            $dosen = $this->input->post('dos_id[]', true);
            $jumlah = count($dosen);
            // var_dump($jumlah);
            // die;
            for ($i = 0; $i <= $jumlah; $i++) {
                $this->db->set('dos_id', $dosen[$i]);
                $this->db->set('mhs_id', $mhs[$i]);
                $this->db->insert('bimbingan');
            }

            // echo 'berhasil';
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            data berhasisl di tambahkan
            </div>');
            redirect('cordinator/pembagian_pembimbing');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            data gagal di tambahkan
            </div>');
            redirect('cordinator/pembagian_pembimbing');
        }
    }



    public function pembagian_pembimbing_edit()
    {

        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];


        if ($data) {


            $mhs_id = $this->input->post('mhs_id');
            $dos_id = $this->input->post('dos_id');




            $this->db->set('mhs_id', $mhs_id);
            $this->db->set('dos_id', $dos_id);
            $this->db->where('mhs_id', $data['bimbingan']['mhs_id']);
            $this->db->update('bimbingan');
            // echo 'berhasil';
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            data berhasisl di tambahkan
            </div>');
            redirect('cordinator/pembagian_pembimbing');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            data gagal di tambahkan
            </div>');
            redirect('cordinator/pembagian_pembimbing');
        }
    }



    public function Proposal_hasil()
    {
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_1', $data);
        $this->load->view('cordinator/Proposal_hasil', $data);
        $this->load->view('templates/footer');
    }



    public function tambah_proposal()
    {
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];


        if ($data) {
            $tanggal_pengumpulan_proposal = $this->input->post('tanggal_pengumpulan_proposal');
            $date = date_create($tanggal_pengumpulan_proposal);
            $tas = date_format($date, "d-F-Y");
            // $format_date = date_format($tanggal_pengumpulan, d - m - Y);
            // var_dump($format_date);
            // die;
            $this->db->set('tanggal_pengumpulan_proposal', $tas);
            $this->db->where('data_id', $data['user_data']['data_id']);
            $this->db->update('user_data');
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            wakatu berhasil di setel
            </div>');
            redirect('cordinator/Proposal_hasil');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            wakatu gagal di setel 
            </div>');
            redirect('cordinator/Proposal_hasil');
        }
    }



    public function detailproposal($id)
    {
        $mhs2 = "SELECT * FROM user JOIN user_data 
         ON user . data_id  = user_data . data_id
         WHERE user . role_id = 3 AND user . user_id = '" . $id . "' ";
        $data['mhs'] = $this->db->query($mhs2)->row_array();
        // var_dump($data['mhs']);
        // die;
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_1', $data);
        $this->load->view('cordinator/detailproposal', $data);
        $this->load->view('templates/footer');
    }



    public function laporan_hasil()
    {
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();

        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_1', $data);
        $this->load->view('cordinator/laporan_hasil', $data);
        $this->load->view('templates/footer');
    }



    public function tambah_laporan()
    {
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];


        if ($data) {
            $tanggal_pengumpulan_laporan = $this->input->post('tanggal_pengumpulan_laporan');
            $date = date_create($tanggal_pengumpulan_laporan);
            $tas = date_format($date, "d-F-Y");
            // $format_date = date_format($tanggal_pengumpulan, d - m - Y);
            // var_dump($format_date);
            // die;
            $this->db->set('tanggal_pengumpulan_laporan', $tas);
            $this->db->where('data_id', $data['user_data']['data_id']);
            $this->db->update('user_data');
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            data barhasil di tambahkan
            </div>');
            redirect('cordinator/laporan_hasil');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            data gagal di tambahkan
            </div>');
            redirect('cordinator/laporan_hasil');
        }
    }




    public function detaillaporan($id)
    {
        $mhs2 = "SELECT * FROM user JOIN user_data 
         ON user . data_id  = user_data . data_id
         WHERE user . role_id = 3 AND user . user_id = '" . $id . "' ";
        $data['mhs'] = $this->db->query($mhs2)->row_array();
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_1', $data);
        $this->load->view('cordinator/detaillaporan', $data);
        $this->load->view('templates/footer');
    }




    public function persensi_bimbingan()
    {
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_1', $data);
        $this->load->view('cordinator/persensi_bimbingan', $data);
        $this->load->view('templates/footer');
    }



    public function detailpresensi($id)
    {
        $mhs2 = "SELECT bimbingan.*, user.*, admin.*, user_data.*, berkas_bimbingan.* FROM bimbingan 
        JOIN user ON bimbingan . mhs_id = user . mhs_id 
        JOIN admin ON bimbingan . dos_id = admin . dos_id 
        JOIN user_data ON user . data_id = user_data . data_id  
        JOIN berkas_bimbingan ON user_data . berkas_bimbingan_id = berkas_bimbingan . berkas_bimbingan_id
         WHERE user . role_id = 3 AND user . user_id = '" . $id . "' ";
        $data['mhs'] = $this->db->query($mhs2)->row_array();
        $mhs1 = "SELECT bimbingan.*, user.*, admin.*, user_data.*, berkas_bimbingan.* FROM bimbingan 
        JOIN user ON bimbingan . mhs_id = user . mhs_id 
        JOIN admin ON bimbingan . dos_id = admin . dos_id 
        JOIN user_data ON user . data_id = user_data . data_id  
        JOIN berkas_bimbingan ON user_data . berkas_bimbingan_id = berkas_bimbingan . berkas_bimbingan_id
         WHERE user . role_id = 3 AND user . user_id = '" . $id . "' ";
        $data['mhs1'] = $this->db->query($mhs1)->result_Array();
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_1', $data);
        $this->load->view('cordinator/detailpresensi', $data);
        $this->load->view('templates/footer');
    }



    public function nilai_mahasiswa()
    {
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_1', $data);
        $this->load->view('cordinator/nilai_mahasiswa', $data);
        $this->load->view('templates/footer');
    }



    public function detailnilai()
    {
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_1', $data);
        $this->load->view('cordinator/detailnilai', $data);
        $this->load->view('templates/footer');
    }



    public function my_profile()
    {
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_1', $data);
        $this->load->view('cordinator/my_profile', $data);
        $this->load->view('templates/footer');
    }



    public function edit_my_profile()
    {
        $data['title'] = 'Menu Buku Pedoman';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];


        if ($data) {
            $name_cor = $this->input->post('name_cor');
            $NIK = $this->input->post('NIK');
            $email_cor = $this->input->post('email_cor');


            $this->db->set('name_cor', $name_cor);
            $this->db->set('NIK', $NIK);
            $this->db->set('email_cor', $email_cor);
            $this->db->where('user_id', $data['user']['user_id']);
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            data berhasil di ubah
            </div>');
            redirect('cordinator/my_profile');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            data gagal di ubah
            </div>');
            redirect('cordinator/my_profile');
        }
    }




    public function edit_profile()
    {
        $data['title'] = 'Menu cordinator';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_1', $data);
        $this->load->view('cordinator/edit_profile', $data);
        $this->load->view('templates/footer');
    }



    public function ubah_profile()
    {
        $data['title'] = 'Menu Buku Pedoman';
        $data['user'] = $this->db->get_where('user', ['user_id' =>
        $this->session->userdata('user_id')])->row_array();
        $data['user_data'] = $this->db->get_where('user_data', ['data_id' =>
        $data['user']['data_id']])->row_array();
        // echo 'Selamat data mahasiswa ' . $data['user']['name_mhs_1'] . ' dan ' . $data['user']['name_mhs_2'];


        if ($data) {
            $user_id = $this->input->post('user_id');
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);



            $this->db->set('user_id', $user_id);
            $this->db->set('password', $password);
            $this->db->where('user_id', $data['user']['user_id']);
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            data berhasil di ubah
            </div>');
            redirect('auth');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            data gagal di ubah
            </div>');
            redirect('auth');
        }
    }
}
