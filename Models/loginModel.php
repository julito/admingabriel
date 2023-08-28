<?php

class loginModel
{

    static public function CURLs($url, $data = '', $metodo = 'GET')
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $metodo,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
        ));

        $json_response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($json_response);

        $data = $response;
        return $data;
    }

    static public function login()
    {
        $user = funcionesController::getPost('email');
        $pass = funcionesController::getPost('password');
        if ($user && $pass) {
            $data = "email_user={$user}&password_user={$pass}";
            $data = loginModel::CURLs(API_CONCIERGE . 'users?login=true', $data, 'POST');
            if ($data->status == 400) {
                echo '<br>
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <strong>' . var_dump($data->results) . '!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                ';
                return false;
            }
            else
            {
                $item=$data->results;
               // var_dump($item);
                sessionController::set('rol',$item[0]->rol_user);
                sessionController::set('autenticado',true);
                
            }
        } else
            return false;
    }
}
