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
                'rules' => 'required|min_length[12]|regex_match[/[A-Z]/]|regex_match[/[a-z]/]|regex_match[/[0-9]/]|regex_match[/[^a-zA-Z0-9]/]',
                'errors' => [
                    'regex_match' => 'Password harus mengandung huruf kapital, kecil, angka, dan simbol.'
                ]
            ],
            'birthdate' => [
                'label' => 'Tanggal Lahir',
                'rules' => 'required|check_age',
                'errors' => [
                    'check_age' => 'Usia minimal 17 tahun.'
                ]
            ]
        ];

        if (! $validation->setRules($rules)->withRequest($this->request)->run()) {
            return view('auth/register', [
                'validation' => $validation
            ]);
        }

        $session = session();
        $session->set('user', [
            'email' => $this->request->getPost('email'),
            'birthdate' => $this->request->getPost('birthdate')
        ]);

        return redirect()->to('/register')->with('success', 'Registrasi berhasil!');
    }

    public function listUsers()
    {
        helper(['form']);

        // Gunakan HTTP client bawaan CodeIgniter
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->get('https://reqres.in/api/users?page=1');
            $result = json_decode($response->getBody(), true);

            return view('users/list', ['users' => $result['data'] ?? []]);
        } catch (\Exception $e) {
            return view('users/list', ['users' => [], 'error' => $e->getMessage()]);
        }
    }
}
