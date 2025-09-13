<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Users extends Controller
{
    public function list()
    {
        $session = session();
        $localUser = $session->get('user');

        $allUsers = [];

        try {
            // ambil data langsung pakai file_get_contents
            $json = file_get_contents('https://reqres.in/api/users?page=1');
            $users = json_decode($json, true);

            $allUsers = $users['data'] ?? [];

            // tambahkan user dari session di paling atas
            if ($localUser) {
                $allUsers = array_merge([[
                    'id'         => 'local',
                    'email'      => $localUser['email'],
                    'first_name' => explode('@', $localUser['email'])[0],
                    'last_name'  => '',
                    'avatar'     => 'https://fastly.picsum.photos/id/1/5000/3333.jpg?hmac=Asv2DU3rA_5D1xSe22xZK47WEAN0wjWeFOhzd13ujW4'
                ]], $allUsers);
            }

            return view('users/list', [
                'users' => $allUsers,
                'error' => null
            ]);
        } catch (\Exception $e) {
            return view('users/list', [
                'users' => [],
                'error' => 'Gagal mengambil data: ' . $e->getMessage()
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
                'header'  => "Content-Type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
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
        $id = $response['id'] ?? null;

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
