<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Barang_asal extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_asal_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q     = urldecode($this->input->get('q', true));
        $start = intval($this->input->get('start'));

        if ($q != '') {
            $config['base_url']  = base_url() . 'barang_asal/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'barang_asal/index?q=' . urlencode($q);
        } else {
            $config['base_url']  = base_url() . 'barang_asal/index';
            $config['first_url'] = base_url() . 'barang_asal/index';
        }

        $config['per_page']          = 10;
        $config['page_query_string'] = true;
        $config['total_rows']        = $this->Barang_asal_model->total_rows($q);
        $config['attributes']        = array('class' => 'page-link');
        $barang_asal                 = $this->Barang_asal_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'barang_asal_data' => $barang_asal,
            'q'                => $q,
            'pagination'       => $this->pagination->create_links(),
            'total_rows'       => $config['total_rows'],
            'start'            => $start,
        );
        $this->render_view('barang_asal/barang_asal_list', $data);
    }

    public function load()
    {
        $start  = urldecode($this->input->post('start', true));
        $length = urldecode($this->input->post('length', true));
        $search = urldecode($this->input->post('search[value]', true));
        // $pph    = urldecode($this->input->post('pph', true)) ?? null;
        // $tahun                    = urldecode($this->input->post('tahun', true)) ?? null;
        // $perusahaan               = urldecode($this->input->post('perusahaan', true)) ?? null;
        // $status                   = urldecode($this->input->post('status', true)) ?? null;
        $operasional              = $this->Barang_asal_model->get_limit_data_array($length, $start, $search);
        $get_all_data_operasional = $this->Barang_asal_model->get_all();
        $count_all_results        = count($operasional);
        $count_all_data           = count($get_all_data_operasional);

        foreach ($operasional as $pal) {

            $ngaray['nama'] = '';
            $ngaray['nama'] .= $pal->nama;

            $ngaray['inisial'] = '';
            $ngaray['inisial'] .= $pal->inisial;

            $ngaray['alamat'] = '';
            $ngaray['alamat'] .= $pal->alamat;

            $ngaray['skb'] = '';
            $ngaray['skb'] .= $pal->sk_brg;

            $ngaray['npwp'] = '';
            $ngaray['npwp'] .= $pal->npwp;

            $ngaray['pph'] = '';
            $ngaray['pph'] .= $pal->npwp ? 'Ya' : 'Tidak';

            $ngaray['total_pph'] = '';
            $ngaray['total_pph'] .= $pal->total_pph;

            $ngaray['tb'] = '';
            $ngaray['tb'] .= $pal->tarif_baru;

            $ngaray['tp'] = '';
            $ngaray['tp'] .= $pal->tarif_perpanjang;

            $ngaray['tr'] = '';
            $ngaray['tr'] .= $pal->tarif_revisi;

            //     $this->db->where('id', $pal['created_by']);
            //     $created_by = $this->db->get('users')->row()->username;
            //     if ($pal['operasional_status'] == 1) {
            //         $ngaray['status'] = '<span class="badge badge-info" data-toggle="tooltip" data-placement="right" title="" data-original-title="Dibuat oleh ' . $created_by . '">Active <i class="fas fa-cog fa-spin"></i></span>';
            //     }
            //     if ($pal['operasional_status'] == 2) {
            //         $ngaray['status'] = '<span class="badge badge-success faa-parent animated-hover" data-toggle="tooltip" data-placement="right" title="" data-original-title="Dibuat oleh ' . $created_by . '">Selesai <i class="fa fa-check faa-vertical faa-fast"></i></span>';
            //     }
            //     if ($pal['operasional_status'] == 3) {
            //         $ngaray['status'] = '<span class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="Dibuat oleh ' . $created_by . '">Arsip</span>';
            //     }
            //     $this->db->where('operasional', $pal['id']);
            //     $this->db->where('status', 1);
            //     $count_new = $this->db->get('permohonan')->result();
            //     $count_new = count($count_new) ?? 0;

            //     $this->db->where('operasional', $pal['id']);
            //     $this->db->where('status', 2);
            //     $count_pan = $this->db->get('permohonan')->result();
            //     $count_pan = count($count_pan) ?? 0;

            //     $this->db->where('operasional', $pal['id']);
            //     $this->db->where('status', 3);
            //     $count_rev = $this->db->get('permohonan')->result();
            //     $count_rev = count($count_rev) ?? 0;

            //     $this->db->where('operasional', $pal['id']);
            //     $this->db->where('status', 4);
            //     $count_can = $this->db->get('permohonan')->result();
            //     $count_can = count($count_can) ?? 0;

            //     $ngaray['status'] .= '<br>';
            //     $ngaray['status'] .= '<span class="ml-n2 text-left badge btn-outline-secondary"><span class="badge badge-light">' . $count_new . '</span> Baru<br>';
            //     $ngaray['status'] .= '<span class="badge badge-light">' . $count_pan . '</span> Perpanjang<br>';
            //     $ngaray['status'] .= '<span class="badge badge-light">' . $count_rev . '</span> Revisi<br>';
            //     $ngaray['status'] .= '<span class="badge badge-light">' . $count_can . '</span> Batal</span>';
            //     $ngaray['id']          = $pal['id'];
            //     $ngaray['operasional'] = '<code>' . date('h:i:s') . ' ' . $this->Reza_model->tanggal_indo(date('Y-m-d', strtotime($pal['updated_at'])), true) . '</code><h5 class="card-title mt-2"><a href="' . base_url() . 'kegiatan/permohonan/' . $pal['id'] . '" class="link">' . $pal['nama'] . '</a></h5><h6 class="card-subtitle">' . $pal['keterangan'] . '</h6>';

            //     $this->db->where('id', $pal['barang_asal']);
            //     $barang_asal = $this->db->get('barang_asal')->row();
            //     $this->db->where('id', $pal['barang_pemilik']);
            //     $barang_pemilik = $this->db->get('barang_pemilik')->row();
            //     $this->db->where('id', $pal['perusahaan']);
            //     $perusahaan = $this->db->get('perusahaan')->row();

            //     $ngaray['deskripsi']  = '<b>Asal barang :</b> ' . $barang_asal->nama . '<br>' . '<b>Pemilik Barang :</b> ' . $barang_pemilik->nama . '<br>' . '<b>Perusahaan :</b> ' . $perusahaan->nama . '<br>';
            //     $ngaray['keterangan'] = '<a href="' . base_url() . 'operasional/no/' . $pal['id'] . '" class="badge badge-info">Lihat</a>';
            //     $ngaray['keterangan'] .= '<a href="' . base_url() . 'operasional/update/' . $pal['id'] . '" class="ml-1 badge badge-warning">Edit</a>';
            //     $ngaray['keterangan'] .= '<a href="' . base_url() . 'operasional/delete/' . $pal['id'] . '" class="ml-1 badge badge-danger" onclick="return confirm(' . "'Apa kamu yakin ingin menghapus opersional ini?'" . ');">Hapus</a>';

            $bum[] = $ngaray;
        }
        $bum    = $bum ?? null;
        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $count_all_data,
            "recordsFiltered" => $count_all_results,
            "data"            => $bum,
        );

        echo json_encode($output);
    }

    public function read($id)
    {
        $row = $this->Barang_asal_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id'               => $row->id,
                'nama'             => $row->nama,
                'alamat'           => $row->alamat,
                'sk_brg'           => $row->sk_brg,
                'npwp'             => $row->npwp,
                'jenis'            => $row->jenis,
                'pph'              => $row->pph,
                'total_pph'        => $row->total_pph,
                'unix'             => $row->unix,
                'data_status'      => $row->data_status,
                'tarif_baru'       => $row->tarif_baru,
                'tarif_perpanjang' => $row->tarif_perpanjang,
                'tarif_revisi'     => $row->tarif_revisi,
                'created_at'       => $row->created_at,
                'updated_at'       => $row->updated_at,
            );
            $this->render_view('barang_asal/barang_asal_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_asal'));
        }
    }

    public function create()
    {
        $data = array(
            'button'           => 'Create',
            'action'           => site_url('barang_asal/create_action'),
            'id'               => set_value('id'),
            'nama'             => set_value('nama'),
            'alamat'           => set_value('alamat'),
            'sk_brg'           => set_value('sk_brg'),
            'npwp'             => set_value('npwp'),
            'jenis'            => set_value('jenis'),
            'pph'              => set_value('pph'),
            'total_pph'        => set_value('total_pph'),
            'unix'             => set_value('unix'),
            'data_status'      => set_value('data_status'),
            'tarif_baru'       => set_value('tarif_baru'),
            'tarif_perpanjang' => set_value('tarif_perpanjang'),
            'tarif_revisi'     => set_value('tarif_revisi'),
            'created_at'       => set_value('created_at'),
            'updated_at'       => set_value('updated_at'),
        );
        $this->render_view('barang_asal/barang_asal_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
                'nama'             => $this->input->post('nama', true),
                'alamat'           => $this->input->post('alamat', true),
                'sk_brg'           => $this->input->post('sk_brg', true),
                'npwp'             => $this->input->post('npwp', true),
                'jenis'            => $this->input->post('jenis', true),
                'pph'              => $this->input->post('pph', true),
                'total_pph'        => $this->input->post('total_pph', true),
                'unix'             => $this->input->post('unix', true),
                'data_status'      => $this->input->post('data_status', true),
                'tarif_baru'       => $this->input->post('tarif_baru', true),
                'tarif_perpanjang' => $this->input->post('tarif_perpanjang', true),
                'tarif_revisi'     => $this->input->post('tarif_revisi', true),
                'created_at'       => $this->input->post('created_at', true),
                'updated_at'       => $this->input->post('updated_at', true),
            );

            $this->Barang_asal_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('barang_asal'));
        }
    }

    public function update($id)
    {
        $row = $this->Barang_asal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'           => 'Update',
                'action'           => site_url('barang_asal/update_action'),
                'id'               => set_value('id', $row->id),
                'nama'             => set_value('nama', $row->nama),
                'alamat'           => set_value('alamat', $row->alamat),
                'sk_brg'           => set_value('sk_brg', $row->sk_brg),
                'npwp'             => set_value('npwp', $row->npwp),
                'jenis'            => set_value('jenis', $row->jenis),
                'pph'              => set_value('pph', $row->pph),
                'total_pph'        => set_value('total_pph', $row->total_pph),
                'unix'             => set_value('unix', $row->unix),
                'data_status'      => set_value('data_status', $row->data_status),
                'tarif_baru'       => set_value('tarif_baru', $row->tarif_baru),
                'tarif_perpanjang' => set_value('tarif_perpanjang', $row->tarif_perpanjang),
                'tarif_revisi'     => set_value('tarif_revisi', $row->tarif_revisi),
                'created_at'       => set_value('created_at', $row->created_at),
                'updated_at'       => set_value('updated_at', $row->updated_at),
            );
            $this->render_view('barang_asal/barang_asal_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_asal'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
                'nama'             => $this->input->post('nama', true),
                'alamat'           => $this->input->post('alamat', true),
                'sk_brg'           => $this->input->post('sk_brg', true),
                'npwp'             => $this->input->post('npwp', true),
                'jenis'            => $this->input->post('jenis', true),
                'pph'              => $this->input->post('pph', true),
                'total_pph'        => $this->input->post('total_pph', true),
                'unix'             => $this->input->post('unix', true),
                'data_status'      => $this->input->post('data_status', true),
                'tarif_baru'       => $this->input->post('tarif_baru', true),
                'tarif_perpanjang' => $this->input->post('tarif_perpanjang', true),
                'tarif_revisi'     => $this->input->post('tarif_revisi', true),
                'created_at'       => $this->input->post('created_at', true),
                'updated_at'       => $this->input->post('updated_at', true),
            );

            $this->Barang_asal_model->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('barang_asal'));
        }
    }

    public function delete($id)
    {
        $row = $this->Barang_asal_model->get_by_id($id);

        if ($row) {
            $this->Barang_asal_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('barang_asal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_asal'));
        }
    }

    public function rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('sk_brg', 'sk brg', 'trim|required');
        $this->form_validation->set_rules('npwp', 'npwp', 'trim|required');
        $this->form_validation->set_rules('jenis', 'jenis', 'trim|required|numeric');
        $this->form_validation->set_rules('pph', 'pph', 'trim|required|numeric');
        $this->form_validation->set_rules('total_pph', 'total pph', 'trim|required|numeric');
        $this->form_validation->set_rules('unix', 'unix', 'trim|required');
        $this->form_validation->set_rules('data_status', 'data status', 'trim|required|numeric');
        $this->form_validation->set_rules('tarif_baru', 'tarif baru', 'trim|required|numeric');
        $this->form_validation->set_rules('tarif_perpanjang', 'tarif perpanjang', 'trim|required|numeric');
        $this->form_validation->set_rules('tarif_revisi', 'tarif revisi', 'trim|required|numeric');
        $this->form_validation->set_rules('created_at', 'created at', 'trim|required');
        $this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Barang_asal.php */
/* Location: ./application/controllers/Barang_asal.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-10 10:55:45 */
/* http://harviacode.com */