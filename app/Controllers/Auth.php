<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function register()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            dd($this->request->getPost()); // Harus tampil kalau form benar-benar terkirim
        }

        return view('auth/register');
    }

    public function tesDebug()
    {
        if ($this->request->getMethod() === 'post') {
            dd('POST MASUK');
        }

        echo '<form method="post" action="' . site_url('tesdebug') . '">
            <input type="text" name="coba" />
            <button type="submit">Tes</button>
        </form>';
    }
}
