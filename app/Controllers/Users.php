<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Users extends Controller
{
    public function list()
    {
        $session    = session();
        $localUser  = $session->get('user');
        $allUsers   = [];

        try {
            // Ambil user dari API
            $client   = \Config\Services::curlrequest();
            $response = $client->get('https://reqres.in/api/users?page=1');
            $result   = json_decode($response->getBody(), true);
            $apiUsers = $result['data'] ?? [];

            // Simpan user aktif terpisah
            $activeUser = null;
            if ($localUser && isset($localUser['email'])) {
                $activeUser = [
                    'name'  => ucfirst(explode('@', $localUser['email'])[0]),
                    'email' => $localUser['email'],
                ];
            }

            $allUsers = $apiUsers;

            return view('users/list', [
                'users'      => $allUsers,
                'activeUser' => $activeUser,
                'error'      => null
            ]);
        } catch (\Exception $e) {
            return view('users/list', [
                'users'      => [],
                'activeUser' => null,
                'error'      => 'Gagal mengambil data: ' . $e->getMessage()
            ]);
        }
    }


    public function createForm()
    {
        return view('users/create');
    }

    public function create()
    {
        $name = $this->request->getPost('name');
        $job  = $this->request->getPost('job');

        try {
            $data = ['name' => $name, 'job' => $job];

            $options = [
                'http' => [
                    'header'        => "Content-Type: application/json\r\n",
                    'method'        => 'POST',
                    'content'       => json_encode($data),
                    'ignore_errors' => true
                ]
            ];

            $context  = stream_context_create($options);
            $result   = file_get_contents('https://reqres.in/api/users', false, $context);

            if ($result === false) {
                session()->setFlashdata('error', 'Gagal membuat user (stream gagal)');
                return redirect()->to('/users/create');
            }

            $response = json_decode($result, true);
            $id       = $response['id'] ?? null;

            if ($id) {
                session()->setFlashdata('success', 'User berhasil dibuat dengan ID: ' . $id);
            } else {
                session()->setFlashdata('success', 'User berhasil dibuat, tapi ID tidak tersedia');
            }

            return redirect()->to('/users/list');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Exception: ' . $e->getMessage());
            return redirect()->to('/users/create');
        }
    }
}
