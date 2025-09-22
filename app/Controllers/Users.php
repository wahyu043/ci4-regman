<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Users extends Controller
{

    private function getApi($url, $method = 'GET', $payload = null)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // handle POST/PUT/DELETE
        if ($method !== 'GET') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            if ($payload) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($payload)
                ]);
            }
        }

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // fallback kalau gagal
        if ($response === false || $httpcode >= 400) {
            if ($method === 'GET') {
                $response = @file_get_contents($url);
            } else {
                // fallback untuk POST/PUT/DELETE
                $opts = [
                    'http' => [
                        'method'  => $method,
                        'header'  => "Content-Type: application/json\r\n",
                        'content' => $payload ?: ''
                    ]
                ];
                $context = stream_context_create($opts);
                $response = @file_get_contents($url, false, $context);
            }
        }

        return $response;
    }


    public function list()
    {
        $apiResponse = $this->getApi("https://reqres.in/api/users?page=1");
        $usersApi = [];

        if ($apiResponse) {
            $data = json_decode($apiResponse, true);
            $usersApi = $data['data'] ?? [];
        }

        $session = session();
        $activeUser = $session->get('user') ?? [];

        return view('users/list', [
            'users'      => $usersApi,
            'activeUser'  => $activeUser
        ]);
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

    public function editForm($id)
    {
        $response = $this->getApi("https://reqres.in/api/users/" . $id);
        $data = json_decode($response, true);

        $data['user'] = $data['data'] ?? null;

        if (!$data['user']) {
            return redirect()->to('/users/list')->with('error', 'User tidak ditemukan.');
        }

        return view('users/edit', $data);
    }

    public function update($id)
    {
        $name = $this->request->getPost('name');
        $job  = $this->request->getPost('job');

        $payload = json_encode(['name' => $name, 'job' => $job]);

        $ch = curl_init("https://reqres.in/api/users/" . $id);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        ]);

        $result = curl_exec($ch);
        curl_close($ch);

        if ($result) {
            return redirect()->to('/users/list')->with('success', 'User berhasil diupdate!');
        } else {
            return redirect()->to('/users/list')->with('error', 'Gagal update user.');
        }
    }

    public function delete($id)
    {
        // Delay 3 detik sesuai soal
        sleep(3);

        $url = "https://reqres.in/api/users/" . $id;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode == 204) {
            session()->setFlashdata('success', 'User berhasil dihapus (ID: ' . $id . ').');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus user (ID: ' . $id . ').');
        }

        return redirect()->to('/users/list');
    }
}
