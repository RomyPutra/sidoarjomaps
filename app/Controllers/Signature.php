<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use Config\Services;
use App\Models\Auth_model;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class Signature extends BaseController
{
    public function __construct()
    {
        $this->validation =  Services::validation();
        $this->auth_model = new Auth_model();
    }
    
    public function index()
    {
        $data['subview'] = 'signature/index';
        $data['jscript'] = 'signature/js';
        return view('main_layout', $data);
    }

    public function ajaxsignature()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $records = $this->auth_model->getDatatables($request);
            $data = [];
            $no = $request->getPost('start');
            // log_message('info', 'ajax: '.$this->db->getLastQuery());
            // log_message('info', 'ajax: '.print_r($records, TRUE));

            foreach($records as $record){
                $no++;
                $data[] = array( 
                    $no,
                    $record->username,
                    $record->level,
                    $record->signature,
                    $record->signature !== null ? '<a href="'.base_url('signature/download/').$record->id.'" target="_blank" class="btn custom-button btn-sm" title="Download"><i class="fa fa-download"></i></a>' : '',
                ); 
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->auth_model->countAll(),
                'recordsFiltered' => $this->auth_model->countFiltered($request),
                'data' => $data
            ];

            $output[$csrfName] = $csrfHash; 
            echo json_encode($output);
        }
    }

    public function download($id)
    {
        $data = $this->auth_model->getData($id)[0];
        // log_message('info', 'download: '.print_r($data, TRUE));

        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create(base_url().'public/uploads/signature/'.$data->signature)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // Create generic logo
        $logo = Logo::create(ROOTPATH.'public/adminlte/dist/img/150x150.png')
            ->setResizeToWidth(15);

        // Create generic label
        $label = Label::create('Laporan PertanggungJawaban')
            ->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, $logo, $label);
        $result->saveToFile(ROOTPATH.'public/uploads/qrcode/'.$id.'.png');

        return $this->response->download(ROOTPATH.'public/uploads/qrcode/'.$id.'.png', null);
    }

}