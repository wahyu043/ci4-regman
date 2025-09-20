<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function register()
    {
        helper(['form']);
        return view('auth/register');
    }

    public function processRegister()
    {
        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|regex_match[/@rumahweb\.co\.id$/]',
                'errors' => [
                    'regex_match' => 'Email harus menggunakan domain @rumahweb.co.id'
                ]
            ],
            'password' => [
                'label' => 'Password',
                // cek min 12, ada huruf besar, kecil, angka, simbol
                'rules' => 'required|min_length[12]'
                    . '|regex_match[/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).+/]',
                'errors' => [
                    'regex_match' => 'Password harus mengandung huruf kapital, huruf kecil, angka, dan simbol.'
                ]
            ],
            'birthdate' => [
                'label' => 'Tanggal Lahir',
                'rules' => 'required|valid_date[Y-m-d]|check_age',
                'errors' => [
                    'check_age' => 'Usia minimal 17 tahun untuk registrasi.'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            return view('auth/register', [
                'validation' => $this->validator
            ]);
        }

        // kalau valid → simpan session sementara
        $session = session();
        $session->set([
            'user' => [
                'name'  => explode('@', $this->request->getVar('email'))[0],
                'email' => $this->request->getVar('email'),
            ],
            'logged_in' => true
        ]);

        return redirect()->to('/users/list')->with('success', 'Registrasi berhasil!');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/register')->with('success', 'Logout berhasil!');
    }
}
