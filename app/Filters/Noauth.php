<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Noauth implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedIn')) {

			if (session()->get('role') == "admin") {
				return redirect()->to(base_url('admin'));
			}

            if (session()->get('role') == "gestor") {
				return redirect()->to(base_url('gestor'));
			}

			if (session()->get('role') == "user") {
				return redirect()->to(base_url('user'));
			}

            if (session()->get('role') == "bradesco_panel") {
				return redirect()->to(base_url('bradesco_panel'));
			}

			if (session()->get('role') == "leva_traz_panel") {
				return redirect()->to(base_url('leva_traz_panel'));
			}

            if (session()->get('role') == "cestou_cadastro") {
				return redirect()->to(base_url('cestou_cadastro'));
			}
            
            if (session()->get('role') == "Caixa") {
				return redirect()->to(base_url('Caixa'));
			}
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
